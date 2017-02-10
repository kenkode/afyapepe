<!--left menu start-->
<nav class="navbar-default navbar-static-side" role="navigation">
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


            <li><a href="{{ url('/admin') }}"><i class="fa fa-home"></i> <span>HOME</span></a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa fa-users"></i> <span>USER</span></a></li>
            <li><a href="{{ route('roles.index') }}"><i class="fa fa-info"></i> <span>ROLES</span></a></li>
        
           <li><a href="{{ route('test.index') }}"><i class="fa fa-stethoscope"></i> <span>TEST</span></a></li>
           <li><a href="{{ url('/nurse') }}"><i class="fa fa-user-md"></i> <span>NURSE</span></a></li>
           <li><a href="{{ url('/doctor') }}"><i class="fa fa-user-md"></i> <span>DOCTOR</span></a></li>
           <li><a href="{{ url('/pharmacy') }}"><i class="fa fa-user-md"></i> <span>PHARM</span></a></li>
           <li><a href="{{ url('/manufacturer') }}"><i class="fa fa-industry"></i> <span>MANUFACTURER</span></a></li>
           <li><a href="{{ url('/patient') }}"><i class="fa fa-users"></i> <span>PATIENT</span></a></li>
           <li><a href="{{ url('config') }}"><i class="fa fa-cog"></i> <span>Master Configuration</span></a></li>

        </ul>

    </div>
</nav>
