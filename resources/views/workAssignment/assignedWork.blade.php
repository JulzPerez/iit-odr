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
                    <div class="card-body">
                        
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <!-- <div class="card card-outline card-info">               
                                    <div class="card-body" > -->
                                    @if($requests->isEmpty() )
                                        <p class="text-danger">No requests assigned yet.</p>                                
                                    @else
                                        <table class="table table-sm table-condensed table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width:2%" class="text-center">#</th>
                                                    <th style="width:15%" class="text-center">Requester</th>
                                                    <th style="width:15%" class="text-center"> Requested Document</th>   
                                                    <th style="width:15%" class="text-center"> Request Date</th>  
                                                    
                                                    <!-- <th style="width:15%"> Payment Status</th> -->
                                                    <th style="width:25%" class="text-center"> Action</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody style="line-height: 0.75">
                                                @foreach($requests as $key => $request)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <a href="{{ route('requester.show', $request->requestor_id) }}" >
                                                        {{ucfirst($request->first_name).' '.ucfirst($request->last_name)}}
                                                        
                                                        </a>
                                                    </td>
                                                    <!-- <td>{{$request->docName.' '.$request->docParticular}}</td> -->
                                                    <td>
                                                    @if($request->filename != '')
                                                        <a href="{{ route('getFile', $request->filename) }}">
                                                            {{$request->docName.' '.$request->docParticular}}
                                                        </a>  
                                                    @else
                                                        {{$request->docName.' '.$request->docParticular}}                                          
                                                    @endif
                                                    </td>
                                                    <td>{{$request->created_at}}</td>
                                                   
                                                                                               
                                                    <td >
                                                        
                                                      
                                                        <form action="{{ route('workAssignment.complete',$request->request_id) }}" method="POST">
                                                        @csrf
                                                                <button type="submit" rel="tooltip" class="btn btn-success">
                                                                    <i class="material-icons">edit</i>Mark Completed
                                                                </button>                                                       
                                                        </form>

                                                        @if($request->thread_id === null)
                                                        <a href="{{ route('messages.create', [$request->request_id, $request->requestor_id] ) }}" >
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                                Create Message
                                                            </button>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('messages.show', $request->thread_id) }}" >
                                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                                Message
                                                            </button>
                                                        </a>
                                                        @endif
                                                       
                                                    </td>
                                                    
                                                                                
                                                </tr>                            
                                                @endforeach
                                    @endif    
                                            </tbody>
                                        
                                        </table>
                                    
                                <!--  </div>
                                </div> -->
                                <!-- /.card-body -->
                                
                                <!-- /.card -->
                            </div>
                        </div> 
                    
                        
                    </div>              
                </div> 
            </div>       
        </div>    

    </div>
</div>
@endsection