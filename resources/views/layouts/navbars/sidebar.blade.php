<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('ODR') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="app">
    <ul class="nav">
      
        @can('isRequester')
          <li class="nav-item {{ $activePage == 'request' ? ' active' : '' }} ">
            <a class="nav-link" href="{{ route('request.index') }}">
              <i class="material-icons">dashboard</i>
              <p>Document Request</p>
            </a>
          </li>
          <li class="nav-item {{ $activePage == 'requester' ? ' active' : '' }} ">
            <a class="nav-link" href="{{ route('requester.index') }}">
              <i class="material-icons">person</i>
              <p>Requester Profile</p>
            </a>
          </li>
        @endcan
        @canany(['isAdmin', 'isWindowStaff'])
          <li class="nav-item {{ $activePage == 'requests' ? ' active' : '' }}">
            <a href="{{ route('request.index') }}" class="nav-link">
            <i class="material-icons">description</i>
              <p>Requests </p>
            </a>
                  
          </li>
          @endcan
        
         

         <!--  @canany(['isAdmin','isWindowStaff'])
          <li class="nav-item ">
            <a href="/document" class="nav-link ">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Documents         
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="/fees" class="nav-link ">
              <i class="nav-icon fas fa-comments-dollar"></i>
              <p>
                Fees         
              </p>
            </a>
          </li>
          @endcan -->

          @can('isAdmin')
          <li class="nav-item {{ $activePage == 'users' ? ' active' : '' }}">
            <a href="{{ route('users.index') }}" class="nav-link ">
            <i class="material-icons">people</i>
              <p>Users</p>
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
  </div>
</div>