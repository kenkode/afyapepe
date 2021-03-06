<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>afyapepe - @yield('title') </title>


    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('font-awesome/css/font-awesome.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}" />


</head>
<body class="gray-bg">
  <div class="row border-bottom">
      <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"></a>
              <form role="search" class="navbar-form-custom" method="post" action="/">
                  <div class="form-group">
                      <input type="text" placeholder="AFYAPEPE" class="form-control" name="top-search" id="top-search" />
                  </div>
              </form>
          </div>
          <ul class="nav navbar-top-links navbar-right">
          	@if (Auth::guest())
                 <li><a href="{{ url('/login') }}">Login</a></li>
                 <li><a href="{{ url('/register') }}">Register</a></li>
          	@else

  								<li class="dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    	{{ Auth::user()->name }} <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" role="menu">
                         <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                      </ul>
                	</li>
           		@endif
          </ul>
      </nav>
  </div>
    <div class="">

      {!! Html::image('images/healthcare22.jpg', 'alttext' , ['width' => '1400']) !!}
<strong>Copyright</strong> Afyapepe &copy; 2017
    </div>



<!-- Mainly scripts -->

<script src="{!! asset('js/jquery-3.1.1.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}" type="text/javascript"></script>

</body>
</html>
