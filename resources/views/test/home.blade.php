@extends('layouts.test')
@section('title', 'Tests')
@section('content')
<div class="content-page  equal-height">

		<div class="content">
				<div class="container">
         	<div class="wrapper wrapper-content animated fadeInRight">
										<div class="row">
												<div class="col-lg-11">
												<div class="ibox float-e-margins">
														<div class="ibox-title">

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
																												<th>Patient Name</th>
																												<th>Gender</th>
																												<th>Age</th>
																												<!-- <th>Conditional Diesease</th> -->
																												<th>Date Created</th>
																												<th>Status</th>
																									</tr>
																								</thead>

																								<tbody>

																									<?php $i =1; ?>

																									@foreach($tsts as $tst)
																									<?php
																									if ($tst->persontreated=='Self') {$gender= $tst->gender; }
																									else {$gender= $tst->depgender;}

																									  if ($gender==1) {$gender='Male';}else{$gender='Female';}

																										if ($tst->persontreated=='Self') {$dob=$tst->dob; }
																										else {$dob=$tst->depdob;}

																									 $interval = date_diff(date_create(), date_create($dob));
																									 $age= $interval->format(" %Y Year, %M Months, %d Days Old");

																									$status= $tst->test_status;
																									//  if ($status=1) {$status='Done';}else{$status='NOT DONE';}
																									if ($status==1) {
																										$status='Done';
																									}elseif($status==2) {
																										$status='Partially Done';
																									}else {
																										$status='NOT DONE';
																									}


                                                  ?>
																									  <tr>
																									  <td><a href="{{route('patientTests',$tst->tid)}}">{{$i}}</a></td>
																									 <td><a href="{{route('patientTests',$tst->tid)}}">
																									 <?php if ($tst->persontreated=='Self') {echo $tst->firstname." ".$tst->secondName;}
																									 else {echo $tst->depname." ".$tst->depname2;}
																									 ?></a></td>


																										<td>{{$gender}}</td>
																									  <td>{{$age}}</td>

																									   <td>{{$tst->date}}</td>
																										 <td>{{$status}}</td>
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
																	 </div>



											 </div>

				</div><!--content-->
		</div><!--content page-->

@endsection
