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
foreach ($patientD as $pdetails) {
  // $patientid = $pdetails->pat_id;
  //  $facilty = $pdetails->FacilityName;
   $stat= $pdetails->status;
   $afyauserId= $pdetails->afya_user_id;
    $dependantId= $pdetails->persontreated;
    $app_id= $pdetails->id;
    $doc_id= $pdetails->doc_id;
    $fac_id= $pdetails->facility_id;
    $fac_setup = $pdetails->set_up;
    $condition = $pdetails->condition;
    $dependantAge = $pdetails->depdob;



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


     <ul class="nav nav-tabs">
       <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li class="active"><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
         <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
          <?php if ($stat==2) { ?>
         <li class=""><a href="{{route('admit',$app_id)}}">Admit</a></li>
         <?php } ?>
          <?php if ($condition =='Admitted') { ?>
         <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
          <?php } ?>
           <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
     <?php if ($stat==2) { ?>
         <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
     <?php } ?>
   </ul>
   <div class="row wrapper border-bottom white-bg page-heading">
     <div class="ibox float-e-margins">
          <div class="col-lg-12">
              <div class="tabs-container">
   <div class="row">
  <?php $i=1; $fhDeta=DB::table('patient_test_details')
     ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
     ->select('lab_test.name','lab_test.category')
     ->where('patient_test_details.id', '=',$patientT->ptdid)
     ->first(); ?>

   <h3 class="text-center">{{$fhDeta->category}} Report</h3>
   <div class="col-lg-6 b-r">
   <div class="ibox float-e-margins">
   <h5>{{$fhDeta->name}} Test</h5>
   <div class="ibox-content">
   <table class="table table-bordered">
   <thead>
   <tr>
   <th>#</th>
   <th>TEST</th>
   <th>VALUE</th>
   <th>UNITS</th>
   @if($gender == 'Male')
   <th><button type="button" class="btn btn-primary">NORMAL MALE</button></th>
   <th>NORMAL FEMALE</th>
   @else
   <th>NORMAL MALE</th>
   <th><button type="button" class="btn btn-primary">NORMAL FEMALE</button></th>
   @endif
   </tr>
   </thead>
   <tbody>
     <?php $i=1; $fh=DB::table('test_ranges')
     ->leftJoin('test_results', 'test_ranges.id', '=', 'test_results.test')
     ->select('test_ranges.*','test_results.value')
     ->where('test_results.ptd_id', '=',$patientT->ptdid)
     ->get(); ?>
   @foreach($fh as $fhtest)
   <tr>
   <td>{{$i}}</td>
   <td>{{$fhtest->test}}</td>
   <td>{{$fhtest->value}}</td>
   <td>{{$fhtest->units}}</td>
   <td>{{$fhtest->normal_male}}</td>
   <td>{{$fhtest->normal_female}}</td>
   <?php $i ++ ?>
   </tr>
   @endforeach

   </tbody>
   </table>
   </div>
   </div>
   <?php $i=1; $fh2=DB::table('interpretations')
      ->where('lab_test_id', '=',$patientT->ptdid)->get(); ?>
      @if($fh2)
   <div class="ibox float-e-margins">
   <h5>Interpretations</h5>
   <div class="ibox-content">
   <table class="table table-bordered">
   <thead>
   <tr>
   <th>#</th>
   <th>Units</th>
   <th>Interpretations</th>
   </tr>
   </thead>
   <tbody>

   @foreach($fh2 as $fhtest)
   <tr>
   <td>{{$i}}</td>
   <td>{{$fhtest->ranges}}</td>
   <td>{{$fhtest->status}}</td>
   <?php $i ++ ?>
   </tr>
   @endforeach

   </tbody>
   </table>
   </div>
   </div>
   @endif

</div>

        <?php $i=1; $fhfilmr = DB::table('film_reports')
        ->where('ptd_id', '=',$patientT->ptdid)
        ->get(); ?>
  <?php if($fhfilmr) { ?>


          <div class="col-lg-6 ">
          <div class="ibox float-e-margins">
          <h5>Film Reports</h5>

          <div class="ibox-content">
          @foreach($fhfilmr as $fhfilm)
          <div class="col-lg-6 b-r">
          <div class="form-group"><label>Test</label>
          <input type="text"  value="{{$fhfilm->test}}" class="form-control" >
          </div>
          </div>
          <div class="col-lg-6">
          <div class="form-group"><label>Status</label>
          <input type="text"  value="{{$fhfilm->status}}" class="form-control" >
          </div>
          </div>
          @endforeach
          </div>
           </div>
          </div>
      <?php } ?>






      <?php $i=1; $fhcommr = DB::table('patient_test_details')
        ->where('id', '=',$patientT->ptdid)
        ->first(); ?>
      @if (is_null($fhcommr))
      @else
        <div class="col-lg-6 ">
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

<div class="row">


   <li class="btn btn-primary"><a href="{{route('Testconfirms',$patientT->ptdid)}}">Negative Test</a></li>


    <div id="">
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
    </div>
</div>

          <div class="col-lg-offset-5">
            <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>
     </div>
      {{ Form::close() }}
           </div>





         </div>
        </div><!-- tabs-container -->
      </div><!-- col md 12" -->
   </div><!-- emargis" -->
</div>
@endsection
