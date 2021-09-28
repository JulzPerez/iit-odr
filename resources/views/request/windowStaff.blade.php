@extends('layouts.app', ['activePage' => 'requests', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name) ])

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
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                            
                                <div class="btn-group float-right" role="group" aria-label="Basic example">
                            
                                    <button type="button" class="btn btn-info" id="btnRequests">Requests</button>
                                    <button type="button" class="btn btn-secondary" id="btnPending">For Assessment</button>
                                    <button type="button" class="btn btn-secondary" id="btnPaid">For Verification</button>
                                    
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="table-responsive" id="tblRequests" style="display:bock">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>Requestor</th>
                                        <th>Document</th>
                                        <th>Request Date</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if(($requests->isEmpty())) 
                                        <p>No requests found</p>
                                    @else
                                        @foreach($requests as $request)
                                        <tr>
                                            <td>
                                                <a href="{{ route('requester.show', $request->requestor_id) }}" >
                                                    {{ucfirst($request->first_name).' '.ucfirst($request->last_name)}}</td>                                                    
                                                </a>
                                            </td>
                                            <td>{{$request->docName." ".$request->docParticular}}</td>
                                            <td>{{\Carbon\Carbon::parse($request->request_date)->toFormattedDateString()}}</td> 
                                            <td>
                                                @if($request->request_status === 'paid')
                                                    {{$request->request_status}} 
                                                    <a href="{{route('payments.show', $request->request_id )}}">(proof of payment)
                                                    </a>
                                                @else 
                                                    {{$request->request_status}}
                                                @endif
                                            </td>                    
                                            <td class="td-actions text-right">
                                                    @if($request->request_status === 'pending')                                                    
                                               
                                                    <input type="hidden" class="request" value="{{$request->request_id}}">
                                                    <input type="hidden" class="docfee" value="{{$request->doc_fee}}">
                                                    <button type="button" class="btn btn-primary request_id" data-toggle="modal" data-target="#updatePages">
                                                        Assess
                                                    </button>

                                                    @else {{-- if($request->request_status === 'paid') --}}
                                                        <form action="{{ route('payments.verify',$request->request_id) }}" method="POST">
                                                        @csrf
                                                                <button type="submit" rel="tooltip" class="btn btn-success">
                                                                    <i class="material-icons">edit</i>Verify Payment
                                                                </button>                                                       
                                                        </form>
                                                    @endif
                                                   <!--  <button id="btnAssess" type="button" class="btn btn-warning request_id" data-toggle="modal" data-target="#exampleModal">
                                                        Additional Fees
                                                    </button> -->

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

                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive" id="tblPending" style="display:none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>Requestor</th>
                                        <th>Document</th>
                                        <th>Request Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                     
                                    @if(($pendingRequests === null)) 
                                        <p>No requests found</p>
                                    @else
                                        @foreach($pendingRequests as $pendingRequest)
                                        <tr>
                                            <td>
                                                <a href="{{ route('requester.show', $pendingRequest->requestor_id) }}" >
                                                    {{ucfirst($pendingRequest->first_name).' '.ucfirst($pendingRequest->last_name)}}</td>                                                    
                                                </a>
                                            </td>
                                            <td>{{$pendingRequest->docName." ".$pendingRequest->docParticular}}</td>
                                            <td>{{\Carbon\Carbon::parse($pendingRequest->request_date)->toFormattedDateString()}}</td>                        
                                            <td class="td-actions text-right">                        
                                               
                                                    <input type="hidden" class="request" value="{{$pendingRequest->request_id}}">
                                                    <input type="hidden" class="docfee" value="{{$pendingRequest->doc_fee}}">
                                                    <button type="button" class="btn btn-primary request_id" data-toggle="modal" data-target="#updatePages">
                                                        Assess
                                                    </button>
                                                   <!--  <button id="btnAssess" type="button" class="btn btn-warning request_id" data-toggle="modal" data-target="#exampleModal">
                                                        Additional Fees
                                                    </button> -->

                                                    @if($request->thread_id === null)
                                                    <a href="{{ route('messages.create', [$pendingRequest->request_id, $pendingRequest->requestor_id] ) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Create Message
                                                        </button>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('messages.show', $pendingRequest->thread_id) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Message
                                                        </button>
                                                    </a>
                                                    @endif                                              
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive" id="tblPaid" style="display:none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>Requestor</th>
                                        <th>Document</th>
                                        <th>Request Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                     
                                    @if(($paidRequests->isEmpty())) 
                                        <p>No requests found</p>
                                    @else
                                        @foreach($paidRequests as $paidRequest)
                                        <tr>
                                            <td>
                                                <a href="{{ route('requester.show', $paidRequest->requestor_id) }}" >
                                                    {{ucfirst($paidRequest->first_name).' '.ucfirst($paidRequest->last_name)}}</td>                                                    
                                                </a>
                                            </td>
                                            <td>{{$paidRequest->docName." ".$paidRequest->docParticular}}</td>
                                            <td>{{\Carbon\Carbon::parse($paidRequest->request_date)->toFormattedDateString()}}</td>                        
                                            <td class="td-actions text-right">

                                                    <form action="{{ route('payments.verify',$request->request_id) }}" method="POST">
                                                        @csrf
                                                            <button type="submit" rel="tooltip" class="btn btn-success">
                                                                <i class="material-icons">edit</i>Verify Payment
                                                            </button>                                                       
                                                    </form>
                                               
                                                   <!--  <button id="btnAssess" type="button" class="btn btn-warning request_id" data-toggle="modal" data-target="#exampleModal">
                                                        Additional Fees
                                                    </button> -->

                                                    @if($request->thread_id === null)
                                                    <a href="{{ route('messages.create', [$paidRequest->request_id, $paidRequest->requestor_id] ) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Create Message
                                                        </button>
                                                    </a>
                                                    @else
                                                    <a href="{{ route('messages.show', $paidRequest->thread_id) }}" >
                                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                                            Message
                                                        </button>
                                                    </a>
                                                    @endif   
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

