@extends('layouts.show')
@section('title', 'Test')
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
          $fac_setup= $pdetails->set_up;
          $dependantAge = $pdetails->depdob;
          $AfyaUserAge = $pdetails->dob;
          $condition = $pdetails->condition;

if($app_id_prev){ $app_id2 = $app_id_prev;}else{$app_id2 = $app_id;}
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
          $lmp = $pdetails->almp;
          $pregnant = $pdetails->apregnant;
   }

 else {    $dob=$dependantAge;
           $gender=$pdetails->depgender;
           $firstName = $pdetails->dep1name;
           $secondName = $pdetails->dep2name;
           $name =$firstName." ".$secondName;
           $lmp = $pdetails->dlmp;
           $pregnant = $pdetails->dpregnant;
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
elseif ($stat == 7) {
  $appStatue='Waiting Test Result';
}
}
?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
            <h2>{{$name}}</h2>
            <ol class="breadcrumb">
            <li><a>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></li>
            <li><a>{{$age}}</a> </li>
            @if($gender !=1)
            <li><a>LMP /{{$lmp}}</a> </li>
            <li><a>Pregnant /{{$pregnant}}</a></li>
            @endif
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
                    <li><a role="button" href="{{route('transfering',$app_id)}}">Referral</a></li>
                   <li><a role="button" href="{{route('endvisit',$app_id)}}">End Visit</a></li>
                 </ul>
             </div>
        </nav>
     </div>

          <div class="row wrapper border-bottom  page-heading">
             <div class="float-e-margins">
               <div class="col-lg-12">
<div class="row">
     <div class="col-lg-7">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>{{$tsts1->category}} Test Report</h5>
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
                      <div class="list-group">
                        <h2>{{$tsts1->tstname}} -{{$tsts1->target}}</h2>
                          <a class="list-group-item">
                              <h3 class="list-group-item-heading">CLINICAL INFORMATION : </h3>

                              <p class="list-group-item-text">{{$tsts1->clinicalinfo}} </p>
                          </a>

                          <a class="list-group-item" href="#">
                              <h3 class="list-group-item-heading">TECHNIQUE :</h3>
                              <p class="list-group-item-text">{{$tsts1->technique}}</p>
                          </a>
                          <?php
                        $freport = DB::table('xray_findings')
                        ->leftJoin('radiology_test_result', 'xray_findings.id', '=', 'radiology_test_result.findings_id')
                          ->where('xray_findings.xray_id', '=',$tsts1->xrayid)
                          ->select('radiology_test_result.results','xray_findings.findings')
                          ->get();
                            ?>
                          <a class="list-group-item" href="#">
                              <h3 class="list-group-item-heading">FINDINGS :</h3>
                              @foreach($freport as $frpt)
                             <p class="list-group-item-text"><label>{{$frpt->findings}} :</label>&nbsp;&nbsp;{{$frpt->results}}</p>
                                     @endforeach
                          </a>


                          <a class="list-group-item" href="#">
                              <h3 class="list-group-item-heading">IMPRESSION : </h3>
                            <p class="list-group-item-text">{{$tsts1->conclusion}}</p>

                          </a>
                          <a class="list-group-item" href="#">
                              <h3 class="list-group-item-heading">DONE BY : </h3>
                            <p class="list-group-item-text"><strong>DR.</strong> {{$tsts1->firstname}} {{$tsts1->secondname}}</p>
                            <p class="list-group-item-text"><strong>RADIOLOGIST</strong></p>
                            <p class="list-group-item-text"><strong>FACILITY: </strong> {{$tsts1->FacilityName}}</p>
                          </a>

                  </div>
              </div>
          </div>
        </div>

<div class="col-lg-4">
          <div class="ibox float-e-margins">
              <div class="ibox-title">
                  <h5>{{$tsts1->category}} Test Report</h5>
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
                  <div class="list-group">
                    <h2>{{$tsts1->tstname}} -{{$tsts1->target}} Images</h2>
                    <?php $images=DB::table('radiology_images')->where('radiology_td_id',$tsts1->rtdid)->get(); ?>


                       @foreach($images as $image)
                      <a class="list-group-item" href="{{ asset("images/$image->image") }} "target="_blank">
                          <h3 class="list-group-item-heading">View Image</h3>

                      </a>
                       @endforeach


              </div>
          </div>
      </div>
    </div>




  </div><!-- row -->







      </div><!-- col md 12" -->
   </div><!-- emargis" -->
  </div>

@endsection
