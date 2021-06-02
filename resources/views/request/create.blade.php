@extends('layouts.master')

@section('main_content')
<div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
            
        </div>
      </div>
    </div>
    
      <div class="row mt-3">
        <div class="col-md-6">
            <div class="card card-primary">
                <dic class="card-header">
                    Request
                </div>
                <form method="POST" action="{{ route('request.store') }} " enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                              <label>Document to Request</label>
                              <select class="form-control select2bs4" name="docID" id="selectDocument" style="width: 100%;">
                                <!-- <option value="0"> --Document-- </option>   -->
                                @foreach($docs as $doc)
                                  <option value="{{$doc->id}},{{$doc->require_file_upload}}"> {{$doc->docName.' '.$doc->docParticular}} </option>
                                @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label>Number of Copy: </label>
                              <input  type="number" class="form-control" name="copy" value="1">
                            
                          </div>

                          <div class="form-group">
                              <label>File Upload <strong class="text-danger">(Use only for authentication)</strong></label>
                              <input type="file" name="file" class="form-control" >
                              @if ($errors->has('file'))
                                <span class="text-danger">{{ $errors->first('file') }}</span>
                              @endif 
                          </div>
                                                                        
                        </div>
                        
                      </div>
                    </div>

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add Request</button>
                    </div>
                    
                  </form>
                
            </div>
            <!-- /.card -->
        </div>
      </div>    

</div>
@endsection