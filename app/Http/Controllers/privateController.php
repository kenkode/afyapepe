<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;

class privateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('private.index');
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
