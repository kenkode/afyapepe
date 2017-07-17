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


	$dependantId = $tsts1->dependant_id;
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
			<h3 class="text-center">@if($tsts1->category){{$tsts1->category}} @else Test @endif Report</h3>
				<div class="text-center">
				@if($tsts1->name){{$tsts1->name}} // {{$tsts1->sub_category}} @else OTHER TESTS @endif
				  </div>
				 </div>
       </div>
		</div>
  </div>
</div>
<div class="row wrapper border-bottom page-heading">
  <div class="content-page  equal-height">
		<div class="content">


 <?php $i=1; $fh100=DB::table('tests')
 ->Join('test_ranges', 'tests.id', '=', 'test_ranges.tests_id')
 ->where('tests.id', '=',$tsts1->tests_id)
 ->select('tests.id as tests_id','tests.name as tname','test_ranges.*','test_ranges.id as testranges','test_ranges.name as rangesname')
 ->first();
  ?>
@if($fh100)
@include('test.action1')
@else


@if($tsts1->tests_reccommended)
<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>TEST RESULTS</h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
													<?php
													$i=1; $fh04=DB::table('patientNotes')
													->where([['appointment_id', '=',$appId],['target', '=', 'Test']])
													->select('note')
													->get();
													 ?>
													 @if($fh04)
													<div class="col-lg-6">
													<div class="ibox float-e-margins">
													<div class="ibox-title">
													 <h5> Doctor Notes </h5>
													</div>
													<div class="ibox-content">
													<div class="form-group ">
													<label for="d_list2">Notes:</label>
													<textarea rows="4" name="comment" cols="50"  class="form-control">
													  @foreach($fh04 as $fh041)
													{{$fh041->note}}
													 @endforeach
													  </textarea>
													</div>
													</div>
													</div>
													</div>
													@endif
                    <div class="col-sm-5 b-r col-md-offset-1">
									{{ Form::open(array('route' => array('testResult3'),'method'=>'POST')) }}

												 <div class="form-group"><label>Test</label>
												 <input type="text"  value="{{$tsts1->name}}" class="form-control">
												 </div>
													<div class="form-group"><label>Value</label>
													<input type="text" name="value" placeholder="Enter Value" class="form-control">
													</div>
													<div class="form-group"><label>Units</label>
													<input type="text" name="units" placeholder="Enter Value" class="form-control">
													</div>
                      </div>

									    <div class="col-sm-5">
												<div class="form-group">
												<label  class="">Comments:</label>
											 <select class="form-control" name="comments" required >
											 <option value=''>Choose one ..</option>
											 <option value='Normal'>Normal</option>
											 <option value='Severe'>Severe</option>
											 <option value='High'>High</option>
											 <option value='Efficient'>Efficient</option>
											 <option value='Inefficient'>Inefficient</option>
											 <option value='Borderline neutropenia'>Borderline neutropenia</option>
											 <option value='Normal peripherial blood picture'>Normal peripherial blood picture</option>
											 </select>
											 </div>
                      <div class="form-group">
											 <label>Other Reports</label>
											 <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>
                      </div>
										 <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
										 <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
										 <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">
										 <input type="hidden" name="tests_id" value="{{$tsts1->tests_id}}" class="form-control">

										 <div class="text-center">
										 <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
									 </div>
											{{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
</div>
@else
<div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>TEST RESULTS</h5>

                    </div>
                    <div class="ibox-content">
                        <div class="row">
													<?php
													$i=1; $fh04=DB::table('patientNotes')
													->where([['appointment_id', '=',$appId],['target', '=', 'Test']])
													->select('note')
													->get();
													 ?>
													 @if($fh04)
													<div class="col-lg-6">
													<div class="ibox float-e-margins">
													<div class="ibox-title">
													 <h5> Doctor Notes </h5>
													</div>
													<div class="ibox-content">
													<div class="form-group ">
													<label for="d_list2">Notes:</label>
													<textarea rows="4" name="comment" cols="50"  class="form-control">
													  @foreach($fh04 as $fh041)
													{{$fh041->note}}
													 @endforeach
													  </textarea>
													</div>
													</div>
													</div>
													</div>
													@endif
                    <div class="col-sm-5 b-r col-md-offset-1">
									{{ Form::open(array('route' => array('testResult4'),'method'=>'POST')) }}
<?php
$tsts201 = DB::table('patient_test_details')
->select('patient_test_details.*')
->where('id', '=',$tsts1->id)
->first();   ?>
<div class="form-group">
 <label>Other Requested Test</label>
 <textarea rows="2"  class="form-control" readonly="">{{$tsts201->testmore}}</textarea>
</div>
												 <div class="form-group"><label>Test Name</label>
												 <input type="text" name="test" placeholder="Write test name" class="form-control">
												 </div>
													<div class="form-group"><label>Value</label>
													<input type="text" name="value" placeholder="Enter Value" class="form-control">
													</div>
													<div class="form-group"><label>Units</label>
													<input type="text" name="units" placeholder="Enter Value" class="form-control">
													</div>
                      </div>

									    <div class="col-sm-5">
												<div class="form-group">
												<label  class="">Comments:</label>
											 <select class="form-control" name="comments" required >
											 <option value=''>Choose one ..</option>
											 <option value='Normal'>Normal</option>
											 <option value='Severe'>Severe</option>
											 <option value='High'>High</option>
											 <option value='Efficient'>Efficient</option>
											 <option value='Inefficient'>Inefficient</option>
											 <option value='Borderline neutropenia'>Borderline neutropenia</option>
											 <option value='Normal peripherial blood picture'>Normal peripherial blood picture</option>
											 </select>
											 </div>
                      <div class="form-group">
											 <label>Other Reports</label>
											 <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>
                      </div>
										 <input type="hidden" name="appointment_id" value="{{$tsts201->appointment_id}}" class="form-control">
										 <input type="hidden" name="ptd_id" value="{{$tsts201->id}}" class="form-control">
										 <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">

										 <div class="text-center">
										 <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
          {{ Form::close() }}
					</div>
					<div class="form-group">
						<label>Done Adding Other Tests</label>
											{{ Form::open(array('route' => array('testResult5'),'method'=>'POST')) }}
									    <input type="hidden" name="appointment_id" value="{{$tsts201->appointment_id}}" class="form-control">
										  <input type="hidden" name="ptd_id" value="{{$tsts201->id}}" class="form-control">
										  <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">
											<button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>FINISH</strong></button>
                {{ Form::close() }}
								</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif

@endif


		</div><!--content-->
  </div><!--content page-->
</div>
@endsection
