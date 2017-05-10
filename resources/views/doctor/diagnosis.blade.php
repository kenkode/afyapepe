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
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li class="active"><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
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

     <!--Test result tabs PatientController@testdone-->
     <div id="testR">
       <?php $i =1;

       $tstdone = DB::table('patient_test_details')
      ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
      ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
      ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
      ->select('patient_test_details.*','patient_test_details.id as ptdid','facilities.*','lab_test.name','diagnoses.name as diagnoses')
      ->where([
        ['patient_test_details.afya_user_id', '=',$afyauserId],
        ['patient_test_details.confirm', '=','N'],
       ])
          ->orWhere([
            ['patient_test_details.dependant_id', '=',$dependantId],
            ['patient_test_details.confirm', '=','N'],
           ])

       ->orderBy('created_at', 'desc')
       ->get();
       ?>
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


</div><!-- div id="testR" -->
 </div><!-- tabs-container -->
  </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
