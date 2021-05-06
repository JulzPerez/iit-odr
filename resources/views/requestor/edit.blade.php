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
            
                <form method="POST" action="{{ route('requester.update',$requester->id) }} ">
                @method('PATCH')
                @csrf
                    <div class="card-body">
                    <h5 style="color:blue;">Requester Information</h5> 
                      <hr class="my-12"/>
                      

                      <div class="row">
                      <div class="col-md-3">
                          <div class="form-group">
                            <label>ID Number</label>
                            <input  type="text" class="form-control" name="id_no" value="{{ $requester->id_no }}">
                            
                            @if ($errors->has('id_no'))
                              <span class="text-danger">{{ $errors->first('id_no') }}</span>
                            @endif 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>First Name</label>
                            <input  type="text" class="form-control" name="first_name" value="{{ $requester->first_name }}"> 

                            @if ($errors->has('first_name'))
                              <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif                          

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Middle Name</label>
                            <input  type="text" class="form-control" name="middle_name" value="{{ $requester->middle_name }}">
                          
                            @if ($errors->has('middle_name'))
                              <span class="text-danger">{{ $errors->first('middle_name') }}</span>
                            @endif 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input  type="text" class="form-control"  name="last_name" value="{{ $requester->last_name }}">
                            
                            @if ($errors->has('last_name'))
                              <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Sex</label>
                              <select class="form-control select2bs4" name="sex" value="{{ $requester->sex }}" data-placeholder="Select from options below" style="width: 100%;">
                                <option {{ ($requester->sex) == 'Male' ? 'selected' : '' }}  value="Male">Male</option>
                                <option {{ ($requester->sex) == 'Female' ? 'selected' : '' }}  value="Female">Female</option>                                 
                              </select>
                              
                            @if ($errors->has('sex'))
                              <span class="text-danger">{{ $errors->first('sex') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Civil Status</label>
                            <select class="form-control select2bs4" name="civil_status" value="{{ $requester->civil_status }}" style="width: 100%;">
                               
                               <option {{ ($requester->civil_status) == 'Single' ? 'selected' : '' }}  value="Single" >Single</option>
                               <option {{ ($requester->civil_status) == 'Married' ? 'selected' : '' }}  value="Married">Married</option>   
                               <option {{ ($requester->civil_status) == 'Divorced' ? 'selected' : '' }}  value="Divorced">Divorced</option>  
                               <option {{ ($requester->civil_status) == 'Widow' ? 'selected' : '' }}  value="Widow">Widow</option>                          
                               
                             </select>

                            @if ($errors->has('civil_status'))
                              <span class="text-danger">{{ $errors->first('civil_status') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Religion</label>
                            <input  type="text" class="form-control"  name="religion" value="{{ $requester->religion }}">
                            
                            @if ($errors->has('religion'))
                              <span class="text-danger">{{ $errors->first('religion') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Citizenship</label>
                            <input  type="text" class="form-control" name="citizenship" value="{{  $requester->citizenship }}">
                            
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
                              <select class="form-control select2bs4" name="requestor_type" value="{{ $requester->requestor_type }}"  style="width: 100%;">
                                <option {{ ($requester->requestor_type) == 'Current Student' ? 'selected' : '' }}  value="Current Student">Current Student</option>
                                <option {{ ($requester->requestor_type) == 'Alumnus' ? 'selected' : '' }}  value="Alumnus">Alumnus</option>                               
                                
                              </select>
                            
                              @if ($errors->has('requestor_type'))
                                <span class="text-danger">{{ $errors->first('requestor_type') }}</span>
                              @endif 

                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Contact No.</label>
                            <input  type="text" class="form-control"  name="contact_no" value="{{ $requester->contact_no }}">
                            
                            @if ($errors->has('contact_no'))
                              <span class="text-danger">{{ $errors->first('contact_no') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                              <label>Date of Birth</label>                             
                              <input type="date" class="date form-control" name="birthdate" value="{{ $requester->date_of_birth }}">
                            
                            @if ($errors->has('birthdate'))
                              <span class="text-danger">{{ $errors->first('birthdate') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Place of Birth</label>
                            <input  type="text" class="form-control" name="birth_place" value="{{ $requester->place_of_birth  }}">
                            
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
                              <input  type="text" class="form-control" name="spouse_name" value="{{ $requester->spouse }}">
                            
                            @if ($errors->has('spouse_name'))
                              <span class="text-danger">{{ $errors->first('spouse_name') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Father (Full Name)</label>
                            <input  type="text" class="form-control" name="father_fullname" value="{{ $requester->name_of_father }}">
                            
                            @if ($errors->has('father_fullname'))
                              <span class="text-danger">{{ $errors->first('father_fullname') }}</span>
                            @endif 
                            
                          </div>
                        </div>  
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Name of Mother (Full Maiden Name)</label>
                            <input  type="text" class="form-control" name="mother_fullmaidenname" value="{{ $requester->maiden_name_of_mother }}">
                            
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
                              <input  type="text" class="form-control" name="parents_address" value="{{ $requester->address_of_parents }}">
                            
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
                            <input  type="text" class="form-control"  name="degree" value="{{ $requester->degree }}">
                            
                            @if ($errors->has('degree'))
                              <span class="text-danger">{{ $errors->first('degree') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Major/Option</label>
                            <input  type="text" class="form-control" name="option" value="{{ $requester->major_option }}"> 
                            
                            @if ($errors->has('option'))
                              <span class="text-danger">{{ $errors->first('option') }}</span>
                            @endif 
                            
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Honor/Academic Distinction</label>
                            <input  type="text" class="form-control"  name="honor" value="{{ $requester->academic_distinction }}">
                            
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
                            <input type="date" class="form-control" name="graduation_date" value="{{ $requester->date_of_graduation }}" >
                            
                            @if ($errors->has('graduation_date'))
                              <span class="text-danger">{{ $errors->first('graduation_date') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Semester Attended</label>
                            <input  type="text" class="form-control" name="last_sem_attended" value="{{ $requester->last_sem_attended }}">
                            
                            @if ($errors->has('last_sem_attended'))
                              <span class="text-danger">{{ $errors->first('last_sem_attended') }}</span>
                            @endif 
                            
                          </div>
                        </div> 
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Last Academic Year Attended</label>
                            <input  type="text" class="form-control"  name="last_AY_attended" value="{{ $requester->last_sem_AY }}">
                            
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
                            <input  type="text" class="form-control"  name="highschool_graduated" value="{{ $requester->highschool_graduated }}">
                            
                            @if ($errors->has('highschool_graduated'))
                              <span class="text-danger">{{ $errors->first('highschool_graduated') }}</span>
                            @endif 
                            
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>High School Address</label>
                            <input  type="text" class="form-control" name="highschool_address" value="{{ $requester->highschool_address }}">
                            
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
                            <input  type="text" class="form-control"  name="home_address" value="{{  $requester->home_address }}">
                            
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
                            <input  type="text" class="form-control"  name="mailing_address" value="{{ $requester->mailing_address }}">
                            
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
                            <input  type="text" class="form-control"  name="request_purpose" value="{{ $requester->purpose_of_request }}">
                            
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
                            <input  type="text" class="form-control"  name="transferee_last_school" value="{{ $requester->last_university_attended }}">
                            
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
                              <input  type="text" class="form-control" name="authorized_person" value="{{ $requester->authorized_person }}">
                            
                              @if ($errors->has('authorized_person'))
                                <span class="text-danger">{{ $errors->first('authorized_person') }}</span>
                              @endif 
                            
                          </div>
                        </div>                                             
                      </div>
                    
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                      <a href="/requester">
                        <button type="button" class="btn btn-primary float-right">Cancel</button>
                      </a>
                    
                    </div>
                    
                </form>
                
            </div>
            <!-- /.card -->
          </div>
      </div>    

</div>
@endsection