@extends('layouts.master')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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

                <div class="card-body">
                <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:40%"> Document</th>   
                                    <th style="width:25%"> Request Date</th>  
                                    <th style="width:20%"> Status</th> 
                                    <th style="width:10%" colspan = 2>Actions</th>                 
                                </tr>
                            </thead>
                        
                                <tbody style="line-height: 0.75">
                                
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="" class="btn btn-primary">Edit
                                            <!-- <i class="fas fa-edit"></i> -->
                                            </a>
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>                            
                            
                                </tbody>
                        
                        </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
