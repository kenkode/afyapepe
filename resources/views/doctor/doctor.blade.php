<div class="row">
  <?php
$doc = (new \App\Http\Controllers\DoctorController);
$Docdatas = $doc->DocDetails();
foreach($Docdatas as $Docdata){



	$Name = $Docdata->name;
	$Address = $Docdata->address;
	$RegNo = $Docdata->regno;
	$RegDate = $Docdata->regdate;
	$Speciality = $Docdata->speciality;
	$Sub_Speciality = $Docdata->subspeciality;
  $Facility = $Docdata->facility;

}


if ( empty ($Name ) ) {
// return view('doctor.create');

return redirect('doctor.create');


// return redirect()->action('DoctorController@create');

}
?>

<div class="pull-right">
 <div class="page-title clearfix">
                          <h3><?php echo $Facility;?></h3>

                      </div><!--end page title-->

   <div class="widget-box clearfix">
<h4><?php echo $Name;?></h4>
<h4>Address:
<?php echo $Address; ?></h4>
<h4>Registration Number:
<?php echo $RegNo; ?></h4>

<h4>Registration Date:
<?php echo $RegDate; ?></h4>

<h4>Speciality:
<?php echo $Speciality; ?></h4>

<h4>Sub Speciality:
<?php echo $Sub_Speciality; ?></h4>
</div>
</div>

	<br>	<br>	<br>

</div>
