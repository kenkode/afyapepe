@extends('layouts.facilityadmin')
@section('title', 'Dashboard')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
          <div class="content">
              <div class="container">

  <div class="row wrapper border-bottom white-bg page-heading col-lg-11">

               <div class="ibox-title">
                 <h5>Update Test Details</h5>
               </div>
  {{ Form::open(array('route' => array('updateranges'),'method'=>'POST')) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-lg-3">
      <div class="form-group">
     <label>Test:</label>
     <input type="text"  class="form-control" value="{{$testranges->name}}" readonly="">
     <input type="hidden"  class="form-control" name="test_id" value="{{$testranges->id}}" readonly="">
     <input type="text"  class="form-control" name="machine_id" value="{{$testranges->machineid}}" readonly="">

   </div>
      <div class="form-group">
     <label>Units:</label>
     <input type="text" name="units" value="{{$testranges->units}}" class="form-control">
     </div>

 </div>
    <div class="col-lg-1 col-md-offset-1">
                 <div class="form-group">
                <label>Low Female:</label>
                <input type="text" name="low_female" value="{{$testranges->low_female}}" class="form-control">
                </div>
                <div class="form-group">
               <label>Low Male:</label>
               <input type="text" name="low_male" value="{{$testranges->low_male}}" class="form-control">
               </div>
   </div>
   <div class="col-lg-1 col-sm-offset-1">
     <div class="form-group">
     <label>High Female:</label>
     <input type="text" name="high_female" value="{{$testranges->high_female}}" class="form-control">
     </div>
     <div class="form-group">
     <label>High Male:</label>
     <input type="text" name="high_male" value="{{$testranges->high_male}}" class="form-control">
     </div>
   </div>
   <div class="col-lg-3 col-sm-offset-1">
     <div class="form-group">
     <label>Machine:</label>
     <input type="text" name="machine_name" value="{{$testranges->machine}}" class="form-control">
     </div>

     <div class="form-group">
     <label>Series:</label>
     <input type="text" name="series" value="{{$testranges->series}}" class="form-control">
     </div>
     <div class="form-group">
     <label>Serial No:</label>
     <input type="text" name="serial_no" value="{{$testranges->serial_no}}" class="form-control">
     </div>
   </div>
   <div class="col-md-12 col-md-offset-10">
       <button type="submit" class="btn btn-primary">Save</button>
   </div>
     {!! Form::close() !!}

    </div>
  </div>


</div>
</div><!--container-->

@include('includes.default.footer')

@endsection
