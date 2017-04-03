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
																												<th>Conditional Diesease</th>
																												<th>Date Created</th>
																									</tr>
																								</thead>

																								<tbody>

																									<?php $i =1; ?>

																									@foreach($tsts as $tst)
																									<?php  $gender= $tst->gender;
																									if ($gender=1) {$gender='Male';}else{$gender='Female';}
																									 $dob=$tst->dob;
																									 $interval = date_diff(date_create(), date_create($dob));
																									 $age= $interval->format(" %Y Year, %M Months, %d Days Old");
                                                  ?>
																									  <tr>
																									  <td><a href="{{route('patientTest',$tst->id)}}">{{$i}}</a></td>
																									 <td><a href="{{route('patientTest',$tst->id)}}">{{$tst->firstname}} {{$tst->secondName}}</a></td>
																									  <td>{{$gender}}</td>
																									  <td>
												                              {{$age}}</td>
																									  <td>{{$tst->disease}}</td>
																									   <td>{{$tst->date}}</td>
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
@include('includes.default.footer')
				</div><!--content-->
		</div><!--content page-->

@endsection
