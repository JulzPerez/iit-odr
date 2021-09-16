@extends('layouts.app', ['activePage' => 'request', 'titlePage' => __('Upload Proof of Payment Form')])

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
        <br>
        <div class="row ">
            <div class="col-sm-12">  
                @if (session()->get('error'))
                    <div class="alert alert-danger">
                        {{session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
    
        <div class="row ">
            <div class="col-md-8">
                <div class="card card-danger">   
                    <div class="card-header">
                      <h3>Upload Proof of Payment Form</h3>
                    </div>             
                        
                    <form method="POST" action="{{route('payments.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Payment for request</label>
                                        <br>
                                        <input type="text" name="payment_for" value="{{$docName}}" class="form-control" readonly>
                                        <input type="hidden" name="request_id" value="{{$id}}" class="form-control" >
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Upload Proof of Payment</label>
                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                        <div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-exists">Browse File</span>
                                                <input type="file" name="file" />
                                            </span>
                                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div>
                                        @if ($errors->has('file'))
                                            <span class="text-danger">{{ $errors->first('file') }}</span>
                                        @endif
                                    </div>  
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">                                       
                                    <div class="form-group">
                                        <label> Amount</label>
                                        <input type="number" name="amount" class="form-control" >
                                            @if ($errors->has('amount'))
                                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                                            @endif 
                                    </div> 
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">  
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <!-- <input type="text" name="notes" class="form-control" > -->
                                        <textarea class="form-control" rows="2" name="notes"></textarea>
                                            @if ($errors->has('notes'))
                                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                                            @endif 
                                    </div>
                                </div>
                            </div>                              
                        </div>

                        <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                        
                    </form>
                    
                </div>
                <!-- /.card -->
            </div>
            
        </div>
    
            
    </div>
</div>
@endsection