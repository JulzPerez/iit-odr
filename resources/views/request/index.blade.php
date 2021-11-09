@extends('layouts.app', ['activePage' => 'request', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

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

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header card-header-icon card-header-rose">
                        <a href="{{route('request.create') }}"> 
                            <div class="card-icon text-white">
                                <i class="material-icons">create</i>                                
                                    New Request                                                               
                            </div>
                        </a>
                        
                    </div>
                    <!-- <div class="card-header card-header-rose">
                        <div class="col-md-12 ">
                            <a href="{{route('request.create') }}">
                                <button  type="button" class="btn btn-danger " ><i class="material-icons">add_circle_outline
                                    </i>New Request
                                </button>
                            </a>

                        </div>
                    </div> -->
                    <div class="card-body">
                        @if($all_request->isEmpty())
                        <p class="text-danger">You have no request created so far.</p>    
                        @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><strong>REQUESTS</strong></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($all_request as $key =>$request)
                                    <tr style="height:200px">
                                        <td>
                                            <div class="form-row">
                                                <div class="col-md-6" >
                                                    <label>Document </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <b>{{$request->docName.' '.$request->docParticular}}</b>   
                                                </div>                                     
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6" >
                                                    <label>Request Date: </label>
                                                </div>
                                                <div class="col-md-6" >
                                                    <b>{{\Carbon\Carbon::parse($request->request_date)->toDateTimeString()}}</b>   
                                                
                                                </div>                                     
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6" >
                                                    <label>Request Status </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <span class="badge badge-primary">{{$request->request_status}}</span>
                                                    
                                                </div>                                     
                                            </div>

                                            @if($request->auto_assess === 1 OR $request->request_status === 'assessed' 
                                                OR $request->request_status === 'paid' OR $request->request_status === 'verified' 
                                                OR $request->request_status === 'completed'
                                                OR $request->request_status === 'processing'
                                                OR $request->request_status === 'released')
                                                <div class="form-row">                                        
                                                        <div class="col-md-6" >
                                                            <label>Assessment Fee:   </label>                                                         
                                                        </div>
                                                        <div class="col-md-6" >                                                           
                                                            <b style="color:red">Php {{$request->assessment_total}}</b>
                                                            <br>
                                                     @if($request->request_status === 'assessed')
                                                                                                
                                                        <div>
                                                            <a href="{{ route('showUploadPaymentForm',
                                                                    [
                                                                    $request->request_id,
                                                                    $request->docName.' '.$request->docParticular,                                                                    
                                                                    ] 
                                                                ) }}" >
                                                                <button type="button" class="btn btn-link btn-sm"><i class="material-icons">file_upload</i>
                                                                    <b style="color:blue">Upload Proof of Payment</b>
                                                                </button>
                                                            <!-- <i class="fas fa-edit"></i> -->
                                                            </a>
                                                        </div>
                                                        <br>
                                                    
                                                    @endif
                                                        </div> 
                                                        
                                                                                                                                                              
                                                </div>
                                                
                                            @else
                                                <div class="form-row">                                        
                                                    <div class="col-md-6" >
                                                        <label>Assessment Fee</label>
                                                        
                                                    </div>   
                                                    <div class="col-md-6" >
                                                        <p>pending for assessment<p>                                                          
                                                    </div>                                             
                                                </div>
                                               
                                            @endif
                                            
                                        </td>
                                       

                                       
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="alert alert-success">
                   
                    <h5><i class="icon fas fa-info"></i> NOTE</h5>
                    <ol start="1">
                        <li>Complete the STUDENT PROFILE by filling in all required information, and submit, before creating the request.</li>
                        <li>When uploading file, only PDF format is accepted. Please convert your file to PDF before uploading.</li>
                        
                    </ol>
                </div>
            </div>
        </div> 

      
        

    </div>
</div>
@endsection

