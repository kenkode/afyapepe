@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')



<div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Baby Details</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Mother's Details</a></li>
                    
                   
                </ul>
<div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
  <br><br>
  <div class="col-lg-6">                     
  <div class="ibox-title">
      <h5>Dependant Details</h5>

  </div>
         <div class="ibox-content">
               <form class="form-horizontal" role="form" method="POST" action="/createdependent" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
               <div class="form-group">
              <label for="exampleInputEmail1">First Name</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="first"  value="
               "  >
              </div>
              <div class="form-group">
             <label for="exampleInputEmail1">Second Name</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="second"  value="
              "  >
             </div>
             <div class="form-group">
              <label for="exampleInputPassword1">Gender</label>
              <input type="radio" value="Male"  name="gender"  />
                <label>Male</label>
                      <input type="radio" value="Female"  name="gender" />
                    <label>Female</label>

              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Age</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"  value="
               "  >
               </div>
                <div class="form-group">
              <label for="exampleInputPassword1">School</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="school"  value="
               "  >
                

              </div>
                

             
              <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
    <select class="form-control" name="relationship">
    <?php  $kin = DB::table('kin')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->relation}}">{{$kn->relation}}</option>
                 @endforeach
                </select>
    </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Blood Group</label>
              <select class="form-control" name="blood">
              <option value="O +">O +</option>
              <option value="O -">O -</option>
              <option value="A +">A +</option>
              <option value="A -">A -</option>
              <option value="B +">B +</option>
              <option value="B -">B -</option>
              <option value="AB +">AB +</option>
              <option value="AB -">AB -</option>
              </select>
              </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Place of Birth</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="pob" value=""  >
                </div>
                <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">Date of Birth</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="dob" value="">
                 </div>
                 </div>
              <button type="submit" class="btn btn-primary btn-sm">Create Details</button>
                 {!! Form::close() !!}
               </div>
             </div>
             </
              <div id="tab-2" class="tab-pane">
              </div>
              
             </div>

             </div>
             
            
               </div>


            @include('includes.default.footer')
             </div>
           
            
            @endsection

