<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                   <!-- <span><img alt="user" class="img-circle" src="img/profile_small.jpg" /></span> -->
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                    </span> <span class="text-muted text-xs block">{{ Auth::user()->role }} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Contacts</a></li>
                        <li><a href="#">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>

                    </ul>
                </div>
                <div class="logo-element">
                    Afya+
                </div>
            </li>

            <!-- <li><a href="{{ url('doctor') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Patients</span> <span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                        <li><a href="{{ url('doctor') }}"><span>Today's Patient</span></a></li>
                        <li><a href="{{ route('pending') }}"><span>Pending Patient</span></a></li>
                        <li><a href="{{ route('admitted') }}"><span>Admitted Patients</span></a></li>
                    </ul>
              </li> -->
              <li><a href="{{ url('doctor') }}"><i class="glyphicon glyphicon-calendar "></i><span>Today's Patient</span><span class="fa arrow"></span></a></li>
              <li><a href="{{ route('pending') }}"><i class="fa fa-stethoscope"></i><span>Test Result</span><span class="fa arrow"></span></a></li>
              <li><a href="{{ route('admitted') }}"><i class="fa fa-hospital-o"></i><span>Admitted Patients</span><span class="fa arrow"></span></a></li>

              <li><a href="{{ url('yourfees') }}"><i class="fa fa-money"></i><span>Your Fees</span><span class="fa arrow"></span></a></li>
              <li><a href="{{ URL::to('appointment')}}">  <i class="fa fa-clock-o"></i> <span>Appointment</span><span class="fa arrow"></span></a></li>
              <li><a href="{{ URL::to('calendar')}}">  <i class="glyphicon glyphicon-calendar "></i> <span>Calendar</span><span class="fa arrow"></span></a></li>
              <li> <a href="{{ URL::to('waitingList')}}">  <i class="fa fa-envelope "></i> <span>Email</span><span class="fa arrow"></span></a></li>
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout<span class="fa arrow"></span></a></li>
           </ul>

    </div>
</nav>
