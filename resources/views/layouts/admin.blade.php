
<html>
<head>
    @include('includes.admin_inc.head')
</head>
    <body class="fixed-left">
     <div id="wrapper">

<!--top bar-->
  @include('includes.default.topbar')
<!--end top bar-->

<!--left menu start-->
  @include('includes.admin_inc.leftmenu')
<!--left menu end-->
 <!--page-->
  @yield('content')
<!--page-->
    </div>

  <!--page-->
              @include('includes.admin_inc.footer')
  <!--page-->
    </body>
</html>
