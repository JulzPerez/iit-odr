@extends('layouts.app', ['activePage' => 'documents', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

@section('content')
<div class="content">
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
                          <div class="form-group">
                              <label class="float-left"> Particular</label>
                              <input  type="text" class="form-control" name="particular" value="{{$doc->docParticular}}"  >
                          </div>
                          <br>
                          <div class="form-group">
                              <b>Document Fee</b>
                              <input  type="text" class="form-control"  name="docFee" value="{{$doc->doc_fee}}">
                          </div>                        
                           <br>   

                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input class="form-check-input" name="requireFileUpload" type="checkbox" {{  ($doc->require_file_upload == 1 ? ' checked' : '') }}>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                      </div>
                                    </td>
                                    <td>This document requires file uploading when requested.</td>
                                    
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input class="form-check-input" type="checkbox" name="manualAssess"  {{  ($doc->auto_assess == 1 ? ' checked' : '') }}>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                      </div>
                                    </td>
                                    <td>This document requires manual assessment.</td>
                                    
                                  </tr>
                                </tbody>
                              </table>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        

                        <a href="/document">
                          <button type="button" class="btn btn-secondary pull-right">Back</button>
                        </a>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                  </form>
                  
              </div>
              <!-- /.card -->
          </div>
      </div>
      

  </div>
</div>
@endsection