@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@push('css')
<style>
.btnRight, .btn.btnRight {
  float: right; !important; 
}
</style>
@endpush

@section('content')
<div class="content">
      <div class="col-md-8">
        <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h4 class="card-title">Compose New Message</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                <div class="form-group">
                <label>Subject:</label>
                  <input class="form-control" name="subject" >
                </div>
                <label>Body</label>
                <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" rows="2">
                      
                    </textarea>
                </div>
                <input type="hidden" name="recipient" value="{{$requestorID}}">
                <input type="hidden" name="requestID" value="{{$requestID}}">
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
               
                  <button type="submit" class="btn btn-primary " >
                     <b class="mr-2"> Send<b><!-- <i class="material-icons">send</i> --></button>
            
                   
                <!-- <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button> -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </form>
        </div>
</div>
           
@stop
