@extends('layouts.app', ['activePage' => 'monitoring', 'titlePage' => 'Welcome, '.ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name.'!') ])

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
                    <div class="card-header"><h4><strong>Reports</strong></h4>
                        <form action="{{ route('getStat') }}" method="get" id="reportForm">  
                        @csrf
                            <div class="input-group mb-3">
                                <div class="form-group mr-5">
                                    <label class="label-control">Date From</label>
                                    <input type="text" class="form-control datepicker" name="dateFrom" id="dateFrom" />
                                </div>
                                <div class="form-group">
                                    <label class="label-control mr-10">Date To</label>
                                    <input type="text" class="form-control datepicker"name="dateTo" id="dateTo" />
                                </div>
                                
                                    <button type="submit" class="btn btn-primary btn-small ml-10" id="btnSubmit">View</button>
                            
                            </div>
                            <span class="text-danger error-text date_error"></span>
                        </form>
                        
                    </div>

                    <div class="card-body">
                    
                    @if(empty($results))
                        <div style="color:red">Please select valid date.</div>
                        
                    @else   
                        @if($results->isEmpty())
                                <div style="color:red">No record found.</div>
                                <br>
                                <hr>
                        @else
                        <hr>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                    <tr>
                                        <th style="text-align:center"><strong>Date<strong></th>
                                        <th style="text-align:center"><strong>Assessed</strong></th>
                                        <th style="text-align:center"><strong>Verified</strong></th>
                                        <th style="text-align:center"><strong>Completed</strong></th>
                                        <th style="text-align:center"><strong>Released</strong></th>
                                       
                                    </tr>
                            </thead>
                            
                                <tbody>
                                    @foreach($results as $result)
                                        <tr> 
                                            <td style="text-align:center">{{$result->date_created}}</td>
                                            <td style="text-align:center">{{$result->assessed}}</td>
                                            <td style="text-align:center">{{$result->verified}}</td>
                                            <td style="text-align:center">{{$result->completed}}</td>
                                            <td style="text-align:center">{{$result->released}}</td>
                                        </tr>
                                    @endforeach    
                                </tbody>                           
                        </table>
                       
                        @endif
                    @endif

                    </div>              
                </div> 
            </div>       
        </div>  

    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">

    $(document).ready(function() {

            $('.datepicker').datetimepicker({
            defaultDate:'now',
            format: 'YYYY-MM-DD',

                icons: {
                    time: "fa fa-clock-o",
                    date: "fa fa-calendar",
                    up: "fa fa-chevron-up",
                    down: "fa fa-chevron-down",
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash',
                    close: 'fa fa-remove'
                }
            });
      

            $("#btnSubmit").click(function(e){ 
              

                var fromDate = $('#dateFrom').val();
                var toDate = $('#dateTo').val();


               if(fromDate > toDate)
               {
                e.preventDefault();
                $('span.date_error').text('Invalid Date! From date must be lesser than To date!');
                                 
               }
            });

            /* $("#reportForm").on('submit', function(e){
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
                                   
                  success:function(data){
                    
                      
                  }
              });
          }); */




    });


</script>
@endpush

