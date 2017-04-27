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
        <a class="collapse-link">{{FacilityName}}  </a>
      </div>
      <?php  }   } ?>
       </div>
   <div class="ibox-content col-md-12">
     <ul class="nav nav-tabs">

         <li><a  href="{{route('showPatient',$app_id)}}">Home</a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li class="active"><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
  <li class=""><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
         <!-- <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
         <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
         <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
         <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li> -->
     </ul>
     <!--Test result tabs PatientController@testdone-->
     <div id="testR">
     <?php $i =1;

      if ($dependantdays <='28') {
        $tstdone = DB::table('appointments')
            ->leftJoin('patient_test', 'appointments.id', '=', 'patient_test.appointment_id')
        ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
        ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
        ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
        ->leftJoin('patient_cond_diagnosis', 'patient_test.appointment_id', '=', 'patient_cond_diagnosis.appointment_id')
        ->Join('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
        ->Join('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
        ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
        ->where('appointments.persontreated', '=',$dependantId)
        ->orderBy('created_at', 'desc')
        ->get();

     }elseif ($dependantdays >='28') {
       $tstdone = DB::table('appointments')
           ->leftJoin('patient_test', 'appointments.id', '=', 'patient_test.appointment_id')
       ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
       ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
       ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
       ->leftJoin('patient_cond_diagnosis', 'patient_test.appointment_id', '=', 'patient_cond_diagnosis.appointment_id')
       ->Join('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
       ->Join('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
       ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
       ->where('appointments.afya_user_id', '=',$afyauserId)
       ->orderBy('created_at', 'desc')
       ->get();

     }
     ?>

     <div class="table-responsive ibox-content">

     <table class="table table-striped table-bordered table-hover dataTables-conditional" >
        <thead>
     <tr>
      <th></th>
         <th>Date </th>
        <th>Test Name</th>
        <th>Conditional Diagnosis</th>
        <th>Other Diagnosis</th>
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
       <td>{{$tstdn->disease}}</td>
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
     </div> <!-- div id="testR" -->
     <button id="diag" class="btn btn-primary btn-block btn-outline">Confirm Diagnosis</button>

<div id="confdiag" class="divtest">
  {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

<div class="col-sm-6 b-r">

  <?php  if ($dependantdays <='28') { ?>

    <div class="form-group">
        <label for="tag_list" class=""> Diagnosis:</label>
             <select class="test-multiple" name="disease"  style="width: 100%" required="required">
               <?php $diagnoses=DB::table('diagnoses')->where(function($query)
        {
            $query->where('target', '=','28 ')
                  ->orWhere('target', '=','28-29');
        })
        ->get();
          ?><option value=''>Choose one</option>
               @foreach($diagnoses as $diag)
                      <option value='{{$diag->id}}'>{{$diag->name}}</option>
               @endforeach
               </select>
         </div>
         <?php } if ($dependantdays >='28') { ?>
         <div class="form-group">
             <label for="tag_list" class="">Diagnosis:</label>
                  <select class="test-multiple" name="disease"  style="width: 100%" required="required">
                    <?php $diagnoses=DB::table('diagnoses')->where(function($query)
             {
                 $query->where('target', '=','29 ')
                       ->orWhere('target', '=','28-29');
             })
             ->get();
               ?>
                      <option value=''>Choose one</option>
                    @foreach($diagnoses as $diag)
                           <option value='{{$diag->id}}'>{{$diag->name}}</option>
                    @endforeach
                    </select>
              </div>
              <?php }  ?>
              <div class="form-group">
                  <label for="tag_list" class="">Type of Diagnosis:</label>
                       <select class="test-multiple" name="level"  style="width: 100%" required="required">
                         <option value=''>Choose one</option>
                           <option value='Primary'>Primary</option>
                           <option value='Secondary'>Secondary</option>
                         </select>
                     </div>
                   </div>
                   <div class="col-sm-6">
                   <div class="form-group">
                       <label for="tag_list" class="">Chronic:</label>
                            <select class="test-multiple" name="chronic"  style="width: 100%" required="required">
                              <option value=''>Choose one</option>
                                <option value='Y'>YES</option>
                                <option value='N'>No</option>
                              </select>
                        </div>
                   <div class="form-group">
                       <label for="tag_list" class="">Level of Severity:</label>
                            <select class="test-multiple" name="severity"  style="width: 100%" required="required">
                              <?php $severeity=DB::table('severity')->get();
                         ?>
                    <option value=''>Choose one</option>
                              @foreach($severeity as $diag)
              <option value='{{$diag->id}}'>{{$diag->name}}</option>
                              @endforeach
                              </select>
                           </div>
                           {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                        </div>


  <div class="col-lg-offset-5">
    <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>

  </div>


  {{ Form::close() }}

</div><!-- testes -->
      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
