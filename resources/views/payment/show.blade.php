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
            
        <div class="col-md-12">   
            <div class="card card-default ">
                <div class="card-header">
                    Uploaded Proof of Payment
                </div>
            
                <div class="card-body">
    
                <table class="table table-bordered table-condensed">
                
                @if(count($payments) === 0)
                        <p>There are no payments made by this requestor yet.<p>
                @else
                    <thead>
                        <tr>
                            <th style="width:30%"> Name</th>
                            <th style="width:30%"> Status</th>
                            <th style="width:30%"> Date Uploaded</th>   
                            <th style="width:30%"> Action</th> 
                        </tr>
                    </thead>
                    <tbody>                     

                
                            @foreach($payments as $payment)
                            <tr>
                                    <td>
                                        <a href="{{ route('payments.show', $payment->proof) }}" >
                                            {{$payment->proof}}
                                        </a>
                                    </td>
                                    <td class="text-olive">{{$payment->payment_status}} </td>
                                    <td class="text-olive">{{$payment->created_at}} </td>  
                                    <td>
                                        <form method="POST" action="{{ route('payments.verify', $request_id ) }} ">
                                        @csrf
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Validate</button>
                                            </div>
                                        </form> 
                                    </td>                                                                 
                                  
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