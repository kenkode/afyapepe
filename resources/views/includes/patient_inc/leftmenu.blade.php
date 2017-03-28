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
            <li>
            <a href="patient"><i class="fa fa-home"></i> <span>Home</span> </a>

            </li>

            <li><a href="{{ URL::to('PatientAllergies')}}"><i class="fa fa-plus-square" aria-hidden="true"></i>
 <span>Patient Details</span></a></li>

<li><a href="{{ URL::to('expenditure')}}">  <i class="fa fa-money "></i> <span>Health Expenditure</span></a></li>


<li><a href="{{ URL::to('patientcalendar')}}">  <i class="glyphicon glyphicon-calendar "></i> <span>Calendar</span></a></li>


<li><a href="{{ URL::to('#')}}">  <i class="fa fa-envelope "></i> <span>Email</span></a></li>
  <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span></li>









        </ul>

    </div>
</nav>
