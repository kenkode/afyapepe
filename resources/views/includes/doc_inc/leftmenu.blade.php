
          <!--left menu start-->
          <nasv class="navbar-default navbar-static-side" role="navigation">
              <div class="sidebar-collapse">
                  <ul class="nav metismenu" id="side-menu">
                      <li class="nav-header">
                          <div class="dropdown profile-element">
                              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                  <span class="clear">
                                      <span class="block m-t-xs">
                                          <strong class="font-bold">{{ Auth::user()->name }}</strong>
                                      </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                                  </span>
                              </a>
                              <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                  <li><a href="{{ url('/logout') }}">Logout</a></li>
                              </ul>
                          </div>
                          <div class="logo-element">
                              Afya+
                          </div>
                          <li class="active"><a href="{{ url('/') }}"<i class="fa fa-home"></i>  <span>DOCTOR-Dashboard</span></a></li>


                          <li><a href="{{ url('doctor') }}"><i class="fa fa-edit"></i> <span>Today's Patient</span><span class="fa arrow"></span></a></li>
                          <li><a href="{{ url('newpatients') }}"><i class="fa fa-edit"></i> <span>Waiting Patient</span><span class="fa arrow"></span></a></li>

                          <li><a href="{{ url('allpatients') }}"><i class="fa fa-edit"></i> <span>All Patients</span><span class="fa arrow"></span></a></li>
                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout<span class="fa arrow"></span></a></li>


                  </ul>

              </div>
          </nav>
