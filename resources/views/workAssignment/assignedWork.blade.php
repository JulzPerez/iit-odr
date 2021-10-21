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
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th ><strong>#</th>
                                                    <th > <strong>Requester</th>
                                                    <th> <strong>Requested Document</th>   
                                                    <th><strong>Purpose of Request</strong></th>  
                                                    
                                                    <!-- <th style="width:15%"> Payment Status</th> -->
                                                    <th><strong> Action</th>
                                                    
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
                                                   
                                                    <td style="text-align: center">
                                                    
                                                        {{$request->docName.' '.$request->docParticular}}
                                                        <br>
                                                        @if($request->require_file_upload === 1)
                                                        <br>
                                                        <input type="hidden" class="attachment_request" name="requestID" value="{{$request->request_id}}">
                                                        <button type="button" class="btn btn-link btn-sm attachment_requestID mr-1" id="attachment">
                                                            <i class="material-icons">attachment</i><b style="color:red"> Attachment</b>
                                                        </button>
                                                        @endif
                                                   
                                                    </td>
                                                    
                                                    <td>{{$request->purpose_of_request}}</td>                                                   
                                                                                               
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

<!-- View attachments Modal -->
<div class="modal fade" id="viewAttachmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAttachment" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id=""><b style="color:blue">Attachments</b></h5>
        
      </div>
        
     
        <div class="table-responsive">
                <table class="table" id="tblAttachments">

                </table>
        </div>
   

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           
      </div>
     
    </div>
  </div>
</div>  

    </div>
</div>
@endsection

@push('js')

<script type="text/javascript">
        
        $('button.attachment_requestID').on("click", function(e) {
                var row = $(this).closest('tr');
                var request_id = row.find('.attachment_request').val();  
                console.log(request_id);

                $.ajax({
                    url: "/request/getAttachments/"+ request_id,
                    method: 'GET',
                    success: function(data) {
                       //console.log(data.html);
                       $('#tblAttachments').html(data.html);
                       $("#viewAttachmentModal").modal('show');
                    }
                });
               
            });

       

</script>
@endpush