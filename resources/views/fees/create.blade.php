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
                <form method="POST" action="{{ route('fees.store') }} ">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name of Fee</label>
                            <input  type="text" class="form-control" name="fee_name" value="{{ old('fee_name') }}">
                            
                            @if ($errors->has('fee_name'))
                              <span class="text-danger">{{ $errors->first('fee_name') }}</span>
                            @endif 

                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <input  type="text" class="form-control" name="unit" value="{{ old('unit') }}">
                            
                            @if ($errors->has('unit'))
                              <span class="text-danger">{{ $errors->first('unit') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input  type="number" class="form-control" name="amount" value="{{ old('amount') }}">
                            
                            @if ($errors->has('amount'))
                              <span class="text-danger">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>

                      <a href="/fees">
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