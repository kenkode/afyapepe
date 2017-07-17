@extends('layouts.show')
@section('content')
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

   $stat= $pdetails->status;
   $afyauserId= $pdetails->afya_user_id;
    $dependantId= $pdetails->persontreated;
    $app_id_prev= $pdetails->last_app_id;
    $app_id =  $pdetails->id;
    $doc_id= $pdetails->doc_id;
    $fac_id= $pdetails->facility_id;
    $fac_setup = $pdetails->set_up;
    $condition = $pdetails->condition;
    $dependantAge = $pdetails->depdob;

if($app_id_prev){ $app_id2 = $app_id_prev;}else{$app_id2 = $app_id;}

if ($dependantId =='Self') {
      $dob=$pdetails->dob;
      $gender=$pdetails->gender;
    $firstName = $pdetails->firstname;
    $secondName = $pdetails->secondName;
    $name =$firstName." ".$secondName;
}

else {
     $dob = $pdetails->depdob;
     $gender=$pdetails->depgender;
     $firstName = $pdetails->dep1name;
     $secondName = $pdetails->dep2name;
     $name =$firstName." ".$secondName;
}
$now = time(); // or your date as well
$your_date = strtotime($dependantAge);
$datediff = $now - $your_date;
$dependantdays= floor($datediff / (60 * 60 * 24));
$interval = date_diff(date_create(), date_create($dob));
$age= $interval->format(" %Y Year, %M Months, %d Days Old");
}
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
if ($gender ==1){ $gender = 'Male';}else{ $gender = 'Female';}

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
                 <li><a role="button" href="{{route('transfering',$app_id)}}">Referral</a></li>
                <li><a role="button" href="{{route('endvisit',$app_id)}}">End Visit</a></li>
              </ul>
          </div>
     </nav>
  </div>
   <div class="row wrapper border-bottom white-bg page-heading">
     <div class="ibox float-e-margins">
          <div class="col-lg-12">
              <div class="tabs-container">

<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
              <!-- <div class="col-lg-6">
              <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-1"><i class="fa fa-database"></i> TEST RESULT</a>
              </div> -->
              <div class="col-lg-3">
              <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-2"><i class="fa fa-flask"></i> POSITIVE RESULT </a>
              </div>
              <div class="col-lg-3">
          {{ Form::open(array('route' => array('Testconfirms'),'method'=>'POST')) }}
              <input type="hidden" name="appid" value="{{$app_id}}" class="form-control" >
              <input type="hidden" name="ptdid" value="{{$patientT->ptdid}}" class="form-control" >
          <button class="btn btn-primary btn-lg btn-block" type="submit" ><i class="fa fa-flask"></i> NEGATIVE RESULT</button>
          {{ Form::close() }}
             </div>

              </ul>
              <?php $i=1; $fhDeta=DB::table('patient_test_details')
                 ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
                 ->select('tests.name','appointment_id')
                 ->where('patient_test_details.id', '=',$patientT->ptdid)
                 ->first(); ?>

  <h3 class="text-center">@if($fhDeta->name){{$fhDeta->name}}@else Test @endif Report</h3>
              <div class="tab-content">
                <?php $i=1; $fhb=DB::table('test_ranges')
                ->leftJoin('test_results', 'test_ranges.id', '=', 'test_results.test_ranges_id')
                ->leftJoin('tests', 'test_ranges.tests_id', '=', 'tests.id')
                ->select('test_results.*','test_results.value','tests.name')
                ->where('test_results.ptd_id', '=',$patientT->ptdid)
                ->first(); ?>
                @if($fhb)
  <!--test with Testranges------------------------------------------------------------------>
