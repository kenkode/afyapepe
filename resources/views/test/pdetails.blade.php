@extends('layouts.test')
@section('title', 'Tests')
@section('content')
<div class="content-page  equal-height">
	<?php
	$dependantId = $pdetails->persontreated;
	$afyauserId = $pdetails->afya_user_id;
	$appId = $pdetails->id;

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

?>
		<div class="content">
				<div class="container">
					<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-6">
					<h2>{{$name}}</h2>
					<ol class="breadcrumb">
					<li><a>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></li>
					<li><a>{{$age}}</a> </li>
					
					</ol>
					</div>
					<div class="col-lg-6">
					<h2>Test Center </h2>
					<ol class="breadcrumb">
					<li class="active"><strong>Name </strong></li>
					</ol>
					</div>
					</div>

           <div class="wrapper wrapper-content animated fadeInRight">
										<div class="row">
											<div class="ibox float-e-margins">

													<div class="ibox-content">
                      <h5>Today's Visit Triage</h5>
											<div class="table-responsive ibox-content">
											<table class="table table-striped table-bordered table-hover dataTables-conditional" >


    <?php if ($dependantId =='Self')   {  ?>
<thead>
<tr>
<th>Weight </th>
<th>Height</th>
<th>Temperature</th>
<th>Systolic BP</th>
<th>Diastolic BP</th>
<th>BMI</th>
<th>Chief Compliant</th>
<th>Observations</th>
<th>Symptoms</th>
<th>Nurse Notes</th>
</tr>
</thead>

<tbody>
<tr>

<td>{{$afyadetails->current_weight}}</td>
<td>{{$afyadetails->current_height}}</td>
<td>{{$afyadetails->temperature}}</td>
<td>{{$afyadetails->systolic_bp}}</td>
<td>{{$afyadetails->diastolic_bp}}</td>
<td><?php $height=$afyadetails->current_height; $weight=$afyadetails->current_weight;
$bmi =$weight/($height*$height);
echo number_format($bmi, 2);
?></td>
<td>{{$afyadetails->chief_compliant}}</td>
<td>{{$afyadetails->observation}}</td>
<td>{{$afyadetails->symptoms}}</td>
<td>{{$afyadetails->nurse_notes}}</td>
</tr>
</tbody>
                <?php  } else {  ?>
<thead>
<tr>
<th>Weight </th>
<th>Height</th>
<th>Temperature</th>
<th>Systolic BP</th>
<th>Diastolic BP</th>
<th>Chief Compliant</th>
<th>Observations</th>
<th>Symptoms</th>
<th>Nurse Notes</th>

</tr>
</thead>

<tbody>

<tr>
<td>{{$deppdetails->weight}}</td>
<td>{{$deppdetails->height}}</td>
<td>{{$deppdetails->temperature}}</td>
<td>{{$deppdetails->systolic_bp}}</td>
<td>{{$deppdetails->diastolic_bp}}</td>
<td>{{$deppdetails->chief_compliant}}</td>
<td>{{$deppdetails->observation}}</td>
<td>{{$deppdetails->symptoms}}</td>
<td>{{$deppdetails->nurse_notes}}</td>
</tr>
</tbody>
<?php  } ?>



											</table>
										</div>
									</div>
								</div>
												<div class="col-md-12">
												<div class="ibox float-e-margins">
														<div class="ibox-title">
                            <h5>Tests Requested</h5>
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

																<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
																										<tr>
																												<th>No</th>
																												<th>Test Name</th>
																												<th>Category</th>
																												<th>Sub- Category</th>
																												<th>Conditional Diesease</th>
																												<th>Status</th>
																												<th>Date Created</th>

																									</tr>
																								</thead>

																								<tbody>

																									<?php $i =1; ?>

																									@foreach($tsts as $tst)

																									  <tr>
																									  <td>{{$i}}</td>
																									 <td>{{$tst->testname}}</td>
																									  <td>{{$tst->category}}</td>
																									  <td>{{$tst->sub_category}}</td>
																									  <td>{{$tst->disease }}</td>
																									   <td><?php
																										 $status=$tst->done; if ($status==0) {
																									   	$status='NOT DONE';
																									   } else {
																									   	$status='DONE';
																									   }
																									    ?>
                                                  {{$status}}</td>

																										  <td>{{$tst->date}}</td>

																											<td>
																												<div>
																													<button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$tst->patTdid}}"
																														 data-target="#edit-modal">Perform Test</button>
                                                   	</td>
																								</tr>
																									<?php $i++; ?>

																									@endforeach
																								 </tbody>
                             <li class="btn btn-primary"><a href="{{ url('test') }}">GO BACK</a></li>

								</table>
								<?php if ($dependantId =='Self') { ?>

								  <div class="col-sm-6">
								      <label>Patient Allergy To:</label>
								      <?php $allergy=DB::table('afya_users_allergy')
								      ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
								      ->where('afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>

								      @foreach($allergy as $micrtest)
								           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
								      @endforeach

								      <label>Patient Chronic Disease:</label>
								      <?php $chronic=DB::table('appointments')
								      ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
								      ->Join('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
								      ->where('appointments.afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>


								      @foreach($chronic as $micrtest)
								           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
								      @endforeach

								  </div>
								<?php }
								else { ?>


								  <div class="col-sm-6">
								      <label>Patient Allergy To:</label>
								      <?php $allergy=DB::table('afya_users_allergy')
								      ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
								      ->where('dependant_id', '=',$dependantId)->distinct()->get(['name']); ?>

								      @foreach($allergy as $micrtest)
								           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
								      @endforeach

								      <label>Patient Chronic Disease:</label>
								      <?php $allergy=DB::table('appointments')
								        ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
								      ->Join('diagnoses', 'patient_diagnosis.disease_id',  '=', 'diagnoses.id')
								      ->where([ ['appointments.persontreated', '=',$dependantId],['patient_diagnosis.chronic', '=','Y'],])->distinct()->get(['name']); ?>

								      @foreach($allergy as $micrtest)
								           <input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
								      @endforeach

								  </div>
								<?php } ?>
							<div class="ibox-content">

                         <div id="edit-modal" class="modal fade" aria-hidden="true">
                             <div class="modal-dialog">
                                 <div class="modal-content">
                                     <div class="modal-body">
                                         <div class="row">
                                             <div class="col-sm-8"><h3 class="m-t-none m-b">Test Result</h3>

																							 {{ Form::open(array('route' => array('testResult'),'method'=>'POST')) }}

																									 <div class="form-group"><label>Sample Input</label>
																									   <input type="text" name="testId" id="edit-content" class="form-control" >
																									</div>

                                                     <div class="form-group"><label>Results</label>
																											  <input type="text" name="results" placeholder="Enter Value" class="form-control"></div>
                                                     <div class="form-group"><label>Notes</label>
																											 <input type="textarea" name="notes" placeholder="Any other notes" class="form-control"></div>
                                                     <div>
                                                         <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>

                                                     </div>
                                                {{ Form::close() }}
                                             </div>

                                     </div>
                                 </div>
                                 </div>
                             </div>
                     </div>
                 </div>

																									 </div>

																							 </div>
																					 </div>
																			 </div>
																			 </div>
																	 </div>



											 </div>
@include('includes.default.footer')
				</div><!--content-->
		</div><!--content page-->

@endsection
