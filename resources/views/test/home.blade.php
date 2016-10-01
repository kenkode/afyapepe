
@extends('layouts.test')

@section('content')
<div class="content-page  equal-height">
	          <div class="content">
	              <div class="container">
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in Test!
                </div>
@permission('admin-create')
          <div class="panel-body">
              You are logged in Test Role!
          </div>
  @endpermission

            </div>
        </div>
    </div>
</div>
</div><!--container-->
</div><!--content -->
</div><!--content page-->@endsection
