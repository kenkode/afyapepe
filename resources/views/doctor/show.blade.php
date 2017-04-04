@extends('layouts.show')
@section('content')
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


}


if ( empty ($Name ) ) {
// return view('doctor.create');

return redirect('doctor.create');

}
?>

<?php
      foreach ($patientdetails as $pdetails) {
        // $patientid = $pdetails->pat_id;
       if ($pdetails->persontreated=='Self') {
         $pname = $pdetails->firstname;
         $lname = $pdetails->secondName;
         $facilty = $pdetails->FacilityName;
         $phone = $pdetails->msisdn;
         $stat= $pdetails->appstatus;
         $afyauserId= $pdetails->afyaId;
        }
        else {
          $pname = $pdetails->Infname;
          $lname = $pdetails->InfName;
          $facilty = $pdetails->FacilityName;
          $phone = $pdetails->msisdn;
          $stat= $pdetails->appstatus;
          $afyauserId= $pdetails->afyaId;
         }


        // $dob = $pdetails->dob;
        // $nid = $pdetails->nationalId;
        // $appoid = $pdetails->app_id;
        // $appdate = $pdetails->created_at;

        // $weight = $pdetails->current_weight;
        // $height = $pdetails->current_height;
        // $temperature = $pdetails->temperature;
        // $systolic = $pdetails->systolic_bp;
        // $diastolic = $pdetails->diastolic_bp;
        //
        // $complain = $pdetails->chief_compliant;
        // $observations = $pdetails->observation;
        // $gender = $pdetails->gender;

 //        if ($gender=1) {
 //          $gender='Male';
 //        }else{
 //          $gender='Female';
 //        }
 //
 //        if ($stat=="1") {
 //          $stat='queueing';
 //        }elseif($stat=="2") {
 //          $stat='Active';
 //        }elseif($stat=="3") {
 //          $stat='Discharged';
 //        }elseif($stat=='4') {
 //        $stat='Admitted';
 //        }else{
 //          $stat='Referred';
 //        }
 //
 //
 // $interval = date_diff(date_create(), date_create($dob));
 // $age= $interval->format(" %Y Year, %M Months, %d Days Old");

}
?>

    <div class="ibox-title">
        <h5>{{$facilty}}</h5>
        <div class="ibox-tools">
          <a class="collapse-link">{{$Name}}  </a>
        </div>
      </div>
      <div class="panel-body">

          <h5><strong>Patient Name</strong>&nbsp;&nbsp;&nbsp;<?php echo $pname;?>&nbsp<?php echo $lname;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Phone:<?php echo $phone; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          status&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs"><?php echo $stat; ?>
        </h5></div>

<!--tabs-->
        <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Today's Triage</button></a></li>
                    <li><a data-toggle="tab" href="#tab-2">History</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Tests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li>
                </ul>
              <!-- </div> -->
                <div class="tab-content">
                  <!--tabs1-->
                  <div id="tab-1" class="tab-pane active">
                      <div class="ibox float-e-margins">
                        <div class="table-responsive ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                           <thead>
                        <tr>
                         <th></th>
                           <th>Weight </th>
                           <th>Height</th>
                           <th>Temperature</th>
                           <th>Systolic BP</th>
                           <th>Diastolic BP</th>
                           <th>BMI</th>
                           <th>Chief Compliant</th>
                           <th>Observations</th>
                           <th>Symptoms</th>
                           <th>Nurse Notes</th>


                        </tr>
                        </thead>

                        <tbody>
                        <?php $i =1; ?>

                        @foreach($patientdetails as $pdetails)
                          <tr>
                          <td>{{ +$i }}</td>
                         <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->current_weight;}
                         else {echo $pdetails->Infweight;}
                         ?>
                           </td>
                          <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->current_height;}
                          else {echo $pdetails->Infheight;}
                          ?></td>
                          <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->temperature;}
                            else {echo $pdetails->Inftemp;}
                            ?></td>
                          <td>
                            <?php if ($pdetails->persontreated=='Self') {echo $pdetails->systolic_b;}
                              else {echo $pdetails->Infsysto;}
                              ?></td>
                           <td>
                             <?php if ($pdetails->persontreated=='Self') {echo $pdetails->diastolic_b;}
                               else {echo $pdetails->Infdiasto;}
                               ?></td>
                           <td>
                             <?php if ($pdetails->persontreated=='Self') {$height=$pdetails->current_height; $weight=$pdetails->current_weight;}
                               else {$height=$pdetails->Infheight; $weight=$pdetails->Infweight;}
                                         $bmi =$weight/($height*$height);
                                      echo number_format($bmi, 2);
                                   ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->chief_compliant;}
                             else {echo $pdetails->Infcompliant;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->observation;}
                             else {echo $pdetails->Infobservation;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->symptoms;}
                             else {echo $pdetails->Infsymptoms;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->nurse_notes;}
                             else {echo $pdetails->nurse_notes;}
                             ?>
                               </td>


                        </tr>
                        <?php $i++; ?>

                        @endforeach

                        </tbody>
                        </table>
                        </div>
                         </div>
                      </div>
