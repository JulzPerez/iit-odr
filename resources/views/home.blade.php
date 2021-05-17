@extends('layouts.master')

@section('main_content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
           
            <div class="row mb-2 mt-4 ">
                @can('isAdmin')
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Request: {{$request_count}}</h3>
                        <p>Pending Request for Assessment</p>
                    </div>
                    <div class="icon">
                       <!--  <i class="fas fa-shopping-cart"></i> -->
                    </div>
                    <a href="{{route('viewRequestByStatus', 'pending')}}" class="small-box-footer">
                        View <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>
                @endcan
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                    <div class="inner">
                        <h3>Request: {{$myrequest_count}}</h3>

                        <p>My Document <br> Request</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/request" class="small-box-footer">
                        View/Create <i class="fas fa-arrow-circle-right"></i>
                    </a>
                    </div>
                </div>            
            </div>
            <!-- /.row -->

           
        </div>
    </div>
    
</div>
@endsection
