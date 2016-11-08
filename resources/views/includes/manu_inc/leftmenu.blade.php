<!--left menu start-->
          <div class="side-menu left" id="side-menu">
            <ul class="metismenu clearfix" id="menu">
       <li   <?php $data = DB::table("patients")->count();
                ?>
                    <li>
                      <a href="#"><i class="glyphicon glyphicon-dashboard "></i> <span>Dashboard</span>
                      <a href="{{ URL::to('#')}}"><i class="glyphicon glyphicon-stats"></i> <span>Statistics</span>
                      <a href="{{ URL::to('#')}}"><i class="fa fa-medkit"></i> <span>Druglist</span>       <span class="badge">0</span>
                      <a href="{{ URL::to('nurses.show')}}"><i class="fa fa-shopping-cart"></i> <span>Today Sales</span>    <span class="badge">0</span>
                    
                    <a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                    </li>

            </div>




 </ul>
</div>
          <!--left menu end-->
