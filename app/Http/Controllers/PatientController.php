<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Doctor;
use Carbon\Carbon;
use Auth;

use App\Patient;
class PatientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('patient.home');
    }
    public function patientAllergies(){

      return view('patient.patientallery');
    }

    public function Prescription(){
      return view('patient.prescription');

    }
    public function Test(){
      return view('patient.test');

    }
    public function Admission(){
      return view('patient.admision');
    }
    public function patientAppointment(){
      return view('patient.appointment');
    }
    public function patientCalendar(){
      return view('patient.calendar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showpatient($id)

     {


       $patientdetails = DB::table('appointments')
          ->Join('facilities', 'appointments.facility_id', '=', 'facilities.FacilityCode')
          ->Join('patients', 'appointments.patient_id', '=', 'patients.id')
          ->Join('afya_users', 'patients.afya_user_id', '=', 'afya_users.id')
          ->Join('triage_details', 'patients.id', '=', 'triage_details.patient_id')
          ->select('afya_users.*','triage_details.*','triage_details.id as triage_id','patients.*','patients.id as pat_id','appointments.id as app_id','appointments.facility_id','appointments.created_at','facilities.FacilityName')
          ->where('appointments.id',$id)
          ->get();


      $tstdone = DB::table('patient_test')
      ->Join('patient_test_details','patient_test.patient_id', '=', 'patient_test_details.patient_id')
      ->select('patient_test_details.*','patient_test.test_reccommended','patient_test.appointment_id')
      ->where('patient_test.appointment_id', '=',$id)
      ->get();

  return view('doctor.show')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails);
}

public function pvisit($id)
{
  $patientvisit = DB::table('afya_users')
  ->Join('patients','afya_users.id', '=', 'patients.afya_user_id')
  ->Join('appointments','patients.id', '=', 'appointments.patient_id')
  ->Join('constituency','patients.constituency_id', '=', 'constituency.const_id')
  ->Join('kin_details','afya_users.id', '=', 'kin_details.afya_user_id')
  ->Join('kin','kin_details.relation', '=', 'kin.id')
  ->Join('triage_details','patients.id', '=', 'triage_details.patient_id')
  ->select('patients.*','afya_users.*','appointments.*','kin_details.*','triage_details.*','constituency.constituency'
  ,'kin.relation')
  ->where('appointments.id', '=',$id)
  ->get();
return view('doctor.visit')->with('patientvisit',$patientvisit);;
}


}