<!--tabs2-->
<div id="tab-2" class="tab-pane">
    <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Patient Visit History</h5>

            </div>
            <div class="ibox-content">
            <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-conditional" >
            <thead>
            <tr>
              <th></th>
                <th>Date of visit</th>
                <th>Chief Complaint</th>
                <th>Doctor's Note</th>
                <th>Test</th>
                <th>Prescription</th>
                <th>view more</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $pathists = DB::table('appointments')
              ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
              ->leftJoin('patient_test', 'appointments.id',  '=', 'patient_test.appointment_id')
              ->leftJoin('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
              ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
              ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
              ->select('triage_details.chief_compliant','triage_details.updated_at',
              'patient_test.test_status','prescriptions.filled_status','appointments.id',
              'appointments.persontreated',

              'triage_infants.chief_compliant as Infcompliant','triage_infants.updated_at as Infupdated')

              ->where('appointments.afya_user_id',$afyauserId)
              ->get();
              ?>
              <?php $i =1; ?>
           @foreach($pathists as $pathist)
                <tr>
                    <td>{{ +$i }}</td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->updated_at;}
                    else {echo $pathist->Infupdated;}?></td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->chief_compliant;}
                    else {echo $pathist->Infcompliant;}?></td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->chief_compliant;}
                    else {echo $pathist->Infcompliant;}?></td>
                    <td><?php
                    if ($pathist->persontreated=='Self') {$tests=$pathist->test_status;}
                    else {$tests=$pathist->test_status;}


                    if (is_null($tests)) {
                      $tests= 'N/A';
                    }
                    elseif($tests==0) {
                     $tests= 'Pending';
                   } elseif($tests==1) {
                      $tests= 'Done';
                    }else {
                        $tests= 'Partial';
                    }
                      ?>  {{$tests}}</td>
                      <td><?php
                      $prescs=$pathist->filled_status;
                      if (is_null($prescs)) {
                        $prescs= 'N/A';
                      }
                      elseif ($prescs==0) {
                        $prescs= 'Pending';
                      } elseif($prescs==1) {
                        $prescs= 'Complete';
                      }else {
                          $prescs= 'Partial';
                      }
                        ?>  {{$prescs}}</td>
                    <td><a href="{{route('visit',$pathist->id)}}" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i></a></td>
                 </tr>

                <?php $i++; ?>
                  @endforeach
           </tbody>
            <tfoot>
              <tr>
                <th></th>
                  <th>Date of visit</th>
                  <th>Chief Complaint</th>
                  <th>observations</th>
                  <th>Prescription</th>
                  <th>Prescription</th>
                    <th>view more</th>
              </tr>
            </tfoot>
            </table>
          </div>
         </div>
      </div>

