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
        <br>
        

        <div class="row ">
                
            <div class="col-md-12">
                <div class="card card-danger card-outline">              
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>  Requester Information </h5>
                            
                                <a href="{{ route('requester.edit', $requester->id) }}">
                                    <button  type="button" class="btn btn-info btn-flat float-right "><i class="fas fa-edit"></i>Edit Profile</button>
                                </a>
                                <!-- <a href="/messages/create">
                                    <button  type="button" class="btn btn-info btn-flat "><i class="fab fa-facebook-messenger"></i>Create Message</button>
                                </a>  -->     
                                <a href="{{route('request.create') }}">
                                    <button  type="button" class="btn btn-danger btn-flat float-right  "><i class="fas fa-folder-plus"></i>Create Request</button>
                                </a>       
                            </div>
                        </div>
                    

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <table class="table table-hover" style="border-style: hidden">
                                    <tbody>
                                        <tr>
                                            <td  width="40%"> <label>ID No.</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->id_no)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Full Name</label></td>
                                            <td class="text-olive "> {{ucfirst($requester->first_name)}} {{ucfirst($requester->middle_name)}} {{ucfirst($requester->last_name)}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td ><label>Contact Number</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->contact_no)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Sex</label></td>
                                            <td class="text-olive ">{{ ucfirst($requester->sex)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Civil Status</label></td>
                                            <td class="text-olive ">{{ ucfirst($requester->civil_status)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Religion</label></td>
                                            <td class="text-olive ">{{ ucfirst($requester->religion)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Citizenship</label></td>
                                            <td class="text-olive ">{{ ucfirst($requester->citizenship)}}</td>
                                        </tr>

                                        <tr>
                                            <td ><label>Date of Birth</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->date_of_birth)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Place of Birth</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->place_of_birth)}}</td>
                                        </tr>
                                        
                                    
                                    </tbody>                          
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-hover" style="border-style: hidden">
                                    <tbody>

                                    <tr>
                                            <td width="40%"><label>Degree/Course</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->degree)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Major/Option</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->major_option)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Honor/Academic Distinction</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->academic_distinction)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Date of Graduation</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->date_of_graduation)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Last Semester Attended</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->last_sem_attended)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Last Academic Year Attended</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->last_sem_AY)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>High School Graduated</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->highschool_graduated)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>High School Address</label></td>
                                            <td class="text-olive "> {{ ucfirst($requester->highschool_address)}}</td>
                                        </tr>
                                    
                                    </tbody>                          
                                </table>
                            </div>
                            <hr>
                            <div class="col-md-6">
                                <table class="table table-hover" style="border-style: hidden">
                                    <tbody>

                                        <tr >
                                            <td width="40%"><label>Name of Spouse (If married)</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->spouse)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Name of Father (Full Name)</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->name_of_father)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Name of Mother (Full Maiden Name)</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->maiden_name_of_mother)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Address of Parents</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->address_of_parents)}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td ><label>Home Address</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->home_address)}}</td>
                                        </tr>
                                        <tr>
                                            <td ><label>Mailing Address</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->mailing_address)}}</td>
                                        </tr>
                                    
                                        <tr>
                                            <td ><label>Last School/University attended (For transferee)</label></td>
                                            <td class="text-olive"> {{ ucfirst($requester->last_university_attended)}}</td>
                                        </tr>
                                    
                                    </tbody>                          
                                </table>
                            </div>
                        </div>
                    
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
@endsection