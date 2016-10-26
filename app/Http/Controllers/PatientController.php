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
        ->select('patients.*', 'appointments.Facility_ID','appointments.Appointment_Date','facilities.FacilityName')
       ->where('patients.id',$id)
       ->get();
        return view('doctor.show', ['patientdetails' => $patientdetails]);


     }

}
