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
       <li><a  href="{{route('showPatient',$app_id)}}">Home</a></li>
         <li><a data-toggle="tab" href="#tab-1">Today's Triage</button></a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li class="active"><a href="{{route('testes',$app_id)}}">Tests</a></li>
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
        ->leftJoin('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
        ->leftJoin('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
        ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
        ->where('appointments.persontreated', '=',$dependantId)
        ->orderBy('created_at', 'desc')
        ->get();

     }if ($dependantId =='Self') {
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
     <button id="addtestes" class="btn btn-primary btn-block btn-outline">Add Test</button>

<div id="divtest" class="divtest">

{{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
<!-- {{ Form::open(array('id' => 'ptest')) }} -->

  <div class="col-sm-6 b-r ibox float-e-margins ibox-content">
  <?php  if ($dependantdays <='28') {
      ?>
    <div class="form-group">
        <label for="tag_list" class="">Conditional Diagnosis:</label>
             <select class="test-multiple" name="mainconditional"  style="width: 100%">
               <?php $diagnoses=DB::table('diagnoses')->where(function($query)
        {
            $query->where('target', '=','28 ')
                  ->orWhere('target', '=','28-29');
        })
        ->get();
          ?>
               @foreach($diagnoses as $diag)
                      <option value='{{$diag->id}}'>{{$diag->name}}</option>
               @endforeach
               </select>
         </div>
         <?php } if ($dependantdays >='28') { ?>
         <div class="form-group">
             <label for="tag_list" class="">Conditional Diagnosis:</label>
                  <select class="test-multiple" name="mainconditional"  style="width: 100%">
                    <?php $diagnoses=DB::table('diagnoses')->where(function($query)
             {
                 $query->where('target', '=','29 ')
                       ->orWhere('target', '=','28-29');
             })
             ->get();
               ?>
                    @foreach($diagnoses as $diag)
                           <option value='{{$diag->id}}'>{{$diag->name}}</option>
                    @endforeach
                    </select>
              </div>
               <?php }  ?>
<div class="form-group ">
    <label for="d_list2"> Other Conditional Diagnosis:</label>
    <select id="d_list2" name="conditional" class="d_list2 form-control" style="width: 100%"></select>
</div>


          <div class="col-sm-6 b-r">
          <div class="form-group">
              <label for="tag_list" class="">Malaria Test:</label>
                   <select class="test-multiple" name="malaria2[]" multiple="multiple" style="width: 100%">
                     <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Malaria')->distinct()->get(['id','name']); ?>
                     @foreach($biotests as $biotest)
                            <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                     @endforeach
                     </select>
               </div>
               <div class="form-group">
                   <label for="tag_list" class="">Haematology Test:</label>
                        <select class="test-multiple" name="haematology2[]" multiple="multiple" style="width: 100%">
                          <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Haematology')->distinct()->get(['id','name']); ?>
                          @foreach($biotests as $biotest)
                                 <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                          @endforeach
                          </select>
                    </div>
                    <div class="form-group">
                        <label for="tag_list" class="">Chemistry Test:</label>
                             <select class="test-multiple" name="chemistry2[]" multiple="multiple" style="width: 100%">
                               <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Chemistry')->distinct()->get(['id','name']); ?>
                               @foreach($biotests as $biotest)
                                      <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                               @endforeach
                               </select>
                         </div>
                         <div class="form-group">
                             <label for="tag_list" class="">HIV Test:</label>
                                  <select class="test-multiple" name="hiv2[]" multiple="multiple" style="width: 100%">
                                    <?php $biotests=DB::table('lab_test')->where('sub_category', '=','HIV')->distinct()->get(['id','name']); ?>
                                    @foreach($biotests as $biotest)
                                           <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                    @endforeach
                                    </select>
                              </div>
                              <div class="form-group">
                                  <label for="tag_list" class="">TB Test:</label>
                                       <select class="test-multiple" name="tb2[]" multiple="multiple" style="width: 100%">
                                         <?php $biotests=DB::table('lab_test')->where('sub_category', '=','TB')->distinct()->get(['id','name']); ?>
                                         @foreach($biotests as $biotest)
                                                <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                         @endforeach
                                         </select>
                                   </div>
             </div>
        <div class="col-sm-6 ">
               <div class="form-group">
                   <label for="tag_list" class="">Glucose Test:</label>
                        <select class="test-multiple" name="glucose2[]" multiple="multiple" style="width: 100%">
                          <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Glucose')->distinct()->get(['id','name']); ?>
                          @foreach($biotests as $biotest)
                                 <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                          @endforeach
                          </select>
                    </div>
                   <div class="form-group">
                        <label for="tag_list" class="">X-RAY Test:</label>
                             <select class="test-multiple" name="xray2[]" multiple="multiple" style="width: 100%">
                               <?php $biotests=DB::table('lab_test')->where('sub_category', '=','X-ray')->distinct()->get(['id','name']); ?>
                               @foreach($biotests as $biotest)
                                      <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                               @endforeach
                               </select>
                         </div>
                         <div class="form-group">
                              <label for="tag_list" class="">Microbiology Test:</label>
                                   <select class="test-multiple" name="mcrobiology2[]" multiple="multiple" style="width: 100%">
                                     <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Microbiology')->distinct()->get(['id','name']); ?>
                                     @foreach($biotests as $biotest)
                                            <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                     @endforeach
                                     </select>
                               </div>
                               <div class="form-group">
                                    <label for="tag_list" class="">Urine Test:</label>
                                         <select class="test-multiple" name="urine2[]" multiple="multiple" style="width: 100%">
                                           <?php $biotests=DB::table('lab_test')->where('sub_category', '=','Urine')->distinct()->get(['id','name']); ?>
                                           @foreach($biotests as $biotest)
                                                  <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                           @endforeach
                                           </select>
                                     </div>
                               <div id="buttonsDiv">
                                    <input type="button" id="button2" class="btn btn-w-m btn-warning" value="Other Tests"></input>
                                 </div>

    </div>
    <div class="form-group ">
        <label for="d_list2">Doctor Note(For test):</label>
      <textarea rows="4" name="docnote" cols="50" class="form-control"></textarea>
    </div>
  </div>



                   <div id="div1">
                     <div class="col-sm-6">
                      <div id="othertest" class="ibox float-e-margins ibox-content">
                    <div class="form-group ">
                         <label class="col-md-4">Test Categories:</label>
                         <input type="checkbox" name="colorCheckbox" value="MRI">MRI
                         <input type="checkbox" name="colorCheckbox" value="Lab"> Laboratory
                         <br />
                         <input type="checkbox" name="colorCheckbox" value="Neurology"> Neurology
                          <input type="checkbox" name="colorCheckbox" value="Gestrointestinal"> Gestrointestinal
                     </div>


                      <div class="MRI box">MRI TESTS COMING SOON</div>
                      <!-- Laboratory Tests starts}} -->
                     <div class="Lab">

                      <div class="col-sm-6 b-r box">
                          <div class="form-group">
                             <label>Biochestry Test:</label>
                                  <select class="test-multiple" name="biotests[]" multiple="multiple" style="width: 100%">
                                    <?php $biotests=DB::table('lab_test')->where('category', '=','Biochemistry')->distinct()->get(['id','name']); ?>
                                    @foreach($biotests as $biotest)
                                           <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
                                    @endforeach
                                    </select>
                              </div>
                              <div class="form-group">
                                  <label>Coagulation  Test:</label>
                                       <select class="test-multiple" name="coagtests[]" multiple="multiple" style="width: 100%">
                                         <?php $coagtests=DB::table('lab_test')->where('category', '=','Coagulation')->distinct()->get(['id','name']); ?>
                                         @foreach($coagtests as $coagtest)
                                                <option value='{{$coagtest->id}}'>{{$coagtest->name}}</option>
                                         @endforeach
                                         </select>
                                   </div>
                                   <div class="form-group">
                                       <label>Haematology Test:</label>
                                            <select class="test-multiple" name="haemtests[]" multiple="multiple" style="width: 100%">
                                              <?php $haemtests=DB::table('lab_test')->where('category', '=','Haematology')->distinct()->get(['id','name']); ?>
                                              @foreach($haemtests as $haemtest)
                                                     <option value='{{$haemtest->id}}'>{{$haemtest->name}}</option>
                                              @endforeach
                                              </select>
                                        </div>

                            </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Immunology Infective Test:</label>
                                 <select class="test-multiple" name="inftests[]" multiple="multiple" style="width: 100%">
                                   <?php $imitests=DB::table('lab_test')->where('category', '=','Immunology_Infective')->distinct()->get(['id','name']); ?>
                                   @foreach($imitests as $imitest)
                                          <option value='{{$imitest->id}}'>{{$imitest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>

                        <div class="form-group">
                            <label>Immunology Auto Immune Test:</label>
                                 <select class="test-multiple" name="autotests[]" multiple="multiple" style="width: 100%">
                                   <?php $imatests=DB::table('lab_test')->where('category', '=','Immunology-Auto-Immune')->distinct()->get(['id','name']); ?>
                                   @foreach($imatests as $imatest)
                                          <option value='{{$imatest->id}}'>{{$imatest->name}}</option>
                                   @endforeach
                                   </select>
                             </div>
                    <div class="form-group">
                            <label>Microbiologye  Test:</label>
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

{{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}

<?php if ($pdetails->persontreated=='Self') { ?>

  <div class="col-sm-6">
      <label>Patient Allergy To:</label>
      <?php $allergy=DB::table('afya_users_allergy')
      ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
      ->where('afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>

      @foreach($allergy as $micrtest)
           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
      @endforeach

      <label>Patient Chronic Disease:</label>
      <?php $chronic=DB::table('appointments')
      ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
      ->Join('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
      ->where('appointments.afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>


      @foreach($chronic as $micrtest)
           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
      @endforeach

  </div>
<?php }
else { ?>



  <div class="col-sm-6">
      <label>Patient Allergy To:</label>
      <?php $allergy=DB::table('afya_users_allergy')
      ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
      ->where('dependant_id', '=',$dependantId)->distinct()->get(['name']); ?>

      @foreach($allergy as $micrtest)
           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
      @endforeach

      <label>Patient Chronic Disease:</label>
      <?php $allergy=DB::table('appointments')
        ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
      ->Join('diagnoses', 'patient_diagnosis.disease_id',  '=', 'diagnoses.id')
      ->where([ ['appointments.persontreated', '=',$dependantId],['patient_diagnosis.chronic', '=','Y'],])->distinct()->get(['name']); ?>

      @foreach($allergy as $micrtest)
           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
      @endforeach

  </div>
<?php } ?>

<div class="">
  <button class=" mtop btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>Submit</strong></button>

</div>


{{ Form::close() }}

</div><!-- testes -->
</div>
      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
