<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Redirect;
class AdminController extends Controller
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
    public function index()
    {
      return view('admin.home');
    }

    public function facility(){

        return view('admin.facility');
    }

    public function addfacility(Request $request){
        $code=$request->code;
        $name=$request->name;
        $type=$request->type;
        $county=$request->county;
        $constituency=$request->constituency;
        $ward=$request->ward;


        DB::table('facilities')->insert([
            'FacilityCode'=>$code,
             'FacilityName'=>$name,
             'Type'=>$type,
             'County'=>$county,
             'Constituency'=>$constituency,
             'Ward'=>$ward
            ]);

return redirect()->action('AdminController@facility');

    }


    public function facilityAdmin(){
        return view('admin.facilityadmin');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
        DB::table('facility_admin')->insert([
            'user_id'=>$userid,
            'facilitycode'=>$facility,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        DB::table('role_user')->insert([
            'user_id'=>$userid,
            'role_id'=>10
            ]);

        return redirect()->action('AdminController@facilityAdmin');
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
