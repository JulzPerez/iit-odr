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
    <br>
    <h5> <strong class="text-blue"> Requester Information </strong></h5>

    <div class="row ">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="images/profile.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ucfirst($requester->first_name).' '.ucfirst($requester->last_name)}}</h3>

                <p class="text-muted text-center">{{ $requester->requestor_type}}</p>

                <hr>
                <a href="{{ route('requester.edit', $requester->id) }}">
                    <button  type="button" class="btn btn-primary ">Edit Info</button>
                </a>
                <a href="#">
                    <button  type="button" class="btn btn-primary ">Message</button>
                </a>
                
                <hr>
                
                <strong>Sex</strong>
                <p class="text-muted">{{ ucfirst($requester->sex)}} </p>

                <strong>Civil Status</strong>
                <p class="text-muted">{{ ucfirst($requester->civil_status)}} </p>

                <strong>Religion</strong>
                <p class="text-muted">{{ ucfirst($requester->religion)}} </p>

                <strong>Citizenship</strong>
                <p class="text-muted">{{ ucfirst($requester->citizenship)}} </p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->            
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card card-primary card-outline">
              
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
                    </tbody>                          
                </table>
                
                
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
         <!-- /.col -->
</div>
@endsection