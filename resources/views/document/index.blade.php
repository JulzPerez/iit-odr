@extends('layouts.app', ['activePage' => 'documents', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!' ) ])

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
                <div class="card card-outline card-primary">
                <div class="card-header">
                    <a href="{{route('document.create') }}">
                        <button  type="button" class="btn btn-primary float-left">New Document</button>
                    </a>                
                    
                </div>
                    
                    <div class="card-body"  >
                        <div class="table-responsive">
                        <!--   <p>Document List</p> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th style="width:80%"> Name</th>     
                                        
                                        <th style="width:10%" colspan = 2>Actions</th>                 
                                    </tr>
                                </thead>
                               
                                    <tbody style="line-height: 0.75">
                                    @php
                                        $i = 0
                                    @endphp
                                        @foreach($docs as $doc)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$doc->docName.' '.$doc->docParticular}}</td>
                                        
                                            <td>
                                                <a href="{{ route('document.edit',$doc->id)}}" class="btn btn-warning btn-sm">Edit
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
                        </div>
                            {{ $docs->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
                
                <!-- /.card -->
            </div>
        </div> 

    </div>
</div>
@endsection