<!-- Modal -->
<div class="modal fade" id="updatePages" tabindex="-1" role="dialog" aria-labelledby="updatePages" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatePages">Number of Pages:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form id="UpdatePagesForm">
      @csrf

      <div class="modal-body">            
            <div class="form-row">
                <div class="col">
                    <label>Enter Value:</label>
                </div>
                <div class="col">
                    <input type="hidden" name="requestID" id="requestID">
                    <input type="hidden" name="docFee" id="docFee">
                    <input type="number" name="pages" value="1">
                </div>
            </div>
           
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="btnPages" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
     
        
        $('button.request_id').on("click", function(e) {
                var row = $(this).closest('tr');
                var request_id = row.find('.request').val();
                var docfee = row.find('.docfee').val();

                $('#requestID').val(request_id);
                $('#docFee').val(docfee);
                //console.log(request_id);
        });
    
        $(function(){

            $("#UpdatePagesForm").on('submit', function(e){
                e.preventDefault();
                 
                $.ajax({
                    url: "{{ route('updatePages') }}",
                    method: 'POST',
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    success: function(data) {
                        if(data.status==1)
                            window.location.href = "{{route('request.index')}}";
                        else alert('something went wrong!');
                        
                    }
                });
            });
        });    
        
        $(document).ready(function () {
             
             $('#btnRequests').on('click',function(e) {
                        
                 document.getElementById("tblRequests").style.display = "block";         
                         
                 document.getElementById("tblPending").style.display = "none";  
                 
                 document.getElementById("tblPaid").style.display = "none"; 
              
                 
             });   
     
             $('#btnPending').on('click',function(e) {
     
                document.getElementById("tblRequests").style.display = "none";         
                         
                 document.getElementById("tblPending").style.display = "block";  
                 
                 document.getElementById("tblPaid").style.display = "none";
         
             });   

             $('#btnPaid').on('click',function(e) {
     
                document.getElementById("tblRequests").style.display = "none";         
                         
                 document.getElementById("tblPending").style.display = "none";  
                 
                 document.getElementById("tblPaid").style.display = "block";

            });
             
           });

    
</script>

@endpush