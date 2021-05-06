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
            <div class="card-header">
               Fill-in form:
            </div>
                <form method="POST" action="{{ route('document.store') }} ">
                @csrf
                    <div class="card-body">
                        <div>
                            <label class="float-left">Name</label>
                            <input  type="text" class="form-control" placeholder="Enter value here" name="docname">
                        </div>
                        <br>
                        <div>
                            <label class="float-left">Particular</label>
                            <input  type="text" class="form-control" placeholder="Enter value here" name="particular">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>

                      <a href="/document">
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