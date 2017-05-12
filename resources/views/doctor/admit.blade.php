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
$Duser = $Docdata->user_id;


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
          $dependantAge = $pdetails->depdob;
          $AfyaUserAge = $pdetails->dob;
          $name= $pdetails->firstname;

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
<!--tabs-->
        <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
              <ul class="nav nav-tabs">
                <li><a href="{{route('showPatient',$app_id)}}">Today's Triage</button></a></li>
                  <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
                  <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
                  <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
                  <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
                   <?php if ($stat==2) { ?>
                  <li class="active"><a href="{{route('admit',$app_id)}}">Admit</a></li>
                  <?php } ?>
                   <?php if ($stat==4) { ?>
                  <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
                   <?php } ?>
                    <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
              <?php if ($stat==2) { ?>
                  <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
              <?php } ?>
            </ul>
              <!-- </div> -->
                <div class="tab-content">





  <!--tabs5 Admit-->




                            <div id="admit" class="panel-body">
                                    {{ Form::open(array('route' => array('admitting'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>

                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
                                    </div>
                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Doctor Visit</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',4, array('class' => 'form-control')) }}
                                 {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('docr',$Duser, array('class' => 'form-control')) }}
                                  {{ Form::hidden('afyaUser',$afyauserId, array('class' => 'form-control')) }}
                                  {{ Form::hidden('dependt',$dependantId, array('class' => 'form-control')) }}

                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}
                        </div><!--panel body-->







              </div><!--tabcontent-->
          </div><!--tabs-container-->
        </div><!--col12-->
        <!--tabs-->



@endsection
