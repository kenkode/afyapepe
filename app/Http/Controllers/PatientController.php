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
        ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
        ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
        ->Join('facilities', 'appointments.facility_id', '=', 'facilities.FacilityCode')
        ->select('afya_users.*','triage_details.*','triage_details.id as triage_id',
         'appointments.id as app_id','appointments.status as appstatus','appointments.facility_id',
           'appointments.created_at','facilities.FacilityName','facilities.FacilityCode')
       ->where('appointments.id',$id)
       ->get();



      $tstdone = DB::table('patient_test_details')
      ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
      ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
      ->leftJoin('diseases', 'patient_test_details.conditional_diagnosis', '=', 'diseases.code')
      ->select('patient_test_details.*','facilities.*','tests.name','diseases.name as disease')
      ->where('patient_test_details.appointment_id', '=',$id)
      ->get();

      $prescription = DB::table('prescription_details')
      // ->leftJoin('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
      ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
      ->Join('diseases','prescription_details.diagnosis', '=', 'diseases.code')
      ->select('prescription_details.created_at as pdate','prescription_details.*','druglists.drugname','diseases.name')
      ->where('prescription_details.appointment_id', '=',$id)
      ->get();
  return view('doctor.show')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails)->with('prescription',$prescription);
}

// public function showhistory($id)
//
// {
//
//
//   $patientdetails = DB::table('appointments')
//   ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
//   ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
//   ->Join('facilities', 'appointments.facility_id', '=', 'facilities.FacilityCode')
//   ->select('afya_users.*','triage_details.*','triage_details.id as triage_id',
//   'appointments.id as app_id','appointments.status as appstatus','appointments.facility_id',
//   'appointments.created_at','facilities.FacilityName','facilities.FacilityCode')
//   ->where('appointments.id',$id)
//   ->get();
//
//      $tstdone = DB::table('patient_test_details')
//      ->where('appointment_id', '=',$id)
//      ->get();
//
//  $prescription = DB::table('prescriptions')
//  ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
//  ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
//  ->Join('facilities','prescription_details.facility_id', '=', 'facilities.FacilityCode')
//  ->select('prescriptions.*','prescriptions.created_at as pdate','prescription_details.*','druglists.drugname','facilities.FacilityName')
//  ->where('prescriptions.appointment_id', '=',$id )
//  ->orderBy('prescriptions.created_at', 'desc')
//  ->get();
//
//  // $prescription = DB::table('prescriptions')
//  // ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
//  // ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
//  // ->Join('facilities','prescription_details.facility_id', '=', 'facilities.FacilityCode')
//  // ->select('prescriptions.*','prescriptions.created_at as pdate','prescription_details.*','druglists.drugname','facilities.FacilityName')
//  // ->where('prescriptions.appointment_id', '=',$id)
//  // ->get();
//
// return view('doctor.showhistory')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails)->with('prescription',$prescription);
// }
public function pvisit($id)
{
  $patientvisit = DB::table('afya_users')

  ->leftJoin('appointments','afya_users.id', '=', 'appointments.afya_user_id')
  ->leftJoin('kin_details','afya_users.id', '=', 'kin_details.afya_user_id')
  ->leftJoin('constituency','afya_users.constituency', '=', 'constituency.const_id')
  ->leftJoin('kin','kin_details.relation', '=', 'kin.id')
  ->leftJoin('triage_details','appointments.id', '=', 'triage_details.appointment_id')
  ->select('afya_users.*','appointments.*','kin_details.*','triage_details.*','constituency.Constituency'
  ,'kin.relation')
  ->where('appointments.id', '=',$id )
  ->get();

  $tstdone = DB::table('patient_test_details')
  ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
  ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->leftJoin('diseases', 'patient_test_details.conditional_diagnosis', '=', 'diseases.code')
  ->select('patient_test_details.*','facilities.*','tests.name','diseases.name as disease')
  ->where('appointment_id', '=',$id)
  ->get();

  $prescription = DB::table('prescription_details')
  // ->leftJoin('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
  ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
  ->Join('diseases','prescription_details.diagnosis', '=', 'diseases.code')
  ->select('prescription_details.created_at as pdate','prescription_details.*','druglists.drugname','diseases.name')
  ->where('prescription_details.appointment_id', '=',$id)
  ->get();
return view('doctor.visit')->with('patientvisit',$patientvisit)
                           ->with('tstdone',$tstdone)
                           ->with('prescription',$prescription);
}

public function PatientNotes(Request $request)

{

  DB::table('patientNotes')->insert([
      'patient_id'  => $request->get('patient_id'),
      'appointment_id'  => $request->get('appointment_id'),
      'appointment_status' => $request->get('appointment_status'),
      'note'  => $request->get('note'),
      'facility'  => $request->get('facility'),
  ]);

$appid =$request['appointment_id'];
$appstatus =$request['appointment_status'];
       DB::table('appointments')
                 ->where('id',$appid)
                 ->update(['status'=>$appstatus]);
 return redirect()->route('showPatient', ['id' => $appid]);
}

public function facilitiesList(){
  $facilityList = Facility::lists('FacilityCode', 'FacilityName');

return  compact('facilityList');
}


}
