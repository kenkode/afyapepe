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

																												<th>Test Name</th>
																												<th>Unit Cost</th>
																												<th>Quantity</th>
																												<th>Total<th>
																													
																									</tr>
																								</thead>

																								<tbody>


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
