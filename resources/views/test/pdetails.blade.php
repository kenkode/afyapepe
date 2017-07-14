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
$facilityId = $DataTests->FacilityCode;
$TName = $firstname.' '.$secondName;


}


	$dependantId = $pdetails->persontreated;
	$afyauserId = $pdetails->afya_user_id;
	$appId = $pdetails->id;
 if($pdetails->last_app_id){$appId2 = $pdetails->last_app_id;}else{$appId2 = $pdetails->id;}


 if ($dependantId =='Self')   {
	 $afyadetails = DB::table('afya_users')
	 ->select('afya_users.*')
	 ->where('id', '=',$afyauserId)
	 ->first();

	 $dob=$afyadetails->dob;
	 $gender=$afyadetails->gender;
	 $firstName = $afyadetails->firstname;
	 $secondName = $afyadetails->secondName;
	 $name =$firstName." ".$secondName;
}else{
	$deppdetails = DB::table('dependant')
	->select('dependant.*')
	->where('id', '=',$dependantId)
	->first();

	          $dob=$deppdetails->dob;
            $gender=$deppdetails->gender;
            $firstName = $deppdetails->firstName;
            $secondName = $deppdetails->secondName;
            $name =$firstName." ".$secondName;
}
$interval = date_diff(date_create(), date_create($dob));
$age= $interval->format(" %Y Year, %M Months, %d Days Old");

?>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="content-page  equal-height">
		<div class="content">
				<div class="container">

					<div class="col-lg-6">
					<h2>{{$name}}</h2>
					<ol class="breadcrumb">
					<li><a>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></li>
					<li><a>{{$age}}</a> </li>

					</ol>
					</div>
					<div class="col-lg-5">
					<h2>LAB: {{$facility}}</h2>
					<ol class="breadcrumb">
					<li class="active"><strong>Name: {{$pdetails->docname}} </strong></li>
					</ol>
					</div>
				</div>
			</div>
		</div>


  <div class="ibox float-e-margins">
     <div class="col-lg-12">
       <div class="tabs-container">
           <div class="wrapper wrapper-content animated fadeInRight">

<div class="row">

												<div class="col-md-12">
												<div class="ibox float-e-margins">
														<div class="ibox-title">
                            <h5>Tests Requested</h5>
																<div class="ibox-tools">
                                    <a class="collapse-link">
																			<button type="button" id="tshow" class="btn btn-primary btn-sm">Add Test</button>
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
														<div class="ibox-content" id="shttable">
                              <div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
																										<tr>
																												<th>No</th>
																												<th>Test Name</th>
																												<th>Category</th>
																												<th>Sub- Category</th>
																												<th>Conditional Diesease</th>
																												<th>Date Created</th>
																												<th>Action</th>

                                                      </tr>
																								</thead>
                                              <tbody>
																								<?php $i =1; ?>

																								@foreach($tsts as $tst)

																									<tr>
																									<td>{{$i}}</td>
																								  <td>@if($tst->testmore){{$tst->testmore}}@else{{$tst->tname}}@endif</td>
																									<td>{{$tst->tcname}}</td>
																									<td>{{$tst->tsname}}</td>
																									<td>{{$tst->dname }}</td>
																									<td>{{$tst->date}}</td>

																								<td class="btn btn-primary"><a href="{{route('perftest',$tst->patTdid)}}">Perform Test</a></td>

                                                 </tr>
																								<?php $i++; ?>
																									@endforeach

																								 </tbody>

								                            </table>

																									 </div>

																							 </div>
																					 </div>
																			 </div>
																			 </div>
<div class="row" id="tcustom">

  <div class="col-sm-5 b-r col-md-offset-1">
			 	{{ Form::open(array('route' => array('ctest'),'method'=>'POST')) }}


			 				 <div class="form-group"><label>Test Name</label>
			 				 <input type="text" name="test" placeholder="Only if not in the List above" class="form-control">
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
						<div class="form-group">
			 			 <label>Reason</label>
			 			 <textarea name="reason" rows="2" placeholder="i.e Is tested alongside the given test" class="form-control" required=""></textarea>
			 			</div>

			 		 <input type="hidden" name="appointment_id" value="{{$pdetails->appid}}" class="form-control">
			 		 <input type="hidden" name="ptd_id" value="{{$pdetails->ptd_id}}" class="form-control">
		 		 <input type="hidden" name="ptid" value="{{$pdetails->ptid}}" class="form-control">

			 		 <div class="text-center">
			 		 <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
			 {{ Form::close() }}
			 </div>
		</div>
</div>











																	 </div>
                                </div>


            </div>
				</div><!--content-->
		</div><!--content page-->

@endsection
