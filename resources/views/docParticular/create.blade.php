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
                <form method="POST" action="{{ route('docParticular.store') }} ">
                @csrf
                   
                    <div class="card-body">
                      <div >
                          <label class="float-left mt-2">Document Name</label>
                          <select class="form-control select2bs4" name="docID" style="width: 100%;">
                            @foreach($docs as $doc)
                              <option value="{{$doc->id}}"> {{$doc->docName}} </option>
                            @endforeach
                          </select>
                      </div>
                      <!-- <div class="form-group">
                          <label class="float-left mt-2">Code</label>
                          <input type="text" class="form-control" placeholder="Enter Code" name="code">
                      </div> -->
                      <div class="form-group">
                          <label class="float-left mt-2">Particular Name</label>
                          <input type="text" class="form-control" placeholder="Enter Particular Name" name="docname"> 
                      </div>                     
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
                
            </div>
            <!-- /.card -->
        </div>
    </div>
    

</div>
@endsection