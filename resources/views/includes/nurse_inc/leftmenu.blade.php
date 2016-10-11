<!--left menu start-->
          <div class="side-menu left" id="side-menu">
            <ul class="metismenu clearfix" id="menu">
       <li   <?php $data = DB::table("patients")->count();
                ?>
                    <li>
                      <a href="#"><i class="glyphicon glyphicon-dashboard "></i> <span>Dashboard</span>
                      <a href="{{ URL::to('#')}}"><i class="glyphicon glyphicon-stats"></i> <span>Statistics</span>
                      <a href="{{ URL::to('#')}}"><i class="glyphicon  glyphicon-user"></i> <span>Total Patients</span>       <span class="badge"><?php echo $data; ?></span>
                      <a href="{{ URL::to('nurses.show')}}"><i class="glyphicon glyphicon-user"></i> <span>New Patients</span>    <span class="badge"><?php echo $data; ?></span>
                     <a href="{{ URL::to('#')}}"><i class="glyphicon glyphicon-user"></i> <span>Waiting List</span>   <span class="badge">0</span>
                    </li>

            </div>




 </ul>
</div>
          <!--left menu end-->
