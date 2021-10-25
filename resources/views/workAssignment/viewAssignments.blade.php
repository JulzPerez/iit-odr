@extends('layouts.app', ['activePage' => 'assignments', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12">  
                @if(session()->get('success'))
                    <div class="alert alert-success">
                    {{ session()->get('success') }}  
                    </div>
                @endif
            </div>
        </div>
        <div class="row ">
            <div class="col-sm-12">  
                @if(session()->get('error'))
                    <div class="alert alert-danger">
                    {{ session()->get('error') }}  
                    </div>
                @endif
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">                
                <div class="card">
                    <div class="card-header"><h4><strong>View Assignments</strong></h4></div>
                    <div class="card-body">

                                    @if($assignments->isEmpty())
                                        <p class="text-danger">No record found.</p>                                
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th ><strong>#</strong></th>
                                                    <th ><strong>Requester</strong></th>
                                                    <th ><strong> Requested Document</strong></th>   
                                                    <th ><strong> Request Date</strong></th>                                                      
                                                    <th > <strong>Assigned to</strong></th>
                                                    <th ><strong> Work Status</strong></th>
                                                </tr>
                                            </thead>

                                            <tbody >
                                                @foreach($assignments as $key => $assignment)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <a href="{{ route('requester.show', $assignment->requestor_id) }}" >
                                                        {{ucfirst($assignment->first_name).' '.ucfirst($assignment->last_name)}}
                                                        
                                                        </a>
                                                    </td>
                                                    
                                                    <td style="text-align: center">
                                                    
                                                        {{$assignment->docName.' '.$assignment->docParticular}}
                                                        <br>                                                   
                                                   
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($assignment->request_date)->toDateTimeString()}}</td>
                                                    <td>{{$assignment->user_fullname}}</td>    

                                                    @if($assignment->work_status === 'completed')
                                                    <td >{{$assignment->work_status}} 
                                                    
                                                        <form action="{{ route('workAssignment.release',$assignment->request_id) }}" method="POST">
                                                            @csrf
                                                                <button type="submit" rel="tooltip" class="btn btn-secondary btn-small">
                                                                    <i class="material-icons">task_alt</i><b style="color:green">{{_('Released')}}</b>
                                                                </button>                                                       
                                                        </form>   
                                                    </td>
                                                    @else
                                                    <td >{{$assignment->work_status}}</td>
                                                    @endif                                        
                                                                                
                                                </tr>                            
                                                @endforeach
                                    @endif    
                                            </tbody>
                                        
                                        </table>
                    </div>              
                </div> 
            </div>       
        </div>  

 

    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">

        $('#fromDate').datepicker({  

        format: 'mm-dd-yyyy'

        });  

    </script>  
@endpush

