
<html>
<head>
    @include('includes.nurse_inc.head')
</head>
    <body class="fixed-left">
     <div id="wrapper">

<!--top bar-->
  @include('includes.default.topbar')
<!--end top bar-->

<!--left menu start-->
  @include('includes.nurse_inc.leftmenu')
<!--left menu end-->
 <!--page-->
  @yield('content')
<!--page-->
        </div>
        <div class="sidebar">
            <div class='nicescroll'>
                <h4>Quick Support</h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod.
                </p>
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows='5' placeholder="Name"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="button" class=" btn btn-theme btn-lg">Send</button>
                    </div>
                </form>
            </div>
        </div>
  <!--page-->
              @include('includes.nurse_inc.footer')
  <!--page-->
    </body>
</html>
