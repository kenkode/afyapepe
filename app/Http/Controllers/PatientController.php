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
        return view('patient.home');
    }
    public function patientAllergies(){

      return view('patient.patientallery');
    }

  public function Expenditure(){
    return view('patient.expenditure');
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
      ->where('appointment_id', '=',$id)
      ->get();

      // $tstdone = DB::table('patient_test_details')
      // ->Join('patient_test', 'patient_test_details.appointment_id', '=', 'patient_test.appointment_id')
      // ->Join('tests', 'patient_test.test_reccommended', '=', 'tests.id')
      // ->Join('diseases', 'patient_test.conditional_diagnosis', '=', 'diseases.short_desc')
      // ->select('patient_test_details.*','tests.name','diseases.short_desc')
      // ->where('patient_test_details.appointment_id', '=',$id)
      // ->get();
  return view('doctor.show')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails);
}

public function showhistory($id)

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
     ->where('appointment_id', '=',$id)
     ->get();

 $prescription = DB::table('prescriptions')
 ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
 ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
 ->Join('facilities','prescription_details.facility_id', '=', 'facilities.FacilityCode')
 ->select('prescriptions.*','prescriptions.created_at as pdate','prescription_details.*','druglists.drugname','facilities.FacilityName')
 ->where('prescriptions.appointment_id', '=',$id )
 ->orderBy('prescriptions.created_at', 'desc')
 ->get();

 // $prescription = DB::table('prescriptions')
 // ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
 // ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
 // ->Join('facilities','prescription_details.facility_id', '=', 'facilities.FacilityCode')
 // ->select('prescriptions.*','prescriptions.created_at as pdate','prescription_details.*','druglists.drugname','facilities.FacilityName')
 // ->where('prescriptions.appointment_id', '=',$id)
 // ->get();

return view('doctor.showhistory')->with('tstdone',$tstdone)->with('patientdetails',$patientdetails)->with('prescription',$prescription);
}
public function pvisit($id)
{
  $patientvisit = DB::table('afya_users')

  ->Join('appointments','afya_users.id', '=', 'appointments.afya_user_id')
  ->Join('kin_details','afya_users.id', '=', 'kin_details.afya_user_id')
  ->Join('constituency','afya_users.constituency', '=', 'constituency.const_id')
  ->Join('kin','kin_details.relation', '=', 'kin.id')
  ->Join('triage_details','appointments.id', '=', 'triage_details.appointment_id')
  ->select('afya_users.*','appointments.*','kin_details.*','triage_details.*','constituency.Constituency'
  ,'kin.relation')
  ->where('appointments.id', '=',$id )
  ->get();

  $tstdone = DB::table('patient_test')
  ->Join('patient_test_details','patient_test.appointment_id', '=', 'patient_test_details.appointment_id')
  ->select('patient_test_details.*','patient_test.test_reccommended','patient_test.appointment_id')
  ->where('patient_test.appointment_id', '=',$id)
  ->get();

  $prescription = DB::table('prescriptions')
  ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
  ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
  ->Join('facilities','prescription_details.facility_id', '=', 'facilities.FacilityCode')
  ->select('prescriptions.*','prescriptions.created_at as pdate','prescription_details.*','druglists.drugname','facilities.FacilityName')
  ->where('prescriptions.appointment_id', '=',$id)
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
