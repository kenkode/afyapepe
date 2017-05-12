@extends('layouts.test')
@section('title', 'Tests')
@section('content')
<div class="content-page  equal-height">

		<div class="content">
				<div class="container">



					<div class="wrapper wrapper-content animated fadeInRight">
										<div class="row">
											<div class="ibox float-e-margins">
													<div class="ibox-title">
														<h5>Today's Visit Triage</h5>

													</div>
													<div class="ibox-content">

											<div class="table-responsive ibox-content">
											<table class="table table-striped table-bordered table-hover dataTables-conditional" >
												 <thead>
											<tr>
												@foreach($triage as $pdetails)
              <?php

							$dependantId = $pdetails->persontreated;
              $afyauserId = $pdetails->afya_user_id;

							if ($dependantId =='Self') {  ?>
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
  <?php  } else {  ?>
		<th>Weight </th>
 	 <th>Height</th>
 	 <th>Temperature</th>
 	 <th>Systolic BP</th>
 	 <th>Diastolic BP</th>
 	  <th>Chief Compliant</th>
 	 <th>Observations</th>
 	 <th>Symptoms</th>
 	 <th>Nurse Notes</th>
	   <?php  } ?>
											</tr>
											</thead>

											<tbody>

											<?php   if ($dependantId =='Self') { ?>
												<tr>
												 <td>
											 </td>
											 <td>{{$pdetails->current_weight}}</td>
												<td>{{$pdetails->current_height}}</td>
												<td>{{$pdetails->temperature}}</td>
												<td>{{$pdetails->systolic_bp}}</td>
												 <td>{{$pdetails->diastolic_bp}}</td>
												 <td><?php $height=$pdetails->current_height; $weight=$pdetails->current_weight;
																		$bmi =$weight/($height*$height);
																		echo number_format($bmi, 2);
																 ?></td>
												 <td>{{$pdetails->chief_compliant}}</td>
												 <td>{{$pdetails->observation}}</td>
												 <td>{{$pdetails->symptoms}}</td>
												 <td>{{$pdetails->nurse_notes}}</td>
                        </tr>
											<?php }  else { ?>
													<tr>

												 <td>{{$pdetails->weight}}</td>
													<td>{{$pdetails->height}}</td>
													<td>{{$pdetails->temperature}}</td>
													<td>{{$pdetails->systolic_bp}}</td>
													 <td>{{$pdetails->diastolic_bp}}</td>
                           <td>{{$pdetails->chief_compliant}}</td>
													 <td>{{$pdetails->observation}}</td>
													 <td>{{$pdetails->symptoms}}</td>
													 <td>{{$pdetails->nurse_notes}}</td>
	                        </tr>
													<?php  } ?>



											@endforeach

											</tbody>
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
