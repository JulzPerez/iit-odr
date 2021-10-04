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
      
        <div class="row ">
          <div class="col-md-12">
              <div class="card">
              
                  <form method="POST" action="{{ route('requester.store') }} " id="newRequesterForm">
                  @csrf
                      <div class="card-body">
                      <h5 style="color:blue;">Requester Info Form</h5> 
                        <hr class="my-12"/>
                        

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="bmd-label-floating">ID Number</label>
                              <input  type="text" class="form-control" name="id_no" >
                              
                              <span class="text-danger error-text id_no_error"></span>                            

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>First Name</label>
                              <input  type="text" class="form-control" name="first_name" > 

                              <span class="text-danger error-text first_name_error"></span>                                               

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Middle Name</label>
                              <input  type="text" class="form-control" name="middle_name" >
                            
                              <span class="text-danger error-text middle_name_error"></span>
                             

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input  type="text" class="form-control"  name="last_name" >
                              
                              <span class="text-danger error-text last_name_error"></span>                          
                              
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">Sex</label>
                                <select class="form-control" name="sex" style="width: 100%;">
                                  <option value="" >--Select--</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>                            
                                  
                                </select>
                              
                                <span class="text-danger error-text sex_error"></span>
                            
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Civil Status</label>
                              <select class="form-control" name="civil_status"   style="width: 100%;">
                                  <option value="" >--Select--</option>
                                  <option value="Single">Single</option>
                                  <option value="Married">Married</option>    
                                  <option value="Widow">Widow</option>                          
                                  
                                </select>

                                <span class="text-danger error-text civil_status_error"></span>
                            
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Religion</label>
                              <input  type="text" class="form-control"  name="religion" >
                              
                              <span class="text-danger error-text religion_error"></span>
                            
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Citizenship</label>
                              <input  type="text" class="form-control" name="citizenship" >
                              
                              <span class="text-danger error-text citizenship_error"></span>
                             
                              
                            </div>
                          </div> 
                        </div> 

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Requestor Type</label>
                                <select class="form-control" name="requestor_type"  data-placeholder="Select from options below" style="width: 100%;">
                                <option value="" >--Select--</option>
                                  <option value="Current Student">Current Student</option>
                                  <option value="Alumnus">Alumnus</option>                               
                                  
                                </select>
                              
                                <span class="text-danger error-text requestor_type_error"></span>
                                

                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Mobile No.</label>
                              <input  type="text" class="form-control"  name="contact_no" id="mobile_no" placeholder="0917-123-4567">
                            
                              
                              <span class="text-danger error-text contact_no_error"></span>
                           
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth</label>                             
                                <input type="date" class="date form-control" name="birthdate" >
                              
                                <span class="text-danger error-text birthdate_error"></span>
                             
                              
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Place of Birth</label>
                              <input  type="text" class="form-control" name="birth_place" >

                              <span class="text-danger error-text birth_place_error"></span>                             
                            
                              
                            </div>
                          </div>                                                                       
                        </div>

                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>Name of Spouse (If married)</label>
                                <input  type="text" class="form-control" name="spouse_name" >
                              
                                <span class="text-danger error-text spouse_name_error"></span>
                            
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Name of Father (Full Name)</label>
                              <input  type="text" class="form-control" name="father_fullname" >
                              
                              <span class="text-danger error-text father_fullname_error"></span>                            
                              
                            </div>
                          </div>  
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Name of Mother (Full Maiden Name)</label>
                              <input  type="text" class="form-control" name="mother_fullmaidenname" >
                              
                              <span class="text-danger error-text mother_fullmaidenname_error"></span>
                             
                              
                            </div>
                          </div>                       
                        </div>

                        <div class="row">
                          <div class="col-md-8">
                            <div class="form-group">
                                <label>Address of Parents</label>
                                <input  type="text" class="form-control" name="parents_address" >
                              
                                <span class="text-danger error-text parents_address_error"></span>                              
                              
                            </div>
                          </div>
                                              
                        </div>

                        <div class="row">            
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Degree/Course</label>
                              <input  type="text" class="form-control"  name="degree" >
                              
                              <span class="text-danger error-text degree_error"></span>
                                                          
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Major/Option</label>
                              <input  type="text" class="form-control" name="option" > 
                              
                              <span class="text-danger error-text option_error"></span>
                                                          
                            </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Honor/Academic Distinction</label>
                              <input  type="text" class="form-control"  name="honor" >

                              <span class="text-danger error-text honor_error"></span>
                                                            
                            </div>
                          </div>
                        </div>  

                        <div class="row">            
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Date of Graduation</label>
                              <input type="date" class="form-control" name="graduation_date"  >
                              
                              <span class="text-danger error-text graduation_date_error"></span>
                            
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Last Semester Attended</label>
                              <select class="form-control" name="last_sem_attended"  style="width: 100%;">
                                  <option value="" >--Select--</option>
                                  <option value="1st Sem">1st Sem</option>
                                  <option value="2nd Sem">2nd Sem</option>   
                                  <option value="Summer">Summer</option>                   
                                  
                              </select>
                            
                              <span class="text-danger error-text last_sem_attended_error"></span>
                             
                              
                            </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Last Academic Year Attended</label>
                              <input  type="text/javascript" class="form-control" id="AY_attended" name="last_AY_attended" placeholder="2020-2021">
                              
                              <span class="text-danger error-text last_AY_attended_error"></span>
                             
                              
                            </div>
                          </div>
                        </div>                    
                        <div class="row">  
                                    
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>High School Graduated</label>
                              <input  type="text" class="form-control"  name="highschool_graduated" >
                              
                              <span class="text-danger error-text highschool_graduated_error"></span>
                         
                              
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>High School Address</label>
                              <input  type="text" class="form-control" name="highschool_address" >
                              
                              <span class="text-danger error-text highschool_address_error"></span>
                             
                              
                            </div>
                          </div>                         
                        </div>
                      
                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Home Address</label>
                              <input  type="text" class="form-control"  name="home_address" >
                              
                              <span class="text-danger error-text home_address_error"></span>
                              
                              
                            </div>
                          </div>                        
                        </div> 
                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Mailing Address</label>
                              <input  type="text" class="form-control"  name="mailing_address" >
                              
                              <span class="text-danger error-text mailing_address_error"></span>
                     
                            </div>
                          </div>                        
                        </div>  

                        <div class="row">            
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>If transferee, last School/University attended</label>
                              <input  type="text" class="form-control"  name="transferee_last_school" >
                              
                              <span class="text-danger error-text transferee_last_school_error"></span>
                            
                            </div>
                          </div>                        
                        </div>                      
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <div class="btn-group " role="group" aria-label="Basic example">
                          <button type="submit" class="btn btn-primary float-right">Save Data</button>
                          <a href="{{route('requester.index') }}">
                            <button type="button" class="btn btn-secondary float-right ml-1">Back</button>
                          </a>
                        </div>

                        <div id='loader' style='display: none; '>
                              <span>Saving data ... </span>
                              <img src='/images/progress-bar.gif' width='100px' height='100px'>
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

             
          $("#newRequesterForm").on('submit', function(e){
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
                    $("#loader").show();
                  },
                  complete:function(data){
                    
                    $("#loader").hide();
                  },
                  success:function(data){
                    
                      if(data.status == 0){
                       
                          $.each(data.error, function(prefix, val){
                           
                              $('span.'+prefix+'_error').text(val[0]); 
                                                   
                          }); 
                          
                      }
                      else
                      {
                        $('#newRequesterForm')[0].reset();                                                         
                              window.location = "{{route('requester.index')}}";                           
                      }
                  }
              });
          });

          $(document).ready(function(){
            
           // $('#mobile_no').inputmask({"mask": "99999999999"}); 
            $('#AY_attended').inputmask({"mask": "9999 - 9999"});
           
          });
        
      }); 


</script>

@endpush