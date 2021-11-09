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
                    <div class="card-header"><h4><strong>Reports</strong></h4></div>
                    <div class="card-body">
                        
                                   
                    </div>              
                </div> 
            </div>       
        </div>  

 

    </div>
</div>
@endsection

@push('js')
    <script type="text/javascript">

        $('#fromDate').datepicker({  

        format: 'mm-dd-yyyy'

        });  

    </script>  
@endpush

