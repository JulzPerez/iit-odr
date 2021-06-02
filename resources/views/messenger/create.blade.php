@extends('layouts.master')

@section('main_content')
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
                    <label>To:</label>
                  <input class="form-control" name="to" placeholder="To:" value="{{$user->first_name.' '.$user->last_name}}">
                </div>
                <div class="form-group">
                <label>Subject:</label>
                  <input class="form-control" name="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 200px">
                      
                    </textarea>
                </div>
                <input type="hidden" name="recipient" value="{{$user->id}}">
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <div class="float-right">
                  
                  <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </form>
        </div>
           
@stop
