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

?>

<?php
foreach ($patientdetails as $pdetails) {
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

    //$name= $pdetails->firstname;

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

else {
     $dob=$dependantAge;
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
                  <h2>{{$name }}</h2>
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
              <li class="active"><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
              <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
              <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
              <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
              <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
              @if ($condition =='Admitted')
                      <li><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
               @else  <li><a href="{{route('admit',$app_id)}}">Admit</a></li>@endif
                <li ><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
               <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>

              </ul>
              <!-- </div> -->
                <div class="tab-content">
                  <!--tabs1-->
                  <div id="tab-1" class="tab-pane active">
                    <?php if ($pdetails->persontreated=='Self') {
                    ?>
                          @include('doctor.triage')
                    <?php }
                    elseif ($dependantdays <='28') {
                      ?>
               @include('doctor.triage28')

                     <?php } elseif ($dependantdays <='413') {
                       ?>
                @include('doctor.triage59')

                <?php } else  {
                  ?>
                @include('doctor.triage')

                      <?php } ?>


                   </div><!--tabs1-->









              </div><!--tabcontent-->
          </div><!--tabs-container-->
        </div><!--col12-->
        <!--tabs-->
