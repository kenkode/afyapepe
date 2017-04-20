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
            <li class="active">
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>

            </li>




               <?php $allpatients=DB::table('afya_users')->count();
               $today = date('Y-m-d');
               $patients=DB::table('afyamessages')
                         ->where('status',NULL)->where('created_at','>=',$today)->count();
                     ?>
                         <li>

                         <li><a href="{{ URL::to('registrar') }}"><i class="fa fa-users"></i> <span>Today's Patients</span> <span class="badge"><?php echo $patients; ?></span>
                          <li><a href="{{ URL::to('allpatients') }}"><i class="fa fa-users"></i> <span>All Patients</span> <span class="badge"><?php echo $allpatients; ?></span>
                          

                        <a href="{{ URL::to('fees') }}"><i class="fa fa-money"></i> <span>Consultation Fee</span>
                          <a href="{{ URL::to('#')}}">  <i class="fa fa-envelope "></i> <span>Email</span>
                          <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span>
                         </li>




        </ul>

    </div>
</nav>
