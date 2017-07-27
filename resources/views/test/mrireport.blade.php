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
			<h3 class="text-center">{{$tsts1->category}} REPORT</h3>

				 </div>
       </div>
		</div>
  </div>
</div>
<div class="row wrapper border-bottom page-heading">
  <div class="content-page  equal-height">
		<div class="content">



										<div class="col-lg-12">
		                    <div class="ibox float-e-margins">
		                        <div class="ibox-title">
		                            <h5>{{$tsts1->category}} Test Request</h5>
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
		                            <form class="form-horizontal">
																	<div class="form-group">
																		<label class="col-lg-3 control-label"><h2>{{$tsts1->tstname}} -{{$tsts1->target}}</h2></label>
                                  </div>

																		<div class="form-group"><label class="col-lg-2 control-label">Clinical Information</label>
                                         <div class="col-lg-8">
																					  <textarea rows="4" name="comment" cols="50"  class="form-control" readonly="">
																					 {{$tsts1->clinicalinfo}}</textarea>
																				</div>
		                                </div>
																		<div class="form-group"><label class="col-lg-2 control-label">Technique</label>
                                         <div class="col-lg-8">
																					  <textarea rows="4" name="comment" cols="50"  class="form-control">
																					 {{$tsts1->technique}}</textarea>
																				</div>
		                                </div>
																	<div class="form-group">
																		<label class="col-lg-3 control-label"><h2>Findings</h2></label>
                                  </div>
																	<?php
																	$findings = DB::table('mri_findings')
																	->where('mri_tests_id', '=',$tsts1->mriid)
																	->get();
																	?>
																	@foreach($findings as $ftst)
																		<div class="form-group"><label class="col-lg-3 control-label">{{$ftst->findings}}</label>
																				 <div class="col-lg-7"><textarea rows="3" name="comment" cols="50"  class="form-control">
																				{{$ftst->results}}</textarea>

																			 </div>
																	 </div>
                                  @endforeach


																	 <div class="form-group">
 																		<label class="col-lg-3 control-label"><h2>Impression</h2></label>
                                   </div>
																	 <div class="form-group"><label class="col-lg-2 control-label"></label>
																	 		 <div class="col-lg-8"><input type="text" value=" Normal ({{$tsts1->target}}){{$tsts1->tstname}}" class="form-control" >
																	 	 </div>
																	 </div>

		                            </form>
		                        </div>
		                    </div>
		                </div>



		</div><!--content-->
  </div><!--content page-->
</div>
@endsection
