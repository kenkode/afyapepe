<?php
$doc = (new \App\Http\Controllers\DoctorController);
$Docdatas = $doc->DocDetails();
foreach($Docdatas as $Docdata){


$Did = $Docdata->id;
$Name = $Docdata->name;
$Address = $Docdata->address;
$RegNo = $Docdata->regno;
$RegDate = $Docdata->regdate;
$Speciality = $Docdata->speciality;
$Sub_Speciality = $Docdata->subspeciality;
}


      foreach ($patientD as $pdetails) {
        // $patientid = $pdetails->pat_id;
        //  $facilty = $pdetails->FacilityName;
         $stat= $pdetails->status;
         $afyauserId= $pdetails->afya_user_id;
          $dependantId= $pdetails->persontreated;
          $app_id= $pdetails->id;
          $doc_id= $pdetails->doc_id;
          $fac_id= $pdetails->facility_id;
          $fac_setup= $pdetails->set_up;
          $dependantAge = $pdetails->depdob;
          $AfyaUserAge = $pdetails->dob;
        $condition = $pdetails->condition;
 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;
 $dependantdays= floor($datediff / (60 * 60 * 24));


 if ($dependantId =='Self') {
            $dob=$AfyaUserAge;
            $gender=$pdetails->gender;
          $firstName = $pdetails->firstname;
          $secondName = $pdetails->secondName;
          $name =$firstName." ".$secondName;
   }

 else {    $dob=$dependantAge;
           $gender=$pdetails->depgender;
           $firstName = $pdetails->dep1name;
           $secondName = $pdetails->dep2name;
           $name =$firstName." ".$secondName;
      }


  $interval = date_diff(date_create(), date_create($dob));
  $age= $interval->format(" %Y Year, %M Months, %d Days Old");


 $appStatue=$stat;
if ($appStatue == 2) {
  $appStatue ='ACTIVE';
} elseif ($stat == 3) {
  $appStatue='Discharged Outpatient';
} elseif ($stat == 4) {
  $appStatue='Admitted';
} elseif ($stat == 5) {
  $appStatue='Refered';
}
elseif ($stat == 6) {
  $appStatue='Discharged Intpatient';
}

}
?>
<div class="row wrapper border-bottom white-bg page-heading">
              <div class="col-lg-6">
                  <h2>{{$name}}</h2>
                  <ol class="breadcrumb">
                      <li><a>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></li>
                      <li><a>{{$age}}</a> </li>
                      <li>
                          <strong> <button type="btn" class="btn btn-primary">{{$appStatue}}</button></strong>
                      </li>
                  </ol>
              </div>
              <div class="col-lg-6">
                  <h2>{{$pdetails->FacilityName}} </h2>
                  <ol class="breadcrumb">
                    <li class="active"><strong>{{$Name}} </strong></li>
                  </ol>
              </div>
</div>
<!--tabs Menus-->
<div class="row border-bottom">
<nav class="navbar" role="navigation">
  <div class="navbar-collapse " id="navbar">
        <ul class="nav navbar-nav">
          <li><a role="button" href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
          <li><a role="button" href="{{route('patienthistory',$app_id)}}">History</a></li>
          <li><a role="button" href="{{route('testes',$app_id)}}">Tests</a></li>
          <li class="active"><a role="button" href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
          <li><a role="button" href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
          @if ($condition =='Admitted')
            <li><a role="button" href="{{route('discharge',$app_id)}}">Discharge</a></li>
           @else
            <li><a role="button" href="{{route('admit',$app_id)}}">Admit</a></li>@endif
            <li><a role="button" href="{{route('transfering',$app_id)}}">Transfer</a></li>
           <li><a role="button" href="{{route('endvisit',$app_id)}}">End Visit</a></li>
         </ul>
     </div>
