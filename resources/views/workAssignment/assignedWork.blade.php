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

    <div class="row mt-1">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <!-- <div class="card card-outline card-info">               
                                <div class="card-body" > -->
                                @if(count($requests)===0 )
                                    <p class="text-danger">No Records Found</p>                                
                                @else
                                    <table class="table table-sm table-condensed table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:2%" class="text-center">#</th>
                                                <th style="width:15%" class="text-center">Requester</th>
                                                <th style="width:15%" class="text-center"> Requested Document</th>   
                                                <th style="width:15%" class="text-center"> Request Date</th>  
                                                <th style="width:10%" class="text-center"> Payment Status</th>  
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
                                                <td class="lead text-center">
                                                    <span class="badge badge-success text-white">                                                    
                                                        {{$request->payment_status}} 
                                                    </span>
                                                </td>
                                                <!-- <td>{{$request->payment_status}} </td> -->

                                            
                                                <td >
                                                    
                                                    <a href="#" class="btn btn-primary btn-sm">
                                                        Mark Completed
                                                    </a>
                                                    <a href="{{ route('messages.create', $request->requestor_id) }}" class="btn btn-primary btn-sm">
                                                        Send Message
                                                        <!-- <i class="fas fa-edit"></i> -->
                                                    </a>
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
@endsection