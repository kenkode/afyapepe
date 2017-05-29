@extends('layouts.facilityadmin')
@section('title', 'Dashboard')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
              <br><br>
  <div class="col-sm-6  col-sm-offset-2">                     
  <div class="ibox-title">
      <h5>Add Facility Doctor</h5>

  </div>
         <div class="ibox-content">
               <form class="form-horizontal" role="form" method="POST" action="/adminstore" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
               <div class="form-group">
              <label for="exampleInputPassword1">Username</label>
              <input type="name" class="form-control" id="exampleInputEmail1"  placeholder="" name="name">
              </div>

              <div class="form-group">
             <label for="exampleInputPassword1">Email</label>
             <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="" name="email"/>
             </div>
             <input type="hidden" name="role" value="FacilityAdmin">
             <div class="form-group">
             <label for="exampleInputPassword1">Password</label>
             <input type="password" class="form-control" id="exampleInputEmail1"  placeholder="" name="password"/>
             </div>
             
             <div class="form-group">
                     <label >Doctor:</label>
                     <select  id="doctor" name="doctor" class="form-control doctor" style="width:50%"></select>
                 </div>
                  <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>
</div>



</div>
                   </div><!--container-->
                
@endsection
