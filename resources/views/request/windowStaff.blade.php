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

        <div class="row" style="display:none" id="msg_row">
            <div class="col-sm-12">
                <div class="alert alert-success" id="success_alert">
                  <!--  <p id="success_alert"></p -->
                  <p>Hello successful</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-md-12">
                            
                                <a href="{{route('getRequests','pending') }}">
                                
                                    <button type="button" class="btn btn-primary">For Assessment</button>
                                </a>                            
                                <a href="{{route('getRequests','paid') }}">
                                
                                    <button type="button" class="btn btn-info">For Verification</button>
                                </a>

                                <a href="{{route('getRequests','assessed') }}">
                                    
                                    <button type="button" class="btn btn-warning">Assessed</button>
                                </a>

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
                        <div class="table-responsive">
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
                                    @if($requests === null)
                                        <p>Click on the button to view request.</p>
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
                                            <td class="td-actions text-right">
                                                @if($status === 'pending')
                                               
                                                    <input type="hidden" class="request" value="{{$request->request_id}}">
                                                    <button type="button" class="btn btn-primary request_id" data-toggle="modal" data-target="#updatePages">
                                                        Assess
                                                    </button>
                                                    <button id="btnAssess" type="button" class="btn btn-warning request_id" data-toggle="modal" data-target="#exampleModal">
                                                        Additional Fees
                                                    </button>

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

                                                @elseif($status === 'paid')
                                                <a href="#">
                                                    <button type="button" rel="tooltip" class="btn btn-success">
                                                        <i class="material-icons">edit</i>Verify Payment
                                                    </button>
                                                </a>
                                                @elseif($request->request_status === 'assessed')
                                                    
                                               
                                                
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
     
        var request_id;
        
        $('button.request_id').on("click", function(e) {
                var row = $(this).closest('tr');
                request_id = row.find('.request').val();

                $('#requestID').val(request_id);
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
                        window.location.href = "{{route('getRequests','pending') }}";
                        
                    }
                });
            });
        });         

    
</script>

@endpush