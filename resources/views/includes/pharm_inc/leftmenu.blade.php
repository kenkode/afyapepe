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
            @role(['Pharmacyadmin','Pharmacymanager'])

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
                         <li><a href="{{ URL::to('pharmacy')}}"><i class="glyphicon glyphicon-tasks"></i> <span>Today's Prescription</span></a></li>
                           <li> <a href="{{route('filled_prescriptions')}}"><i class="fa fa-money"></i> <span>Sales</span></a></li>
                           @endrole

                          @role(['Pharmacystorekeeper','Pharmacymanager','Pharmacyadmin'])
                         <li><a href="{{ URL::to('inventory')}}"><i class="fa fa-money"></i> <span>Inventory</span><span class="fa arrow"> </a>
                         </li>
                         @endrole


                         @role(['Pharmacyadmin','Pharmacymanager'])
                         <li> <a href="{{route('inventory_report')}}"><i class="fa fa-money"></i> <span>Inventory Report</span></a></li>
                         @endrole
                         <li>  <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i><span>Logout</span> </a> </li>

        </ul>

    </div>
</nav>
