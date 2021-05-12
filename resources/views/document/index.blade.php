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
            <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="{{route('document.create') }}">
                    <button  type="button" class="btn btn-primary float-left">New Document</button>
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
                    <!--   <p>Document List</p> -->
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%">ID</th>
                                <th style="width:80%"> Name</th>     
                                
                                <th style="width:10%" colspan = 2>Actions</th>                 
                            </tr>
                        </thead>
                      
                            <tbody style="line-height: 0.75">
                                @foreach($docs as $doc)
                                <tr>
                                    <td>{{$doc->id}}</td>
                                    <td>{{$doc->docName.' '.$doc->docParticular}}</td>
                                   
                                    <td>
                                        <a href="{{ route('document.edit',$doc->id)}}" class="btn btn-primary btn-sm">Edit
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('document.destroy', $doc->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>                            
                                @endforeach
                            </tbody>
                    
                    </table>
                    {{ $docs->links() }}
                </div>
            </div>
              <!-- /.card-body -->
              
            <!-- /.card -->
        </div>
    </div> 

</div>
@endsection