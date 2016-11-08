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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function showpatient($id)

     {
       $patientdetails = DB::table('appointments')
         ->Join('facilities', 'appointments.Facility_ID', '=', 'facilities.FacilityCode')
          ->Join('patients', 'appointments.PatientId', '=', 'patients.id')
          ->Join('afya_users', 'patients.afya_user_id', '=', 'afya_users.id')
          ->Join('triage_details', 'patients.id', '=', 'triage_details.patient_id')
          ->select('afya_users.*','triage_details.*','patients.*','appointments.AppID','appointments.Facility_ID','appointments.Appointment_Date','facilities.FacilityName')
          ->where('appointments.AppID',$id)
          ->get();

      //  $triageDetails = DB::table('triage_details')
      // ->where('patient_id',$id)
      // ->get();

      $tstdone = DB::table('patient_test')
      ->Join('patient_test_details','patient_test.id', '=', 'patient_test_details.patient_test_id')
      ->Join('appointments','patient_test.id', '=', 'appointments.PatientID')
      ->select('patient_test_details.*','appointments.AppID','patient_test.patient_id','patient_test.appointment_id')
      ->where('patient_test.appointment_id', '=',$id)
      ->get();

      return view('doctor.show')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails);;
}


}
