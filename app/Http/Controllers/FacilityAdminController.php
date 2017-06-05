<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Redirect;
use App\Doctor;
use App\Kin;



class FacilityAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('facilityadmin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facilityregister(){
        return view('facilityadmin.register');
    }

    public function addregistrar(Request $request){

    }
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
        $name=$request->name;
        $email=$request->email;
        $role=$request->role;
        $regno=$request->regno;
        $password=bcrypt($request->password);
        $facility=$request->facility;

        $userid=DB::table('users')->insertGetId([
            'name'=>$name,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('facility_registrar')->insert([
            'user_id'=>$userid,
            'regno'=>$regno,
            'facilitycode'=>$facility,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>9
            ]);

        return  Redirect()->action('FacilityAdminController@facilityregister');
    }

    public function facilitynurse(){

        return view('facilityadmin.nurse');
    }

public function storenurse(Request $request){

    $name=$request->name;
        $email=$request->email;
        $role=$request->role;
        $regno=$request->regno;
        $password=bcrypt($request->password);
        $facility=$request->facility;

        $userid=DB::table('users')->insertGetId([
            'name'=>$name,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('facility_nurse')->insert([
            'user_id'=>$userid,
            'regno'=>$regno,
            'facilitycode'=>$facility,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>4
            ]);

        return  Redirect()->action('FacilityAdminController@facilitynurse');
}
 public function facilitydoctor(){

    return view('facilityadmin.doctor');
 }

 public function storedoctor(Request $request){
        $name=$request->name;
        $email=$request->email;
        $role=$request->role;
        $password=bcrypt($request->password);
        $facility=$request->facility;
        $doc=$request->doc;
        $userid=DB::table('users')->insertGetId([
            'name'=>$name,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('facility_doctor')->insert([
            'user_id'=>$userid,
            'doctor_id'=>$doc,
            'facilitycode'=>$facility,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>2
            ]);
        DB::table('doctors')->where('id',$doc)
         ->limit(1)->update([
            'user_id'=>$userid]);

        return  Redirect()->action('FacilityAdminController@facilitydoctor');


 } 

 public function facilityofficer(){

    return view('facilityadmin.officers');
 } 
 public function storeofficer(Request $request){

     $name=$request->name;
        $email=$request->email;
        $role=$request->role;
        $regno=$request->regno;
        $regdate=$request->regdate;
        $address=$request->address;
        $qualify=$request->qualify;
        $speciality=$request->speciality;
        $sub=$request->sub_speciality;
        $password=bcrypt($request->password);
        $facility=$request->facility;

        $userid=DB::table('users')->insertGetId([
            'name'=>$name,
            'email'=>$email,
            'role'=>$role,
            'password'=>$password,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('facility_officer')->insert([
            'user_id'=>$userid,
            'regno'=>$regno,
            'facilitycode'=>$facility,
            'regdate'=>$regdate,
            'address'=>$address,
            'qualification'=>$qualify,
            'speciality'=>$speciality,
            'sub_speciality'=>$sub,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>2
            ]);

        return  Redirect()->action('FacilityAdminController@facilityofficer');

 } 
 public function createdoc(){
  return view('facilityadmin.createdoc');
 }

public function finddoc(Request $request){

      $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = Doctor::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->id, 'text' => $drug->name];
         }
     return \Response::json($formatted_drugs);
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
