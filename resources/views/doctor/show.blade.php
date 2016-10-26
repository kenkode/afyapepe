
@extends('layouts.doctor')
@section('content')
<div class="content-page  equal-height">
 <div class="content">
  <div class="container">
    <div class="row">
Gear to
<div class="col-xs-12 col-sm-12 col-md-12">

    <div class="form-group">


<?php
        foreach ($patientdetails as $pdetails) {
          $Name = $pdetails->firstname;
          $lname = $pdetails->lastname;
          $age = $pdetails->age;
          $nid = $pdetails->national_id;
          $appdate = $pdetails->Appointment_Date;
          $facilty = $pdetails->FacilityName;



    }
    ?>
    </div>
</div>
<div class="col-sm-6">
  <div class="panel-box">
  <h4>Basic form</h4>
  <h4><strong>Name:</strong><?php echo $Name;?>&nbsp<?php echo $lname;?></h4>
   <h4><strong>Age:</strong><?php echo $age;?></h4>
   <h4><strong>National ID:</strong><?php echo $nid;?></h4>
   <h4><strong>Appointment Date:</strong><?php echo $appdate;?></h4>
   <h4><strong>Facility Name:</strong><?php echo $facilty;?></h4>
 </div>
</div>
<div class="col-sm-6">
  <div class="panel-box">
  <h4>Vitals</h4>

     <h4><strong>Name:</strong><?php echo $Name;?>&nbsp<?php echo $lname;?></4>

 </div>
</div>
<div class="col-sm-6">
  <div class="panel-box">
  <h4>Today's Observations</h4>

     <h4><strong>Name:</strong><?php echo $Name;?>&nbsp<?php echo $lname;?></4>

 </div>
</div>
<div class="col-sm-6">
  <div class="panel-box">
  <h4>Patient History</h4>

     <h4><strong>Name:</strong><?php echo $Name;?>&nbsp<?php echo $lname;?></4>

 </div>
</div>
  </div>
</div><!--container-->
</div><!--content -->
</div><!--content page-->
@endsection
