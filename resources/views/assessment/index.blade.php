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

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label>Year</label>
                                <select class="form-control select2bs4" name="Year"  style="width: 100%;">
                                    <option>20</option>
                                    <option>Student</option>
                                    <option>Admin</option>                           
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Month</label>
                                <select class="form-control select2bs4" name="month"  style="width: 100%;">
                                    <option>January</option>
                                    <option>February</option>
                                                              
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Status</label>
                                <select class="form-control select2bs4" name="month"  style="width: 100%;">
                                    <option>All</option>
                                    <option>pending</option>
                                    <option>received</option>
                                    <option>processed</option>  
                                    <option>completed</option> 
                                    <option>released</option>                        
                                </select>
                            </div>
                            <div class="col-md-2">
                            <label class="hidden">Status</label>
                                <a href="/users">
                                    <button type="submit" class="btn btn-primary form-control">Search</button>
                                </a>
                                
                            </div>
                        </div>                
                </div>
                
                <div class="card-body" >
                    
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th style="width:5%">#</th>
                                <th style="width:15%">Requester</th>
                                <th style="width:20%"> Document</th>   
                                <th style="width:15%"> Request Date</th>  
                                <th style="width:15%"> Status</th> 
                                <th style="width:15%"> Assessment</th> 
                                <th style="width:15%"> Action</th>
                                                 
                            </tr>
                        </thead>
                      
                        <tbody style="line-height: 0.75">
                            @foreach($requests as $key => $request)
                            
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ucfirst($request->first_name)}} {{ucfirst($request->last_name)}}</td>
                                <td>{{$request->docName.' '.$request->docParticular}}</td>
                                <td>{{$request->created_at}}</td>
                                <td>{{$request->request_status}} </td>
                                
                                @if($request->request_status === 'pending')
                                    <td>
                                        <a href="{{ route('assessments.show', $request->request_id) }}" class="btn btn-primary btn-sm">Create Assessment
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
                                <td>
                                        <a href="" class="btn btn-primary btn-sm">Send Message
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                </td>                               
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