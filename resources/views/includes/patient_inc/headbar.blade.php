<div class="row border-bottom">
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
<div class="navbar-header">
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

</div>
    <ul class="nav navbar-top-links navbar-right">
      <?php $id = Auth::id();
       $user=DB::table('users')->select('name')->where('id',$id)->first();
      ?>
<li><a href="#"><i class="fa fa-user"></i> {{$user->name}}</a></li>
<li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Log out</a></li>

    </ul>

</nav>
</div>
