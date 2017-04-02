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
																												<th>Category</th>
																												<th>Sub- Category</th>
																												<th>Conditional Diesease</th>
																												<th>Status</th>
																												<th>Date Created</th>
																									</tr>
																								</thead>

																								<tbody>

																								 </tbody>

																							 </table>
																									 </div>

																							 </div>
																					 </div>
																			 </div>

 <div class="ibox float-e-margins col-md-6">
 							 <div class="ibox-title">
 									 <h5>Chosen select <small>http://harvesthq.github.io/chosen/</small></h5>
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
 							 <p>
 									 With chosen select uesr can fase chose from large in select input.
 							 </p>
							 <form class="form-horizontal m-t-md" action="#">
															 <div class="form-group">
																	 <label class="col-sm-2 col-sm-2 control-label">ISBN 1</label>
																	 <div class="col-sm-2">
																			 <input type="text" class="form-control" data-mask="999-99-999-9999-9" placeholder="">
																			 <span class="help-block">999-99-999-9999-9</span>
																	 </div>
															 </div>
															 <div class="form-group">
																	 <label class="col-sm-2 col-sm-2 control-label">ISBN 1</label>
																	 <div class="col-sm-2">
																			 <input type="text" class="form-control" data-mask="999-99-999-9999-9" placeholder="">
																			 <span class="help-block">999-99-999-9999-9</span>
																	 </div>
															 </div>
 							</div>
</div>
<div class="ibox float-e-margins col-md-6">
							 <div class="ibox-title">
									 <h5>Chosen select <small>http://harvesthq.github.io/chosen/</small></h5>
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
							 <p>
									 With chosen select uesr can fase chose from large in select input.
							 </p>
							 <div class="form-group ">
								<label for="role" class="control-label">Doctor note</label>
								 {{ Form::text('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
						 </div>
							</div>



           </div>
			 </div>

</div>
@include('includes.default.footer')
				</div><!--content-->
		</div><!--content page-->

@endsection
