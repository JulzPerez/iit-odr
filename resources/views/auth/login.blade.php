@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('MSU-IIT OIR-Online Request of Document')])

@section('content')
<div class="container">
  <section class="login-block">
  <div class="container">
    <div class="row">
          <div class="col-md-4 login-sec">
            <!-- <h2 class="text-center">Login Now</h2> -->
            

              <div class="card card-login mb-3">
                <div class="card-header card-header-primary text-center">
                  <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>                
                </div>
                <div class="card-body">
              <form class="form" method="POST" action="{{ route('login') }}">
              @csrf
                  <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">email</i>
                        </span>
                      </div>
                      <input type="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                    </div>
                    @if ($errors->has('email'))
                      <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                        <strong>{{ $errors->first('email') }}</strong>
                      </div>
                    @endif
                  </div>
                  <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="material-icons">lock_outline</i>
                        </span>
                      </div>
                      <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "secret" : "" }}" required>
                    </div>
                    @if ($errors->has('password'))
                      <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                        <strong>{{ $errors->first('password') }}</strong>
                      </div>
                    @endif
                  </div>
                  <!-- <div class="form-check mr-auto ml-3 mt-3">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                      <span class="form-check-sign">
                        <span class="check"></span>
                      </span>
                    </label>
                  </div> -->
                  <br>
                  <div class="form-row mt-3">
                    <div class="col">
                      @if (Route::has('password.request'))
                          <a href="{{ route('password.request') }}">
                              {{ __('Forgot password?') }}
                          </a>
                      @endif
                    </div>
                    <div class="col">
                      <div class="float-right">
                        <button type="submit" class="btn btn-primary btn-md ">{{ __('SUBMIT') }}</button>
                      </div>
                    </div>
                  </div>

              </form>
                  <hr>
                  <p>Is this your first time here? Create account to register.</p>
                  <a href="{{route('register')}}">
                      <button type="submit" class="btn btn-primary btn-md btn-block ">{{ __('CREATE ACCOUNT') }}</button> 
                  </a>
                </div>
                <div class="card-footer">
                 
                </div>                 
                  
              </div>
           
          
            <!-- <div class="copy-text">Created with <i class="fa fa-heart"></i> by Grafreez</div> -->
          </div>
          <div class="col-md-8 banner-sec">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                  <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
              <div class="banner-text">
                  <h2>This is Heaven</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
              </div>	
            </div>
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <div class="banner-text">
                      <h2>This is Heaven</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                  </div>	
              </div>
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="https://images.pexels.com/photos/872957/pexels-photo-872957.jpeg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                  <div class="banner-text">
                      <h2>This is Heaven</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
                  </div>	
              </div>
            </div>
          </div>	   
              
          </div>
        </div>
      </div>
  </section>      
</div>
@endsection
