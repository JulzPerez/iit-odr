@extends('layouts.app', ['activePage' => 'fees', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

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
                    <a href="{{route('fees.create') }}">
                        <button  type="button" class="btn btn-primary float-left">New Fee</button>
                    </a>
                
                  
                </div>
                    
                    <div class="card-body"  >
                        <div class="table-responsive">
                        <!--   <p>Document List</p> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:10%">ID</th>
                                        <th style="width:40%"> Name of Fee</th>
                                        <th style="width:10%"> Unit</th>   
                                        <th style="width:20%"> Amount</th>  
                                        
                                        <th style="width:20%" colspan = 2>Actions</th>                 
                                    </tr>
                                </thead>
                            
                                    <tbody style="line-height: 0.75">
                                        @foreach($fees as $fee)
                                        <tr>
                                            <td>{{$fee->id}}</td>
                                            <td>{{$fee->fee_name}}</td>
                                            <td>{{$fee->unit}}</td>
                                            <td>{{number_format($fee->amount, 2, '.' , ',') }}</td>
                                        
                                            <td>
                                                <a href="{{ route('fees.edit',$fee->id)}}" class="btn btn-primary btn-sm">Edit
                                                <!-- <i class="fas fa-edit"></i> -->
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{ route('fees.destroy', $fee->id)}}" method="post">
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
                        {{ $fees->links() }}
                    </div>
                </div>
                <!-- /.card-body -->
                <!--  <div class="overlay">
                    <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                </div> -->
        
                <!-- /.card -->
            </div>
        </div> 

    </div>
</div>
@endsection