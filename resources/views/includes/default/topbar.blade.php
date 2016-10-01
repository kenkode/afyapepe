
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
                     <li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                         {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                         <ul class="dropdown-menu" role="menu">
                         <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                      </li>
                     @endif

                    <!-- <li class="dropdown profile-link hidden-xs">
                        <div class="clearfix">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                             <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout1</a></li>
                        </ul>
                    </li>
                     </ul>

                  <!-- Right Side Of Navbar -->

                  <!-- <ul class="nav navbar-nav navbar-right">

                      Authentication Links -->
                     </ul>
                    </div>
 </li> -->

                </ul>
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
