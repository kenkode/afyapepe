<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Http\Requests;
use DB;
use Auth;
use Carbon\Carbon;
use App\County;
use PDF;


class RegistrarController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
         $facilitycode=DB::table('facility_registrar')->where('user_id', Auth::id())->first(); 
        $users=DB::table('afya_users')->
        join('afyamessages','afya_users.msisdn','=','afyamessages.msisdn')->
        leftjoin('constituency','afya_users.constituency','=','constituency.id')->
        select('afya_users.*','afyamessages.created_at as created_at','constituency.Constituency','constituency.cont_id')
        ->where('afyamessages.facilityCode',$facilitycode->facilitycode)
        ->where('afyamessages.created_at','>=',$today)
        ->where('afyamessages.status','=',NULL)
        ->distinct()
        ->get();
        return view('registrar.index')->with('users',$users)->with('facilitycode',$facilitycode);
    }
    public function   showUser($id){

      $user=DB::table('afya_users')->where('id',$id)->first();
      return view('registrar.show')->with('user',$user);
    }

    public function selectChoice($id){

      return view('registrar.select')->with('id',$id);
    }

    public function selectDependant($id){

     
            return view('registrar.dependants')->with('id',$id);
    }
    public function allPatients(){
  
       return view('registrar.allpatients');

    }

    public function createDependent(Request $request){
      $id=$request->id;
      $first=$request->first;
      $second=$request->second;
      $gender=$request->gender;
      $blood=$request->blood;
      $pob=$request->pob;
      $dob=$request->dob;
     
      $relation=$request->relationship;
      $school=$request->school;

$newDate = date("Y-m-d", strtotime($dob));

      $parent=DB::table('afya_users')->where('id',$id)->first();
      $name=$parent->firstname." ".$parent->secondName;
      $parentgender=$parent->gender;
      $phone=$parent->msisdn;

    

     $dependant_id= DB::table('dependant')->insertGetId(
      ['afya_user_id' => $id,
      'firstName' => $first,
      'secondName'=> $second,
      'gender'=>$gender,
      'blood_type'=>$blood,
      'dob'=>$newDate,
      'pob'=>$pob,
      'relationship'=>$relation,
   
      ]
  );

if($parentgender==1){
  DB::table('dependant_parent')->insert(
    [
    'name'=>$name,
    'relationship'=>'Father',
    'phone'=>$phone,
    'dependant_id'=>$dependant_id,
    'afya_user_id'=>$id,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    ]);
} 
  else{
     DB::table('dependant_parent')->insert(
    [
    'name'=>$name,
    'relationship'=>'Mother',
    'phone'=>$phone,
    'dependant_id'=>$dependant_id,
    'afya_user_id'=>$id,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    ]);

  }
     


     $end = Carbon::parse($dob);
        $now = Carbon::now();
        $length = $end->diffInDays($now);
if ($length <=1825) {
  $vaccines=DB::table('vaccine')->get();
    foreach ($vaccines as $vaccine) {
    $MyDateCarbon = \Carbon\Carbon::parse($dob);
    $MyDateCarbon->addDays($vaccine->age);
    DB::table('dependant_vaccination')->insert(
    [
    'dependent_id'=>$dependant_id,
    'vaccine_id'=>$vaccine->id,
    'date_guideline'=>$MyDateCarbon,
    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
);
}
}

   return redirect()->action('RegistrarController@selectDependant', [$id]);
    }
public function addDependents($id){
  return view('registrar.addDependents')->with('id',$id);
}

public function dependantTriage($id){
  $user=DB::table('dependant')->where('id',$id)->first();
  return view('registrar.dependantTriage')->with('id',$id)->with('user',$user);
}



    public function updateUsers(Request $request){
      $id=$request->id;
      $idno=$request->idno;
      $db=$request->date;
      $pob=$request->place;
      $email=$request->email;
      $constituency=$request->constituency;
      $nhif=$request->nhif;
      $blood=$request->blood_type;
    
     
      DB::table('afya_users')->where('id',$id)->
      update([
      'age'=> date_diff(date_create($db), date_create('now'))->y,
      'dob' => $db,
     'pob' => $pob,
     'nhif'=>$nhif,
     'nationalId'=>$idno,
     'email'=>$email,
     'blood_type'=>$blood,
     'constituency' =>$constituency,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
     'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);



  return redirect()->action('RegistrarController@showUser',[$id]);

    }

    public function registrarNextkin(Request $request){
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
     return redirect()->action('RegistrarController@showUser',[$id]);
    }

    public function updateKin($id){

    return view('registrar.update')->with('id',$id);
    }
    public function registrarUpdatekin(Request $request){
      $phone=$request->phone;
      $name=$request->kin_name;
      $relationship=$request->relationship;
      $id=$request->id;
      $userid=$request->userid;
     DB::table('kin_details')->where('id',$id)->update(
     ['kin_name' => $name,
     'relation' => $relationship,
     'phone_of_kin'=> $phone,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
     'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
    return redirect()->action('RegistrarController@showUser',[$userid]);

    }

    public function consultationFee($id){

      return view('registrar.consultationfee',[$id])->with('id',$id);
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
  'status'=>1,
  'facility_id'=>$facilitycode->facilitycode,
  'afya_user_id'=>$id,
  'persontreated'=>'Self',
  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()


  ]);

   return redirect()->action('RegistrarController@index');
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
  'status'=>1,
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
  $facility=DB::table('facility_registrar')->where('user_id', Auth::id())->first(); 
   $fees=DB::table('consultation_fees')->
   join('afya_users','consultation_fees.afyauser_id','=','afya_users.id')->where('fee_required','=','Yes')
   ->where('facility',$facility->facilitycode)
   ->select('consultation_fees.*','afya_users.firstname','afya_users.secondName')->
   orderby('consultation_fees.created_at','desc')->get();

   return view('registrar.fees')->with('fees',$fees)->with('facility',$facility);
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

    public function findConstituency(Request $request)
     {
         $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = County::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->id, 'text' => $drug->Constituency];
         }
     return \Response::json($formatted_drugs);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $first=$request->first;
      $second=$request->second;
      $gender=$request->gender;
      $age=$request->age;
      $phone=$request->phone;

     $id= DB::table('afya_users')->insertGetId(
      ['msisdn' => $phone,
      'firstname'=>$first,
      'secondName' => $second,
      'gender'=> $gender,
      'age'=> $age,
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
 

   return redirect()->action('RegistrarController@allPatients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function edit_nextkin($id){

     

      return view('registrar.edit_nextkin')->with('id',$id);
    }

    public function update_nextkin(Request $request){
      $name=$request->name;
      $phone=$request->phone;
      $user=$request->id;
      $id=$request->user;
      $rel=$request->relationship;

    

     DB::table('kin_details')->where('id',$user)->update(
      ['kin_name' => $name,
      'relation'=>$rel,
      'phone_of_kin' => $phone,
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
 
 
 return redirect()->action('RegistrarController@showUser',['id'=> $id]);
      
    }

    public function edit_patient($id){

      return view('registrar.edit_patient')->with('id',$id);
    }

    public function update_patient(Request $request){
      $id=$request->id;
      $phone=$request->phone;
      $email=$request->email;

      $constituency=$request->constituency;


       DB::table('afya_users')->where('id',$id)->update(
      ['msisdn' => $phone,
      'email'=>$email,
      'constituency' => $constituency,
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
 
 
 return redirect()->action('RegistrarController@showUser',['id'=> $id]);




    }


public function receiptsFees($id){

  $facility=DB::table('facility_registrar')->join('facilities','facilities.FacilityCode','=','facility_registrar.facilitycode')->where('facility_registrar.user_id', Auth::id())->first(); 
   $fee=DB::table('consultation_fees')->
   join('afya_users','consultation_fees.afyauser_id','=','afya_users.id')->where('fee_required','=','Yes')
   ->where('facility',$facility->facilitycode)->where('consultation_fees.id',$id)
   ->select('consultation_fees.*','afya_users.*')->
   orderby('consultation_fees.created_at','desc')->first();


    $dy=$fee->created_at; $dys=date("d-M-Y", strtotime( $dy));
    $last = $id;
$last ++;

$number = sprintf('%07d', $last);

return view('receipts.consulationfees')->with('facility',$facility)->with('fee',$fee)->with('dys',$dys)->with('number',$number);

 

}
}
