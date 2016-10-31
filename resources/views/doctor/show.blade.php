@extends('layouts.doctor')
@section('content')
<div class="content-page  equal-height">
 <div class="content">
  <div class="container">
    <div class="row">

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

                    </tr>

                  </tbody>
               </table>
            </div>



     </div>
      </div>
      <?php
      $trg= (new \App\Http\Controllers\TriageController);
      $triageDetails = $trg->triageDetails();
              foreach ($triageDetails as $triage) {

                $tweight= $triage->current_weight;
                $theight= $triage->current_height;
                $ttemperature= $triage->temperature;
                $tsystolic= $triage->systolic_bp;
                $tdiastolic= $triage->diastolic_bp;
                $tcomplaint= $triage->chief_compliant;
                $tobservation= $triage->observation;
                $tphysician= $triage->consulting_physician;
                $tprescription= $triage->prescription;
                $tdate= $triage->updated_at;
                $tfacility= $triage->updated_at;
}
?>


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
                                      <td>Date of visit</td>
                                      <td><?php echo $tdate;?></td>
                                      <td><strong>Systolic BP:</strong></td>
                                      <td><?php echo $tsystolic;?></td>
                                      <td><strong>Diastolic BP:</strong></td>
                                      <td><?php echo $tdiastolic;?></td>
                                   </tr>
                                   <tr>
                                      <td><strong>Temperature:</strong></td>
                                      <td><?php echo $ttemperature;?></td>
                                      <td><strong>Weight:</strong></td>
                                      <td><?php echo $tweight;?></td>
                                      <td><strong>Height:</strong></td>
                                      <td><?php echo $theight;?></td>
                                   </tr>
                                   <tr>
                                     <td><strong>Chief complain:</strong></td>
                                      <td><?php echo $tcomplaint;?></td>
                                      <td><strong>Observations:</strong></td>
                                      <td><?php echo $tobservation;?></td>
                                       </tr>
                                       <tr>
                                         <td><strong>Consulting physician:</strong></td>
                                          <td><?php echo $tphysician?></td>
                                          <td><strong>Facility:</strong></td>
                                          <td><?php echo $tfacility;?></td>
                                          <td><strong>Prescription:</strong></td>
                                          <td><?php echo $tprescription;?></td>
                                           </tr>
                                </tbody>
                             </table>
                          </div>

          </div>
      </div>



            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                  <div class="table-responsive">
                                 <table class="table table-striped">
                                    <thead>
                                       <tr>
                                          <h4><strong>Tests</strong></h4>

                                       </tr>
                                    </thead>
                                    <tbody>


                    <?php
                  $tst= (new \App\Http\Controllers\TestController);
                  $tests = $tst->TestList();
                  foreach($tests as $test){

                }
                  ?>
              <tr><td>Select Tsest</td>
                <td>  <select name="test">
                    @foreach($tests as $test)
                     <option value="{{ $test->id }}">{{ $test->name }}</option>
                    @endforeach
                </select>
              </td>
               <td>  </td>
            </tr>



            <?php
            $tstd= (new \App\Http\Controllers\TestController);
            $testsd = $tstd->TestListdetails();
            foreach($testsd as $testd){

            }
            ?>
            <tr><td> Test Details</td>
            <td>  <select name="test">
            @foreach($testsd as $testd)
             <option value="{{ $testd->tests_id }}">{{ $testd->test_name }}</option>
            @endforeach
            </select>
            </td>
            <td>  </td>
            </tr>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <tr>  <td><button type="submit" class="btn btn-primary">Submit</button>  </td>
                <td>  </td><td>  </td>
                      </tr>
              </div>
                {!! Form::close() !!}


                <tr>
                <td><strong>Test Result</strong></td>
                </tr>
                <tr>
                   <td><strong>Test:</strong></td>
                   <td><?php echo $facilty;?></td>
                   <td><strong>Result:</strong></td>
                   <td><?php echo $facilty;?></td>
                    </tr>



              </tbody>
           </table>
              </div>
            </div>
</div>




      <div id="tab-4" class="tab-pane">
          <div class="panel-body">

              {!! Form::open(array('route' => 'doctor.store','method'=>'POST')) !!}
              <?php
              $tstd= (new \App\Http\Controllers\TestController);
              $testsd = $tstd->TestListdetails();
              foreach($testsd as $testd){

              }
              ?>
              <table class="table table-striped">
                 <thead>
                    <tr>
                       <h4>History</h4>

                    </tr>
                 </thead>
                 <tbody>
              <tr><td> Drug</td>
              <td>  <select name="test">
              @foreach($testsd as $testd)
               <option value="{{ $testd->tests_id }}">{{ $testd->test_name }}</option>
              @endforeach
              </select>
              </td>
              <td>  </td>
              <td>  </td>
              </tr>

              <tr><td> Dosage</td>
              <td>  <select name="test">
              @foreach($testsd as $testd)
               <option value="{{ $testd->tests_id }}">{{ $testd->test_name }}</option>
              @endforeach
              </select>
              </td>
              <td>  </td>
              </tr>


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
</tbody>
              {!! Form::close() !!}

          </div>
          </div>
      </div>
  </div>
<div

  </div>
    </div>
     </div>


  </div><!--row-->
</div><!--container-->
</div><!--content -->
</div><!--content page-->
@endsection
