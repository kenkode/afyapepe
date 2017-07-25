<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;

class PatientTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testdata($id)
    {

      $patientD=DB::table('appointments')
      ->leftjoin('triage_details','appointments.id','=','triage_details.appointment_id')
      ->leftjoin('triage_infants','appointments.id','=','triage_infants.appointment_id')
   ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
    ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
    ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
      ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
      ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
        'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
        'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition',
        'triage_details.lmp as almp','triage_details.pregnant as apregnant','triage_infants.lmp as dlmp','triage_infants.pregnant as dpregnant')
      ->where('appointments.id',$id)
      ->get();



      return view('doctor.test')->with('patientD',$patientD);


    }
    public function destroytest($id)
    {
      $pttd=DB::table('patient_test_details')
      ->where('id',$id)
      ->first();
      DB::table("patient_test_details")->where('id',$id)->delete();

return redirect()->route('testes',$pttd->appointment_id);
}

public function diagnoses($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();


  return view('doctor.diagnosis')->with('patientD',$patientD);


}
public function diagnosesconf(Request $request)
{
 $appointment=$request->get('appointment_id');
 $pat_details_id = $request->get('pat_details_id');

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','patient_admitted.condition','facilities.set_up')
  ->where('appointments.id',$appointment)
  ->get();

  $patientT=DB::table('patient_test_details')
  ->join('diagnoses','patient_test_details.conditional_diag_id','=','diagnoses.id')
  ->select('diagnoses.id','diagnoses.name','patient_test_details.id as ptdid','patient_test_details.tests_reccommended as ptest')
  ->where('patient_test_details.id', $pat_details_id)
  ->first();

  return view('doctor.diagnosisconfirm')->with('patientD',$patientD)->with('patientT',$patientT);
}
public function discharges($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
 ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.discharge')->with('patientD',$patientD);
}

public function admit($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();


  return view('doctor.admit')->with('patientD',$patientD);


}


public function transfer($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();

  return view('doctor.transfer')->with('patientD',$patientD);


}
public function disdiagnosis($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.disdiagnosis')->with('patientD',$patientD);
}

public function disprescription($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();

  $Pdiagnosis=DB::table('patient_diagnosis')
  ->leftjoin('diagnoses','patient_diagnosis.disease_id','=','diagnoses.id')
  ->leftjoin('severity','patient_diagnosis.severity','=','severity.id')
  ->select('diagnoses.name','patient_diagnosis.level','severity.name as severity','diagnoses.id')

  ->where([
                ['patient_diagnosis.appointment_id',$id],
                ['patient_diagnosis.state', '=', 'Discharge'],

               ])
  ->get();

  return view('doctor.disprescription')->with('patientD',$patientD)->with('Pdiagnosis',$Pdiagnosis);
}

  public function Testconfirm(Request $request){
          $appid = $request->appid;
          $ptdid = $request->ptdid;
          DB::table('patient_test_details')->where('id', $ptdid)
          ->update(['confirm' =>'Y']);

          // $appid = DB::table('patient_test_details')->where('id', $ptdid)
          // ->first();

          $tNY = DB::table('patient_test_details')
          ->where([['appointment_id','=', $appid],
          ['confirm','=', 'N'],])
          ->first();
        if ($tNY){
        return redirect()->route('testes',$appid);
        }else{
        return redirect()->route('medicines',$appid);
       }


      }




}
