@extends('layouts.app', ['activePage' => 'requester', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name) ])

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

          <div class="row ">
              <div class="col-sm-12">  
                  @if(session()->get('error'))
                      <div class="alert alert-danger">
                      {{ session()->get('error') }}  
                      </div>
                  @endif
              </div>
          </div>

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
      
        <div class="row">
          <div class="col-md-12">
              <div class="card">
              
                  <form method="POST" action="{{ route('requester.update',$requester->id) }} " id="editRequesterForm">
                  @method('PATCH')
                  @csrf
                      <div class="card-body">
                      <h5 style="color:blue;">Requester Information</h5> 
                        <hr class="my-12"/>
                        

                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                              <label>ID Number</label>
                              <input  type="text" class="form-control" name="id_no" value="{{ old('id_no',$requester->id_no) }}">
                              
                              <span class="text-danger error-text id_no_error"></span>

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>First Name</label>
                              <input  type="text" class="form-control" name="first_name" value="{{ old('first_name',$requester->first_name) }}"> 

                              <span class="text-danger error-text first_name_error"></span>                        

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Middle Name</label>
                              <input  type="text" class="form-control" name="middle_name" value="{{ old('middle_name',$requester->middle_name) }}">
                            
                              <span class="text-danger error-text middle_name_error"></span>

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input  type="text" class="form-control"  name="last_name" value="{{ old('last_name',$requester->last_name) }}">
                              
                              <span class="text-danger error-text last_name_error"></span>
                              
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Sex</label>
                                <select class="form-control" name="sex" style="width: 100%;">
                                  <option {{ old('sex',$requester->sex) == 'Male' ? 'selected' : '' }}  value="Male">Male</option>
                                  <option {{ old('sex',$requester->sex) == 'Female' ? 'selected' : '' }}  value="Female">Female</option>                                 
                                </select>
                                
                                <span class="text-danger error-text sex_error"></span> 
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Civil Status</label>
                              <select class="form-control" name="civil_status" value="{{ $requester->civil_status }}" style="width: 100%;">
                                
                                <option {{ old('civil_status',$requester->civil_status) == 'Single' ? 'selected' : '' }}  value="Single" >Single</option>
                                <option {{ old('civil_status',$requester->civil_status) == 'Married' ? 'selected' : '' }}  value="Married">Married</option>   
                                <option {{ old('civil_status',$requester->civil_status) == 'Divorced' ? 'selected' : '' }}  value="Divorced">Divorced</option>  
                                <option {{ old('civil_status',$requester->civil_status) == 'Widow' ? 'selected' : '' }}  value="Widow">Widow</option>                          
                                
                              </select>

                              <span class="text-danger error-text civil_status_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Religion</label>
                              <input  type="text" class="form-control"  name="religion" value="{{ old('religion',$requester->religion) }}">
                              
                              <span class="text-danger error-text religion_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Citizenship</label>
                              <input  type="text" class="form-control" name="citizenship" value="{{ old('citizenship', $requester->citizenship) }}">
                              
                              <span class="text-danger error-text citizenship_error"></span>
                              
                            </div>
                          </div> 
                        </div> 

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Requestor Type</label>
                                <select class="form-control" name="requestor_type" value="{{ old('requestor_type',$requester->requestor_type) }}"  style="width: 100%;">
                                  <option {{ old('requestor_type',$requester->requestor_type) == 'Current Student' ? 'selected' : '' }}  value="Current Student">Current Student</option>
                                  <option {{ old('requestor_type',$requester->requestor_type) == 'Alumnus' ? 'selected' : '' }}  value="Alumnus">Alumnus</option>                               
                                  
                                </select>
                              
                                <span class="text-danger error-text requestor_type_error"></span>

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Contact No.</label>
                              <input  type="text" class="form-control"  name="contact_no" id="mobile_no" value="{{ old('contact_no',$requester->contact_no) }}">
                              
                              <span class="text-danger error-text contact_no_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth</label>                             
                                <input type="text" class="datepicker form-control" name="birthdate" value="{{ old('birthdate',$requester->date_of_birth) }}">
                              
                                <span class="text-danger error-text birthdate_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Place of Birth</label>
                              <input  type="text" class="form-control" name="birth_place" value="{{ old('birth_place',$requester->place_of_birth ) }}">
                              
                              <span class="text-danger error-text birth_place_error"></span>
                              
                            </div>
                          </div>                                                                       
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>Name of Spouse (If married)</label>
                                <input  type="text" class="form-control" name="spouse_name" value="{{old('spouse_name', $requester->spouse )}}">
                              
                                <span class="text-danger error-text spouse_name_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Name of Father (Full Name)</label>
                              <input  type="text" class="form-control" name="father_fullname" value="{{ old('father_fullname',$requester->name_of_father) }}">
                              
                              <span class="text-danger error-text father_fullname_error"></span>
                              
                            </div>
                          </div>  
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Name of Mother (Full Maiden Name)</label>
                              <input  type="text" class="form-control" name="mother_fullmaidenname" value="{{ old('mother_fullname',$requester->maiden_name_of_mother) }}">
                              
                              <span class="text-danger error-text mother_fullmaidenname_error"></span>
                              
                            </div>
                          </div>                       
                        </div>

                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                                <label>Address of Parents</label>
                                <input  type="text" class="form-control" name="parents_address" value="{{ old('parents_address',$requester->address_of_parents) }}">
                              
                                <span class="text-danger error-text parents_address_error"></span>
                              
                            </div>
                          </div>
                                              
                        </div>

                        <div class="row">            
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Degree/Course</label>
                              <input  type="text" class="form-control"  name="degree" value="{{ old('degree',$requester->degree) }}">
                              
                              <span class="text-danger error-text degree_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Major/Option</label>
                              <input  type="text" class="form-control" name="option" value="{{ old('option',$requester->major_option )}}"> 
                              
                              <span class="text-danger error-text option_error"></span>
                              
                            </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Honor/Academic Distinction</label>
                              <input  type="text" class="form-control"  name="honor" value="{{ old('honor',$requester->academic_distinction )}}">
                              
                              <span class="text-danger error-text honor_error"></span>
                              
                            </div>
                          </div>
                        </div>  

                        <div class="row">            
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Date of Graduation</label>
                              <input type="text" class="form-control datepicker" name="graduation_date" value="{{ old('graduation_date',$requester->date_of_graduation) }}" >
                              
                              <span class="text-danger error-text graduation_date_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Last Semester Attended</label>
                              <select class="form-control" name="last_sem_attended"  style="width: 100%;">
                                
                                  <option {{ old('last_sem_attended',$requester->last_sem_attended) == '1st Sem' ? 'selected' : '' }}  value="1st Sem">1st Sem</option>                               
                                  <option {{ old('last_sem_attended',$requester->last_sem_attended) == '2nd Sem' ? 'selected' : '' }}  value="2nd Sem">2nd Sem</option>                               
                                  <option {{ old('last_sem_attended',$requester->last_sem_attended) == 'Summer' ? 'selected' : '' }}  value="Summer">Summer</option>                               
                                            
                              </select>

                              <span class="text-danger error-text last_sem_attended_error"></span>
                              
                            </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Last Academic Year Attended</label>
                              <input  type="text" class="form-control"  name="last_AY_attended" id="AY_attended" value="{{ old('last_AY_attended',$requester->last_sem_AY) }}">
                              
                              <span class="text-danger error-text last_AY_attended_error"></span>
                              
                            </div>
                          </div>
                        </div>                    
                        <div class="row">  
                                    
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>High School Graduated</label>
                              <input  type="text" class="form-control"  name="highschool_graduated" value="{{ old('highschool_graduated',$requester->highschool_graduated )}}">
                              
                              <span class="text-danger error-text highschool_graduated_error"></span>
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>High School Address</label>
                              <input  type="text" class="form-control" name="highschool_address" value="{{ old('highschool_address',$requester->highschool_address) }}">
                              
                              <span class="text-danger error-text highschool_address_error"></span>
                              
                            </div>
                          </div>                         
                        </div>
                      
                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Home Address</label>
                              <input  type="text" class="form-control"  name="home_address" value="{{  old('home_address',$requester->home_address) }}">
                              
                              <span class="text-danger error-text home_address_error"></span>
                              
                            </div>
                          </div>                        
                        </div> 
                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Mailing Address</label>
                              <input  type="text" class="form-control"  name="mailing_address" value="{{old('mailing_address', $requester->mailing_address) }}">
                              
                              <span class="text-danger error-text mailing_address_error"></span>
                              
                            </div>
                          </div>                        
                        </div>  

                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>If transferee, last School/University attended</label>
                              <input  type="text" class="form-control"  name="transferee_last_school" value="{{ old('transferee_last_school',$requester->last_university_attended) }}">
                              
                              <span class="text-danger error-text transferee_last_school_error"></span>
                              
                            </div>
                          </div>                        
                        </div>
                      
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                          <a href="/requester">
                            <button type="button" class="btn btn-secondary ml-1 float-right">Back</button>
                          </a>
                        </div>                      
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

             
          $("#editRequesterForm").on('submit', function(e){
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
                        $('#editRequesterForm')[0].reset();                                                         
                              window.location = "{{route('requester.index')}}";                           
                      }
                  }
              });
          });

          $(document).ready(function(){
            
           //$('#mobile_no').inputmask({"mask": "99999999999"}); 
            $('#AY_attended').inputmask({"mask": "9999 - 9999"}); 
           
          });

          $('.datepicker').datetimepicker({
            //defaultDate:'now',
            format: 'YYYY-MM-DD',

                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });

        
      }); 
        
        

</script>

@endpush