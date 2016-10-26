@extends('layouts.doc_template')

@section('content')

<div class="span5 well">	

<?php  
$doc = (new \App\Services\DocService);	
$Docdata = $doc->DocDetails(); 
foreach($Docdata as $Docdata){
	$Name = $Docdata->Name;
	$Address = $Docdata->Address;
	$RegNo = $Docdata->RegNo;
	$RegDate = $Docdata->RegDate;
	$Speciality = $Docdata->Speciality;
	$Sub_Speciality = $Docdata->Sub_Speciality;
}	
?>	
<h2><?php echo $Name;?></h2>
<h2>Address:
<?php echo $Address; ?></h2>
<h2>Registration Number:
<?php echo $RegNo; ?></h2>

<h2>Registration Date:
<?php echo $RegDate; ?></h2>

<h2>Speciality:
<?php echo $Speciality; ?></h2>

<h2>Sub Speciality:
<?php echo $Sub_Speciality; ?></h2>
</div>

@include('doctor/todayspatients')

@include('doctor/allpatients')


@stop