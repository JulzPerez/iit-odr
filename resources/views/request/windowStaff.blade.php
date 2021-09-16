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

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="col-md-12 ">
                            <button type="button" class="btn btn-primary" id="for_assessment">For Assessment</button>
                            <button type="button" class="btn btn-info">For Verification</button>
                            <button type="button" class="btn btn-success">Success</button>
                            <button type="button" class="btn btn-danger">Danger</button>
                            <button type="button" class="btn btn-warning">Warning</button>
                            <button type="button" class="btn btn-default">Default</button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th>Document</th>
                                        <th>Requestor</th>
                                        <th>Request Date</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="request_data">

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

@push('js')
<script type="text/javascript">
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
     

      $(function()
      {
        $(function(){
            $("#for_assessment").click(function(){
                $.ajax({
                    url: "{{route('getRequestForAssessment')}}",
                    method: 'GET',
                    success: function(data) {
                        $('#request_data').html(data.html);
                    }
                });
            });
          });         

        });

</script>

@endpush