</nav>
</div>
<div class="row wrapper border-bottom  page-heading">
   <div class="ibox float-e-margins">
      <div class="col-lg-12">
           <div class="tabs-container">
     <!--Test result tabs PatientController@testdone-->

       <?php $i =1;
     $tstdone = DB::table('patient_test')
      ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
      ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.FacilityCode')
      ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
      ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
      ->select('patient_test_details.*','patient_test_details.id as ptdid','facilities.*','lab_test.name','diagnoses.name as diagnoses')
       ->where([
        ['patient_test.appointment_id', '=',$app_id],
        ['patient_test_details.confirm', '=','N'],
       ])
       ->orderBy('created_at', 'desc')
       ->get();
       ?>
        <div class="row">
          <div class="col-lg-12">
              <div class="tabs-container">
                  <ul class="nav nav-tabs">
         <div class="col-lg-6">
        <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-1"><i class="fa fa-database"></i>Diagnosis</a>
           </div>
          <div class="col-lg-6">
          <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-2"><i class="fa fa-flask"></i>Quick Diagnosis</a>
          </div>
         </ul>

         <div class="tab-content">
             <div id="tab-1" class="tab-pane active">
                 <div class="panel-body">
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
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                             </thead>
                            <tbody>

                             @foreach($tstdone as $tstdn)
                               <tr>
                               <td>{{ +$i }}</td>
                              <td>{{$tstdn->created_at}}</td>
                               <td>{{$tstdn->name}}</td>
                              <td>{{$tstdn->diagnoses}}</td>

                               <td><?php
                               $prescs=$tstdn->done;
                               if (is_null($prescs)) {
                                 $prescs= 'N/A';
                               }
                               elseif ($prescs==0) {
                                 $prescs= 'Pending';
                               } elseif($prescs==1) {
                                 $prescs= 'Complete';
                               }
                                 ?>  {{$prescs}}</td>
                                <td>{{$tstdn->results}}</td>
                                <td>{{$tstdn->note}}</td>
                           <td>
                             <div>
                               {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
                               {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                               {{ Form::hidden('pat_details_id',$tstdn->ptdid, array('class' => 'form-control')) }}
                               <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
                              {{ Form::close() }}
                           </td>
                        </tr>
                        <?php $i++; ?>

                        @endforeach

                        </tbody>
                      </table>

                     </div>
                   </div>
                </div>

            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                  {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

                  <div class="col-md-6 b-r">
                  <div class="form-group">
                  <label for="tag_list" class="">Disease Name:</label>
                  <select class="test-multiple" name="disease"  style="width: 100%">
                  <?php $diagnoses=DB::table('diagnoses')->get();?>
                  @foreach($diagnoses as $diag)
                  <option value='{{$diag->id}}'>{{$diag->name}}</option>
                  @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                  <label for="tag_list" class="">Type of Diagnosis:</label>
                  <select class="test-multiple" name="level"  style="width: 100%" >
                  <option value=''>Choose one</option>
                  <option value='Primary'>Primary</option>
                  <option value='Secondary'>Secondary</option>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="tag_list" class="">Chronic:</label>
                  <select class="test-multiple" name="chronic"  style="width: 100%" >
                  <option value=''>Choose one</option>
                  <option value='Y'>YES</option>
                  <option value='N'>No</option>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="tag_list" class="">Level of Severity:</label>
                  <select class="test-multiple" name="severity"  style="width: 100%" >
                  <?php $severeity=DB::table('severity')->get();
                  ?>
                  <option value=''>Choose one</option>
                  @foreach($severeity as $diag)
                  <option value='{{$diag->id}}'>{{$diag->name}}</option>
                  @endforeach
                  </select>
                  </div>

                  </div>
                  <div class="col-sm-6">
                  <div class="form-group">
                  <label for="tag_list" class="">Supportive Care:</label>
                  <select class="test-multiple" name="care"  style="width: 100%" >
                  <?php $scare=DB::table('supportive_care')->get();
                  ?>
                  <option value=''>Choose one</option>
                  @foreach($scare as $sup)
                  <option value='{{$sup->name}}'>{{$sup->name}}</option>
                  @endforeach
                  </select>
                  </div>
                  {{ Form::hidden('state','Normal', array('class' => 'form-control')) }}
                  {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                  {{ Form::hidden('dependant_id',$dependantId, array('class' => 'form-control')) }}
                  {{ Form::hidden('afya_user_id',$afyauserId, array('class' => 'form-control')) }}
                  {{ Form::hidden('facility_id',$fac_id, array('class' => 'form-control')) }}
                  {{ Form::hidden('doc_id',$Did, array('class' => 'form-control')) }}
                  </div>
                  <div class="col-lg-offset-5">
                  <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>
                  </div>
                  {{ Form::close() }}
                </div>
           </div>
        </div>

      </div>
    </div>
  </div>


</div><!-- div id="testR" -->
 </div><!-- tabs-container -->
  </div><!-- col md 12" -->
   </div><!-- emargis" -->
