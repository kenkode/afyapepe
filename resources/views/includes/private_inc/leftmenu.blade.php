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


                    </ul>
                </div>
                <div class="logo-element">
                    Afya+
                </div>
            </li>
            <li>
            <a href="{{ URL::to('private')}}"><i class="fa fa-th-large"></i> <span>Dashboards</span></a>

            </li>





            <li>
          <a href=""><i class="fa fa-th-large"></i> <span class="nav-label">Patients</span> <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
              <li><a href="{{ url('private') }}"><span>New Patient</span></a></li>
            <li><a href="{{ route('privatepat') }}"><span>Today's Patient</span></a></li>
            <li><a href="{{ route('privadmpat') }}"><span>Admitted Patients</span></a></li>
          </ul>
          </li><li> <a href="{{ URL::to('private.fees')}}"><i class="fa fa-money"></i> <span>Consultation Fees</span></a></li>
<li> <a href="{{ URL::to('#')}}">  <i class="fa fa-envelope "></i> <span>Email</span></a></li>
<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span></a></li>





        </ul>

    </div>
</nav>
