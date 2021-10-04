@extends('layouts.app', ['activePage' => 'assignments', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

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

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            
                                    @if($requests->isEmpty() )
                                        <p class="text-danger">No requests assigned yet.</p>                                
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th >#</th>
                                                    <th >Requester</th>
                                                    <th> Requested Document</th>   
                                                    <th > Request Date</th>  
                                                    
                                                    <!-- <th style="width:15%"> Payment Status</th> -->
                                                    <th> Action</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tbody style="line-height: 0.75">
                                                @foreach($requests as $key => $request)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <a href="{{ route('requester.show', $request->requestor_id) }}" >
                                                        {{ucfirst($request->first_name).' '.ucfirst($request->last_name)}}
                                                        
                                                        </a>
                                                    </td>
                                                   
                                                    <td>
                                                   
                                                        {{$request->docName.' '.$request->docParticular}}
                                                        <br>
                                                        <br>
                                                        <a href="">
                                                            View Attachments
                                                        </a>  
                                                  
                                                    </td>
                                                    <td>{{$request->created_at}}</td>
                                                   
                                                                                               
                                                    <td >
                                                     
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                      
                                                        <form action="{{ route('workAssignment.complete',$request->request_id) }}" method="POST">
                                                        @csrf
                                                                <button type="submit"  class="btn btn-secondary mr-1">
                                                                    <i class="material-icons">task</i><b style="color:blue">Mark Completed</b>
                                                                </button>                                                       
                                                        </form>

                                                        @if($request->thread_id === null)
                                                        <a href="{{ route('messages.create', [$request->request_id, $request->requestor_id] ) }}" >
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="material-icons">chat</i><b style="color:purple">Send Message </b>
                                                            </button>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('messages.show', $request->thread_id) }}" >
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                                            <i class="material-icons">chat</i><b style="color:purple">View Message </b>
                                                            </button>
                                                        </a>
                                                        @endif
                                                    </div>
                                                       
                                                    </td>
                                                    
                                                                                
                                                </tr>                            
                                                @endforeach
                                    @endif    
                                            </tbody>
                                        
                                        </table>
                                    
                             
                            
                        </div> 
                    
                        
                    </div>              
                </div> 
            </div>       
        </div>    

    </div>
</div>
@endsection