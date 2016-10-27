
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
          $weight = $pdetails->current_weight;
          $height = $pdetails->current_height;
          $temperature = $pdetails->temperature;
          $systolic = $pdetails->systolic_bp;
          $diastolic = $pdetails->diastolic_bp;
          $allergies = $pdetails->allergies;
          $complain = $pdetails->chief_complaint;
          $nursenote = $pdetails->nurse_note;
          $observations = $pdetails->observations;




    }
    ?>
    </div>
</div>
<div class="col-sm-12">
  <div class="panel-box">

    <div class="tabs-container">
  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> HOME</a></li>
      <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">HISTORY</a></li>
      <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">TESTS</a></li>
      <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">PRESCRIPTION</a></li>
  </ul>
  <div class="tab-content">
      <div id="tab-1" class="tab-pane active">
          <div class="panel-body">


<div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <h4>Basic Details</h4>

                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Name</td>
                        <td><?php echo $Name;?>&nbsp<?php echo $lname;?></td>
                        <td><strong>Age:</strong></td>
                        <td><?php echo $age;?></td>
                     </tr>
                     <tr>
                        <td><strong>National ID:</strong></td>
                        <td><?php echo $nid;?></td>
                        <td><strong>Appointment Date:</strong></td>
                        <td><?php echo $appdate;?></td>
                     </tr>
                     <tr>

                        <td><strong>Facility Name:</strong></td>
                        <td><?php echo $facilty;?></td>
                        <td></td>
                        <td></td>

                     </tr>
                     <tr>
                          <td><strong>VITALS</strong></td>
                    </tr>
                     <tr>
                        <td><strong>Weight:</strong></td>
                        <td><?php echo $weight;?></td>
                        <td><strong>Height:</strong></td>
                        <td><?php echo $height;?></td>
                     </tr>
                     <tr>
                        <td><strong>Temperature:</strong></td>
                        <td><?php echo $temperature;?></td>
                        <td><strong>Systolic BP:</strong></td>
                        <td><?php echo $systolic;?></td>
                     </tr>
                     <tr>
                        <td><strong>Diastolic BP:</strong></td>
                        <td><?php echo $diastolic;?></td>
                        <td><strong>Allergies:</strong></td>
                        <td><?php echo $allergies;?></td>
                     </tr>
                     <tr>
                          <td><strong>VITALS</strong></td>
                    </tr>
                     <tr>
                        <td><strong>Chief Complaint:</strong></td>
                        <td><?php echo $complain;?></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td><strong>Nurses Notes:</strong></td>
                        <td><?php echo $nursenote;?></td>
                        <td></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td><strong>Observation's:</strong></td>
                        <td><?php echo $observations;?></td>
                        <td></td>
                        <td></td>
                     </tr>
                           <tr><td></td></tr>
                        {!! Form::open(array('route' => 'doctor.store','method'=>'POST')) !!}
                   <tr>
                     <div class="col-xs-12 col-sm-12 col-md-12">
                     <div class="form-group">
                    <td> <strong>Doctor's Notes:</strong></td>
                       <td>{!! Form::textarea('facility', null, array('placeholder' => 'facility','class' => 'form-control')) !!}  </td>
                     </div>
                     </div>
                      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <td/><button type="submit" class="btn btn-primary">Submit</button>  </td>
                      </div>
                    </tr>
                     	{!! Form::close() !!}
                  </tbody>
               </table>
            </div>



     </div>
      </div>
      <div id="tab-2" class="tab-pane">
          <div class="panel-body">
            <div class="table-responsive">
                             <table class="table table-striped">
                                <thead>
                                   <tr>
                                      <h4>History</h4>

                                   </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                      <td>Date</td>
                                      <td><?php echo $Name;?>&nbsp<?php echo $lname;?></td>
                                      <td><strong>Chief complain:</strong></td>
                                      <td><?php echo $age;?></td>
                                   </tr>
                                   <tr>
                                      <td><strong>Doctor Note:</strong></td>
                                      <td><?php echo $nid;?></td>
                                      <td><strong>Prescription:</strong></td>
                                      <td><?php echo $appdate;?></td>
                                   </tr>
                                   <tr>

                                      <td><strong>DOctor:</strong></td>
                                      <td><?php echo $facilty;?></td>
                                      <td><strong>Hospital:</strong></td>
                                      <td><?php echo $facilty;?></td>
                                       </tr>
                                </tbody>
                             </table>
                          </div>

          </div>
      </div>
      <div id="tab-3" class="tab-pane">
          <div class="panel-body">
              <strong>Tests</strong>

            <p>  that I neglect my talents. I should be incapable of d
              rawing a single stroke at the present moment; and yet.</p>
          </div>
      </div>
      <div id="tab-4" class="tab-pane">
          <div class="panel-body">
              <strong>Prescription</strong>

            <p>  that I neglect my talents. I should be incapable of d
              rawing a single stroke at the present moment; and yet.</p>
          </div>
      </div>
  </div>


  </div>
    </div>
     </div>


  </div>
</div><!--container-->
</div><!--content -->
</div><!--content page-->
@endsection
