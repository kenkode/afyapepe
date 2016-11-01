@extends('layouts.doctor')
@section('content')
<div class="content-page  equal-height">
 <div class="content">
  <div class="container">
    <div class="row">
      @if (count($errors) > 0)
     <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
     <ul>
      @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
      @endforeach
     </ul>
     </div>
     @endif
      <?php
    $doc = (new \App\Http\Controllers\DoctorController);
    $Docdatas = $doc->DocDetails();
    foreach($Docdatas as $Docdata){


      $Did = $Docdata->doc_id;
    	$Name = $Docdata->name;
    	$Address = $Docdata->address;
    	$RegNo = $Docdata->regno;
    	$RegDate = $Docdata->regdate;
    	$Speciality = $Docdata->speciality;
    	$Sub_Speciality = $Docdata->subspeciality;
      $Facility = $Docdata->facility;

    }


    if ( empty ($Name ) ) {
    // return view('doctor.create');

    return redirect('doctor.create');


    // return redirect()->action('DoctorController@create');

    }
    ?>

    <div class="pull-right">
     <div class="page-title clearfix">
                              <h3><?php echo $Facility;?></h3>

                          </div><!--end page title-->

       <div class="widget-box clearfix">
    <h4><?php echo $Name;?></h4>
    <h4>Address:
    <?php echo $Address; ?></h4>
    <h4>Registration Number:
    <?php echo $RegNo; ?></h4>

    <h4>Registration Date:
    <?php echo $RegDate; ?></h4>

    <h4>Speciality:
    <?php echo $Speciality; ?></h4>

    <h4>Sub Speciality:
    <?php echo $Sub_Speciality; ?></h4>
    </div>
    </div>

    	<br>	<br>	<br>

    </div>

    <div class="row">

<div class="col-xs-12 col-sm-12 col-md-12">

    <div class="form-group">


<?php
        foreach ($patientdetails as $pdetails) {
          $pid = $pdetails->patient_id;
          $Name = $pdetails->firstname;
          $lname = $pdetails->secondName;
          $age = $pdetails->age;
          $nid = $pdetails->national_id;
          $appid = $pdetails->AppID;
          $appdate = $pdetails->Appointment_Date;
          $facilty = $pdetails->FacilityName;
          $weight = $pdetails->current_weight;
          $height = $pdetails->current_height;
          $temperature = $pdetails->temperature;
          $systolic = $pdetails->systolic_bp;
          $diastolic = $pdetails->diastolic_bp;
          $allergies = $pdetails->allergies;
          $complain = $pdetails->chief_compliant;

          $observations = $pdetails->observation;
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

<!--Home tabs-->
<div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <h4>Basic Details</h4>

                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                       <td><strong>Patient Id:</strong></td>
                       <td><?php echo $pid;?></td>
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
                        <td><strong>Observation's:</strong></td>
                        <td><?php echo $observations;?></td>
                        <td></td>
                        <td></td>
                     </tr>



                  </tbody>
               </table>
            </div>



     </div>
      </div>
      <!--History tabs-->
      <!--Patient controller @showpatient-->
      <?php

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
         <table class="table table-small-font table-bordered table-striped">
       <thead>
           <tr>
             <th></th>
               <th>Date of visit</th>
               <th>CHief Complain</th>
               <th>observations</th>
               <th>Prescription</th>

         </tr>
       </thead>

       <tbody>
         <?php $i =1; ?>
      @foreach($triageDetails as $triageDetails)
           <tr>
               <td>{{ +$i }}</td>
               <td>{{$triageDetails->updated_at}}</td>
               <td>{{$triageDetails->chief_compliant}}</td>
               <td>{{$triageDetails->observation}}</td>
               <td>{{$triageDetails->prescription}}</td>



           </tr>
           <?php $i++; ?>

        @endforeach

        </tbody>
      </table>
  </div>
    </div>
  </div>


<!--Test tabs-->
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                  <div class="table-responsive">
  {{ Form::open(array('route' => array('test.store'),'method'=>'POST')) }}



   <table class="table table-striped">
      <thead>
         <tr>
            <h4><strong>Tests</strong></h4>
 </tr>
      </thead>
      <tbody>


<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<tr>
  <td>{{ Form::hidden('patient_id',$pdetails->patient_id, array('class' => 'form-control')) }}
</td>

  <td>{{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
</td>
<td>{{ Form::text('appointment_id',$appid, array('class' => 'form-control')) }}
</td>
  <td>{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}
  </td></tr>
  </div>
    </div>

                    <?php
                  $tst= (new \App\Http\Controllers\TestController);
                  $tests = $tst->TestList();
                  foreach($tests as $test){

                }
                  ?>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
              <tr><td>Select Tsest</td>
                <td>  <select name="test" id='pre-selected-options1' multiple='multiple'>
                    @foreach($tests as $test)
                     <option value="{{ $test->id }}">{{ $test->name }}</option>
                    @endforeach
                </select>
              </td>
               <td>  </td>
            </tr>
</div>
</div>


            <?php
            $tstd= (new \App\Http\Controllers\TestController);
            $testsd = $tstd->TestListdetails();
            foreach($testsd as $testd){

            }
            ?>
            <tr><td> Test Details</td>
            <td>  <select name="test_reccommended[]" id='pre-selected-options' multiple='multiple'>
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
                {{ Form::close() }}

             </tbody>
           </table>
              </div>
            </div>
</div>



<!--Prescription tabs-->
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

   <tr>
   <td><strong>Test Result</strong></td>
   <td><strong>Test Result</strong></td>
   <td><strong>Test Result</strong></td>
   </tr>
   <tr>
      <td><strong>Test:</strong></td>
      <td><?php echo $facilty;?></td>
      <td><strong>Result:</strong></td>
      <td><?php echo $facilty;?></td>
       </tr>

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
