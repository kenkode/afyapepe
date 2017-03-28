@extends('layouts.patient')
@section('title', 'Patient')
@section('content')
<div class="content-page  equal-height">
      <div class="content">
          <div class="container">
 <div class="col-lg-12">
 <h2>Your Profile</h2>
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Basic Info</button></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Contact Info</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Next of Kin Details</a></li>
                    
                    
                </ul>
                <br>



  <div class="row">
  <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
    <div class="col-sm-6 col-sm-offset-2">
      <div class="ibox float-e-margins">
            <form class="form-horizontal">

           <h4>Basic Info</h4>
              <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patient->firstname}} {{$patient->secondName}}" name="kin_name"  readonly="">
              </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Age:</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="relation" value="{{$patient->age}}" 
                readonly="">
              </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Gender:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="@if($patient->gender==1){{"Male"}}@else{{"Female"}}@endif" 
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Blood Type:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="{{$patient->blood_type}}" readonly="" 
            />
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Place of Birth:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="{{$patient->pob}}" readonly="" 
            />
              </div>
             
              </div>
              </div>
              </div>
      <div id="tab-2" class="tab-pane">
          <div class="col-sm-6 col-sm-offset-2">
          <div class="ibox float-e-margins">
            <form class="form-horizontal">

           <h4>Contact Info</h4>
              <div class="form-group">
              <label for="exampleInputPassword1">Counstituency:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" <?php $const=$patient->constituency; $cons=DB::table('constituency')->where('const_id',$const)->first();?> value="{{$cons->Constituency}}" readonly=""
              />
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">County of Residence</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" <?php $county=DB::Table('county')->where('id',$cons->cont_id)->first();?> value="{{$county->county}}" readonly=""
              >
              </div>
              
              <div class="form-group">
              <label for="exampleInputPassword1">Phone Number:</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="{{$patient->msisdn}}" readonly="" 
              />
            
              </div>
              
             
              <div class="form-group">
              <label for="exampleInputPassword1">Email:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="{{$patient->email}}" readonly="" 
              />
              </div>
              
         </div>
            </div>
            </div>
<div id="tab-3" class="tab-pane">
 <div class="row">
    <div class="col-sm-6 col-sm-offset-2">
        <div class="ibox float-e-margins">
              <form class="form-horizontal">

              <h4>Next of Kin Details</h4>
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="kin_name" value="{{$nextkin->kin_name}}" readonly=""  >
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Relationship</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="relation" value="{{$nextkin->relation}}" readonly="" 
                >
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone" value="{{$nextkin->phone_of_kin}}" readonly="" 
                >
                </div>
               <input type="submit" class="btn btn-block btn-primary" value="Update Details">
               </form>
                        </div>

            </div>
            </div>
            </div>
            </form>
            </div>
            </div>
        </div>
</div>
@endsection
