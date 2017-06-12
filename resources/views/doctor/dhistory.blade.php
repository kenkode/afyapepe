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
<div class="row wrapper border-bottom page-heading">
<div class="ibox float-e-margins">
  <div class="col-lg-12">
      <div class="tabs-container">

             <ul class="nav nav-tabs">
             <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
             <li  class="active"><a href="{{route('patienthistory',$app_id)}}">History</a></li>
             <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
             <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
             <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
             @if ($condition =='Admitted')
                     <li><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
              @else  <li><a href="{{route('admit',$app_id)}}">Admit</a></li>@endif
               <li ><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
               <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>

             </ul>

<?php if ($dependantId =='Self') {
$i =1;
     $triagedetails= DB::table('appointments')
     ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
     ->select('triage_details.*','appointments.created_at as visitDate')
     ->where('appointments.afya_user_id', '=',$afyauserId)
     ->orderBy('visitDate', 'desc')
     ->get();
?>
<div class ="ibox-content">
   <h5>Patient Triage Details</h5>
      <div class="table-responsive ibox-content">
      <table class="table table-striped table-bordered table-hover dataTables-conditional" >
      <thead>
      <tr>
      <th></th>
      <th>Date Of Visit</th>
      <th>Height</th>
      <th>weight</th>
      <th>Temperature</th>
      <th>Systolic BP</th>
      <th>Diastolic BP</th>
      <th>Chief Compliant</th>
      <th>Observation</th>
      <th>Notes</th>
      </tr>
      </thead>

      <tbody>

      @foreach($triagedetails as $triage)
      <tr>
      <td>{{ +$i }}</td>
      <td>{{$triage->visitDate}}</td>
      <td>{{$triage->current_height}}</td>
      <td>{{$triage->current_weight}}</td>
      <td>{{$triage->temperature}}</td>
      <td>{{$triage->systolic_bp}}</td>
      <td>{{$triage->diastolic_bp}}</td>
      <td>{{$triage->chief_compliant}}</td>
      <td>{{$triage->observation}}</td>
      <td>{{$triage->nurse_notes}}</td>
      </tr>
      <?php $i++; ?>
      @endforeach
      </tbody>
      </table>
      </div>
      </div>

<?php     }else{ if($dependantdays <='28') {
$i =1;
$triagedetails= DB::table('appointments')
->Join('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
->select('triage_infants.*','appointments.created_at as visitDate')
->where('appointments.persontreated', '=',$dependantId)
->orderBy('visitDate', 'desc')
->get();
?>

 <h5>Patient Triage Details</h5>
  <div class="table-responsive ibox-content">
   <table class="table table-striped table-bordered table-hover dataTables-conditional" >
     <thead>
  <tr>
   <th></th>
   <th>Date Of Visit</th>
     <th>Height</th>
     <th>weight</th>
     <th>Temperature</th>
     <th>Systolic BP</th>
     <th>Diastolic BP</th>
     <th>Chief Compliant</th>
     <th>Observation</th>
     <th>Notes</th>
  </tr>
  </thead>

  <tbody>

  @foreach($triagedetails as $triage)
    <tr>
   <td>{{ +$i }}</td>
   <td>{{$triage->visitDate}}</td>
   <td>{{$triage->height}}</td>
   <td>{{$triage->weight}}</td>
   <td>{{$triage->temperature}}</td>
   <td>{{$triage->systolic_bp}}</td>
  <td>{{$triage->diastolic_bp}}</td>
  <td>{{$triage->chief_compliant}}</td>
  <td>{{$triage->observation}}</td>
  <td>{{$triage->nurse_notes}}</td>

  </tr>
  <?php $i++; ?>

  @endforeach

  </tbody>
    </table>
     </div>

      <?php } }
      $i=1;
      $tstdone = DB::table('patient_test_details')
      ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.FacilityCode')
      ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
      ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
      ->select('patient_test_details.*','facilities.*','lab_test.name','diagnoses.name as diagnoses')
      ->where('patient_test_details.afya_user_id', '=',$afyauserId)
         ->orWhere('patient_test_details.dependant_id', '=',$dependantId)
      ->orderBy('created_at', 'desc')
      ->get();

         ?>
<div class ="ibox-content">
       <h5>Patient Test Details</h5>
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
          <td>{{$tstdn->FacilityName}}</td>
          <td>{{$tstdn->note}}</td>
      </tr>
      <?php $i++; ?>

      @endforeach

      </tbody>
      </table>
      </div>

      <?php
        $prescriptions = DB::table('prescription_details')
          ->leftJoin('diagnoses', 'prescription_details.diagnosis', '=', 'diagnoses.id')
          ->leftJoin('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
          ->leftJoin('frequency', 'prescription_details.frequency', '=', 'frequency.id')
          ->leftJoin('route', 'prescription_details.routes', '=', 'route.id')
          ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
          ->select('diagnoses.name','druglists.drugname','frequency.name as frequency','prescription_details.created_at',
          'route.name as route','prescription_filled_status.start_date','prescription_filled_status.end_date')
        ->where('prescription_details.afya_user_id', '=',$afyauserId)
             ->orWhere('prescription_details.dependant_id', '=',$dependantId)
          ->orderBy('created_at', 'desc')
          ->get();
        ?>

      <h5>Prescription History</h5>
      <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-conditional" >
      <thead>
      <tr>
      <th></th>
      <th>Diagnosis</th>
      <th>Drug Name</th>
      <th>Start Date</th>
      <th>Stop Date</th>
      <th>Frequeny</th>
      <th>Route</th>
      </tr>
      </thead>

      <tbody>
      <?php $i =1; ?>

      @foreach($prescriptions as $tstdn)
      <tr>
      <td>{{ +$i }}</td>
      <td>{{$tstdn->name}}</td>
      <td>{{$tstdn->drugname}}</td>
      <td>{{$tstdn->start_date}}</td>
      <td>{{$tstdn->end_date}}</td>
      <td>{{$tstdn->frequency}}</td>
      <td>{{$tstdn->route}}</td>

      </tr>
      <?php $i++; ?>

      @endforeach

      </tbody>
      </table>
      </div>
   </div>





    </div>
  </div><!-- col md 12" -->
</div><!-- emargis" -->
</div>
