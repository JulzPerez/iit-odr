@extends('layouts.master')

@section('main_content')
<div class="container-fluid">
    <div class="row ">
      <div class="col-sm-12">
        <div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <!-- <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul> -->
              <p>
              Please fill-in required information!
              </p>
            </div><br />
          @endif
            
        </div>
      </div>
    </div>
    
      <div class="row ">
        <div class="col-md-12">
            <div class="card">
            
                <form method="POST" action="{{ route('requester.store') }} ">
                @csrf
                    <div class="card-body">
                    <h5 style="color:blue;">Requester Information</h5> 
                      <hr class="my-12"/>
                      

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                            <label class="col-form-label">ID Number</label>
                            <input  type="text" class="form-control" name="id_no" value="{{ old('id_no') }}">
                            
                            @error('id_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>First Name</label>
                            <input  type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"> 

                              @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror                        

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Middle Name</label>
                            <input  type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
                          
                            @if ($errors->has('middle_name'))
                              <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                            @endif 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input  type="text" class="form-control"  name="last_name" value="{{ old('last_name') }}">
                            
                            @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror 
                            
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label class="col-form-label">Sex</label>
                              <select class="form-control select2bs4" name="sex" value="{{ old('sex') }}" data-placeholder="Select from options below" style="width: 100%;">
                                <option>Male</option>
                                <option>Female</option>                             
                                
                              </select>
                              
                            @if ($errors->has('sex'))
                              <span class="text-danger">{{ $errors->first('sex') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Civil Status</label>
                            <select class="form-control select2bs4" name="civil_status" value="{{ old('civil_status') }}"  style="width: 100%;">
                               
                                <option>Single</option>
                                <option>Married</option>   
                                <option>Divorced</option>  
                                <option>Widow</option>                          
                                
                              </select>
                            @if ($errors->has('civil_status'))
                              <span class="text-danger">{{ $errors->first('civil_status') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Religion</label>
                            <input  type="text" class="form-control"  name="religion" value="{{ old('religion') }}">
                            
                            @if ($errors->has('religion'))
                              <span class="text-danger">{{ $errors->first('religion') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Citizenship</label>
                            <input  type="text" class="form-control" name="citizenship" value="{{ old('citizenship') }}">
                            
                            @if ($errors->has('citizenship'))
                              <span class="text-danger">{{ $errors->first('citizenship') }}</span>
                            @endif 
                            
                          </div>
                        </div> 
                      </div> 

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Requestor Type</label>
                              <select class="form-control select2bs4" name="requestor_type" value="{{ old('requestor_type') }}" data-placeholder="Select from options below" style="width: 100%;">
                                <option>Click here to select</option>
                                <option>Current Student</option>
                                <option>Alumnus</option>                               
                                
                              </select>
                            
                              @if ($errors->has('requestor_type'))
                                <span class="text-danger">{{ $errors->first('requestor_type') }}</span>
                              @endif 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Contact No.</label>
                            <input  type="text" class="form-control"  name="contact_no" value="{{ old('contact_no') }}">
                            
                            @if ($errors->has('contact_no'))
                              <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Date of Birth</label>                             
                              <input type="date" class="date form-control" name="birthdate" value="{{ old('birthdate') }}">
                            
                            @if ($errors->has('birthdate'))
                              <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Place of Birth</label>
                            <input  type="text" class="form-control" name="birth_place" value="{{ old('birth_place') }}">
                            
                            @if ($errors->has('birth_place'))
                              <span class="text-danger">{{ $errors->first('birth_place') }}</span>
                            @endif 
                            
                          </div>
                        </div>                                                                       
                      </div>

                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                              <label>Name of Spouse (If married)</label>
                              <input  type="text" class="form-control" name="spouse_name" value="{{ old('spouse_name') }}">
                            
                            @if ($errors->has('spouse_name'))
                              <span class="text-danger">{{ $errors->first('spouse_name') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Father (Full Name)</label>
                            <input  type="text" class="form-control" name="father_fullname" value="{{ old('father_fullname') }}">
                            
                            @if ($errors->has('father_fullname'))
                              <span class="text-danger">{{ $errors->first('father_fullname') }}</span>
                            @endif 
                            
                          </div>
                        </div>  
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Mother (Full Maiden Name)</label>
                            <input  type="text" class="form-control" name="mother_fullmaidenname" value="{{ old('mother_fullmaidenname') }}">
                            
                            @if ($errors->has('mother_fullmaidenname'))
                              <span class="text-danger">{{ $errors->first('mother_fullmaidenname') }}</span>
                            @endif 
                            
                          </div>
                        </div>                       
                      </div>

                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                              <label>Address of Parents</label>
                              <input  type="text" class="form-control" name="parents_address" value="{{ old('parents_address') }}">
                            
                              @if ($errors->has('parents_address'))
                                <span class="text-danger">{{ $errors->first('parents_address') }}</span>
                              @endif 
                            
                          </div>
                        </div>
                                             
                      </div>

                      <div class="row">            
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Degree/Course</label>
                            <input  type="text" class="form-control"  name="degree" value="{{ old('degree') }}">
                            
                            @if ($errors->has('degree'))
                              <span class="text-danger">{{ $errors->first('degree') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Major/Option</label>
                            <input  type="text" class="form-control" name="option" value="{{ old('option') }}"> 
                            
                            @if ($errors->has('option'))
                              <span class="text-danger">{{ $errors->first('option') }}</span>
                            @endif 
                            
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Honor/Academic Distinction</label>
                            <input  type="text" class="form-control"  name="honor" value="{{ old('honor') }}">
                            
                            @if ($errors->has('honor'))
                              <span class="text-danger">{{ $errors->first('honor') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                      </div>  

                      <div class="row">            
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Date of Graduation</label>
                            <input type="date" class="form-control" name="graduation_date" value="{{ old('graduation_date') }}" >
                            
                            @if ($errors->has('graduation_date'))
                              <span class="text-danger">{{ $errors->first('graduation_date') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Semester Attended</label>
                            <input  type="text" class="form-control" name="last_sem_attended" value="{{ old('last_sem_attended') }}">
                            
                            @if ($errors->has('last_sem_attended'))
                              <span class="text-danger">{{ $errors->first('last_sem_attended') }}</span>
                            @endif 
                            
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Academic Year Attended</label>
                            <input  type="number" class="form-control"  name="last_AY_attended" value="{{ old('last_AY_attended') }}">
                            
                            @if ($errors->has('last_AY_attended'))
                              <span class="text-danger">{{ $errors->first('last_AY_attended') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                      </div>                    
                      <div class="row">  
                                  
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>High School Graduated</label>
                            <input  type="text" class="form-control"  name="highschool_graduated" value="{{ old('highschool_graduated') }}">
                            
                            @if ($errors->has('highschool_graduated'))
                              <span class="text-danger">{{ $errors->first('highschool_graduated') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>High School Address</label>
                            <input  type="text" class="form-control" name="highschool_address" value="{{ old('highschool_address') }}">
                            
                            @if ($errors->has('highschool_address'))
                              <span class="text-danger">{{ $errors->first('highschool_address') }}</span>
                            @endif 
                            
                          </div>
                        </div>                         
                      </div>
                    
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Home Address</label>
                            <input  type="text" class="form-control"  name="home_address" value="{{ old('home_address') }}">
                            
                            @if ($errors->has('home_address'))
                              <span class="text-danger">{{ $errors->first('home_address') }}</span>
                            @endif 
                            
                          </div>
                        </div>                        
                      </div> 
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Mailing Address</label>
                            <input  type="text" class="form-control"  name="mailing_address" value="{{ old('mailing_address') }}">
                            
                            @if ($errors->has('mailing_address'))
                              <span class="text-danger">{{ $errors->first('mailing_address') }}</span>
                            @endif 
                            
                          </div>
                        </div>                        
                      </div>  
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Purpose of Request</label>
                            <input  type="text" class="form-control"  name="request_purpose" value="{{ old('request_purpose') }}">
                            
                            @if ($errors->has('request_purpose'))
                              <span class="text-danger">{{ $errors->first('request_purpose') }}</span>
                            @endif 
                            
                          </div>
                        </div>                        
                      </div> 

                      
                      <div class="row">            
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>If transferee, last School/University attended</label>
                            <input  type="text" class="form-control"  name="transferee_last_school" value="{{ old('transferee_last_school') }}">
                            
                            @if ($errors->has('transferee_last_school'))
                              <span class="text-danger">{{ $errors->first('transferee_last_school') }}</span>
                            @endif 
                            
                          </div>
                        </div>                        
                      </div>

                      <div class="row">
                        <div class="col-md-8">
                          <div class="form-group">
                              <label>Authorized Person</label>
                              <input  type="text" class="form-control" name="authorized_person" value="{{ old('authorized_person') }}">
                            
                              @if ($errors->has('authorized_person'))
                                <span class="text-danger">{{ $errors->first('authorized_person') }}</span>
                              @endif 
                            
                          </div>
                        </div>                                             
                      </div>
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
                
            </div>
            <!-- /.card -->
          </div>
      </div>    

</div>
@endsection