<div class ="ibox-content">
<div class="ibox-title">
 <h5>Patient Triage Details</h5>
    <div class="ibox-tools">
      <a class="collapse-link"></a>
    </div>
  </div>
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
   <?php     }else{ if($dependantdays <='28') {

     $i =1;
          $triagedetails= DB::table('appointments')
          ->Join('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
          ->select('triage_infants.*','appointments.created_at as visitDate')
          ->where('appointments.persontreated', '=',$dependantId)
          ->orderBy('visitDate', 'desc')
          ->get();
     ?>
     <div class="ibox-title">
      <h5>Patient Triage Details</h5>
         <div class="ibox-tools">
           <a class="collapse-link"></a>
         </div>
       </div>
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
->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
->select('patient_test_details.*','facilities.*','lab_test.name','diagnoses.name as diagnoses')
->where('patient_test_details.afya_user_id', '=',$afyauserId)
   ->orWhere('patient_test_details.dependant_id', '=',$dependantId)
->orderBy('created_at', 'desc')
->get();

   ?>
   <div class="ibox-title">
    <h5>Patient Test Details</h5>
       <div class="ibox-tools">
         <a class="collapse-link"></a>
       </div>
     </div>
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

<div class="ibox-title">
  <h5>Prescription History</h5>
  </div>
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
