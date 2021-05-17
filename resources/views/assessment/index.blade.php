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
                    
                    <form method="GET" action="{{ route('assessments.index') }} " >
                        <div class="row">
                            <div class="col-2">  
                                <div class="form-group">
                                
                                    <label class="col-form">Request Status</label>
                                    <select class="form-control" name="request_status">
                                        <option>Pending</option>
                                        <option>Assessed</option>
                                        <option>Scheduled</option>   
                                    </select>                            
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Date Range</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="reservation" name="date_range">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>                                   
                                </div>
                            </div>
                            <!-- <div class="col-4">  
                                <label>FROM Date</label>
                                <div class="input-group">
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Month--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Day--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Year--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                </div>                                                                
                            </div>
                            <div class="col-4">  
                                <label>TO Date</label>
                                <div class="input-group">
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Month--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Day--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                    <div class="form-group"> 
                                        <select class="form-control" name="day">
                                            <option>--Year--</option>
                                            <option>Date</option>
                                            <option>Alumnus</option>   
                                        </select>
                                    </div>
                                </div>
                                                                
                            </div> -->
                           
                        </div>
                    </form>
                    <hr>
                    <!--Row for table  -->
                    <div class="row mt-1">
                        <div class="col-md-12">
                            <!-- <div class="card card-outline card-info">               
                                <div class="card-body" > -->
                                @if(count($requests)===0)
                                    <p class="text-danger">No Pending Request for Assessment</p>
                                @else
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width:5%" class="text-center">#</th>
                                                <th style="width:15%" class="text-center">Requester</th>
                                                <th style="width:20%" class="text-center"> Requested Document</th>   
                                                <th style="width:15%" class="text-center"> Request Date</th>  
                                                <th style="width:15%" class="text-center"> Request Status</th>  
                                                <!-- <th style="width:15%"> Payment Status</th> -->
                                                <th style="width:15%" class="text-center"> Action</th>
                                                
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
                                                <td class="lead text-center">
                                                    <span 
                                                        @if(($request->request_status) === 'pending')
                                                            class="badge badge-danger text-white">
                                                        @elseif(($request->request_status) === 'assessed')
                                                            class="badge badge-success text-white">
                                                        @endif
                                                        {{$request->request_status}} 
                                                    <span>
                                                </td>
                                                <!-- <td>{{$request->payment_status}} </td> -->

                                                @if($request->request_status === 'pending')
                                                    <td>
                                                        <a href="{{ route('assessments.show', $request->request_id) }}" class="btn btn-primary btn-sm">
                                                        Create Assessment
                                                        <!-- <i class="fas fa-edit"></i> -->
                                                        </a>
                                                    </td>                            
                                                @elseif($request->request_status === 'assessed')
                                                    <td>
                                                        <a href="{{ route('assessments.show', $request->request_id) }}" class="btn btn-info btn-sm">Re-assess
                                                        <!-- <i class="fas fa-edit"></i> -->
                                                        </a>
                                                    </td>
                                                @endif
                                                                            
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