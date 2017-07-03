@extends('layouts.admin')
@section('title', 'Admin Add Test')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
          <div class="content">
              <div class="container">



  <div class="row wrapper border-bottom white-bg page-heading col-lg-11">

               <div class="ibox-title">
                 <h5></h5>
               </div>
<form class="form-horizontal" role="form" method="POST" action="/addingtest" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="col-lg-4 col-md-offset-4">
<div class="form-group">
<label>Overall Category</label>
<input type="text" class="form-control" value="{{$tests->oname}}" readonly="">
</div>
<div class="form-group">
<label>Category</label>
<input type="text" class="form-control" value="{{$tests->cname}}" readonly="">
</div>
<div class="form-group">
<label>Sub-Category</label>
<input type="text" class="form-control" value="{{$tests->sname}}" readonly="">
<input type="hidden" class="form-control" value="{{$tests->sid}}" name="sub_cat_id" readonly="">
</div>

<div class="form-group">
<label>Test </label>
<input type="text" class="form-control"  name="test">
</div>


<div class="text-center">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</div>
{!! Form::close() !!}

</div>
</div>
</div>
</div><!--container-->
<!--container-->
@endsection
