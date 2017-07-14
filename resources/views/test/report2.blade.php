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
					<li class="active">Name: {{$TName}}</li>
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
			<h3 class="text-center">{{$tsts1->category}} Report</h3>
				<div class="text-center">
				{{$tsts1->name}} // {{$tsts1->sub_category}}
				  </div>
				 </div>
       </div>
		</div>
  </div>
</div>

<?php $i=1;
		$fhresut=DB::table('test_results')
		->join('test_ranges','test_results.test_ranges_id','=','test_ranges.id')
		->join('tests','test_ranges.tests_id','=','tests.id')
	->where([ ['test_results.ptd_id', '=',$tsts1->id],
						['test_results.appointment_id', '=',$appId], ])
	->select('test_results.*','test_ranges.*','tests.name as tname')
		->get(); ?>

<div class="row wrapper border-bottom page-heading">
  <div class="content-page  equal-height">
		<div class="content">
      <div class="row">
				<!--TEST RESULT------------------------------------------------------------------------->

       <div class="col-lg-6">
      <div class="ibox float-e-margins">
     <div class="ibox-title">
        <h5> TEST RESULTS  </h5>
				<div class="ibox-tools">
          <a class="collapse-link">
						<button class="btn btn-sm btn-primary m-t-n-xs" id ="upresult"><strong>UPDATE TEST RESULT</strong></button>
					</a>
        </div>
     </div>
     <div class="ibox-content">
      <table class="table table-bordered">
      <thead>
      <tr>
      <th>#</th>
      <th>TEST</th>
      <th>VALUE</th>
      <th>UNITS</th>
      @if($gender == 'Male')
      <th><button type="button" class="btn btn-primary">NORMAL MALE</button></th>
      @else
      <th><button type="button" class="btn btn-primary">NORMAL FEMALE</button></th>
      @endif
      </tr>

      </thead>
      <tbody>
 @foreach($fhresut as $fhtest)

      <tr>
      <td>{{$i}}</td>
      <td>@if($fhtest->name){{$fhtest->name}}@else{{$fhtest->tname}}@endif</td>

@if($gender == 'Male')
  <?php if($fhtest->low_male <= $fhtest->value AND  $fhtest->value <= $fhtest->high_male) { ?>
   <td class="font-bold text-navy"> {{$fhtest->value}}</td>
    <?php }else{ ?>
   <td class="font-bold text-danger"> {{$fhtest->value}}</td>
   <?php } ?>


@else

   <?php if($fhtest->low_female <= $fhtest->value AND  $fhtest->value <= $fhtest->high_female) { ?>
   <td class="font-bold text-navy"> {{$fhtest->value}}</td>
    <?php }else{ ?>
   <td class="font-bold text-danger"> {{$fhtest->value}}</td>
   <?php } ?>

@endif

      <td>{{$fhtest->units}}</td>
       @if($gender == 'Male')
     <td>{{$fhtest->low_male}} - {{$fhtest->low_male}}</td>
       @else
     <td>{{$fhtest->low_female}} - {{$fhtest->low_female}}</td>
       @endif

      <?php $i ++ ?>
      </tr>
      @endforeach

    </tbody>
    </table>
      </div>
</div>
</div>
<!--Update------------------------------------------------------------------------->

<div id="Tupdate">
<div class="col-lg-6">
 <div class="ibox float-e-margins">
   <div class="ibox-title">
     <h5>Update</h5>
   </div>
  <div class="ibox-content">
{{ Form::open(array('route' => array('testRupdt'),'method'=>'POST')) }}

    <div class="form-group">
        <label for="tag_list" class="">Test:</label>
             <select class="test-multiple" name="test_rid"  style="width: 100%">
               <?php $fh1=DB::table('test_results')
                 ->Join('test_ranges', 'test_results.test_ranges_id', '=', 'test_ranges.id')
								 ->Join('tests', 'test_ranges.tests_id', '=', 'tests.id')
               ->where([['test_results.appointment_id', '=',$appId],
                       ['test_results.ptd_id', '=',$ptdId],])
							->Select('test_results.id','test_ranges.tests_id','test_ranges.name as rname','tests.name as tname')
							->get();
							?>
               @foreach($fh1 as $fh1test)
                      <option value='{{$fh1test->id}}'>
											@if($fh1test->rname){{$fh1test->rname}}@else{{$fh1test->tname}}@endif</option>
               @endforeach
               </select>


  </div>

<div class="form-group"><label>Value</label>
<input type="text" name="value" placeholder="Enter Value" class="form-control"></div>
<input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
<div class="text-center">
		<button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
		</div>
{{ Form::close() }}

    </div>
  </div>
 </div>
</div>
<!--Interpretations------------------------------------------------------------------------->

<?php $i=1; $fh2=DB::table('test_interpretations')
              ->where('test_ranges_id', '=',$tsts1->tests_reccommended)->get(); ?>
              @if($fh2)
          <div class="col-lg-6">
           <div class="ibox float-e-margins">
             <div class="ibox-title">
               <h5>Interpretations</h5>
             </div>
           <div class="ibox-content">
           <table class="table table-bordered">
           <thead>
           <tr>
           <th>#</th>
           <th>Units</th>
           <th>Interpretations</th>
           </tr>
           </thead>
           <tbody>

           @foreach($fh2 as $fhtest)
           <tr>
           <td>{{$i}}</td>
           <td>{{$fhtest->value}}</td>
           <td>{{$fhtest->description}}</td>
           <?php $i ++ ?>
           </tr>
           @endforeach

           </tbody>
           </table>
           </div>
           </div>
           </div>
           @endif
<!--Comments------------------------------------------------------------------------->

  <div id="Uclose">
  <div class="col-lg-6">
       <div class="ibox float-e-margins">
         <div class="ibox-title">
           <h5>Comments</h5>
         </div>
        <div class="ibox-content">
{{ Form::open(array('route' => array('testfilm'),'method'=>'POST')) }}

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
        <label>Other Comments</label>
        <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>
    </div>

      <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
      <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
      <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">

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
  </div><!--content-->
</div><!--content page-->

@endsection
