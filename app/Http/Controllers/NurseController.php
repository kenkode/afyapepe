<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Observation;
use App\Symptom;
use Redirect;
use Carbon\Carbon;
use App\Http\Requests;
class NurseController extends Controller
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
    public function index(){
      $today = Carbon::today();
      $patients = DB::table('appointments as app')
        ->Join('afya_users as par', 'app.afya_user_id', '=', 'par.id')
        ->leftjoin('dependant as dep','app.persontreated','=','dep.id')
        ->select('par.id as parid','par.firstname as first','par.secondName as second','par.gender as gender','par.age as age','dep.id as depid','dep.firstName as dfirst','dep.secondName as dsecond','dep.age as dage',
            'dep.gender as dgender','app.created_at as created_at','app.persontreated as persontreated')
        ->where('app.status','=',1)
        ->where('app.created_at','>=',$today)
        ->get();
        return view('nurse.newpatient')->with('patients',$patients);
    }
    public function users()
    {
      $patients=DB::table('afya_users')->get();
      return view('nurse.home')->with('patients',$patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nurse.create');

    }

    public function immunination($id){

        

        return view('nurse.immunination')->with('id',$id);
    }

   public function storeImmunization(Request $request){
    $id=$request->id;
    $userid=$request->userid;
    $status=$request->status;
    $vaccinename=$request->vaccine_name;
    $vaccinedate=$request->vaccine_date;


     DB::table('dependant_vaccination')->where('id',$id)->update(
    ['status' => $status,
    'status_date' => $vaccinedate,
    'vaccin_name'=> $vaccinename,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);


return redirect()->action('NurseController@showDependents', [$userid]);

   }
   public function dependantAllergy(Request $request){
     $id=$request->id;
    $drugs=$request->drugs;
if($drugs){
foreach($drugs as $key =>$drug) {
     DB::table('patient_allergy')->insert([
    'dependant_id'=>$id,
    'allergy_id'=>$drug,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $foods=$request->foods;
 if($foods){
foreach($foods as $key) {
    DB::table('patient_allergy')->insert([
    'dependant_id'=>$id,
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $latexs=$request->latexs;
 if($latexs){
foreach($latexs as $key) {
   DB::table('patient_allergy')->insert([
    'dependant_id'=>$id,
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

 $molds=$request->molds;
 if($molds){
   DB::table('patient_allergy')->insert([
    'dependant_id'=>$id,
    'allergy_id'=>$molds,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
$pets=$request->pets;
if($pets)
{
foreach($pets as $key) {
    DB::table('patient_allergy')->insert([
   'dependant_id'=>$id,
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

$pollens=$request->pollens;
if($pollens) {   
   DB::table('patient_allergy')->insert([
    'dependant_id'=>$id,
    'allergy_id'=>$pollens,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}

$insects=$request->insects;
if($insects)
{
foreach($insects as $key) {
    DB::table('patient_allergy')->insert([
   'dependant_id'=>$id,
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 return redirect()->action('NurseController@showDependents', [$id]);
   }
public function babyDetails(Request $request){
    $id=$request->id;
    $dob=$request->admission_date;
    $ipno=$request->ipno;
    $gestation=$request->gestation;
    $temperature=$request->temperature;
    $apgar=$request->apgar;
    $birthweight=$request->birthweight;
    $weightnow=$request->weightnow;
    $bba=$request->bba;
    $bba_where=$request->bba_where;
    $delivery=$request->delivery;
    $resuscitation=$request->resuscitation;
    $rom=$request->rom;
    $vitamen=$request->vitamen;
    $prophylaxis=$request->prophylaxis;
    $babyproblem=$request->babyproblem;
    $revelantdrugs=$request->revelantdrugs;
    DB::table('infant_details')->insert(
    ['dependant_id' => $id,
     'admission_date'=>$dob,
     'ipno'=>$ipno,
     'gestation'=>$gestation,
     'temperature'=>$temperature,
     'apgar'=>$apgar,
     'birthweight'=>$birthweight,
     'weightnow'=>$weightnow,
     'bba'=>$bba,
     'bba_where'=>$bba_where,
     'delivery'=>$delivery,
     'resuscitation'=>$resuscitation,
     'rom'=>$rom,
     'vitamen'=>$vitamen,
     'prophylaxis'=>$prophylaxis,
     'babyproblem'=>$babyproblem,
     'revelantdrugs'=>$revelantdrugs,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
return redirect()->action('NurseController@showDependents', [$id]);
}
public function motherDetails(Request $request){
$id=$request->id;
$dob=$request->dob;
$gravidity=$request->gravidity;
$parity=$request->parity;
$blood_type=$request->blood_type;
$sublocation=$request->sublocation;
$hiv=$request->hiv;
$arvs=$request->arvs;
$vdrl=$request->vdrl;
$fever=$request->fever;
$antibiotics=$request->antibiotics;
$diabetes=$request->diabetes;
$tb=$request->tb;
$tb_type=$request->tb_type;
$tb_treatment=$request->tb_treatment;
$labour1=$request->labour1;
$labour2=$request->labour2;
$hypertention=$request->hypertention;
$aph=$request->aph;
$motherproblem=$request->motherproblem;
$revelantdrugs=$request->revelantdrugs;

$afyaid=DB::table('dependant')->where('id',$id)->first();

 DB::table('mother_details')->insert(
    ['dependant_id' => $id,
    'afya_user_id'=>$afyaid->afya_user_id,
    'gravity'=>$gravidity,
    'parity'=>$parity,
    'labour1'=>$labour1,
    'labour2'=>$labour2,
    'aph'=>$aph,
    'motherproblem'=>$motherproblem,
    'revelantdrugs'=>$revelantdrugs,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);


return redirect()->action('NurseController@showDependents', [$id]);

    
}
public function vitalDetails(Request $request){
$id=$request->id;
$cir=$request->cir;
$skin=$request->skin;
$jaundice=$request->jaundice;
$gest_size=$request->gest_size;
$umbilicus=$request->umbilicus;
$fever=$request->fevers;
$days=$request->days;
$difficultybreathing=$request->difficulty_breathing;
$diarrhoea=$request->diarrhoea;
$diarrhoeadays=$request->diarrhoea_days;
$diarrhoeabloody=$request->diarrhoea_bloody;
$vomiting=$request->vomiting;
$vomitinghours=$request->vomiting_hours;
$vomitseveything=$request->vomits_eveything;
$feedingdifficult=$request->feeding_difficult;
$convulsion=$request->convulsion;
$convulsionhours=$request->convulsion_hours;
$fits=$request->fits;
$apnoea=$request->apnoea;
$femoral=$request->femoral_pulse;
$refill=$request->refill;
$seconds=$request->seconds;
$murmur=$request->Murmur;
$murmuryes=$request->murmur_yes;
$pallor=$request->pallor;
$skincold=$request->skincold;
$stridor=$request->stridor;
$oxygen=$request->oxygen_saturation;
$cyanosis=$request->cyanosis;
$indrawing=$request->indrawing;
$grunting=$request->grunting;
$airentry=$request->air_entry;
$crackles=$request->crackles;
$cry=$request->cry;
 $weight=$request->weight;
        $heightS=$request->current_height;
        $temperature=$request->temperature;
        $systolic=$request->systolic;
        $diastolic=$request->diastolic;
        
        $chiefcompliant=$request->chiefcompliants;
        $observation=$request->observations;
        $symptoms=$request->symptoms;
        $nurse=$request->nurse;
        $doctor=$request->doctor;

        $chiefcompliant=implode(',', $chiefcompliant);
        $observation=implode(',',$observation );
        $symptoms=implode(',', $symptoms);
        
$appointment=DB::table('appointments')->where('persontreated', $id)->orderBy('created_at', 'desc')->first();
DB::table('triage_infants')->insert(
    ['appointment_id' => $appointment->id,
    'dependant_id'=>$id,
      'skin'=>$skin,
      'jaundice'=>$jaundice,
      'gest_size'=>$gest_size,
      'umbilicus'=>$umbilicus,
      'head_circum'=>$cir,
    'weight'=> $weight,
    'height'=>$heightS,
    'temperature'=>$temperature,
    'systolic_bp'=>$systolic,
    'diastolic_bp'=>$diastolic,
    'chief_compliant'=>$chiefcompliant,
    'observation'=>$observation,
    'symptoms'=>$symptoms,
    'nurse_notes'=>$nurse,
    'Doctor_notes'=>'',
     'fever'=>$fever,
    'fever_days'=>$days,
    'difficult_breathing'=>$difficultybreathing,
    'diarrhoea'=>$diarrhoea,
    'diarrhoea_day'=>$diarrhoeadays,
    'diarrhoea_bloody'=>$diarrhoeabloody,
    'vomiting'=>$vomiting,
    'vomiting_hours'=>$vomitinghours,
    'vomiting_everything'=>$vomitseveything,
    'difficult_feeding'=>$feedingdifficult,
    'convulsion'=>$convulsion,
    'convulsion_hours'=>$convulsionhours,
    'fits'=>$fits,
    'aponea'=>$apnoea,
    'femoral_pulse'=>$femoral,
    'refill'=>$refill,
    'seconds'=>$seconds,
    'murmur'=>$murmur,
    'murmur_yes'=>$murmuryes,
    'pallar'=>$pallor,
    'skincold'=>$skincold,
    'stridor'=>$stridor,
    'oxygen_saturation'=>$oxygen,
    'cynanosis'=>$cyanosis,
    'indrawing'=>$indrawing,
    'grunting'=>$grunting,
    'air_entry'=>$airentry,
    'crackles'=>$crackles,
    'cry'=>$cry,
  
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]

);


DB::table('appointments')->where('id',$appointment->id)->update([
    'status'=>2]);


        return redirect()->action('NurseController@index');

}

public function patientDisability(Request $request){
    $id=$request->id;
    $breastfeed=$request->breastfeed;
    $neck=$request->neck;
    $fontanelle=$request->fontanelle;
    $irritable=$request->irritable;
    $tone=$request->tone;

    if($breastfeed=="No"){

          DB::table('patient_disabilities')->insert(
    ['dependant_id' => $id,
    'name' =>'breastfeed',
    'notes'=> 'cant suck',
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);

    }

    if($fontanelle=="Yes"){
        DB::table('patient_disabilities')->insert(
    ['dependant_id' => $id,
    'name' =>'Bulging fontanelle',
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
    }
    if($irritable=="Yes"){
        DB::table('patient_disabilities')->insert(
    ['dependant_id' => $id,
    'name' =>'Irritable',
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
    }
    if($tone=="Yes"){
        DB::table('patient_disabilities')->insert(
    ['dependant_id' => $id,
    'name' =>'Reduced movement',
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
    }
    if($neck=="Yes"){
        DB::table('patient_disabilities')->insert(
    ['dependant_id' => $id,
    'name' =>'Stiff neck',
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
    }
 return redirect()->action('NurseController@showDependents', [$id]);
 


}
public function abnormalities(Request $request){
    $id=$request->id;
    $skull=$request->skull;
    $limbs=$request->limbs;
    $spine=$request->spine;
    $palate=$request->palate;
    $face=$request->face;
    $anus=$request->anus;
    $dysmorphic=$request->dysmorphic;

if($skull){
    $skulldescr=$request->skull_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $skull,
    'notes'=>$skulldescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($limbs){
    $limbsdescr=$request->limbs_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $limbs,
    'notes'=>$limbsdescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($spine){
    $spinedescr=$request->spine_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $spine,
    'notes'=>$spinedescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($palate){
    $palatedescr=$request->palate_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $palate,
    'notes'=>$palatedescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($face){
    $facedescr=$request->face_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $face,
    'notes'=>$facedescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($anus){
    $anusdescr=$request->anus_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $anus,
    'notes'=>$anusdescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
if($dysmorphic){
    $dysmorphicdescr=$request->dysmorphic_descr;
    DB::table('patient_abnormalities')->insert(
    ['dependant_id' => $id,
    'name' => $dysmorphic,
    'notes'=>$dysmorphicdescr,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}





return redirect()->action('NurseController@showDependents', [$id]);

}

   public function infantNutrition(Request $request){
    $id=$request->patient_id;
    $score=$request->muac;
     DB::table('dependant_nutrition_test')->insert(
    ['dependent_id' => $id,
    'score' =>$score,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);


return redirect()->action('NurseController@showDependents', [$id]);

   }

   public function updateInfant(Request $request){

    $id=$request->id;
    $breastfeed=$request->breastfeed;
    $neck=$request->neck;
    $bulging=$request->bulging;
    $tone=$request->tone;
    $umbilicus=$request->umbilicus;
    $skin=$request->skin;
    $jaundice=$request->jaundice;
    $size=$request->size;
    $abs=$request->abs;
    $dob=$request->dob;
    $ipno=$request->ipno;
    $detail=$request->abs_detail;
    $gestation=$request->gestation;
    $temperature=$request->temperature;
    $apgar=$request->apgar;
    $birthweight=$request->birthweight;
    $weightnow=$request->weightnow;
    $bba=$request->bba;
    $bba_where=$request->bba_where;
    $delivery=$request->delivery;
    $vitamink=$request->vitamen;
    $resuscitation=$request->resuscitation;
    $rom=$request->rom;
    $prophylaxis=$request->prophylaxis;
    $stridor=$request->stridor;
    $oxygen=$request->oxygen_saturation;
    $cyanosis=$request->cyanosis;
    $indrawing=$request->indrawing;
    $grunting=$request->grunting;
    $air_entry=$request->air_entry;
    $crackles=$request->crackles;
    $cry=$request->cry;
    $femoral_pulse=$request->femoral_pulse;
    $refill=$request->refill;
    $murmur=$request->Murmur;
    $anaemia=$request->anaemia;
    $skincold=$request->skin_cold;
    $age=$request->age;
    $gravidity=$request->gravidity;
    $parity=$request->parity;
    $blood_type=$request->blood_type;
    $sublocation=$request->sublocation;
    $hiv=$request->hiv;
    $arvs=$request->arvs;
    $vdrl=$request->vdrl;
    $fever=$request->fever;
    $antibiotics=$request->antibiotics;
    $diabetes=$request->diabetes;
    $tb=$request->tb;
    $tb_treatment=$request->tb_treatment;
    $labour1=$request->labour1;
    $labour2=$request->labour2;
    $hypertention=$request->hypertention;
    $aph=$request->aph;
    $babyproblem=$request->babyproblem;
    $motherproblem=$request->motherproblem;
    $revelantdrugs=$request->revelantdrugs;
    $oral=$request->oral;
    $lympn=$request->lympn;
    $difficultybreathing=$request->difficulty_breathing;
    $diarrhoea=$request->diarrhoea;
    $diarrhoeadays=$request->diarrhoea_days;
    $contact_tb=$request->contact_tb;
    $cough=$request->cough;
    $diarrhoeabloody=$request->diarrhoea_bloody;
    $vomiting=$request->vomiting;
    $vomitinghours=$request->vomiting_hours;
    $vomitseveything=$request->vomits_eveything;
    $feedingdifficult=$request->feeding_difficult;
    $convulsion=$request->convulsion;
    $convulsionhours=$request->convulsion_hours;
    $fits=$request->fits;
    $apnoea=$request->apnoea;
    $hypertension=$request->hypertention;
     DB::table('infants_details')->insert(
    ['dependant_id' => $id,
    'admission_date'=>$dob,
    'ipno'=>$ipno,
    'gestation'=>$gestation,
    'temperature'=>$temperature,
    'apgar'=>$apgar,
    'birth_weight'=>$birthweight,
    'weight_now'=>$weightnow,
    'bba'=>$bba,
    'bba_where'=>$bba_where,
    'delivery'=>$delivery,
    'resuscitation'=>$resuscitation,
    'rom'=>$rom,
    'vitamin_K'=>$vitamink,
    'prophylaxis'=>$prophylaxis,
    'breast_feed' => $breastfeed,
    'stiff_neck'=> $neck,
    'bulging_fontance' =>$bulging,
    'reduced_movement'  =>$tone,
     'umbilicus'=>$umbilicus,
     'skin'=>$skin,
     'jaundice'=>$jaundice,
     'gest_size'=>$size,
     'stridor'=>$stridor,
     'oxygen'=>$oxygen,
     'cyanosis'=>$cyanosis,
     'indrawing'=>$indrawing,
     'grunting'=>$grunting,
     'air_entry_bilateral'=>$air_entry,
     'crackles'=>$crackles,
     'femoral_pulse'=>$femoral_pulse,
     'cap_refill'=>$refill,
     'murmur'=>$murmur,
     'pallar_anaemia'=>$anaemia,
     'skin_cold'=>$skincold,
     'mother_age'=>$age,
     'mother_gravidity'=>$gravidity,
     'mother_parity'=>$parity,
     'mother_blood_group'=>$blood_type,
     'sublocation'=>$sublocation,
     'hiv_status'=>$hiv,
     'arvs'=>$arvs,
     'vdrl'=>$vdrl,
     'fever'=>$fever,
     'antibiotics'=>$antibiotics,
     'diabetes'=>$diabetes,
     'tb'=>$tb,
     'tb_treatment'=>$tb_treatment,
     '1_stage'=>$labour1,
     '2_stage'=>$labour2,
      'hypertension'=>$hypertension,
      'aph'=>$aph,
      'babies_problem'=>$babyproblem,
      'mother_problem'=>$motherproblem,
      'revelant_drug'=>$revelantdrugs,
      'oral_thrush'=>$oral,
      'lympn'=>$lympn,
      'difficult_breathing'=>$difficultybreathing,
      'diarrhoea'=>$diarrhoea,
      'diarrhoea_day'=>$diarrhoeadays,
      'contact_tb'=>$contact_tb,
      'chronic_cough'=>$cough,
      'diarrhoea_bloody'=>$diarrhoeabloody,
      'vomiting'=>$vomiting,
      'vomiting_hours'=>$vomitinghours,
      'vomiting_everything'=>$vomitseveything,
      'difficult_feeding'=>$feedingdifficult,
      'convulsion'=>$convulsion,
      'convulsion_hours'=>$convulsionhours,
      'partial_fits'=>$fits,
      'apnoea'=>$apnoea,

    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);

if($abs){

foreach ($abs as $key => $abs) {
    
  
    DB::table('infact_abnormalities')->insert(
    ['dependent_id' => $id,
    'name' => $abs,
    'abnormalities_describe'=> $detail,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
  }

}


return redirect()->action('NurseController@showDependents', [$id]);
   }
   
    
    public function updateDependant($id){

        return view('nurse.updatedependant')->with('id',$id);
    }

    public function nurseUpdate($id){

      return view('nurse.nurseupdate')->with('id',$id);
    }
    public function addfather(Request $request){
     $id=$request->id;
     $father_name=$request->father_name;
     $father_phone=$request->father_phone;
      DB::table('dependant_parent')->insert(
    ['name' => $father_name,
    'relationship' => 'Father',
    'phone'=> $father_phone,
    'dependant_id'=>$id,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);

       return redirect()->action('NurseController@showDependents', [$id]);

    }
    public function addmother(Request $request){
     $id=$request->id;

     $mother_name=$request->mother_name;
     $mother_phone=$request->mother_phone;
     $birthno=$request->Birth_number;
     $birth=$request->birth;
     $dob=$request->dob;
      
 
   
 DB::table('dependant_parent')->insert(
    ['name' => $mother_name,
    'relationship' => 'Mother',
    'phone'=> $mother_phone,
    'dependant_id'=>$id,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
 DB::table('dependant')->where('id', $id)
            ->update([      'birth_no' =>  $birthno,
                             'next_sibling' => $birth,
                             'next_sibling_date' => $dob,
                             'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                             ]);



   
 return redirect()->action('NurseController@showDependents', [$id]);

    }
    public function nurseUpdates(Request  $request){
     $id=$request->id;
     
     $constituency=$request->constituency;
     $phone=$request->phone;

     DB::table('afya_users')->where('id', $id)
                 ->update([
                                  
                                  'constituency' => $constituency,
                                  'msisdn'=>$phone,
                                  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                  'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                                ]);


return Redirect::route('nurse.show', [$id]);

   }

    public function Calendar(){
    return view('nurse.calendar');
    }
    public function Appointment()
    {
      return view('nurse.appointment');
    }

    public function immuninationChart($id){

        return view('nurse.chart')->with('id',$id);
    }
     
    public function childGrowth($id){
        return view('nurse.growth')->with('id',$id);
    }
     
    public function showDependents($id)
    {
        $observations=Observation::all();
       $symptoms=Symptom::all();
        $details=DB::table('triage_infants')
        ->Join('appointments','appointments.id','=','triage_infants.appointment_id')
        ->where('appointments.persontreated',$id)
        ->select('triage_infants.*')
        ->orderBy('triage_infants.id','desc')
        ->get();

        $dependant=DB::table('dependant')->where('id',$id)->first();
        $end = Carbon::parse($dependant->dob);
        $now = Carbon::now();
        $length = $end->diffInDays($now);

        return view('nurse.showdependent')->with('id',$id)->with('length',$length)->with('details',$details)->with('observations',$observations)->with('symptoms',$symptoms);
    }



    public function wList(){
      $patients = DB::table('afya_users')
        ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
        ->select('afya_users.*')
        ->where('afya_users.status',2)
        ->get();

     return view('nurse.waitingList')->with('patients',$patients);

    }

    
    public function createnextkin($id){
      return view ('nurse.createkin')->with('id',$id);
    }

    public function nextkin(Request $request)
    {
     $phone=$request->phone;
     $name=$request->kin_name;
     $relationship=$request->relationship;
     $id=$request->id;

    DB::table('kin_details')->insert(
    ['kin_name' => $name,
    'relation' => $relationship,
    'phone_of_kin'=> $phone,
    'afya_user_id'=>$id,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
     return Redirect::route('nurse.show', [$id]);

    }
  public function Updatekin(Request $request){
    $phone=$request->phone;
    $name=$request->kin_name;
    $relationship=$request->relationship;
    $id=$request->id;
   DB::table('kin_details')->where('afya_user_id',$id)->update(
   ['kin_name' => $name,
   'relation' => $relationship,
   'phone_of_kin'=> $phone,
   'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
   'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
    return Redirect::route('nurse.show', [$id]);


  }

    public function vaccinescreate($id){
    return view('nurse.vaccine')->with('id',$id);
    }

    public function vaccine(Request $request)
    {
    $id=$request->id;
    $diseases=$request->diseases;
    $vaccinename=$request->vaccinename;
    $type=$request->type;
    $date=$request->date;


   DB::table('vaccination')->insert(
    ['userId' => $id,
    'diseaseId' => $diseases,
    'vaccine_name'=> $vaccinename,
    'Yes'=>$type,
    'Created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'yesdate' => \Carbon\Carbon::now()->toDateTimeString()]
);



    return Redirect::route('nurse.show', [$id]);

    }

    public function details($id){

       $observations=Observation::all();
       $symptoms=Symptom::all();
        return view('nurse.details')->with('id',$id)->with('observations',$observations)->with('symptoms',$symptoms);

    }

    public function infactDetails($id){

     $observations=Observation::all();
       $symptoms=Symptom::all();
        return view('nurse.create_infact_triage')->with('id',$id)->with('observations',$observations)->with('symptoms',$symptoms);

    }

    public function createinfantDetails (Request $request){
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
        $hiv=$request->hiv;
       $arvs=$request->arvs;
    $vdrl=$request->vdrl;
    $fever=$request->fever;
    $antibiotics=$request->antibiotics;
    $diabetes=$request->diabetes;
    $tb=$request->tb;
    $tb_treatment=$request->tb_treatment;
    $aph=$request->aph;
    $babyproblem=$request->babyproblem;
    $motherproblem=$request->motherproblem;
    $revelantdrugs=$request->revelantdrugs;
    $oral=$request->oral;
    $lympn=$request->lympn;
    $difficultybreathing=$request->difficulty_breathing;
    $diarrhoea=$request->diarrhoea;
    $diarrhoeadays=$request->diarrhoea_days;
    $contact_tb=$request->contact_tb;
    $cough=$request->cough;
    $diarrhoeabloody=$request->diarrhoea_bloody;
    $vomiting=$request->vomiting;
    $vomitinghours=$request->vomiting_hours;
    $vomitseveything=$request->vomits_eveything;
    $feedingdifficult=$request->feeding_difficult;
    $convulsion=$request->convulsion;
    $convulsionhours=$request->convulsion_hours;
    $fits=$request->fits;
    $apnoea=$request->apnoea;
    $hypertension=$request->hypertention;
    $abs=$request->abs;
        
       
       
       
        
       



$drugs=$request->drugs;
if($drugs){
foreach($drugs as $key =>$drug) {
     DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Drug Allergy',
    'allergy_id'=>$drug,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $foods=$request->foods;
 if($foods){
foreach($foods as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Food Allergy',
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}
 $latexs=$request->latexs;
 if($latexs){
foreach($latexs as $key) {
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Latex Allergy',
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

 $molds=$request->molds;
 if($molds){
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Mold Allergy',
    'allergy_id'=>$molds,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
$pets=$request->pets;
if($pets)
{
foreach($pets as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Pets Allergy',
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}

$pollens=$request->pollens;
if($pollens) {   
   DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Pollen Allergy',
    'allergy_id'=>$pollens,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}

$insects=$request->insects;
if($insects)
{
foreach($insects as $key) {
    DB::table('afya_users_allergy')->insert([
    'afya_user_id'=>$id,
    'allergy_name'=>'Insect Allergy',
    'allergy_id'=>$key,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
}
}


if($abs){

foreach ($abs as $key => $abs) {
    
  
    DB::table('infact_abnormalities')->insert(
    ['dependent_id' => $id,
    'name' => $abs,
    'abnormalities_describe'=> $detail,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
  }

}

$chiefcompliant = implode(',', $chiefcompliant);
$symptom= implode(',', $symptoms);
$observations= implode(',', $observation);
$appointment=DB::table('appointments')->where('persontreated', $id)->orderBy('created_at', 'desc')->first();

    DB::table('triage_infants')->insert(
    ['appointment_id' => $appointment->id,
    'current_weight'=> $weight,
    'current_height'=>$heightS,
    'temperature'=>$temperature,
    'systolic_bp'=>$systolic,
    'diastolic_bp'=>$diastolic,
    'chief_compliant'=>$chiefcompliant,
    'observation'=>$observations,
    'symptoms'=>$symptom,
    'nurse_notes'=>$nurse,
    'Doctor_note'=>'',
    'prescription'=>'',
    'hiv'=>$hiv,
     'arvs'=>$arvs,
     'vdrl'=>$vdrl,
     'fever'=>$fever,
     'antibiotics'=>$antibiotics,
     'diabetes'=>$diabetes,
     'tb'=>$tb,
     'tb_treatment'=>$tb_treatment,
      'hypertention'=>$hypertension,
      'aph'=>$aph,
      'baby_problem'=>$babyproblem,
      'mother_problem'=>$motherproblem,
      'revelant_drug'=>$revelantdrugs,
      'oral_thrush'=>$oral,
      'lympn'=>$lympn,
      'difficult_breathing'=>$difficultybreathing,
      'diarrhoea'=>$diarrhoea,
      'diarrhoea_day'=>$diarrhoeadays,
      'contact_tb'=>$contact_tb,
      'chronic_cough'=>$cough,
      'diarrhoea_bloody'=>$diarrhoeabloody,
      'vomiting'=>$vomiting,
      'vomiting_hours'=>$vomitinghours,
      'vomiting_everything'=>$vomitseveything,
      'difficult_feeding'=>$feedingdifficult,
      'convulsion'=>$convulsion,
      'convulsion_hours'=>$convulsionhours,
      'fits'=>$fits,
      'aponea'=>$apnoea,
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]

);

DB::table('appointments')->where('id',$appointment->id)->update([
    'status'=>2]);


        return redirect()->action('NurseController@index');
    }

    public function createdetails(Request $request)
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
$appointment=DB::table('appointments')->where('afya_user_id', $id)->orderBy('created_at', 'desc')->first();

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
    'status'=>2]);


        return redirect()->action('NurseController@index');
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

    public function updateUser(Request $request)
     {
       $id=$request->id;
       $name=$request->kin_name;
       $phone=$request->phone;
       $relationship=$request->relationship;
       $constituency=$request->Constituency;
       DB::table('patients')->where('id', $id)
                   ->update(['constituency_id' => $constituency,
                             ]);
       return Redirect::route('nurse.show', [$id]);
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
          return view('nurse.show')->with('patient',$patient)->with(['vaccines'=>$vaccines,'kin'=>$kin,'details'=>$details]);
    }

public function showPatient($id){
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
          return view('nurse.showpatient')->with('patient',$patient)->with(['vaccines'=>$vaccines,'kin'=>$kin,'details'=>$details]);

}
public function patientShow($id){
  return view('nurse.patientshow');
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $patient= DB::table('afya_users')
        ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
        ->select('afya_users.*', 'patients.allergies')
        ->where('afya_users.id',$id)
        ->first();



     return view('nurse.edit',compact('patient'));
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
    $name=$request->name;
    $idno=$request->idno;
    $relationship=$request->relationship;
    $phone=$request->phone;
    $weight=$request->weight;
    $temperature=$request->temperature;
    $systolic=$request->systolic;
    $diastolic=$request->diastolic;
    $height=$request->current_height;
    $nurse=$request->nurse;
    $chief=$request->chiefcompliant;
    $observation=$request->observation;
    $doctor=$request->doctor;
    $diseases=$request->diseases;
    $vaccines=$request->vaccinename;
    $yes=$request->yes;
    $date=$request->dates;

DB::table('patients')->where('id', $id)
            ->update(
                       array(
                             'next_kin' => $name,
                             'nextkinID' => $idno,
                             'relation_kin' => $relationship,
                             'phone_kin' => $phone,
                             'current_weight' => $weight,
                             'temperature' => $temperature,
                             'systolic_bp' => $systolic,
                             'diastolic_bp' => $diastolic,
                             'current_height' => $height,
                             'nurse_note' => $nurse,
                             'chief_compliant' => $chief,
                             'observation'=> $observation,
                             'consulting_physician'=> $doctor

                             )
                       );
      DB::table('vaccination')->insert(
    ['userId' => $id,
     'diseaseId' =>$diseases,
     'vaccine_name'=>$vaccines,
     'Yes'=>$yes,
     'yesdate'=>$date
   ]
);




    return Redirect::route('nurse.show', [$id]);

    }

    public function patient(Request $request, $id)
    {
        return 'awesome';

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