</div><!--2 tabs-->
<!--tabs3-->
<div id="tab-3" class="tab-pane">
<div class="ibox float-e-margins">
<div class="ibox-content col-md-12">
{{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
<!-- {{ Form::open(array('id' => 'ptest')) }} -->

<div class="col-md-6">

<div class="form-group ">
    <label for="d_list2">Conditional Diagnosis:</label>
    <select id="d_list2" name="conditional" class="d_list2 form-control" style="width: 100%"></select>
</div>

            <div class="form-group">
                 <label style="margin right:250px;">Request Test:</label>
                  <input id="id_radio1" type="radio" name="name_radio1" value="value_radio1"  style="width: 50px;"/>YES
                   <input id="id_radio2" type="radio" name="name_radio1" value="value_radio2" style="width: 50px;"/>NO
              </div>
              <div>
                   <div id="div1">
                     <div class="form-group ">
                         <label class="col-md-4">Test Categories:</label>
                         <input type="checkbox" name="colorCheckbox" value="MRI">MRI
                         <input type="checkbox" name="colorCheckbox" value="Lab"> Laboratory
                         <input type="checkbox" name="colorCheckbox" value="Neurology"> Neurology
                          <input type="checkbox" name="colorCheckbox" value="Gestrointestinal"> Gestrointestinal
                     </div>

                      <div class="MRI box">MRI TESTS COMING SOON</div>
                      <!-- Laboratory Tests starts}} -->
                     <div class="Lab box">
                       <div class="form-group ">
                          <label class="col-md-4">Laboratory Test Categories:</label>
                          <input type="checkbox" name="lab_test_cat" value="biochemistry">Biochemistry
                          <input type="checkbox" name="lab_test_cat" value="Coagulation"> Coagulation
                          <input type="checkbox" name="lab_test_cat" value="Haematology"> Haematology
                           <input type="checkbox" name="lab_test_cat" value="Immuno_infective">Immuno_infective
                           <input type="checkbox" name="lab_test_cat" value="Immuno_auto ">Immuno Auto Immune
                           <input type="checkbox" name="lab_test_cat" value="Microbilogy">Microbilogy
                      </div>
                       <div class="biochemistry box">

                         <div class="form-group">
                             <label for="tag_list" class="col-md-4">Select Biochestry Test:</label>
                                  <select class="test-multiple" name="biotests[]" multiple="multiple" style="width: 100%">
                                    <?php $biotests=DB::table('lab_test')->where('category', '=','Biochemistry')->distinct()->get(['id','name']); ?>
                                    @foreach($biotests as $biotest)
                                           <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                    @endforeach
                                    </select>
                              </div>

                       </div>
                      <div class="Coagulation box">
                        <div class="form-group">
                            <label for="tag_list" class="col-md-4">Select Coagulation  Test:</label>
                                 <select class="test-multiple" name="coagtests[]" multiple="multiple" style="width: 100%">
                                   <?php $coagtests=DB::table('lab_test')->where('category', '=','Coagulation')->distinct()->get(['id','name']); ?>
                                   @foreach($coagtests as $coagtest)
                                          <option value='{{$coagtest->id}}'>{{$coagtest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                      </div>
                      <div class="Haematology box">
                        <div class="form-group">
                            <label for="tag_list" class="col-md-4">Select Haematology Test:</label>
                                 <select class="test-multiple" name="haemtests[]" multiple="multiple" style="width: 100%">
                                   <?php $haemtests=DB::table('lab_test')->where('category', '=','Haematology')->distinct()->get(['id','name']); ?>
                                   @foreach($haemtests as $haemtest)
                                          <option value='{{$haemtest->id}}'>{{$haemtest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                      </div>
                      <div class="Immuno_infective box">
                        <div class="form-group">
                            <label for="tag_list" class="col-md-4">Select Immunology Infective Test:</label>
                                 <select class="test-multiple" name="inftests[]" multiple="multiple" style="width: 100%">
                                   <?php $imitests=DB::table('lab_test')->where('category', '=','Immunology_Infective')->distinct()->get(['id','name']); ?>
                                   @foreach($imitests as $imitest)
                                          <option value='{{$imitest->id}}'>{{$imitest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                      </div>
                      <div class="Immuno_auto box">
                        <div class="form-group">
                            <label for="tag_list" class="col-md-4">Select Immunology Auto Immune Test:</label>
                                 <select class="test-multiple" name="autotests[]" multiple="multiple" style="width: 100%">
                                   <?php $imatests=DB::table('lab_test')->where('category', '=','Immunology-Auto-Immune')->distinct()->get(['id','name']); ?>
                                   @foreach($imatests as $imatest)
                                          <option value='{{$imatest->id}}'>{{$imatest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                      </div>
                      <div class="Microbilogy box">

                        <div class="form-group">
                            <label for="tag_list" class="col-md-4">Select Microbiologye  Test:</label>
                                 <select class="test-multiple" name="microtests[]" multiple="multiple" style="width: 100%">
                                   <?php $micrtests=DB::table('lab_test')->where('category', '=','Microbiology')->distinct()->get(['id','name']); ?>
                                   @foreach($micrtests as $micrtest)
                                          <option value='{{$micrtest->id}}'>{{$micrtest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                      </div>
                    </div><!-- Laboratory Tests Ends}} -->
                     <div class="Neurology box">Neurology TESTS COMING SOON</div>
                     <div class="Gestrointestinal box">Gestrointestinal TESTS COMING SOON</div>



                   </div>

              </div>



</div>
<div class="form-group  text-center col-md-2">
{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

<br /><br /><br />
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
</div>
</div>


<!--Test result tabs PatientController@testdone-->
<div id="testR">
<div class="table-responsive ibox-content">
<table class="table table-striped table-bordered table-hover dataTables-conditional" >
   <thead>
<tr>
 <th></th>
    <th>Date </th>
   <th>Test Name</th>
   <th>Conditional Diagnosis</th>
   <th>Status</th>
   <th>Result</th>
   <th>Faciity</th>
   <th>Note</th>


</tr>
</thead>

<tbody>
<?php $i =1; ?>

@foreach($tstdone as $tstdn)
  <tr>
  <td>{{ +$i }}</td>
 <td>{{$tstdn->created_at}}</td>
  <td>{{$tstdn->name}}</td>
  <td>{{$tstdn->disease}}</td>
  <td>{{$tstdn->done}}</td>
   <td>{{$tstdn->results}}</td>
   <td>{{$tstdn->FacilityName}}</td>
   <td>{{$tstdn->note}}</td>

</tr>
<?php $i++; ?>

@endforeach

</tbody>
</table>
</div>
</div>

</div><!--3tabs-->

<!--tabs4-->
                    <div id="tab-4" class="tab-pane">

        {{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}

                  <?php  $routem= (new \App\Http\Controllers\TestController);
                        $routems = $routem->RouteM();
                    ?>
                  <?php $Strength= (new \App\Http\Controllers\TestController);
                        $Strengths = $Strength->Strength();
                    ?>
                  <?php $frequency= (new \App\Http\Controllers\TestController);
                        $frequent = $frequency->Frequency();
                    ?>


                      <div class="ibox float-e-margins">
                        <div class="ibox-content col-md-12">
                    <div class="ibox-content col-md-8 col-md-offset-2">

                          <div class="form-group ">
                              <label for="d_list3" class="col-md-4">Confirmed Diagnosis:</label>
                              <select  name="diagnosis" class="form-control d_list2" style="width: 50%"></select>
                          </div>
                          <div class="form-group">
                              <label for="presc" class="col-md-4">Prescription:</label>
                              <select id="presc" name="prescription" class="form-control presc1" style="width: 50%"></select>
                          </div>
                          <div class="form-group">
                              <label for="dosage" class="col-md-4">Dosage Form</label></td>
                               <select class="form-control m-b col-md-4" name="dosageform" id="example-getting-started" style="width: 50%">
                                <?php $druglists=DB::table('druglists')->distinct()->get(['DosageForm']); ?>
                                @foreach($druglists as $druglist)
                                       <option value='{{$druglist->DosageForm}}'>{{$druglist->DosageForm}}</option>
                                @endforeach
                              </select>
                            </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Strength</label></td>
                               <select class="form-control" id="testsj" name="strength" style="width: 25%">
                                   @foreach($Strengths as $Strengthz)
                                     <option value="{{$Strengthz->strength}}">{{ $Strengthz->strength  }}  </option>
                                  @endforeach
                              </select>

                        <input type="radio" name="strength_unit" value="ml"> Ml &nbsp;&nbsp;<input type="radio" name="strength_unit" value="mg"> Mg

                           </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Route</label></td>
                               <select class="form-control" name="routes" style="width: 50%">
                                   @foreach($routems as $routemz)
                                     <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                              <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Frequency</label></td>
                               <select class="form-control"  name="frequency" style="width: 50%">
                                   @foreach($frequent as $freq)
                                     <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                            {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                            {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}



                                    <div class="form-group  text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                                     </div>

                                {{ Form::close() }}
                                    </div>
                                    <div class="col-lg-12">
                                      <div class="ibox float-e-margins">
                                        <div class="ibox-content col-md-12">
                                        <div class="ibox-title">
                                            <h5>Prescription List</h5>
                                            <div class="ibox-tools">

                                                <a class="collapse-link">
                                                    <i class="fa fa-chevron-up"></i>
                                                </a>
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">

                                                    <li><a href="#">Config option 1</a>
                                                    </li>
                                                    <li><a href="#">Config option 2</a>
                                                    </li>
                                                </ul>
                                                <a class="close-link">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                           <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                                        <thead>
                                       <tr>
                                         <th></th>


                                            <th>Diagnosis</th>
                                            <th>Drug Name</th>
                                            <th>Dosage Form</th>
                                           <th>Strength</th>
                                           <th>Strength Unit</th>
                                           <th>Date given</th>
                                     </tr>
                                   </thead>

                                   <tbody>
                                     <?php $i =1; ?>

                                  @foreach($prescription as $presc)
                                          <tr>
                                             <td>{{ +$i }}</td>
                                           <td>{{$presc->name}}</td>
                                           <td>{{$presc->drugname}}</td>
                                           <td>{{$presc->doseform}}</td>
                                           <td>{{$presc->strength}}</td>
                                           <td>{{$presc->strength_unit}}</td>
                                           <td>{{$presc->created_at}}</td>

                                  </tr>
                                       <?php $i++; ?>

                                    @endforeach

                                      </tbody>
                                    </table>
                                   </div>
                                  </div>
                                </div>
                            </div>
                            </div>
                                   </div>
                               </div>
                      </div><!--4 tabs-->

                    <!--tabs5 Admit-->
                    <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
                                    </div>
                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Appointment Date</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',4, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}
                        </div><!--panel body-->
                    </div><!--5 tabs Admit-->

                    <!--tabs6 Discharge-->
                    <div id="tab-6" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}


                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Appointment Date</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',3, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}


                          </div><!--panel body-->
                    </div><!--6tabs Discharged-->
                    <!--tabs7 Transfer-->
                    <div id="tab-7" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}
                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
                                    </div>


                                   {{ Form::hidden('appointment_status',5, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}

                          </div><!--panel body-->
                    </div><!--7tabs-->

















              </div><!--tabcontent-->
          </div><!--tabs-container-->
        </div><!--col12-->
        <!--tabs-->

        </div><!--row-->
  </div><!--wrapper-->


</body>
</html>
@endsection
