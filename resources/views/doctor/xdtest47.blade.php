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
        //  $name= $pdetails->firstname;
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
                  <li class="active"><a role="button" href="{{route('testes',$app_id)}}">Tests</a></li>
                  <li><a role="button" href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
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
 <!--..........Patient allergy and chronic Diseases....................-->
       @include('doctor.allergy')
 <!--...........Patient allergy and chronic Diseases ........................-->
<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
   <div class="col-lg-6">
  <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-1"><i class="fa fa-database"></i> TEST HISTORY</a>
     </div>
    <div class="col-lg-6">
    <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-2"><i class="fa fa-flask"></i> ADD TEST</a>
    </div>
   </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                      <!--Test result tabs PatientController@testdone-->
                  <?php $i =1;

                         $tstdone = DB::table('patient_test')
                       ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
                        ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.FacilityCode')
                        ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
                        ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
                        ->select('patient_test_details.id as ptdid','patient_test_details.*','facilities.*','lab_test.name','diagnoses.name as diagnoses')
                        ->where('patient_test.appointment_id', '=',$app_id)
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
                    </tr>
                      </thead>

                      <tbody>

                      @foreach($tstdone as $tstdn)
                  <?php    $ptdid =$tstdn->ptdid; ?>
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
                         @if($tstdn->confirm =='Y')
                         <td>{{$tstdn->note}}</td>
                         @else
                         <td>
                           {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
                             {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                             {{ Form::hidden('pat_details_id',$ptdid, array('class' => 'form-control')) }}
                             <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
                            {{ Form::close() }}
                         </td>
                          @endif

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

                      {{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
                      <div class="col-sm-6 b-r ibox float-e-margins ">
                      <?php  if ($dependantdays <='28') {
                      ?>
                      <div class="form-group">
                      <label for="tag_list" class="">Conditional Diagnosis:</label>
                      <select class="test-multiple" name="mainconditional"  style="width: 100%">
                      <?php $diagnoses=DB::table('diagnoses')->where(function($query)
                      { $query->where('target', '=','28 ')
                      ->orWhere('target', '=','28-29');  })
                      ->get(); ?>
                      @foreach($diagnoses as $diag)<option value='{{$diag->id}}'>{{$diag->name}}</option>
                      @endforeach </select>
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
                      <div class="form-group">
                      <label  class="col-md-6">Facility:</label>
                      <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
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
                      <div id="othertest" class="ibox float-e-margins">

                      <label class="col-md-2">Test Categories:</label>
                      <input type="checkbox" name="colorCheckbox" value="MRI">MRI
                      <input type="checkbox" name="colorCheckbox" value="Lab"> Laboratory
                      <input type="checkbox" name="colorCheckbox" value="Neurology"> Neurology
                      <input type="checkbox" name="colorCheckbox" value="Gestrointestinal"> Gestrointestinal

                      <div class="MRI box"> MRI TESTS COMING SOON</div>
                      <!-- Laboratory Tests starts}} -->

                      <div class="Lab box">
                      <div class="col-lg-6 b-r">
                      <div class="form-group">
                      <label>Biochemistry Test:</label>
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

                      <div class="col-lg-6">
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



                      </div>
                      <!-- Laboratory Tests Ends}} -->
                      <div class="Neurology box">Neurology TESTS COMING SOON</div>
                      <div class="Gestrointestinal box">Gestrointestinal TESTS COMING SOON</div>


                      </div>
                      </div>

                      </div>
                      {{ Form::hidden('afya_user_id',$afyauserId, array('class' => 'form-control')) }}
                      {{ Form::hidden('dependant_id',$dependantId, array('class' => 'form-control')) }}

                      {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                      {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
                      {{ Form::hidden('facility_from',$fac_id, array('class' => 'form-control')) }}

                      <div class="">
                      <button class=" mtop btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>Submit</strong></button>
                      </div>
                      {{ Form::close() }}
                    </div>
                </div>
            </div>


        </div>
    </div>
  </div>
</div>

      </div><!-- col md 12" -->
   </div><!-- emargis" -->
   </div>