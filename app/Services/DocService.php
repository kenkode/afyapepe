<?php
namespace App\Services;

use DB;
use Response;
use App\Services\Services as Serve;

class DocService extends Serve {

	public function _constructor(){
		$services = new Services;
	}
//include( $_SERVER['DOCUMENT_ROOT']."/afyapepe/config.php");
/*
if(isset($_POST["form"]) == "diag_update" && $_POST["form"] != "insert_presc" && $_POST["form"] != "insert_test" ){
	$query = mysqli_query($link,"UPDATE diagnosis SET consulting_physician = '".$_SESSION['userId']."', doctor_note = '".$_POST['doc_notes']."', dateUpdated = NOW() WHERE id = '".$_POST['diag_id']."' AND patient_id = '".$_POST['patient_id']."' ");


	$query1 = mysqli_query($link,"UPDATE appointments SET status = 1, updateOn = NOW() WHERE AppID = '".$_POST['app_id']."' AND patientID = '".$_POST['patient_id']."' AND Doc_ID = '".$_SESSION['userId']."'") ;

	if(!$query || !$query1 )
	{
	echo "query has failed";
	die(mysqli_error($link));
	} else {
	//echo $query;
	$id	= $_POST['patient_id'];
	header("location: ../doctor.php?id=$id");
	}
}

if(isset($_POST["form"]) == "insert_presc" && $_POST["form"] != "diag_update" && $_POST["form"] != "insert_test" ){
		$query = mysqli_query($link,"INSERT INTO prescriptions (app_id, doc_id, patient_id,filled_status,Prescription_Date) values('".$_POST['app_id']."','".$_SESSION['userId']."','".$_POST['patient_id']."','0',NOW() )");
		$presc = mysqli_query($link,"SELECT presc_id FROM prescriptions ORDER BY presc_id DESC LIMIT 1");

		$presc_id = mysqli_fetch_array($presc);
		$presc_id = $presc_id['presc_id'];

		$arrlength = count($_POST['d_id']);
		for($x = 0; $x < $arrlength; $x++) {
			$query = mysqli_query($link,"INSERT INTO prescription_details (presc_id, drug_id, doseform, dosage, presc_date) values('$presc_id','".$_POST['d_id'][$x]."','".$_POST['d_form'][$x]."','".$_POST['d_dose'][$x]."',NOW() )");

			$query = mysqli_query($link,"INSERT INTO prescription_filled_status (presc_id, drug_id, dosage, dose_given, notes, outlet_id, date) values('$presc_id','".$_POST['d_id'][$x]."','".$_POST['d_dose'][$x]."','','','',NOW() )");
		}



		header("location:../doctor.php");
	}

if(isset($_POST["form"]) == "insert_test" && $_POST["form"] != "insert_presc" && $_POST["form"] != "diag_update" ){
		$query = mysqli_query($link,"INSERT INTO patient_test (app_id, doc_id, patient_id,filled_status,dateCreated) values('".$_POST['app_id']."','".$_SESSION['userId']."','".$_POST['patient_id']."','0',NOW() )");
		$test = mysqli_query($link,"SELECT patient_test_id FROM patient_test ORDER BY patient_test_id DESC LIMIT 1");

		$test_id = mysqli_fetch_array($test);
		$test_id = $test_id['patient_test_id'];

		$arrlength = count($_POST['d_id']);
		for($x = 0; $x < $arrlength; $x++) {

			$query = mysqli_query($link,"INSERT INTO patient_test_details (patient_test_id, test_id, notes, dateCreated) values('$test_id','".$_POST['d_id'][$x]."','".$_POST['d_notes'][$x]."',NOW() )");
		}

		$id	= $_POST['patient_id'];
		header("location:../doctor.php?id=$id");
	}
/*
if($_POST['test_id']){

		$id=$_POST['test_id'];
		$sql=mysql_query("select tests_id , test_name from tests where test_id = 5");
		while($row=mysql_fetch_array($sql)){
				$id=$row['id'];
				$data=$row['data'];
				echo '<option value="'.$id.'">'.$data.'</option>';
			}
}*/
	function doc_todayPatientscount(){
		//include('config.php');
		$date = DATE("Y-m-d");
		$us = session()->get('user.userId');
		$countPatient = DB::select("select patients.id,patients.FirstName,patients.LastName,patients.Age,patients.NationalID,patients.MobileNo,patients.Gender,appointments.Appointment_Date from patients inner join appointments on appointments.PatientID = patients.patient_id where appointments.Doc_ID = '".$us."' and DATE(Appointment_Date) = DATE('".$date."')");

		if($countPatient){

		 $pat = count($countPatient);

				return $pat;
		}
	}

function allPatients(){
		//include('config.php');
	    $us = session()->get('user.userId');
		$countPatient = DB::select("select patients.id,patients.FirstName,patients.LastName,patients.Age,patients.NationalID,patients.MobileNo,patients.Gender,appointments.Appointment_Date from patients inner join appointments on appointments.PatientID = patients.patient_id where appointments.Doc_ID = '".$us."'");
	    if($countPatient){
	    $rowcount = count($countPatient);

		return $rowcount;
		}
	}
function allPatientsDoc(){

	$query = DB::select("select patients.patient_id as id,patients.FirstName,patients.LastName,patients.Age,patients.NationalID,patients.MobileNo,patients.Gender,appointments.Appointment_Date,constituency.Constituency
from patients inner join constituency on patients.constituency = constituency.const_id
inner join appointments on appointments.PatientID = patients.patient_id where appointments.Doc_ID = '".session()->get('user.userId')."'");

	if($query === FALSE) {
			die('Error: ' . mysqli_error()); // TODO: better error handling
			} else {
		return $query;
	}
}

function doc_getDiag($id){
		//include('config.php');
		$Patient = DB::select("select diagnosis.id as diag_id,patients.id,patients.patient_id,patients.FirstName,patients.LastName,patients.Age,patients.NationalID,patients.MobileNo,patients.Gender,diagnosis.allergies,diagnosis.chief_complaint,diagnosis.observations,diagnosis.nurse_note,diagnosis.systolic_bp,diagnosis.diastolic_bp,diagnosis.temperature,diagnosis.weight,diagnosis.height,diagnosis.doctor_note,appointments.AppID,appointments.Appointment_Date,appointments.Facility_ID,appointments.Facility_Name from patients  inner join appointments on patients.patient_id = appointments.patientid inner join diagnosis  on diagnosis.patient_id = patients.patient_id  where patients.patient_id = '$id' order by diagnosis.id desc limit 1");

			if($Patient === FALSE) {
			die('Error: ' . mysqli_error()); // TODO: better error handling
			} else {

				return $Patient;
			}

	}

function doc_getHist($id){
		//include('config.php');
		$Patient = DB::select("select patients.patient_id,diagnosis.allergies,diagnosis.chief_complaint,diagnosis.observations,diagnosis.nurse_note,diagnosis.doctor_note,diagnosis.prescription,diagnosis.systolic_bp,diagnosis.diastolic_bp,diagnosis.weight,diagnosis.height,appointments.AppID,appointments.Appointment_Date,appointments.Facility_Name from patients  inner join appointments on patients.patient_id = appointments.patientid inner join diagnosis  on diagnosis.patient_id = patients.patient_id where patients.patient_id = '$id' order by diagnosis.id desc");

			if($Patient === FALSE) {
			die('Error: ' . mysqli_error()); // TODO: better error handling
			} else {
				return $Patient;
			}

	}

function doc_todayPatients(){
		//include('config.php');
 		$date = DATE("Y-m-d");
	    $us = session()->get('user.userId');
		$todayPatient = DB::select("SELECT patients.patient_id AS id,patients.FirstName,patients.LastName,patients.Age,patients.NationalID, patients.MobileNo,patients.Gender,appointments.Appointment_Date,constituency.Constituency FROM patients INNER JOIN constituency ON patients.constituency = constituency.const_id INNER JOIN appointments ON appointments.PatientID = patients.patient_id WHERE appointments.Doc_ID = '".$us."' AND appointments.appid not in (SELECT app_id FROM prescriptions WHERE DATE(Prescription_Date) = DATE('".$date."')) AND DATE(Appointment_Date) = DATE('".$date."')");


		if($todayPatient === FALSE) {
		die('Error: ' . mysqli_error($link)); // TODO: better error handling
		}
		return $todayPatient;

}

function DocDetails(){
	//include('config.php');
	$us = session()->get('user.userId');
	$DocDetails = DB::select("select * from doctors where Doc_ID='".$us."' ");
	//$Docdata= mysqli_fetch_array($DocDetails);
	return $DocDetails;

}

function ifPrescribed($id){
	//include('config.php');
	$date = DATE("Y-m-d");
	$us = session()->get('user.userId');
	$data = DB::select("SELECT patients.patient_id AS id,patients.FirstName,patients.LastName,appointments.Appointment_Date FROM patients INNER JOIN appointments ON appointments.PatientID = patients.patient_id WHERE appointments.Doc_ID = '".$us."' AND appointments.appid in (SELECT app_id FROM prescriptions WHERE DATE(Prescription_Date) = '$date') AND patients.patient_id  = '$id' AND DATE(Appointment_Date) = '$date'");
	if($data){
		$data = count($data);
		return $data;

	}

}

function ifTest($id, $appid){
	//include('config.php');
	$date = DATE("Y-m-d");
	$us = session()->get('user.userId');
	$data = DB::select("SELECT app_id,patient_test.patient_id,pd.patient_test_id, name, test_name, pd.test_id,notes,done,outlet_id,facilityname,results, DATE(pd.dateUpdated) FROM patient_test_details pd INNER JOIN patient_test ON patient_test.patient_test_id = pd.patient_test_id INNER JOIN tests on tests.tests_id = pd.test_id INNER JOIN test on test.test_id = tests.test_id LEFT JOIN facilities on facilities.facilitycode = pd.outlet_id WHERE patient_test.patient_id = '$id' AND patient_test.doc_id = '".$us."' AND app_id = '$appid'");

	if($data){
		return $data;
	}
	//$data = mysqli_num_rows($data);

}

function seenPatients(){
	//include('config.php');
	$date = DATE("Y-m-d");
	$us = session()->get('user.userId');
	$DocDetails= DB::select("select count( distinct appid) as total from appointments a join prescriptions on prescriptions.app_id = a.appid  where date(updateOn) = '$date' and date(prescription_date) = '$date' and a.doc_id = '".$us."' and status = 1 group by appid");
	//$Docdata = mysqli_num_rows($DocDetails);
	if($DocDetails){
	 foreach($DocDetails as $row){
		 $seen = $row->total;
	 }
	return $seen;
	}
}

function getTest(){
	//include('config.php');

	$Test = DB::select("SELECT Test_ID,Name FROM test");
	if($Test){
		return $Test;
	}

}

function getTests($test_id){
	include('config.php');

	$Test = mysqli_query($link,"SELECT tests_id , test_name FROM tests WHERE test_id = '$test_id'");

	return $Test;

}

function doc_userPrescriptionDetails($p_id,$id){

		//include( $_SERVER['DOCUMENT_ROOT']."/afyapepe/config.php");

		$Patient = DB::select("SELECT p.presc_id,patient_id, facility_name, p.drug_id,drugname,available,DosageForm, dosage, dose_given, notes, outlet_id, DATE(date) AS date FROM prescription_filled_status p INNER JOIN drugslist ON drugslist.id = p.drug_id INNER JOIN prescriptions ON prescriptions.presc_id = p.presc_id INNER JOIN appointments ON appointments.patientid = prescriptions.patient_id INNER JOIN facilities ON facilities.facilitycode = p.outlet_id WHERE prescriptions.filled_status IN (0,1,2,NULL) AND app_id = '$id' AND patient_id = '$p_id'");

		if($Patient === FALSE) {
			die('Error: ' . mysqli_error());
			}
			else {
				return $Patient;

			}
}

function doc_userTest($p_id, $appid){
	//include( $_SERVER['DOCUMENT_ROOT']."/afyapepe/config.php");


	$data = DB::select("SELECT app_id,patient_test.patient_id,pd.patient_test_id, test.name, test_name, pd.test_id,notes,done,outlet_id,facilityname,results,  DATE(pd.dateUpdated) FROM patient_test_details pd INNER JOIN patient_test ON patient_test.patient_test_id = pd.patient_test_id INNER JOIN tests ON tests.tests_id = pd.test_id LEFT JOIN test ON test.test_id = tests.test_id LEFT JOIN facilities ON facilities.facilitycode = pd.outlet_id INNER JOIN appointments ON appointments.patientid = patient_test.patient_id WHERE app_id = '$appid' AND patient_id = '$p_id'");
	if($data === FALSE) {
			die('Error: ' . mysqli_error());
			}
			else {
				return $data;

			}

}
}

?>
