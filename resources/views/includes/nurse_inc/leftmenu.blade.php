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




               <?php
               $today = date('Y-m-d');
               $data = $patients=DB::table('afya_users')->count();
                       $wList=DB::table('afya_users')
                         ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
                         ->select('afya_users.*', 'patients.allergies')
                         ->where('afya_users.status',2)->count();
                       $newpatient =  DB::table('appointments')->where('created_at','>=',$today)->where('status',1)->count();
                     ?>
                         <li>

  <a href="{{ URL::to('nurse') }}"><i class="fa fa-users"></i> <span>Today Patients</span>       <span class="badge"><?php echo $newpatient; ?></span>
                             <a href="{{ URL::to('all_patients')}}"><i class="fa fa-users"></i> <span>All Patients</span>       <span class="badge"><?php echo $data; ?></span>


                          <a href="{{ URL::to('waitingList')}}">  <i class="glyphicon glyphicon-dashboard "></i> <span>Waiting List</span><span class="badge"><?php echo $wList;?></span>
                            <a href="{{ URL::to('nurseappointment')}}">  <i class="fa fa-clock-o"></i> <span>Appointment</span>

                           <a href="{{ URL::to('calendarnurse')}}">  <i class="glyphicon glyphicon-calendar "></i> <span>Calendar</span>

                          <a href="{{ URL::to('waitingList')}}">  <i class="fa fa-envelope "></i> <span>Email</span>
                          <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span>
                         </li>




        </ul>

    </div>
</nav>
