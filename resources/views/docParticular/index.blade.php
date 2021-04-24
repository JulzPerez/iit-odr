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
                <div class="card-header">Document Particular List
                    <a href="{{route('docParticular.create') }}">
                        <button  type="button" class="btn btn-primary float-right">Create New </button>
                    </a>
                </div>
                <div class="card-body">
                
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%">ID</th>
                                <th style="width:30%"> Document</th>  
                                <th style="width:50%"> Particular</th>  
                                <th style="width:10%" colspan = 2>Actions</th>                 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docs as $doc)
                            <tr>
                                <td>{{$doc->id}}</td>
                                <td>{{$doc->docName}}</td>
                                <td>{{$doc->docParticularName}}</td>
                                <td>
                                    <a href="{{ route('docParticular.edit',$doc->id)}}" class="btn btn-primary">
                                    Edit                                   
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('docParticular.destroy', $doc->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
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