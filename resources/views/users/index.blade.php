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

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                <div class="card-header">
                    <a href="{{route('users.create') }}">
                        <button  type="button" class="btn btn-primary float-left">New User</button>
                    </a>
                
                    
                </div>
                    
                    <div class="card-body"  >
                        <!--   <p>Document List</p> -->
                        <div class="table-responsive">
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
                                                <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit
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