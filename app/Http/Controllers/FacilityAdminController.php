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

 public function laboratory(){

    return view('facilityadmin.lab');
 }
 public function storelabtech(Request $request){
        $name=$request->name;
        $email=$request->email;
        $role=$request->role;
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
        DB::table('facility_test')->insert([
            'user_id'=>$userid,
            'firstname'=>$request->get('firstname'),
            'secondname'=>$request->get('lastname'),
            'address'=>$request->get('address'),
            'phone'=>$request->get('phone'),
            'department'=>$request->get('department'),
            'speciality'=>$request->get('speciality'),
            'qualification'=>$request->get('qualification'),
            'facilitycode'=>$facility,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>7  ]);


        return  Redirect()->action('FacilityAdminController@laboratory');


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
     public function labtech($id)
     {
$labtechs=DB::table('facility_test')->where('user_id',$id)
->first();
       return view('facilityadmin.labtechupdate')->with('labtechs',$labtechs);
   }
  public function uplabtech(Request $request){


    $userid = $request->user_id;
    $address = $request->address;
    $phone = $request->phone;
    $department = $request->department;
    $speciality = $request->speciality;
    $qualification = $request->qualifications;
  DB::table('facility_test')
            ->where('user_id',$userid)
            ->update(['department'=>$department,
            'address'=>$address,
            'phone'=>$phone,
                  ]);

return  Redirect()->action('FacilityAdminController@laboratory');
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroylabtech($id)
    {
      DB::table("facility_test")->where('user_id',$id)->delete();
      DB::table("users")->where('id',$id)->delete();
      DB::table("role_user")->where('user_id',$id)->delete();
   return  Redirect()->action('FacilityAdminController@laboratory')
    ->with('success','Record deleted successfully');
         }
         public function testranges()
         {
           return view('facilityadmin.testranges');
        }
        public function rangesadd(Request $request){
               $machine_id=$request->machine_name;


               DB::table('test_ranges')->insert([
                'name'=>$request->get('sub_test'),
                   'tests_id'=>$request->get('tests_id'),
                   'machine_id'=>$machine_id,
                   'facility_id'=>$request->get('facility_id'),
                   'low_male'=>$request->get('low_male'),
                   'high_male'=>$request->get('high_male'),
                   'low_female'=>$request->get('low_female'),
                   'high_female'=>$request->get('high_female'),
                   'units'=>$request->get('units'),
                  'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                   'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                   ]);


     return view('facilityadmin.testranges');
  }

  public function destroyranges($id)
  {

    DB::table("test_ranges")->where('id',$id)->delete();
    return view('facilityadmin.testranges');
       }
       public function testsRang($id)
       {
    $testranges=DB::table('test_ranges')
   ->join('tests','test_ranges.tests_id','=','tests.id')
   ->join('test_machines','test_ranges.machine_id','=','test_machines.id')
    ->select('test_ranges.*','tests.name','test_machines.id as machineid','test_machines.name as machine',
    'test_machines.series','test_machines.serial_no')
    ->where('test_ranges.id',$id)
    ->first();
   return view('facilityadmin.testrangesupdate')->with('testranges',$testranges);
     }
     public function updateranges(Request $request){


       $test = $request->test_id;
       $units = $request->units;
       $low_female = $request->low_female;
       $high_female = $request->high_female;
       $low_male = $request->low_male;
       $high_male = $request->high_male;
       $machine_id = $request->machine_id;

     DB::table('test_ranges')
               ->where('id',$test)
               ->update(['units'=>$units,
               'low_female'=>$low_female,
               'high_female'=>$high_female,
               'low_male'=>$low_male,
               'high_male'=>$high_male,
               'machine_id'=>$machine_id,
               ]);


  return view('facilityadmin.testranges');
     }
         public function create()
         {
             //
         }
}
