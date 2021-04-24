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
                Request List
                <a href="{{route('request.create') }}">
                    <button  type="button" class="btn btn-primary float-right">Create Request</button>
                </a>
            </div>
                
                <div class="card-body"  >
                    <!--   <p>Document List</p> -->
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:10%">ID</th>
                                <th style="width:80%"> Requested Document</th>     
                                <th style="width:10%" colspan = 2>Actions</th>                 
                            </tr>
                        </thead>
                      
                            <tbody style="line-height: 0.75">
                                @foreach($requests as $request)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('request.edit',$request->id)}}" class="btn btn-primary">Edit
                                        <!-- <i class="fas fa-edit"></i> -->
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('request.destroy', $request->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>                            
                                @endforeach
                            </tbody>
                    
                    </table>
                   <!--  {{ $docs->links() }} -->
                </div>
            </div>
              <!-- /.card-body -->
              
            <!-- /.card -->
        </div>
    </div> 

</div>
@endsection