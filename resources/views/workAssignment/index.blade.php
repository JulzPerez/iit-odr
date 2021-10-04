@extends('layouts.app', ['activePage' => 'workAssignment', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

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
                        
                        <div class="row mt-1">
                            <div class="col-md-12">
                                <!-- <div class="card card-outline card-info">               
                                    <div class="card-body" > -->
                                    @if($requests->isEmpty())
                                        <p class="text-danger">No request for assignment yet.</p>                                
                                    @else
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th >#</th>
                                                    <th >Requester</th>
                                                    <th > Requested Document</th>   
                                                    <th > Request Date</th>  
                                                    
                                                    <th > Action</th>
                                                    
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
                                                    <!-- <td>{{$request->docName.' '.$request->docParticular}}</td> -->
                                                    <td>
                                                    
                                                        {{$request->docName.' '.$request->docParticular}}
                                                        <br>
                                                        <br>
                                                        <a href="">
                                                            View Attachments
                                                        </a> 
                                                   
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($request->request_date)->toDateTimeString()}}</td>
                                                   
                                                    <td >
                                                    <form method="POST" action="{{ route('workAssignment') }}" id="formAssignWork"> 
                                                    @csrf   
                                                        <div class="form-group">                            
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <select class="form-control " name="assigned_to"  id="assigned_to">
                                                                        <option value=""> --Select-- </option>  
                                                                        @foreach($users as $user)
                                                                            <option value="{{$user->id}}"> {{ucfirst($user->first_name).' '.ucfirst(substr($user->middle_name, 0, 1)).' '.ucfirst($user->last_name)}} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <span class="input-group-button">
                                                                        <button type="submit" class="btn btn-info">Assign</button>
                                                                    </span>        
                                                                </div>
                                                                <input type="hidden" name="request_id" value="{{ $request->request_id }}">
                                                                <input type="hidden" name="user_fullname" id="user_fullname">                                                            
                                                            </div>
                                                            <span class="text-danger error-text user_fullname_error"></span>

                                                            <!-- @if ($errors->has('assigned_to'))
                                                                <span class="text-danger">{{ $errors->first('assigned_to') }}</span>
                                                            @endif  -->
                                                        </div>
                                                    </form>
                                                    </td>                                                
                                                                                
                                                </tr>                            
                                                @endforeach
                                    @endif    
                                            </tbody>
                                        
                                        </table>
                                    
                                <!--  </div>
                                </div> -->
                                <!-- /.card-body -->
                                
                                <!-- /.card -->
                            </div>
                        </div> 
                    
                        
                    </div>              
                </div> 
            </div>       
        </div>    

    </div>
</div>
@endsection

@push('js')

<script type="text/javascript">
        
        $(document).ready(function () {    
            $('#assigned_to').on('click',function(e) {

                var select = document.getElementById('assigned_to');
				var option = select.options[select.selectedIndex];

				document.getElementById('user_fullname').value = option.text;

            }); 
        });

        $("#formAssignWork").on('submit', function(e){
              e.preventDefault();

              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });

              
              $.ajax({
                  url:$(this).attr('action'),
                  method:$(this).attr('method'),
                  data:new FormData(this),
                  processData:false,
                  dataType:'json',
                  contentType:false,
                  beforeSend:function(){    
                      $(document).find('span.error-text').text('');  
           
                      //$("#loader").show();                      
                  },
                
                  success:function(data){
                    
                      if(data.status == 0){
                       
                          $.each(data.error, function(prefix, val){
                           
                              $('span.'+prefix+'_error').text(val[0]); 
                          }); 
                          
                      }else
                      {                                                                             
                        window.location = "{{route('workAssignment')}}";                           
                      }
                  }
              });
        });

</script>
@endpush