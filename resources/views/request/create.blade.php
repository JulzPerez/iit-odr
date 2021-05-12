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
    
      <div class="row ">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <form method="POST" action="{{ route('request.store') }} ">
                @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Document to Request</label>
                              <select class="form-control select2bs4" name="docID" style="width: 100%;">
                                @foreach($docs as $doc)
                                  <option value="{{$doc->id}}"> {{$doc->docName.' '.$doc->docParticular}} </option>
                                @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <label>Number of Copy</label>
                              <input  type="number" class="form-control" name="copy" value="{{ old('copy') }}">
                            
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