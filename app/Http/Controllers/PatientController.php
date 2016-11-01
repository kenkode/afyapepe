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
     $patientdetails = DB::table('patients')
        ->Join('appointments', 'patients.id', '=', 'appointments.PatientId')
        ->Join('facilities', 'appointments.Facility_ID', '=', 'facilities.FacilityCode')
        ->Join('afya_users', 'patients.afya_user_id', '=', 'afya_users.id')
        ->Join('triage_details', 'patients.id', '=', 'triage_details.patient_id')
        ->select('patients.*', 'afya_users.*','triage_details.*','appointments.AppID','appointments.Facility_ID','appointments.Appointment_Date','facilities.FacilityName')
       ->where('patients.id',$id)
       ->get();

       $triageDetails = DB::table('triage_details')
       ->where('patient_id',$id)
      ->get();
      return view('doctor.show')->with('triageDetails',$triageDetails)->with('patientdetails',$patientdetails);;


     }

}
