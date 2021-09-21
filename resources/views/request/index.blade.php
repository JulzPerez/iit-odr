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
                        @if(count($all_request)===0)
                        <p class="text-danger">No request found.</p>    
                        @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><strong>REQUEST</strong></th>
                                        <th><strong>STATUS</strong></th>
                                       
                                        <th class="text-center"><strong>Actions</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($all_request as $key =>$request)
                                    <tr>
                                        <td>
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
                                                    <b>{{\Carbon\Carbon::parse($request->request_date)->toFormattedDateString()}}</b>   
                                                
                                                </div>                                     
                                            </div>
                                            
                                        </td>
                                        <td>
                                            <div class="form-row">
                                                <div class="col" >
                                                    <label>Request Status </label>
                                                </div>
                                                <div class="col">
                                                    <b>{{$request->request_status}}</b>   
                                                </div>                                     
                                            </div>
                                            @if($request->auto_assess === 1 OR $request->request_status === 'assessed')
                                                <div class="form-row">                                        
                                                        <div class="col" >
                                                            Assessment Fee:                                                            
                                                        </div>
                                                        <div class="col" >                                                           
                                                            <b style="color:red">Php {{$request->assessment_total}}</b>
                                                        </div>                                                                                                        
                                                </div>
                                                <div class="form-row">
                                                    <div class="col" >
                                                        Assessed By:                                                           
                                                    </div>
                                                    <div class="col" >
                                                       <b> {{$request->assessed_by}}  </b>                                                        
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-row">                                        
                                                    <div class="col" >
                                                        Assessment Fee
                                                        
                                                    </div>   
                                                    <div class="col" >
                                                        <span class="badge bg-danger text-white ">pending for assessment</span>                                                            
                                                    </div>                                             
                                                </div>
                                                <div class="form-row">
                                                    <div class="col" >
                                                        Assessed By:                                                            
                                                    </div>
                                                    @if($request->assessed_by != 'auto assess')
                                                    <div class="col" >
                                                        {{$request->assessed_by}}                                                          
                                                    </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </td>

                                        <td class="td-actions text-right">
                                            <div class="form-row">
                                                <div class="col">
                                                    @if($request->thread_id === null)
                                                    <a href="{{ route('messages.create', [$request->request_id, $request->requestor_id] ) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Create Message
                                                        </button>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('messages.show', $request->thread_id) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Message
                                                        </button>
                                                    </a>
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
                                                                <button type="button" class="btn btn-info"><i class="material-icons">file_upload</i>
                                                                 Upload Proof of Payment
                                                                </button>
                                                            <!-- <i class="fas fa-edit"></i> -->
                                                            </a>
                                                        </div>
                                                        <br>
                                                    @elseif($request->request_status === 'paid' AND $request->payment_status==='verified')
                                                        <p>Assessment was verified.</p>
                                                        <a href="{{ route('request.show', $request->request_id) }}" >View Assessment
                                                        <!-- <i class="fas fa-edit"></i> -->
                                                        </a>
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