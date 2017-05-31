<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use Carbon\Carbon;
use App\Observation;
use App\Symptom;
use App\Chief;

class privateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $today = Carbon::today();
      $facilitycode=DB::table('facility_doctor')->where('user_id', Auth::id())->first();
      $patients = DB::table('appointments as app')
        ->Join('afya_users as par', 'app.afya_user_id', '=', 'par.id')
        ->leftjoin('dependant as dep','app.persontreated','=','dep.id')
        ->select('par.id as parid','par.firstname as first','par.secondName as second','par.gender as gender','par.dob as dob','dep.id as depid','dep.firstName as dfirst','dep.secondName as dsecond','dep.dob as ddob',
            'dep.gender as dgender','app.created_at as created_at','app.persontreated as persontreated')
        ->where('app.status','=',2)
        ->where('app.created_at','>=',$today)
        ->where('app.facility_id',$facilitycode->facilitycode)
        ->get();

        return view('private.index')->with('patients',$patients);
    }
    public function selectChoice($id){

      return view('registrar.selects')->with('id',$id);
    }
    public function   showUser($id){

      $user=DB::table('afya_users')->where('id',$id)->first();
      return view('registrar.shows')->with('user',$user);
    }
    
    public function consultationFees(Request $request){
      $id=$request->id;
      $descr=$request->descr;
      $type=$request->type;
      $mode=$request->mode;
      $amount=$request->amount;
      $facility=$request->facility;

      $facilitycode=DB::table('facility_registrar')->where('user_id', Auth::id())->first(); 


      DB::table('consultation_fees')->insert(
      ['afyauser_id' => $id,
      'fee_required'=>$type,
      'payments_method'=> $mode,
      'amount'=> $amount,
      'facility'=>$facility,
      'person_treated'=>'Self',
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
  $phone=DB::Table('afya_users')->where('id',$id)->select('msisdn')->first();
  DB::table('afyamessages')->where('msisdn',$phone->msisdn)->
  update([
 'status' => 1,
 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

 DB::table('patients')->insert(
 ['afya_user_id' => $id,
 'status'=>1,
 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
 DB::table('appointments')->insert([
  'status'=>2,
  'facility_id'=>$facilitycode->facilitycode,
  'afya_user_id'=>$id,
  'persontreated'=>'Self',
  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()


  ]);

   return redirect()->action('RegistrarController@index');
    }


    public function selectDependant($id){

     
            return view('registrar.showdependants')->with('id',$id);
    }

public function Dependentconsultationfee(Request $request){
  $facilitycode=DB::table('facility_registrar')->where('user_id', Auth::id())->first();
   $today = date('Y-m-d');
      $id=$request->id;
        $type=$request->type;
        $afyauser=$request->afya_user;
      $mode=$request->mode;
      $amount=$request->amount;
      $user=$request->afya_user;
  DB::table('appointments')->insert([
  'status'=>2,
  'facility_id'=>$facilitycode->facilitycode,
  'afya_user_id'=>$user,
  'persontreated'=>$id,
  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()


  ]);
  $phone=DB::Table('afya_users')->where('id',$user)->select('msisdn')->first();
  DB::table('afyamessages')->where('msisdn',$phone->msisdn)->where('created_at','>=',$today)->
  update([
 'status' => 1,
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

   DB::table('consultation_fees')->insert(
      ['afyauser_id' => $afyauser,
      'dependent_id'=>$id,
      'fee_required'=>$type,
      'payments_method'=> $mode,
      'amount'=> $amount,
      'person_treated'=>'Dependent',
      'facility'=>$facilitycode->facilitycode,
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
   return redirect()->action('RegistrarController@index');

 }


 public function Fees(){
  $facility=DB::table('facility_doctor')->where('user_id', Auth::id())->first(); 
   $fees=DB::table('consultation_fees')->
   join('afya_users','consultation_fees.afyauser_id','=','afya_users.id')->where('fee_required','=','Yes')
   ->where('facility',$facility->facilitycode)
   ->select('consultation_fees.*','afya_users.firstname','afya_users.secondName')->
   orderby('consultation_fees.created_at','desc')->get();

   return view('private.consultationfees')->with('fees',$fees)->with('facility',$facility);
 }

public function createDetails(Request $request)

 {
        $id=$request->id;
        $weight=$request->weight;
        $heightS=$request->current_height;
        $temperature=$request->temperature;
        $systolic=$request->systolic;
        $diastolic=$request->diastolic;
        $allergies=$request->allergies;
        $chiefcompliant=$request->chiefcompliant;
        $observation=$request->observation;
        $symptoms=$request->symptoms;
        $nurse=$request->nurse;
        $doctor=$request->doctor;
            
      
       



$drugs=$request->drugs;
if($drugs){
foreach($drugs as $key =>$drug) {
     DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
   
    'allergies_type_id'=>$drug,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $foods=$request->foods;
 if($foods){
foreach($foods as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
   
    'allergies_type_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $latexs=$request->latexs;
 if($latexs){
foreach($latexs as $key) {
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
   
    'allergies_type_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

 $molds=$request->molds;
 if($molds){
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    
    'allergies_type_id'=>$molds,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
$pets=$request->pets;
if($pets)
{
foreach($pets as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    
    'allergies_type_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

$pollens=$request->pollens;
if($pollens) {   
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Pollen Allergy',
    'allergies_type_id'=>$pollens,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}

$insects=$request->insects;
if($insects)
{
foreach($insects as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
   
    'allergies_type_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}


$chiefcompliant = implode(',', $chiefcompliant);
$symptoms= implode(',', $symptoms);
$observation= implode(',', $observation);
$appointment=DB::table('appointments')->where('afya_user_id', $id)->where('status',2)->orderBy('created_at', 'desc')->first();

    DB::table('triage_details')->insert(
    ['appointment_id' => $appointment->id,
    'current_weight'=> $weight,
    'current_height'=>$heightS,
    'temperature'=>$temperature,
    'systolic_bp'=>$systolic,
    'diastolic_bp'=>$diastolic,
    'chief_compliant'=>$chiefcompliant,
    'observation'=>$observation,
    'symptoms'=>$symptoms,
    'nurse_notes'=>$nurse,
    'Doctor_note'=>'',
    'prescription'=>'',
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]

);
 DB::table('appointments')->where('id',$appointment->id)->update([
    'doc_id'=>$doctor]);



        return redirect()->action('privateController@index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient= DB::table('afya_users')
        ->where('afya_users.id',$id)
        ->first();

        $kin=DB::table('kin_details')
        ->Join('kin','kin_details.relation','=','kin.id')
        ->select('kin_details.*', 'kin.relation')
        ->where('kin_details.afya_user_id',$id)
        ->first();
        $details=DB::table('triage_details')
        ->Join('appointments','appointments.id','=','triage_details.appointment_id')
        ->where('appointments.afya_user_id',$id)
        ->select('triage_details.*')
        ->orderBy('triage_details.id','desc')
        ->get();

        $vaccines =DB::table('vaccination')
          ->Join('vaccine','vaccination.diseaseId','=','vaccine.id')
          ->select('vaccination.*', 'vaccine.*')
          ->where('vaccination.yes','=','yes')
          ->where('vaccination.userId',$id)
          ->get();
          return view('private.nurse')->with('patient',$patient)->with(['vaccines'=>$vaccines,'kin'=>$kin,'details'=>$details]);
    }

    public function nurseVitals($id){

        return view('private.nursevitals')->with('id',$id);
    }

     public function fobservation(Request $request){
         $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = Observation::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->name, 'text' => $drug->name];
         }
     return \Response::json($formatted_drugs);
     }
      public function fsymptom(Request $request){
         $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = Symptom::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->name, 'text' => $drug->name];
         }
     return \Response::json($formatted_drugs);
     }
     public function fchief(Request $request){
         $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = Chief::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->name, 'text' => $drug->name];
         }
     return \Response::json($formatted_drugs);
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
}
