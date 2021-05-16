@extends('layouts.master')

@section('main_content')
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

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                       For Assessment                        

                       <!-- <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
                        <label class="btn bg-red active">
                            <input type="radio" name="pending" id="option1" autocomplete="off" checked> pending
                        </label>
                        <label class="btn bg-olive">
                            <input type="radio" name="scheduled" id="option2" autocomplete="off"> scheduled
                        </label> 
                        <label class="btn bg-yellow">
                            <input type="radio" name="assessed" id="option3" autocomplete="off"> assessed
                        </label> 
                        </div>   -->                       
                </div>
                
                <div class="card-body" >
                    
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%">#</th>
                                <th style="width:15%">Requester</th>
                                <th style="width:20%"> Requested Document</th>   
                                <th style="width:15%"> Request Date</th>  
                                <th style="width:15%"> Request Status</th>  
                                <th style="width:15%"> Payment Status</th>
                                <th style="width:15%"> Action</th>
                                
                            </tr>
                        </thead>
                      
                        <tbody style="line-height: 0.75">
                            @foreach($requests as $key => $request)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>
                                    <a href="{{ route('requester.show', $request->requestor_id) }}" >
                                    {{ucfirst($request->first_name).' '.ucfirst($request->last_name)}}</td>
                                       
                                    </a>
                                
                                <td>{{$request->docName.' '.$request->docParticular}}</td>
                                <td>{{$request->created_at}}</td>
                                <td>{{$request->request_status}} </td>
                                <td>{{$request->payment_status}} </td>

                                @if($request->request_status === 'pending')
                                    <td>
                                        <a href="{{ route('assessments.show', $request->request_id) }}" class="btn btn-primary btn-sm">
                                        Create Assessment
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                    </td>                            
                                @elseif($request->request_status === 'assessed')
                                    <td>
                                        <a href="{{ route('assessments.show', $request->request_id) }}" class="btn btn-info btn-sm">Re-Assess
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                    </td>
                                @endif
                                                            
                            </tr>                            
                            @endforeach
                        </tbody>
                    
                    </table>
                   
                </div>
            </div>
              <!-- /.card-body -->
              
            <!-- /.card -->
        </div>
    </div> 

</div>
@endsection