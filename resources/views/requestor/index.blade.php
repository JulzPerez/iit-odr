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
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="card">
              <div class="card-header ">
              <h5 class="float-left" style="color:blue;">Requester Information</h5>
                  <a href="{{ route('requester.edit', $requester->id) }}">
                      <button  type="button" class="btn btn-primary float-right">Make Changes</button>
                  </a>
              </div>
              <div class="card-body">                 
              
                  <table class="table table-bordered table-condensed">
                      <tbody>
                          <tr>
                              <td class="first" width="30%">ID No.</td>
                              <td class="second"> {{ ucfirst($requester->id_no)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Full Name</td>
                              <td class="second"> {{ucfirst($requester->first_name)}} {{ucfirst($requester->middle_name)}} {{ucfirst($requester->last_name)}}</td>
                          </tr>
                          <tr>
                              <td class="first" >Sex</td>
                              <td class="second"> {{ ucfirst($requester->sex)}}</td>
                          </tr>
                          <tr>
                              <td class="first" width="20%">Civil Status</td>
                              <td class="second"> {{ ucfirst($requester->civil_status)}}</td>
                          </tr>
                          <tr>
                              <td class="first" width="20%">Religion</td>
                              <td class="second"> {{ ucfirst($requester->religion)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Citizenship</td>
                              <td class="second"> {{ ucfirst($requester->citizenship)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Requestor Type</td>
                              <td class="second"> {{ ucfirst($requester->requestor_type)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Contact Number</td>
                              <td class="second"> {{ ucfirst($requester->contact_no)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Date of Birth</td>
                              <td class="second"> {{ ucfirst($requester->date_of_birth)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Place of Birth</td>
                              <td class="second"> {{ ucfirst($requester->place_of_birth)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Name of Spouse (If married)</td>
                              <td class="second"> {{ ucfirst($requester->spouse)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Name of Father (Full Name)</td>
                              <td class="second"> {{ ucfirst($requester->name_of_father)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Name of Mother (Full Maiden Name)</td>
                              <td class="second"> {{ ucfirst($requester->maiden_name_of_mother)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Address of Parents</td>
                              <td class="second"> {{ ucfirst($requester->address_of_parents)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Degree/Course</td>
                              <td class="second"> {{ ucfirst($requester->degree)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Major/Option</td>
                              <td class="second"> {{ ucfirst($requester->major_option)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Honor/Academic Distinction</td>
                              <td class="second"> {{ ucfirst($requester->academic_distinction)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Date of Graduation</td>
                              <td class="second"> {{ ucfirst($requester->date_of_graduation)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Last Semester Attended</td>
                              <td class="second"> {{ ucfirst($requester->last_sem_attended)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Last Academic Year Attended</td>
                              <td class="second"> {{ ucfirst($requester->last_sem_AY)}}</td>
                          </tr>
                          <tr>
                              <td class="first">High School Graduated</td>
                              <td class="second"> {{ ucfirst($requester->highschool_graduated)}}</td>
                          </tr>
                          <tr>
                              <td class="first">High School Address</td>
                              <td class="second"> {{ ucfirst($requester->highschool_address)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Home Address</td>
                              <td class="second"> {{ ucfirst($requester->home_address)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Mailing Address</td>
                              <td class="second"> {{ ucfirst($requester->mailing_address)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Purpose of Request</td>
                              <td class="second"> {{ ucfirst($requester->purpose_of_request)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Last School/University attended (For transferee)</td>
                              <td class="second"> {{ ucfirst($requester->last_university_attended)}}</td>
                          </tr>
                          <tr>
                              <td class="first">Authorized Person</td>
                              <td class="second"> {{ ucfirst($requester->authorized_person)}}</td>
                          </tr>
                          
                  </table>
                  
              </div>
          </div>
        </div>
    </div>
</div>
@endsection