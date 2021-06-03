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

    @if($payments===null)
    <div class="row">
        <div class="col-md-6">
            <p class="text-red"><strong> You cannot upload yet because you dont have record! 
            <br> Please go to Profile and submit details!</strong></p>
        </div>
    </div>
    @else    
    <div class="row ">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">Upload Payment </div>
                <form method="POST" action="{{route('payments.store')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Payment For</label>
                                    <select class="form-control " name="payment_for"  style="width: 100%;">
                                        <!-- <option value="0"> --Document-- </option>   -->
                                        @foreach($documents as $document)
                                        <option value="{{$document->docName}}"> {{$document->docName.'-'.$document->docParticular}} </option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('payment_for'))
                                        <span class="text-danger">{{ $errors->first('payment_for') }}</span>
                                        @endif 
                                </div>
                                <div class="form-group">
                                    <label>Upload Proof of Payment</label>
                                    <input type="file" name="file" class="form-control" >
                                        @if ($errors->has('file'))
                                        <span class="text-danger">{{ $errors->first('file') }}</span>
                                        @endif 
                                </div>  
                                <div class="form-group">
                                    <label>Amount <strong class="text-red">  *Note: Numeric value only.</strong></label>
                                    <input type="text" name="amount" class="form-control" >
                                        @if ($errors->has('amount'))
                                        <span class="text-danger">{{ $errors->first('amount') }}</span>
                                        @endif 
                                </div> 
                                   
                                <div class="form-group">
                                    <label>Notes</label>
                                    <input type="text" name="notes" class="form-control" >
                                        @if ($errors->has('notes'))
                                        <span class="text-danger">{{ $errors->first('notes') }}</span>
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
                    List of Uploaded Proof of Payments
                </div>
            
                <div class="card-body">
                <table class="table table-bordered table-condensed">
                
                @if(count($payments) === 0)
                        <p>There are no current payments made<p>
                @else
                    <thead>
                        <tr>
                            <th style="width:30%"> File Name</th>
                            <th style="width:30%"> Status</th>
                            <th style="width:30%"> Date Uploaded</th>   
                            <!-- <th style="width:10%"> Action</th>   -->            
                        </tr>
                    </thead>
                    <tbody>
                        

                
                            @foreach($payments as $payment)
                            <tr>
                                    <td>
                                        <a href="{{ route('payments.show', $payment->proof) }}" >
                                            {{$payment->payment_for}}
                                        </a>
                                    </td>
                                    <td class="text-olive">{{$payment->status}} </td>
                                    <td class="text-olive">{{$payment->created_at}} </td>                                    
                                  
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