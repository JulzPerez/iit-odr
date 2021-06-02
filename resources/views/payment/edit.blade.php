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
            <div class="card card-outline card-primary">
         
                <form method="POST" action="{{ route('document.update', $doc->id) }} ">
                @method('PATCH') 
                @csrf
                    <div class="card-body">                    
                        <!-- text input -->
                        <div class="form-group">
                            <label class="float-left"> Name</label>
                            <input  type="text" class="form-control" name="docname" value="{{$doc->docName}}"  >
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>

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