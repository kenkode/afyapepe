<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Http\Requests;
use DB;
use Carbon\Carbon;

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
        $users=DB::table('afya_users')->
        join('afyamessages','afya_users.msisdn','=','afyamessages.msisdn')->
        leftjoin('constituency','afya_users.constituency','=','constituency.const_id')->
        select('afya_users.*','afyamessages.created_at as created_at','constituency.Constituency','constituency.cont_id')
        ->where('afyamessages.facilityCode',19310)
        ->where('afyamessages.created_at','>=',$today)
        ->where('afyamessages.status','=',NULL)
        ->distinct()
        ->get();
        return view('registrar.index')->with('users',$users);
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

    public function createDependent(Request $request){
      $id=$request->id;
      $first=$request->first;
      $second=$request->second;
      $gender=$request->gender;
      $blood=$request->blood;
      $pob=$request->pob;
      $dob=$request->dob;
      $age=$request->age;
      $relation=$request->relationship;
      $school=$request->school;

     $dependant_id= DB::table('dependant')->insertGetId(
      ['afya_user_id' => $id,
      'firstName' => $first,
      'secondName'=> $second,
      'gender'=>$gender,
      'blood_type'=>$blood,
      'dob'=>$dob,
      'pob'=>$pob,
      'age'=>$age,
      'relationship'=>$relation,
      'school'=>$school
      ]
  );
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
      DB::table('fees')->insert(
      ['patient_id' => $id,
      'type'=>$type,
      'descr' => $descr,
      'action'=> $mode,
      'amount'=> $amount,
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
  'facility_id'=>19310,
  'afya_user_id'=>$id,
  'doc_id'=>6,
  'persontreated'=>'Self',
  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()


  ]);

   return redirect()->action('RegistrarController@index');
    }
 public function Dependentconsultationfee(Request $request){
      $id=$request->id;
      $descr=$request->descr;
      $type=$request->type;
      $mode=$request->mode;
      $amount=$request->amount;
      $user=$request->afya_user;
  DB::table('appointments')->insert([
  'status'=>1,
  'facility_id'=>19310,
  'afya_user_id'=>$user,
  'doc_id'=>6,
  'persontreated'=>$id,
  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()


  ]);
  $phone=DB::Table('afya_users')->where('id',$user)->select('msisdn')->first();
  DB::table('afyamessages')->where('msisdn',$phone->msisdn)->
  update([
 'status' => 1,
 'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
 'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

   DB::table('fees')->insert(
      ['patient_id' => $id,
      'type'=>$type,
      'descr' => $descr,
      'action'=> $mode,
      'amount'=> $amount,
      'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
      'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]
  );
   return redirect()->action('RegistrarController@index');

 }
 public function Fees(){
   $fees=DB::table('fees')->
   join('afya_users','fees.patient_id','=','afya_users.id')->where('type','=','yes')
   ->select('fees.*','afya_users.firstname','afya_users.secondName')->
   orderby('fees.created_at','desc')->get();

   return view('registrar.fees')->with('fees',$fees);
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
}
