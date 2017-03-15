<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $today = Carbon::today();
        $users=DB::table('afya_users')->
        join('afyamessages','afya_users.msisdn','=','afyamessages.msisdn')->
        leftjoin('constituency','afya_users.constituency','=','constituency.const_id')->
        select('afya_users.*','constituency.Constituency','constituency.cont_id')
        ->where('afyamessages.dateCreated','>=',$today)
        ->orderBy('afyamessages.dateCreated', 'desc')
        ->distinct()
        ->get();
        return view('registrar.index')->with('users',$users);
    }
    public function   showUser($id){

      $user=DB::table('afya_users')->where('id',$id)->first();
      return view('registrar.show')->with('user',$user);
    }

    public function updateUsers(Request $request){
      $id=$request->id;
      $db=$request->date;
      $pob=$request->place;
      $constituency=$request->constituency;

      DB::table('afya_users')->where('id',$id)->
      update([
        'dob' => $db,
     'pob' => $pob,
     'constituency' =>$constituency,
     'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
     'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

   return redirect()->action('RegistrarController@index');

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
