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
              <div class="card-header">
                <h3>New Document Form</h3>
              </div>
                  <form method="POST" action="{{ route('document.store') }} ">
                  @csrf
                      <div class="card-body">
                          <div class="form-group">
                              <b>Name</b>
                              <input  type="text" class="form-control"  name="docname">
                          </div>
                          <br>
                          <div class="form-group">
                              <b>Particular</b>
                              <input  type="text" class="form-control"  name="particular">
                          </div>
                          <br>
                          <div class="form-group">
                              <b>Document Fee</b>
                              <input  type="text" class="form-control"  name="docFee">
                          </div>                        
                           <br>   

                              <table class="table">
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="form-check">
                                        <label class="form-check-label">
                                          <input class="form-check-input" name="requireFileUpload" type="checkbox"  >
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
                                          <input class="form-check-input" type="checkbox" name="manualAssess"  >
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
                      <div class="card-footer"><a href="/document">
                          <button type="button" class="btn btn-secondary pull-right">Back</button>
                        </a>
                        <button type="submit" class="btn btn-primary pull-right">Add</button>
                      </div>
                  </form>
                  
              </div>
              <!-- /.card -->
          </div>
      </div>
      

  </div>
</div>
@endsection