
            <!--top bar-->
            <div class="topbar">
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="#" class="logo"><img src="images/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="pull-left menu-toggle">
                    <i class="fa fa-bars"></i>
                </div>
                <form class="pull-left app-search hidden-xs">
                    <input type="text" class="form-control" placeholder="Search here...">
                    <i class="fa fa-search"></i>
                </form>
                <ul class="nav navbar-nav  top-right-nav hidden-xs">
                    <li>
                        <span id="para2"></span>
                        <span id="para3"></span>
                        <span id="para1"></span>
                    </li>
                    <!-- Authentication Links -->

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                     @else



                         <li class="dropdown profile-link hidden-xs">
                        <div class="clearfix">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                              <img src="images/user.png" alt="" class="pull-left">
                              <span>{{ Auth::user()->name }} <br></span>
                          </a>
                          <ul class="dropdown-menu">
                              <li><a href="{{ route('doctor.create') }}">Profile</a></li>
                              <li><a href="#">Settings</a></li>
                              <li><a href="{{ url('/logout') }}">Logout</a></li>
                          </ul>
                      </div>

                  </li>
                     @endif
                      </ul>
                    </div>



                @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{Session::get('success')}}

        </div>
      @endif
      @if($errors->has())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
    <div>{{ $error }}</div>
  </div>
   @endforeach
 @endif
            </div>
            <!--end top bar-->
