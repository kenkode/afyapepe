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
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span> <span class="fa arrow"></span></a>

            </li>




               <?php $data = DB::table("patients")->count();
                       $wList=DB::table('afya_users')
                         ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
                         ->select('afya_users.*', 'patients.allergies')
                         ->where('afya_users.status',2)->count();
                       $newpatient= DB::table('afya_users')
                         ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
                         ->select('afya_users.*', 'patients.allergies')
                         ->where('afya_users.status',1)->count();
                     ?>
                         <li>

                           <a href="{{ URL::to('pharmacy')}}"><i class="glyphicon glyphicon-tasks"></i> <span>Today's Prescription</span></a></li>
                           <li> <a href="{{ URL::to('totalsales')}}"><i class="fa fa-money"></i> <span>Sales</span></a></li>
                         <li><a href="{{ URL::to('#') }}"><i class="fa fa-money"></i> <span>Inventory</span> </a>
                           <ul class="dropdown-menu animated fadeInRight m-t-xs">
                               <li><a href="{{ URL::to('available') }}"><span>Available Inventory</span> </a></li>
                               <li><a href="{{ URL::to('#') }}"><span>Update Inventory </span>  </a></li>


                           </ul>


                         </li>
                           <li><a href="{{ URL::to('analytics')}}">  <i class="glyphicon glyphicon-stats"></i> <span>Analytics</span></a></li>
                         <li>  <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span> </a> </li>







        </ul>

    </div>
</nav>
