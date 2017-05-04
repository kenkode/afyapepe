@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Patient Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
              <div class="form-group">
             <label for="exampleInputEmail1">Name</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  value="{{$user->firstname}}  {{$user->secondName}}" readonly=""  >
             </div>
              <div class="form-group">
             <label for="exampleInputPassword1">Age</label>
             <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$user->age}}" readonly  >
             </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Gender</label>
             <?php $gender=$user->gender;?>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"
             value="@if($gender==1){{"Male"}}@else{{"Female"}}@endif " readonly  >
            </div>
            <div class="form-group">
           <label for="exampleInputPassword1">Date of Birth</label>
           <input type="text" class="form-control" id="exampleInputPassword1" placeholder="date of birth" name="phone" value="{{$user->dob}}" readonly=""/>
           </div>
           <div class="form-group">
          <label for="exampleInputPassword1">Place of Birth</label>
          <input type="text" class="form-control" id="exampleInputPassword1" placeholder="place of birth" name="phone" value="{{$user->pob}}" readonly=""/>
          </div>
          <div class="form-group">
         <label for="exampleInputPassword1">Id Number</label>
         <input type="number" class="form-control" id="exampleInputPassword1" placeholder="id number" name="phone" value="{{$user->nationalId}}" readonly=""/>
         </div>
         <div class="form-group">
        <label for="exampleInputPassword1">NHIF</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="nhif" name="phone" value="{{$user->nhif}}" readonly=""/>
        </div>

          </div>
        </div>
</div>
        <?php $patient=DB::Table('kin_details')->where('afya_user_id',$user->id)->first();?>

 <div class="col-lg-6">
     <div class="ibox float-e-margins">
         <div class="ibox-title">
             <h5>Next of Kin Details</h5>
             <div class="ibox-tools">
                 <a class="collapse-link">
                     <i class="fa fa-chevron-up"></i>
                 </a>
                  <a class="close-link">
                     <i class="fa fa-times"></i>
                 </a>
             </div>
         </div>
         <div class="ibox-content">
           <div class="ibox-content">
                 @if(is_null($patient))
                 <form class="form-horizontal" role="form" method="POST" action="/registrarnextkin" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->id}}" name="id"  required>
                 <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  value="
                 "  >
                </div>

                <div class="form-group">
                 <label for="exampleInputPassword1">Relationship</label>
                <select class="form-control" name="relationship">
                <?php  $kin = DB::table('kin')->get();?>
                              @foreach($kin as $kn)
                               <option value="{{$kn->id}}">{{$kn->relation}}</option>
                             @endforeach
                            </select>
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value=""  >
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Create Details</button>
                   {!! Form::close() !!}
               @else
                 <form class="form-horizontal">
               <div class="form-group">
               <label for="exampleInputEmail1">Name</label>
               <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name" value="{{$patient->kin_name}}" readonly="">
               </div>

               <div class="form-group">
               <label for="exampleInputPassword1">Relationship</label>
               <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="relation"
               value="<?php $county=DB::Table('kin')->where('id',$patient->relation)->first();?>{{$county->relation}}"  readonly="">
               </div>

               <div class="form-group">
               <label for="exampleInputPassword1">Phone</label>
               <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"
               value="{{$patient->phone_of_kin}}"readonly="">
               </div>

                       </div>
         <a href="{{ URL('update', $patient->id) }}" class="btn btn-primary btn-sm">Update Details</a>
       {!! Form::close() !!}
               @endif

 </div>
 </div>
 </div>



</div>
     <div class="row">
       @if(is_null($user->nhif))

   <div class="col-sm-6">
     <div class="ibox-title">
         <h5>Patient Contact Details</h5>
         <div class="ibox-tools">
             <a class="collapse-link">
                 <i class="fa fa-chevron-up"></i>
             </a>
              <a class="close-link">
                 <i class="fa fa-times"></i>
             </a>
         </div>
     </div>
     <div class="ibox-content">
       <form class="form-horizontal" role="form" method="POST" action="/updateusers" novalidate>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->id}}" name="id"  required>
      <div class="form-group">
     <label for="exampleInputEmail1">Id Number</label>
     <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="idno" />
     </div>
     <div class="form-group">
    <label for="exampleInputEmail1">NHIF</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="nhif" />
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Blood Group</label>
     <select  name="blood_type">
  <option value="O+">O+</option>
  <option value="O-">O-</option>
  <option value="A+">A+</option>
  <option value="A-">A-</option>
  <option value="B+">B+</option>
  <option value="B-">B-</option>
  <option value="AB+">AB+</option>
  <option value="AB-">AB-</option>
  
</select> 
    </div>
     <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="email" />
    </div>
    <div class="form-group" id="data_1">
     <label for="exampleInputPassword1">Date of Birth</label>
     <div class="input-group date">
         <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
         <input type="text" class="form-control" name="date" value="">
     </div>
     </div>
       <div class="form-group">
      <label for="exampleInputPassword1">Place of Birth</label>
      <input type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="place"/>
      </div>
     <div class="form-group">
    <label for="exampleInputPassword1">Constituency</label>
    <select class="form-control" name="constituency">
    <?php  $kin = DB::table('constituency')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->const_id}}">{{$kn->Constituency}}</option>
                 @endforeach
                </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm">Update Details</button>
      {!! Form::close() !!}
      @else
      <div class="col-sm-6">
        <div class="ibox-title">
            <h5>Patient Contact Details</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                 <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
          <form class="form-horizontal" role="form" method="POST" action="/updateusers" novalidate>
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->id}}" name="id"  required>



          <div class="form-group">
         <label for="exampleInputEmail1">Phone Number</label>
         <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$user->msisdn}}" readonly="" />
         </div>
          <div class="form-group">
         <label for="exampleInputPassword1">Email Address</label>
         <input type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$user->email}}" readonly=""/>
         </div>
        <div class="form-group">
          <label for="exampleInputPassword1">County</label>
          <input type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php $const=DB::table('constituency')->where('const_id',$user->constituency)->first();
          $county=DB::Table('county')->where('id',$const->cont_id)->first();?>{{$county->county}}"  name="place" readonly=""/>

       </div>
       <div class="form-group">
         <label for="exampleInputPassword1">Constituency</label>
         <input type="text"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php $countys=DB::Table('constituency')->where('const_id',$user->constituency)->first();?>{{$countys->Constituency}}" readonly=""/>

      </div>
       <button type="submit" class="btn btn-primary btn-sm">Update Details</button>
         {!! Form::close() !!}
@endif

</div>
</div>
<div class="col-sm-6">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Consultation description</h5>

    </div>
    <div class="ibox-content">
    <form class="form-horizontal" role="form" method="POST" action="/consultationfee" novalidate>

<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$user->id}}" name="id"  required>

    <div class="form-group">
<label class="control-label" for="name">Consultation Fee ?</label>
<input type="radio" value="No" id="type" name="type" checked='checked' autocomplete="off" />
  <label>No</label>
        <input type="radio" value="Yes" id="type" name="type" class="youtube" />
      <label>Yes</label>
      <div id="embedcode">
    Payment Mode: <select name="mode"><option value="">Select</option><option value="Cash">Cash</option><option value="Mpesa">Mpesa</option><option value="Insurance">Insurance</option></select>
     Amount: <input type="number"  placeholder="Amount" name="amount" >
    </div>
  </div>

  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    {!! Form::close() !!}
    </div>
  </div>
</div>
</div>
</div>
<br>


@include('includes.default.footer')
          </div><!--content-->
      </div><!--content page-->

@endsection
