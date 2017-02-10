<!--left menu start-->
          <div class="side-menu left" id="side-menu">
            <ul class="metismenu clearfix" id="menu">


            </div>




 </ul>
</div>
          <!--left menu end-->
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
                                      </span> <span class="text-muted text-xs block">Nurse Afyapepe <b class="caret"></b></span>
                                  </span>
                              </a>
                              <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                  <li><a href="{{ url('/logout') }}">Logout</a></li>
                              </ul>
                          </div>
                          <div class="logo-element">
                              Afya+
                          </div>


                          <li   <?php $data = DB::table("patients")->count();
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
                                         <a href="#"><i class="glyphicon glyphicon-dashboard "></i> <span>Dashboard</span>
                                         <a href="{{ URL::to('#')}}"><i class="glyphicon glyphicon-stats"></i> <span>Statistics</span>
                                         <a href="{{ URL::to('nurse')}}"><i class="fa fa-users"></i> <span>Total Patients</span>       <span class="badge"><?php echo $data; ?></span>
                                        <a href="{{ URL::to('newpatient') }}"><i class="fa fa-users"></i> <span>New Patients</span>    <span class="badge"><?php echo $newpatient; ?></span>
                                        <a href="{{ URL::to('waitingList')}}">
                                        <i class="fa fa-users"></i> <span>Waiting List</span>   <span class="badge"><?php echo $wList;?></span>
                                       <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                                       </li>

                  </ul>

              </div>
          </nav>
