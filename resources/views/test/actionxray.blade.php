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
$facilityId = $DataTests->FacilityCode;

}


	$dependantId = $tsts1->persontreated;
	$afyauserId = $tsts1->afya_user_id;
	$appId = $tsts1->appointment_id;
	$ptdId = $tsts1->id;

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
          <div class="col-lg-6 ">
					<h2>Name: {{$name}}</h2>
					<ol class="breadcrumb">
					<li><a>Gender {{$gender}}</a></li>
					<li><a>Age {{$age}}</a> </li>

					</ol>
					</div>
					<div class="col-lg-5 ">
					<h2 class="">LAB: {{$facility}}</h2>
					<ol class="breadcrumb">
					<li class="active">Name: {{$tsts1->docname}}</li>
					</ol>
					</div>
			</div>
			</div>
		</div>
	</div>
	<div class="row wrapper border-bottom white-bg">
	<div class="content-page  equal-height">
		<div class="content">
			<div class="container">
				<div class="col-lg-10">
			<h3 class="text-center">{{$tsts1->category}} TESTS</h3>

				 </div>
       </div>
		</div>
  </div>
</div>
<div class="row wrapper border-bottom page-heading">
  <div class="content-page  equal-height">
		<div class="content">

			<div class="col-lg-7">
		<div class="ibox float-e-margins">
				<div class="ibox-title">
						 <h5>{{$tsts1->category}} Test Request</h5>
				</div>
				<div class="ibox-content">
						<div class="row">

									<form role="form">
												<div class="form-group"><label>Test</label> <input type="text" value="{{$tsts1->tstname}} -{{$tsts1->target}}" class="form-control" readonly=""></div>
												<div class="form-group"><label>Clinical Information</label> <textarea rows="4" cols="60" readonly=""> {{$tsts1->clinicalinfo}}</textarea></div>

                 </form>


						</div>
				</div>
		</div>
</div>

<div class="col-lg-5">
		<div class="ibox float-e-margins">
				<div class="ibox-title">
						<h5>UPLOAD FILE:</h5>

				</div>
				<div class="ibox-content">
						<div class="row">

										<p>Please upload only images with relevant Information.</p>
										@if (count($errors) > 0)
										<div class="alert alert-danger">
										     <strong>Whoops!</strong> There were some problems with your input.<br><br>
										<ul>
										@foreach ($errors->all() as $error)
										        <li>{{ $error }}</li>
										      @endforeach
										  </ul>
										</div>
										@endif
										{!! Form::open(array('url' => 'fileUpload','files'=>true)) !!}
												<div class="form-group"><label>Choose file:</label><input type="file" name="image[]" multiple="multiple" class="form-control"></div>
												<div class="form-group"><input type="hidden" name="radiology_td_id" value="{{$tsts1->rtdid}}"></div>
                        <div class="form-group"><input type="hidden" name="patient_test_id" value="{{$tsts1->ptId}}"></div>
												<div class="form-group"><input type="hidden" name="user_id" value="{{Auth::user()->id}}"></div>

												<div>
														<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>

												</div>
										{!! Form::close() !!}
						</div>
				</div>
		</div>
</div>



		</div><!--content-->
  </div><!--content page-->
</div>
@endsection
