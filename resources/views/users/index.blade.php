@extends('layouts.app', ['activePage' => 'users', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name) ])

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

        

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <a href="{{route('users.create') }}">
                        <button  type="button" class="btn btn-primary float-left">New User</button>
                    </a>

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        
                        <button type="button" class="btn btn-info" id="btnStaff">All Staff</button>
                        <button type="button" class="btn btn-secondary" id="btnRequester">All Users</button>
                        
                    </div>
                
                    
                </div>
                    
                    <div class="card-body"  >
                        <!--   <p>Document List</p> -->
                        <div class="table-responsive" id="tableStaff">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width:30%"> Name</th>
                                        <th style="width:30%"> Email</th>   
                                        <th style="width:10%"> User Type</th>  
                                        
                                        <th style="width:20%" colspan = 2>Actions</th>                 
                                    </tr>
                                </thead>
                            
                                    <tbody style="line-height: 0.75">
                                        @foreach($all_staff as $staff)
                                        <tr>
                                            <td>{{$staff->id}}</td>
                                            <td>{{ucfirst($staff->first_name)}} {{ucfirst($staff->last_name)}}</td>
                                            <td>{{$staff->email}}</td>
                                            <td>{{$staff->user_type}}</td>
                                        
                                            <td>
                                                <a href="{{ route('users.edit',$staff->id)}}" class="btn btn-warning btn-sm">Edit
                                                <!-- <i class="fas fa-edit"></i> -->
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('users.destroy', $staff->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>                            
                                        @endforeach
                                    </tbody>
                            
                            </table>
                        </div>
                      

                        <div class="table-responsive" id="tableRequester" style="display:none">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width:30%"> Name</th>
                                        <th style="width:30%"> Email</th>   
                                        <th style="width:10%"> User Type</th>  
                                        
                                        <th style="width:20%" colspan = 2>Actions</th>                 
                                    </tr>
                                </thead>
                            
                                    <tbody style="line-height: 0.75">
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->user_type}}</td>
                                        
                                            <td>
                                                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-warning btn-sm">Edit
                                                <!-- <i class="fas fa-edit"></i> -->
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>                            
                                        @endforeach
                                    </tbody>
                            
                            </table>
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
                
                <!-- /.card -->
            </div>
        </div> 

    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">
            $(document).ready(function () {
             
             $('#btnStaff').on('click',function(e) {
                        
                 document.getElementById("tableStaff").style.display = "block";         
                         
                 document.getElementById("tableRequester").style.display = "none";           
              
                 
             });   
     
             $('#btnRequester').on('click',function(e) {
     
                document.getElementById("tableStaff").style.display = "none";         
                         
                document.getElementById("tableRequester").style.display = "block";
         
             });   
             
           });
    </script>

@endpush