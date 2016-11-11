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
         ->Join('facilities', 'appointments.facility_id', '=', 'facilities.FacilityCode')
          ->Join('patients', 'appointments.patient_id', '=', 'patients.id')
          ->Join('afya_users', 'patients.afya_user_id', '=', 'afya_users.id')
          ->Join('triage_details', 'patients.id', '=', 'triage_details.patient_id')
          ->select('afya_users.*','triage_details.*','patients.*','patients.id as pat_id','appointments.id as app_id','appointments.facility_id','appointments.created_at','facilities.FacilityName')
          ->where('appointments.id',$id)
          ->get();

      //  $triageDetails = DB::table('triage_details')
      // ->where('patient_id',$id)
      // ->get();

      $tstdone = DB::table('patient_test')
      ->Join('patient_test_details','patient_test.patient_id', '=', 'patient_test_details.patient_id')
      ->select('patient_test_details.*','patient_test.test_reccommended','patient_test.appointment_id')
      ->where('patient_test.appointment_id', '=',$id)
      ->get();


      // $tstdone = DB::table('patient_test')
      // ->Join('patient_test_details','patient_test.id', '=', 'patient_test_details.patient_test_id')
      // ->Join('appointments','patient_test.id', '=', 'appointments.patient_id')
      // ->select('patient_test_details.*','appointments.id','patient_test.patient_id','patient_test.appointment_id')
      // ->where('patient_test.appointment_id', '=',$id)
      // ->get();

      return view('doctor.show')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails);;
}


}
