<!--left menu start-->
          <div class="side-menu left" id="side-menu">
            <ul class="metismenu clearfix" id="menu">
       <li   <?php $data = DB::table("patients")->count();
                ?>
                    <li>
                      <a href="#"><i class="glyphicon glyphicon-dashboard "></i> <span>Dashboard</span>
                      <a href="{{ URL::to('#')}}"><i class="glyphicon glyphicon-stats"></i> <span>Statistics</span>
                      <a href="{{ URL::to('pharmacy')}}"><i class="fa fa-users"></i> <span>Total Patients</span>       <span class="badge"><?php echo $data; ?></span>
                        <a href="{{ URL::to('totalsales') }}"><i class="fa fa-shopping-cart"></i> <span>Today Sales</span>       
                        <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                    </li>

            </div>




 </ul>
</div>
          <!--left menu end-->
