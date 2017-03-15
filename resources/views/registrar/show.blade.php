@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Patient Details</h5>
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
           <label for="exampleInputPassword1">Phone</label>
           <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$user->msisdn}}" readonly=""/>
           </div>



            </div>
          </div>
        </div>
<div class="col-lg-6">
  <div class="ibox-content">
    <form class="form-horizontal" role="form" method="POST" action="/updateusers" novalidate>
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->id}}" name="id"  required>
    <div class="form-group">
   <label for="exampleInputEmail1">Date of Birth</label>
   <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="date" />
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
  </div>
</div>
</div>
<?php $patient=DB::Table('kin_details')->where('afya_user_id',$user->id)->first();?>
 <div class="row">
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
              value="{{$patient->relation}}"  readonly="">
              </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Phone</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"
              value="{{$patient->phone_of_kin}}"readonly="">
              </div>

                      </div>

      {!! Form::close() !!}
              @endif
              </div>
</div>
</div>
</div>

@include('includes.default.footer')

@endsection
