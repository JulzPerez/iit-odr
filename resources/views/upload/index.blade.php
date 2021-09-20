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
    <br>

    @if($files===null)
    <div class="row">
        <div class="col-md-6">
            <p class="text-red"><strong> You cannot upload yet because you dont have record! 
            <br> Please go to Profile, fill-in and submit required info!</strong></p>
        </div>
    </div>
    @else    
    <div class="row ">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">Upload File </div>
                <form method="POST" action="{{route('files.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label>Document</label>

                              <input type="text" name="doc_name" class="form-control" >
                              
                              @if ($errors->has('doc_name'))
                                <span class="text-danger">{{ $errors->first('doc_name') }}</span>
                              @endif 
                          </div>

                          <div class="form-group">
                              <label>Upload File</label>
                              <input type="file" name="file" class="form-control" >
                              @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                              @endif 
                          </div>
                                                                        
                        </div>
                        
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                    
                  </form>
                
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">   
            <div class="card card-success">
                <div class="card-header">
                    Uploaded Files
                </div>
            
                <div class="card-body">
                <table class="table table-bordered table-condensed">
                @if(count($files) === 0)
                        <p>There are no current files uploaded<p>

                @else
                    <thead>
                        <tr>
                            <th style="width:30%"> File Name</th>
                            <th style="width:30%"> Date Uploaded</th>   
                            <!-- <th style="width:10%"> Action</th>   -->            
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach($files as $file)
                            <tr>
                                    <td>
                                        <a href="{{ route('files.show', $file->filename) }}" >
                                            {{$file->name}}
                                        </a>
                                    </td>
                                    <td class="text-olive">{{$file->created_at}} </td>
                                  
                            </tr>
                            @endforeach

                        @endif
                        
                        
                    </tbody>                          
                </table>
                </div> <!--end card-body -->
               
            
            </div>
          
        </div>
    </div>
    @endif
        
</div>
@endsection