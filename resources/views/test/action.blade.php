@extends('layouts.test')
@section('title', 'Tests')
@section('content')
<?php
$test = (new \App\Http\Controllers\TestController);
$testdet = $test->TDetails();
foreach($testdet as $DataTests){
$facility = $DataTests->FacilityName;
$firstname = $DataTests->firstname;
$secondName = $DataTests->secondname;
$TName = $firstname.' '.$secondName;

}

foreach($tsts1 as $pdetails){
	$dependantId = $pdetails->dependant_id;
	$afyauserId = $pdetails->afya_user_id;
	$appId = $pdetails->appointment_id;
}
 if ($dependantId =='Self')   {
	 $afyadetails = DB::table('appointments')
	 ->leftJoin('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
	 ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
	 ->select('triage_details.*','afya_users.*')
	 ->where('appointments.id', '=',$appId)
	 ->first();

	 $dob=$afyadetails->dob;
	 $gender=$afyadetails->gender;
	 $firstName = $afyadetails->firstname;
	 $secondName = $afyadetails->secondName;
	 $name =$firstName." ".$secondName;
}else{
	$deppdetails = DB::table('appointments')
	->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
	->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
	->select('triage_infants.*','dependant.*')
	->where('appointments.id', '=',$appId)
	->first();

	          $dob=$deppdetails->dob;
            $gender=$deppdetails->gender;
            $firstName = $deppdetails->firstName;
            $secondName = $deppdetails->secondName;
            $name =$firstName." ".$secondName;
}
$interval = date_diff(date_create(), date_create($dob));
$age= $interval->format(" %Y Year, %M Months, %d Days Old");
if ($gender == 1) { $gender = 'Male'; }else{ $gender = 'Female'; }

?>

<div class="row wrapper border-bottom white-bg page-heading">
<div class="content-page  equal-height">
		<div class="content">
				<div class="container">

					<div class="col-lg-6">
					<h2>Name {{$name}}</h2>
					<ol class="breadcrumb">
					<li><a>Gender {{$gender}}</a></li>
					<li><a>Age {{$age}}</a> </li>

					</ol>
					</div>
					<div class="col-lg-6">
					<h2>Test Center: {{$facility}}</h2>
					<ol class="breadcrumb">
					<li class="active"><strong>Name: {{$TName}} </strong></li>
					</ol>
					</div>
				</div>
			</div>
		</div>


  <div class="ibox float-e-margins">
     <div class="col-lg-12">
       <div class="tabs-container">
				 @foreach($tsts1 as $results1)
							<input type="text" value="{{$results1->name}}" class="form-control" readonly="readonly">
				 @endforeach
@if($results1->name =='Full haemoglobin')
  @include('test.fheamoglobin')
@else @endif

@include('includes.default.footer')
        </div>
      </div>
		</div><!--content-->
	</div><!--content page-->

@endsection
