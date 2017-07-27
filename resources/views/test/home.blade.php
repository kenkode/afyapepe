@extends('layouts.test')
@section('title', 'Tests')
@section('content')

<div class="content-page  equal-height">

		<div class="content">
				<div class="container">
         	<div class="wrapper wrapper-content animated fadeInRight">
						@if($facid->department==='Laboratory')
						@include('test.lab')
						@elseif($facid->department ==='Radiology')
						@include('test.rady')
						@endif

		   </div>
    </div>
  </div><!--content-->
</div><!--content page-->

@endsection
