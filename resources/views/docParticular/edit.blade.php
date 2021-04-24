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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <form method="POST" action="{{ route('docParticular.update', $particular->id) }} ">
                @method('PUT')
                @csrf
                   
                    <div class="card-body">
                      <div >
                          <label class="float-left mt-2">Document Name</label>
                          <select class="form-control select2bs4" name="docID" style="width: 100%;">
                            @foreach($docs as $doc)
                                @if(old('doc') == $doc->id)
                                  <option value="{{$doc->id}}" selected > {{$doc->docName}} </option>
                                @else 
                                  <option value="{{$doc->id}}"> {{$doc->docName}} </option>
                                @endif
                            @endforeach
                          </select>
                      </div>
                   
                      <div class="form-group">
                          <label class="float-left mt-3">Particular Name</label>
                          <input type="text" value="{{$particular->docParticularName}}" class="form-control" placeholder="Enter Particular Name" name="docname"> 
                      </div>                     
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>

                      <a href="/docParticular">
                        <button type="button" class="btn btn-primary float-right">Cancel</button>
                      </a>
                    </div>
                </form>
                
            </div>
            <!-- /.card -->
        </div>
    </div>
    

</div>
@endsection