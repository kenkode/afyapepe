@extends('layouts.show')
@section('content')
<!--tabs3-->
<?php
      foreach ($patientD as $pdetails) {
        // $patientid = $pdetails->pat_id;
        //  $facilty = $pdetails->FacilityName;
         $stat= $pdetails->status;
         $afyauserId= $pdetails->afya_user_id;
          $dependantId= $pdetails->persontreated;
          $app_id= $pdetails->id;
          $doc_id= $pdetails->doc_id;
          $fac_id= $pdetails->facility_id;
          $dependantAge= $pdetails->depdob;
          $name= $pdetails->firstname;

 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;

 $dependantdays= floor($datediff / (60 * 60 * 24));



}
?>



   <div class="ibox float-e-margins">
     <div class="ibox-title">
       <?php if ($dependantId =='Self') { ?>
      <h5>{{$pdetails->firstname}} {{$pdetails->secondName}}</h5>
         <div class="ibox-tools">
           <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
         </div>

    <?php     }else{ if($dependantdays <='28') { ?>
       <h5>{{$pdetails->dep1name}} {{$pdetails->dep2name}}</h5>
      <div class="ibox-tools">
        <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
      </div>
      <?php  }   } ?>
       </div>
       <div class="col-lg-12">
           <div class="tabs-container">
     <ul class="nav nav-tabs">
       <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
       <li  class="active"><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
         <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
          <?php if ($stat==2) { ?>
         <li class=""><a href="{{route('admit',$app_id)}}">Admit</a></li>
         <?php } ?>
          <?php if ($stat==4) { ?>
         <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
          <?php } ?>
           <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
     <?php if ($stat==2) { ?>
         <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
     <?php } ?>
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

                                                  <div class="col-lg-12">
                                                    <div class="ibox float-e-margins">
                                                      <div class="ibox-content col-md-12">
                                                      <div class="ibox-title">
                                                          <h5>Prescription History</h5>
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
                                       </div>
                                  </div>
                                </div>

      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
