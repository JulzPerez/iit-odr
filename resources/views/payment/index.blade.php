@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.' !') ])

@push('css')
<style>
.alignLeft, .form-control.alignLeft {
    text-align: left !important; 
}
</style>
@endpush

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
                      <h4>Upload Proof of Payment Form</h4>
                    </div>             
                        
                    <form method="POST" action="{{route('payments.store')}}" enctype="multipart/form-data" id="uploadPaymentForm">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Payment for request</label>
                                        <br>
                                       <h5><strong class="text-info">                                            
                                           {{$docName}}
                                        </strong></h5>
                                        <input type="hidden" name="payment_for" value="{{$docName}}" class="form-control" readonly>
                                        <input type="hidden" name="request_id" value="{{$id}}" class="form-control" >
                                        
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label>Click to browse file</label>
                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                        <input type="file" name="file" class="form-control" id="file">

                                        <span class="text-danger error-text file_error"></span>
                                        
                                    </div>  
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">                                       
                                    <div class="form-group">
                                        <label> Amount</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" >₱</span>
                                            <input type="text" name="amount" class="form-control alignLeft"  id="amount" style="text-align: left">
                                                
                                        </div>
                                        <span class="text-danger error-text amount_error"></span>
                                    </div> 
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">  
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <!-- <input type="text" name="notes" class="form-control" > -->
                                        <textarea class="form-control" rows="1" name="notes"></textarea>
                                        <span class="text-danger error-text notes_error"></span> 
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

@push('js')

<script type="text/javascript">
    $(function()
    {
         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

             
          $("#uploadPaymentForm").on('submit', function(e){
              e.preventDefault();

              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

            
              $.ajax({
                  url:$(this).attr('action'),
                  method:$(this).attr('method'),
                  data:new FormData(this),
                  processData:false,
                  dataType:'json',
                  contentType:false,
                  beforeSend:function(){    
                    $(document).find('span.error-text').text('');
                      
                  },
                  
                  success:function(data){
                    
                      if(data.status == 0){
                       
                          $.each(data.error, function(prefix, val){                           
                              $('span.'+prefix+'_error').text(val[0]);                                                    
                          }); 
                          
                      }
                      else
                      {
                        $('#uploadPaymentForm')[0].reset();                                                         
                              window.location = "{{route('request.index')}}";                           
                      }
                  }
              });
          }); 

          /* $(document).ready(function(){
            
            $('#amount').inputmask({"alias": "currency"}); 
            
           
          }); */
        
      }); 

</script>

@endpush