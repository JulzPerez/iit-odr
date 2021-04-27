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

    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-header">
                        <a href="{{route('requester.edit', $requester->id) }}">
                            <button  type="button" class="btn btn-primary float-left">Update Info</button>
                        </a>
                    </div>
               
                    <div class="card-body">
                      <div class="row">
                        
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Requestor Type</label>
                              <select class="form-control select2bs4" name="requestor_type" data-placeholder="Select from options below" style="width: 100%;">
                                <option>Click here to select</option>
                                <option>Current Student</option>
                                <option>Alumnus</option>
                                <option>Transferee</option>
                                
                              </select>
                          </div>
                        </div>
                        
                      </div>
                      
                      <hr class="my-12"/>
                      <h5 style="color:red;">Requester Information</h5>

                      <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                            <label>ID Number</label>
                            <input  type="text" class="form-control" name="id_no" value="" disabled>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>First Name</label>
                            <input  type="text" class="form-control" name="first_name" value="{{$requester->first_name}}" disabled>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Middle Name</label>
                            <input  type="text" class="form-control" name="middle_name" value="{{$requester->middle_name}}" disabled>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input  type="text" class="form-control"  name="last_name" value="{{$requester->last_name}}" disabled>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Sex</label>
                              <select class="form-control select2bs4" name="sex" data-placeholder="Select from options below" style="width: 100%;">
                                <option>Male</option>
                                <option>Female</option>                              
                                
                              </select>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Civil Status</label>
                            <input  type="text" class="form-control" name="civil_status">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Religion</label>
                            <input  type="text" class="form-control"  name="religion">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Citizenship</label>
                            <input  type="text" class="form-control" name="citizenship">
                          </div>
                        </div> 
                      </div> 

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Contact No.</label>
                            <input  type="text" class="form-control"  name="contact_no">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Date of Birth</label>
                              <input  type="text" class="form-control" name="birthdate">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Place of Birth</label>
                            <input  type="text" class="form-control" name="birth_place">
                          </div>
                        </div> 
                                                                      
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Name of Spouse (If married)</label>
                              <input  type="text" class="form-control" name="spouse_name">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Father (Full Name)</label>
                            <input  type="text" class="form-control" name="father_fullname">
                          </div>
                        </div>  
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Mother (Full Maiden Name)</label>
                            <input  type="text" class="form-control" name="mother_fullmaidenname">
                          </div>
                        </div>                       
                      </div>

                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                              <label>Address of Parents</label>
                              <input  type="text" class="form-control" name="parents_address">
                          </div>
                        </div>
                                             
                      </div>

                      <div class="row">            
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Degree/Course</label>
                            <input  type="text" class="form-control"  name="degree">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Major/Option</label>
                            <input  type="text" class="form-control" name="option">
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Honor/Academic Distinction</label>
                            <input  type="text" class="form-control"  name="honor">
                          </div>
                        </div>
                      </div>  

                      <div class="row">            
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Date of Graduation</label>
                            <input type="text" name="graduation_date" class="form-control" >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Semester Attended</label>
                            <input  type="text" class="form-control" name="last_sem_attended">
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Academic Year Attended</label>
                            <input  type="text" class="form-control"  name="last_AY_attended">
                          </div>
                        </div>
                      </div>                    
                      <div class="row">  
                                  
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>High School Graduated</label>
                            <input  type="text" class="form-control"  name="highschool_graduated">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>High School Address</label>
                            <input  type="text" class="form-control" name="highschool_address">
                          </div>
                        </div>                         
                      </div>
                    
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Home Address</label>
                            <input  type="text" class="form-control"  name="home_address">
                          </div>
                        </div>                        
                      </div> 
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Mailing Address</label>
                            <input  type="text" class="form-control"  name="mailing_address">
                          </div>
                        </div>                        
                      </div>  
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Purpose of Request</label>
                            <input  type="text" class="form-control"  name="request_purpose">
                          </div>
                        </div>                        
                      </div> 

                      
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>If transferee, last School/University attended</label>
                            <input  type="text" class="form-control"  name="transferee_last_school">
                          </div>
                        </div>                        
                      </div>

                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                              <label>Authorized Person</label>
                              <input  type="text" class="form-control" name="authorized_person">
                          </div>
                        </div>                                             
                      </div>
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>    
                
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection