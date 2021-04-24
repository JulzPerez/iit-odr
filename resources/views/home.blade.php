@extends('layouts.master')

@section('main_content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
          <p>
            <a href="#" class="btn btn-sq btn-primary">
                <i class="fa fa-user fa-5x"></i><br/>
                Create Request
            </a>
            <a href="#" class="btn btn-sq btn-success">
              <i class="fa fa-user fa-5x"></i><br/>
              View Request Status 
            </a>
            
          </p>
        </div>
    </div>
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
