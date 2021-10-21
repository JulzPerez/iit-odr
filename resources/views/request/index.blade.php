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
            <div class="col-md-12">
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
                            <table class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th><strong>REQUEST</strong></th>
                                        <th><strong>STATUS</strong></th>
                                       
                                        <th class="text-center"><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($all_request as $key =>$request)
                                    <tr style="height:200px">
                                        <td width="35%">
                                            <div class="form-row">
                                                <div class="col" >
                                                    <label>Document </label>
                                                </div>
                                                <div class="col">
                                                    <b>{{$request->docName.' '.$request->docParticular}}</b>   
                                                </div>                                     
                                            </div>

                                            <div class="form-row">
                                                <div class="col" >
                                                    <label>Request Date: </label>
                                                </div>
                                                <div class="col" >
                                                    <b>{{\Carbon\Carbon::parse($request->request_date)->toDateTimeString()}}</b>   
                                                
                                                </div>                                     
                                            </div>
                                            
                                        </td>
                                        <td width="35%">
                                            <div class="form-row">
                                                <div class="col" >
                                                    <label>Request Status </label>
                                                </div>
                                                <div class="col">
                                                    <b>{{$request->request_status}}</b>   
                                                </div>                                     
                                            </div>
                                            @if($request->auto_assess === 1 OR $request->request_status === 'assessed' 
                                                OR $request->request_status === 'paid' OR $request->request_status === 'verified' 
                                                OR $request->request_status === 'completed'
                                                OR $request->request_status === 'processing')
                                                <div class="form-row">                                        
                                                        <div class="col" >
                                                            <label>Assessment Fee:   </label>                                                         
                                                        </div>
                                                        <div class="col" >                                                           
                                                            <b style="color:red">Php {{$request->assessment_total}}</b>
                                                        </div>                                                                                                        
                                                </div>
                                                <div class="form-row">
                                                    <div class="col" >
                                                        <label>Assessed By:  </label>                                                         
                                                    </div>
                                                    <div class="col" >
                                                     <b>{{$request->assessed_by}}  </b>                                                      
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-row">                                        
                                                    <div class="col" >
                                                        <label>Assessment Fee</label>
                                                        
                                                    </div>   
                                                    <div class="col" >
                                                        <p>pending for assessment<p>                                                          
                                                    </div>                                             
                                                </div>
                                                <div class="form-row">
                                                    <div class="col" >
                                                        <label>Assessed By:</label>                                                            
                                                    </div>
                                                    @if($request->assessed_by != 'auto assess')
                                                    <div class="col" >
                                                        <b>{{$request->assessed_by}}  </b>                                                        
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>

                                        <td class="td-actions text-right">
                                            <div class="form-row">
                                                <div class="col">
                                                    @if($request->thread_id != null)
                                                        <?php $count = Auth::user()->newThreadsCount(); ?>
                                                    <a href="{{ route('messages.show', $request->thread_id) }}" >
                                                        <button type="button" class="btn btn-secondary mt-1 mb-1" >
                                                            <i class="material-icons">chat</i><b style="color:purple">View Message</b>
                                                                @if($count > 0)
                                                                    <span class="text-danger">New</span>
                                                                @endif
                                                        </button>
                                                    </a>
                                                    
                                                    <!-- <a href="{{ route('messages.create', [$request->request_id, $request->requestor_id] ) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Create Message
                                                        </button>
                                                    </a> -->                                                  
                                                    
                                                    @endif
                                                   
                                                </div>  
                                                                                      
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col">
                                                        @if($request->request_status === 'assessed')
                                                                                                
                                                        <div>
                                                            <a href="{{ route('showUploadPaymentForm',
                                                                    [
                                                                    $request->request_id,
                                                                    $request->docName.' '.$request->docParticular,                                                                    
                                                                    ] 
                                                                ) }}" >
                                                                <button type="button" class="btn btn-secondary"><i class="material-icons">file_upload</i>
                                                                 <b style="color:blue">Upload Proof of Payment</b>
                                                                </button>
                                                            <!-- <i class="fas fa-edit"></i> -->
                                                            </a>
                                                        </div>
                                                        <br>
                                                  
                                                    @endif
                                                </div>
                                                                                    
                                            </div>
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
        </div> 
        

    </div>
</div>
@endsection