<div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                      <div class="col-lg-8 b-r">
                      <div class="ibox float-e-margins">

  <h5>@if($fhDeta->name){{$fhDeta->name}} Test @else {{$patientT->name}}@endif</h5>
                  <div class="ibox-content">
                      <table class="table table-bordered">
                      <thead>
                      <tr>
                      <th>#</th>
                      <th>TEST</th>
                      <th>VALUE</th>
                      <th>UNITS</th>
                      @if($gender == 'Male')
                      <th>NORMAL MALE</th>
                      @else
                      <th>NORMAL FEMALE</th>
                      @endif
                        <th>COMMENTS</th>
                        <th>NOTES</th>
                        <th>REASON</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; $fh=DB::table('test_results')
                       ->leftJoin('test_ranges', 'test_results.test_ranges_id', '=', 'test_ranges.id')
                        ->leftJoin('tests', 'test_ranges.tests_id', '=', 'tests.id')
                        ->select('test_results.value','test_results.appointment_id','test_results.units as runit','test_results.result_name as rname',
                        'test_results.comments as rcoment','test_results.notes as rnote','test_results.reason as rreason',
                        'tests.name as tname','test_ranges.*')
                        ->where([['test_results.ptd_id', '=',$patientT->ptdid],
                                 ['test_results.appointment_id','=', $fhDeta->appointment_id], ])
                        ->get(); ?>
                      @foreach($fh as $fhtest)
                      <tr>
                      <td>{{$i}}</td>
                      <td>@if($fhtest->tname){{$fhtest->tname}}@else{{$fhtest->rname}}@endif</td>
                      <td>{{$fhtest->value}}</td>
                      <td>@if($fhtest->runit){{$fhtest->runit}}@else{{$fhtest->units}} @endif</td>
                      @if($gender == 'Male')
                      <td>{{$fhtest->low_male}} - {{$fhtest->high_male}}</td>
                       @else
                      <td>{{$fhtest->low_female}} - {{$fhtest->high_female}}</td>
                       @endif
                       <td>{{$fhtest->rcoment}}</td>
                       <td>{{$fhtest->rnote}}</td>
                       <td>{{$fhtest->rreason}}</td>
                      <?php $i ++ ?>
                      </tr>
                      @endforeach

                      </tbody>
                      </table>
                      </div>
                      </div>


                   </div>
   <?php $i=1; $fhcommr = DB::table('patient_test_details')
                           ->where('id', '=',$patientT->ptdid)
                           ->first(); ?>
                         @if (is_null($fhcommr))
                         @else
       <div class="col-lg-4 ">
             <div class="ibox float-e-margins">
               <h5>Results</h5>
               <div class="ibox-content">
                   <div class="form-group"><label>Comment</label>
                       <textarea class="form-control" rows="2" cols="20" readonly=""> <?php echo $fhcommr->results; ?> </textarea>
                  </div>
                   <div class="form-group"><label>Other Information</label>
                       <textarea class="form-control" rows="2" cols="20" readonly> <?php echo $fhcommr->note; ?> </textarea>
                   </div>
               </div>
             </div>
         </div>
         @endif

      </div>
 </div>
 @else
 <!--test without Testranges------------------------------------------------------------------>
 <div id="tab-1" class="tab-pane active">
     <div class="panel-body">
       <div class="col-lg-8 b-r">
       <div class="ibox float-e-margins">
       <h5>@if($fhDeta->name){{$fhDeta->name}} Test @else {{$patientT->name}}@endif</h5>
       <div class="ibox-content">
       <table class="table table-bordered">
         <?php $i=1; $fh=DB::table('test_results')
        ->leftJoin('tests', 'test_results.tests_id', '=', 'tests.id')
         ->select('test_results.*','test_results.value','tests.name')
         ->where([['test_results.ptd_id', '=',$patientT->ptdid],
                  ['test_results.appointment_id','=', $fhDeta->appointment_id], ])
         ->get(); ?>
       <thead>
       <tr>
       <th>#</th>
       <th>TEST</th>
       <th>VALUE</th>
       <th>UNITS</th>
       <th>COMMENTS</th>
       <th>NOTES</th>
       <th>REASON</th>
       </tr>
       </thead>
       <tbody>

       @foreach($fh as $fhtest)
       <tr>
       <td>{{$i}}</td>
       <td>@if($fhtest->name){{$fhtest->name}}@else {{$fhtest->result_name}} @endif</td>
       <td>{{$fhtest->value}}</td>
       <td>{{$fhtest->units}}</td>
       <td>{{$fhtest->comments}}</td>
       <td>{{$fhtest->notes}}</td>
       <td>{{$fhtest->reason}}</td>

       <?php $i ++ ?>
       </tr>
       @endforeach

       </tbody>
       </table>
       </div>
       </div>


    </div>
<?php $i=1; $fhcommr = DB::table('patient_test_details')
            ->where('id', '=',$patientT->ptdid)
            ->first(); ?>
          @if (is_null($fhcommr))
          @else
<div class="col-lg-4">
<div class="ibox float-e-margins">
<h5>Results</h5>
<div class="ibox-content">
    <div class="form-group"><label>Comment</label>
        <textarea class="form-control" rows="2" cols="20" readonly=""> <?php echo $fhcommr->results; ?> </textarea>
   </div>
    <div class="form-group"><label>Other Information</label>
        <textarea class="form-control" rows="2" cols="20" readonly> <?php echo $fhcommr->note; ?> </textarea>
    </div>
</div>
</div>
</div>
@endif

</div>
</div>
 @endif
  <div id="tab-2" class="tab-pane">
                   <div class="panel-body">
                     <div class="ibox-content col-md-12" id="Tconfirm2">
                         {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

                       <div class="col-md-6 b-r">
                             <div class="form-group"><label>Disease Name</label>
                             <input type="text"  value="{{ $patientT->name }}" class="form-control" >
                             </div>
                             <div class="form-group">
                             <input type="hidden" name="disease" value="{{$patientT->id}}" class="form-control" >
                             <input type="hidden" name="ptdid" value="{{$patientT->ptdid}}" class="form-control" >
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

        </div><!-- tabs-container -->
      </div><!-- col md 12" -->
   </div><!-- emargis" -->
</div>
@endsection
