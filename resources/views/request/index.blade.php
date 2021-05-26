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
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="{{route('request.create') }}">
                        <button  type="button" class="btn btn-primary float-left">Create Request</button>
                    </a>
                
                    <form class="form-inline ml-3 float-right">
                        <div class="input-group input-group-sm ">
                            <input class="form-control form-control-navbar " type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="card-body"  >
                @if(count($all_request)===0)
                <p class="text-danger">You have not created a request yet! Click on <strong class="text-info">Create Request</strong> button to create a request.</p>    
                @else
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%">#</th>
                                <th style="width:30%"> Document</th>   
                                <th style="width:25%"> Request Date</th>  
                                <th style="width:20%"> Status</th> 
                                <th style="width:20%"> Assessment</th> 
                                                 
                            </tr>
                        </thead>
                      
                        <tbody style="line-height: 0.75">
                            @foreach($all_request as $key =>$request)                            
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{$request->docName.' '.$request->docParticular}}</td>
                                <td>{{$request->created_at}}</td>
                                <td>{{$request->request_status}} </td>

                                @if($request->request_status === 'pending')
                                    <td>
                                        <p>Not yet assessed</p>
                                    </td>                            
                                @elseif($request->request_status === 'assessed')
                                    <td>
                                        <a href="{{ route('request.show', $request->request_id) }}" class="btn btn-info btn-sm">View Assessment
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                    </td>
                                @endif
                               
                            </tr>                            
                            @endforeach
                        </tbody>
                    
                    </table>  
                @endif
                </div>

            </div>
              <!-- /.card-body -->
              
            <!-- /.card -->
        </div>
    </div> 

</div>
@endsection