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
         
                <form method="POST" action="{{ route('fees.update', $fee->id) }} ">
                @method('PATCH') 
                @csrf
                    <div class="card-body">                    
                    <div class="form-group">
                            <label>Name of Fee</label>
                            <input  type="text" class="form-control" name="fee_name" value="{{ $fee->fee_name }}">
                            
                            @if ($errors->has('fee_name'))
                              <span class="text-danger">{{ $errors->first('fee_name') }}</span>
                            @endif 

                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <input  type="text" class="form-control" name="unit" value="{{$fee->unit }}">
                            
                            @if ($errors->has('unit'))
                              <span class="text-danger">{{ $errors->first('unit') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input  type="number" class="form-control" name="amount" value="{{ $fee->amount}}">
                            
                            @if ($errors->has('amount'))
                              <span class="text-danger">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                        
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>

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