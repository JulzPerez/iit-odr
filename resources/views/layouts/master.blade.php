<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>MSU-IIT | ODR</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">

  <style>
    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    div.user-center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    nav.custom-color {

      background-color: #B40000;
      color: white;
    }

    table {
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      border: 1px solid #ddd;
    }

    th {
      text-align: left;
      color:white;
      background-color:black;
    }    

    tr:nth-child(odd) {
      background-color: #ADD8E6;
    }

    td.first
    {
        background-color: #ffe9ec ;
        color: black;
    }
    td.second
    {
        background-color: white;
        color: black;
    }

    .btn-sq {
      width: 150px !important;
      height: 150px !important;
      font-size: 15px;
    }

    .list-text-color {
      color:green
    }


  </style>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom">

    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        
            <li class="nav-item dropdown">
              
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ ucfirst(Auth::user()->first_name).' '.ucfirst(Auth::user()->last_name) }}<span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        
    </ul>  

  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
     <!--  <img src="./img/logo.png" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light user-center">MSU-IIT <br> Online Document Request</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info user-center">
          <a href="#" class="d-block">
              {{Auth::user()->first_name.' '.Auth::user()->last_name}}
             
          </a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-center" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Request           
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/requester" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Profile          
              </p>
            </a>
          </li>
          @canany(['isAdmin', 'isStaff'])
          <li class="nav-item ">
            <a href="{{route('document.index') }}" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Document              
              </p>
            </a>            
          </li>

          <li class="nav-item ">
            <a href="{{route('assessments.index') }}" class="nav-link ">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Assessment            
              </p>
            </a>            
          </li>
          <li class="nav-item ">
            <a href="{{route('fees.index') }}" class="nav-link ">
              <i class="nav-icon fas fa-comments-dollar"></i>
              <p>
                Fees          
              </p>
            </a>
            
          </li>
          @endcan

          @can('isAdmin')
          <li class="nav-item ">
            <a href="{{ route('users.index') }}" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users         
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    <i class="nav-icon fa fa-power-off red"></i>
                    <p>
                        {{ __('Logout') }}
                    </p>
                 </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
        </li> 
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
            <div class="row mb-2">  
                @yield('main_content')
            </div><!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://www.msuiit.edu.ph">MSU-IIT</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<script src="/js/app.js"></script>
<script src="/js/popper.js"></script>
</body>
</html>
