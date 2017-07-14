<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Doctor;
use Carbon\Carbon;
use Auth;
use App\Patient;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
      $today = Carbon::today();
         $doc_id = DB::table('facility_doctor')
         ->select('doctor_id')->where('user_id', Auth::user()->id)
         ->first();

    $doctor_id=$doc_id->doctor_id;
       $patients = DB::table('appointments')
       ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
        ->leftJoin('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
       ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
        ->leftJoin('dependant', 'triage_infants.dependant_id', '=', 'dependant.id')
         ->leftJoin('constituency', 'afya_users.constituency', '=', 'constituency.id')
         ->select('afya_users.*','triage_details.*','appointments.id as appid',
          'appointments.created_at','appointments.facility_id','constituency.Constituency',
          'appointments.persontreated', 'appointments.appointment_made',
          'triage_infants.weight as Infweight','triage_infants.height as Infheight','triage_infants.temperature as Inftemp',
         'triage_infants.chief_compliant as Infcompliant','triage_infants.systolic_bp as Infsysto','triage_infants.diastolic_bp as Infdiasto',
          'triage_infants.observation as Infobservation','triage_infants.symptoms as Infsymptoms','triage_infants.nurse_notes as Infnotes',
          'dependant.firstName as Infname','dependant.secondName as InfName','dependant.gender as Infgender','dependant.blood_type as Infblood_type',
          'dependant.dob as Infdob','dependant.pob as Infpob'
        )

   ->where([      ['appointments.created_at','>=',$today],
                 ['appointments.status', '=', 2],
                 ['appointments.doc_id', '=',$doctor_id],
                ])
 ->orWhere([
               ['appointments.date_present','>=',$today],
               ['appointments.status', '=', 2],
               ['appointments.doc_id', '=',$doctor_id],
             ])
->get();

return view('doctor.newPatients')->with('patients',$patients);
     }
     public function pending(){
    $today = Carbon::today();
    $doc_id = DB::table('facility_doctor')
    ->select('doctor_id')->where('user_id', Auth::user()->id)
    ->first();

    $doctor_id=$doc_id->doctor_id;
    $patients = DB::table('appointments')
    ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
    ->leftJoin('triage_details', 'appointments.last_app_id', '=', 'triage_details.appointment_id')
    ->leftJoin('triage_infants', 'appointments.last_app_id', '=', 'triage_infants.appointment_id')
    ->leftJoin('dependant', 'triage_infants.dependant_id', '=', 'dependant.id')
    ->leftJoin('constituency', 'afya_users.constituency', '=', 'constituency.id')
    ->select('afya_users.*','triage_details.*','appointments.id as appid',
     'appointments.created_at','appointments.facility_id','constituency.Constituency',
     'appointments.persontreated', 'appointments.appointment_made','appointments.last_app_id',
     'triage_infants.weight as Infweight','triage_infants.height as Infheight','triage_infants.temperature as Inftemp',
    'triage_infants.chief_compliant as Infcompliant','triage_infants.systolic_bp as Infsysto','triage_infants.diastolic_bp as Infdiasto',
     'triage_infants.observation as Infobservation','triage_infants.symptoms as Infsymptoms','triage_infants.nurse_notes as Infnotes',
     'dependant.firstName as Infname','dependant.secondName as InfName','dependant.gender as Infgender','dependant.blood_type as Infblood_type',
     'dependant.dob as Infdob','dependant.pob as Infpob'
    )

    ->where([ ['appointments.created_at','<=',$today],
            ['appointments.p_status', '=', 11],
            ['appointments.doc_id', '=',$doctor_id],
           ])
     ->orwhere([ ['appointments.created_at','>=',$today],
             ['appointments.p_status', '=', 11],
             ['appointments.doc_id', '=',$doctor_id],
            ])

    ->get();
return view('doctor.pendingPatients')->with('patients',$patients);
     }
public function dependant()

{
 $today = Carbon::today();

  $patients = DB::table('appointments')
  ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
  ->leftJoin('facility_doctor', 'appointments.doc_id', '=', 'facility_doctor.doctor_id')
->leftJoin('doctors', 'appointments.doc_id', '=', 'doctors.id')
  ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
  ->leftJoin('afya_users', 'dependant.afya_user_id', '=', 'afya_users.id')
  ->leftJoin('constituency', 'afya_users.constituency', '=', 'constituency.id')
  ->select('triage_infants.*','dependant.*','appointments.*','appointments.id as appid',
  'afya_users.firstname','afya_users.secondName as ndName','afya_users.constituency','constituency.Constituency')
  ->where([
                  ['appointments.created_at','>=',$today],
                  ['appointments.status', '=', 2],
                  ['facility_doctor.user_id', '=',Auth::user()->id],
                 ])
    ->get();

  return view('doctor.newdependant')->with('patients',$patients);
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('doctor.create');
    }


  public function Calendar(){
      return view('doctor.calendar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

        {
          $this->validate($request, [
          'name' => 'required',
          'user_id' => 'required',
          'regno' => 'required|unique:doctors,RegNo',
          'address' => 'required',
          'phone' => 'required',
          'residence' => 'required',
          'speciality' => 'required'
          ]);

     Doctor::create($request->all());


return redirect()->route('doctor.index')->with('success','User created successfully');

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function Admitted()
    {
      $today = Carbon::today();
      $patients = DB::table('appointments')
      ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
      ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
      ->leftJoin('facility_doctor', 'appointments.doc_id', '=', 'facility_doctor.doctor_id')
      ->leftJoin('doctors', 'appointments.doc_id', '=', 'doctors.id')
       ->leftJoin('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
       ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
       ->leftJoin('dependant', 'triage_infants.dependant_id', '=', 'dependant.id')
        ->leftJoin('constituency', 'afya_users.constituency', '=', 'constituency.id')
        ->select('afya_users.*','triage_details.*','appointments.id as appid',
         'appointments.created_at','appointments.facility_id','constituency.Constituency',
         'appointments.persontreated',
         'triage_infants.weight as Infweight','triage_infants.height as Infheight','triage_infants.temperature as Inftemp',
        'triage_infants.chief_compliant as Infcompliant','triage_infants.systolic_bp as Infsyst','triage_infants.diastolic_bp as Infdiast',
         'triage_infants.observation as Infobservation','triage_infants.symptoms as Infsymptoms','triage_infants.nurse_notes as Infnotes',
         'dependant.firstName as Infname','dependant.secondName as InfName','dependant.gender as Infgender','dependant.blood_type as Infblood_type',
         'dependant.dob as Infdob','dependant.pob as Infpob'
       )
   ->where
             ([
                   ['appointments.created_at','>=',$today],
                   ['appointments.status', '=', 2],
                   ['patient_admitted.condition', '=','Admitted'],
                   ['facility_doctor.user_id', '=',Auth::user()->id],
                  ])
        ->get();

      return view('doctor.patientadmitted')->with('patients',$patients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function DocDetails(){

      $uid = Auth::user()->id;
      $DocDetails = DB::table('facility_doctor')
      ->leftJoin('doctors', 'facility_doctor.doctor_id', '=', 'doctors.id')
      ->where('facility_doctor.user_id', '=', Auth::user()->id)->get();
     return $DocDetails;
}
}
