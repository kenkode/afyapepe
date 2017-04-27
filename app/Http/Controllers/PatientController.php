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
        ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
        ->leftJoin('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
    ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
    // ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
        ->leftJoin('facilities', 'appointments.facility_id', '=', 'facilities.FacilityCode')
        ->select('afya_users.*','afya_users.id as afyaId','triage_details.*','triage_details.id as triage_id',
         'appointments.id as app_id','appointments.status as appstatus','appointments.facility_id',
           'appointments.created_at','facilities.FacilityName','facilities.FacilityCode',
           'appointments.persontreated',

           'dependant.id as Infid','dependant.firstName as Infname','dependant.secondName as InfName','dependant.gender as Infgender','dependant.blood_type as Infblood_type',
           'dependant.dob as Infdob','dependant.pob as Infpob')
       ->where('appointments.id',$id)
       ->get();


  $products = DB::table('products')
->get();

      $prescription = DB::table('prescriptions')
      ->Join('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
      ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
      // ->Join('patient_diagnosis','prescriptions.appointment_id', '=', 'patient_diagnosis.appointment_id')
      // ->Join('diagnoses','patient_diagnosis.disease_id', '=', 'diagnoses.id')
      ->select('prescription_details.created_at as pdate','prescription_details.*','druglists.drugname')
      ->where('prescriptions.appointment_id', '=',$id)
      ->get();

  return view('doctor.show')->with('patientdetails',$patientdetails)
  ->with('prescription',$prescription)->with('products',$products);
}

public function history($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.history')->with('patientD',$patientD);
}
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

  $tstdone = DB::table('patient_test')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
  ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
  ->leftJoin('patient_cond_diagnosis', 'patient_test.appointment_id', '=', 'patient_cond_diagnosis.appointment_id')
  ->Join('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
  ->Join('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
  ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
  ->where('patient_test.appointment_id', '=',$id)
  ->get();

  $prescription = DB::table('prescriptions')
  ->leftJoin('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
  ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
  ->Join('diseases','prescription_details.diagnosis', '=', 'diseases.code')
  ->select('prescription_details.created_at as pdate','prescription_details.*','druglists.drugname','diseases.name')
  ->where('prescriptions.appointment_id', '=',$id)
  ->get();
return view('doctor.visit')->with('patientvisit',$patientvisit)
                           ->with('tstdone',$tstdone)
                           ->with('prescription',$prescription);
}
public function dependantvisit($id)
{
  $patientvisit = DB::table('triage_infants')

  ->leftJoin('appointments','triage_infants.appointment_id', '=', 'appointments.id')
  ->leftJoin('dependant','triage_infants.dependant_id', '=', 'dependant.id')
  ->select('dependant.*','appointments.*','triage_infants.*')
  ->where('triage_infants.appointment_id', '=',$id )
  ->get();

  $tstdone = DB::table('patient_test')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
  ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
  ->leftJoin('patient_cond_diagnosis', 'patient_test.appointment_id', '=', 'patient_cond_diagnosis.appointment_id')
  ->Join('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
  ->Join('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
  ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
  ->where('patient_test.appointment_id', '=',$id)
  ->get();

  $prescription = DB::table('prescriptions')
  ->leftJoin('prescription_details','prescriptions.id', '=', 'prescription_details.presc_id')
  ->Join('druglists','prescription_details.drug_id', '=', 'druglists.id')
  ->Join('diseases','prescription_details.diagnosis', '=', 'diseases.code')
  ->select('prescription_details.created_at as pdate','prescription_details.*','druglists.drugname','diseases.name')
  ->where('prescriptions.appointment_id', '=',$id)
  ->get();
return view('doctor.depvisit')->with('patientvisit',$patientvisit)
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
