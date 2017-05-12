<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Doctor;
use Carbon\Carbon;
use Auth;

use App\Patient;
use App\Facility;
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
      $id = Auth::id();
      $patient=DB::table('afya_users')->where('users_id',$id)->first();
      $nextkin=DB::table('kin_details')
      ->join('kin','kin.id','=','kin_details.relation')
      ->select('kin_details.kin_name','kin_details.phone_of_kin',
        'kin.relation')->where('afya_user_id',$patient->id)->
      orderBy('created_at','desc')->first();
        return view('patient.home')->with('patient',$patient)->with('nextkin',$nextkin);
    }
    public function patientAllergies(){
      $id = Auth::id();
      $patient=DB::table('afya_users')->where('users_id',$id)->first();
      return view('patient.patientallery')->with('patient',$patient);
    }

  public function Expenditure(){
    $id = Auth::id();
      $patient=DB::table('afya_users')->where('users_id',$id)->first();

    return view('patient.expenditure')->with('patient',$patient);
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
       ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
       ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
       ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
       ->select('appointments.*','afya_users.dob','afya_users.firstname','afya_users.secondName','afya_users.gender',
         'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
         'dependant.dob as depdob','facilities.FacilityName')
       ->where('appointments.id',$id)
       ->get();


  return view('doctor.show')->with('patientdetails',$patientdetails);
}

public function history($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','afya_users.dob','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.history')->with('patientD',$patientD);
}

public function facilitiesList(){
  $facilityList = Facility::lists('FacilityCode', 'FacilityName');

return  compact('facilityList');
}


}
