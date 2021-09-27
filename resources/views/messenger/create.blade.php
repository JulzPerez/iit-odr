@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@section('content')
<div class="content">
      <div class="col-md-6">
        <form action="{{ route('messages.store') }}" method="post">
        {{ csrf_field() }}
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
                <div class="form-group">
                <label>Subject:</label>
                  <input class="form-control" name="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 200px">
                      
                    </textarea>
                </div>
                <input type="hidden" name="recipient" value="{{$requestorID}}">
                <input type="hidden" name="requestID" value="{{$requestID}}">
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
               
                  <button type="submit" class="btn btn-primary">
                    <span class="material-icons float-right">send</span> Send</button>
            
                   
                <!-- <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button> -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </form>
        </div>
</div>
           
@stop
