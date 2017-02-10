<!--left menu start-->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Example user</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="{{ url('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Main view</span></a>
            </li>
            <li>
                <a href="{{ url('/minor') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Minor view</span> </a>
              </li>
              <li><a href="{{ URL::to('allergy')}}"><i class="glyphicon glyphicon-cog"></i> <span>Allergy</span>
              </li>
              <li ><a href="{{ URL::to('county')}}"><i class="glyphicon glyphicon-cog"></i> <span>County</span>
              </li>
              <li><a href="{{ URL::to('constituency')}}"><i class="glyphicon glyphicon-cog"></i> <span>Constituency</span>
              </li>
              <li><a href="{{ URL::to('manufacturer')}}"><i class="glyphicon glyphicon-cog"></i> <span>Drug Manufacturer</span>
              </li>
              <li ><a href="{{ URL::to('druglist')}}"><i class="glyphicon glyphicon-cog"></i> <span>Druglist</span>
              </li>
              <li><a href="{{ URL::to('facility')}}"><i class="glyphicon glyphicon-cog"></i> <span>Facility</span>
              </li>
              <li><a href="{{ URL::to('illness')}}"><i class="glyphicon glyphicon-cog"></i> <span>Illness</span>
              </li>
              <li><a href="{{ URL::to('kin')}}"><i class="glyphicon glyphicon-cog"></i> <span>Kin</span>
              </li>
              <li><a href="{{ URL::to('pharmacyconf')}}"><i class="glyphicon glyphicon-cog"></i> <span>Pharmacy</span>
              </li>
              <li><a href="{{ URL::to('testtype')}}"><i class="glyphicon glyphicon-cog"></i> <span>Test_Type</span>
              </li>
              <li >
              <a href="{{ URL::to('tests')}}"><i class="glyphicon glyphicon-cog"></i> <span>Tests</span>
             </li>
         </ul>

    </div>
</nav>
<!--left menu end-->
