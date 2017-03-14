<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Carbon\Carbon;

class RegistrarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::today();
        $users=DB::table('afyamessages')->
        where('afyamessages.dateCreated','<=',$today)->
        join('afya_users','afyamessages.msisdn','=','afya_users.msisdn')
        ->select ('afya_users.*')
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
