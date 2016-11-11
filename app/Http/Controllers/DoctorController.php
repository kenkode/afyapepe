<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Doctor;
use Carbon\Carbon;
use Auth;

use App\Patient;

class DoctorController extends Controller
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

     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Http\Response
      */
     public function index()

     {
      $today = Carbon::today();

       $patients = DB::table('afya_users')
         ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
         ->Join('appointments', 'patients.id', '=', 'appointments.patient_id')
         ->select('afya_users.*','patients.*','appointments.id', 'appointments.created_at', 'appointments.facility_id')
         ->where('appointments.created_at','>=',$today)

         ->get();

       return view('doctor.newPatients')->with('patients',$patients);
     }

     public function newPatients()

     {
      $today = Carbon::today();

       $patients = DB::table('afya_users')
         ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
         ->Join('appointments', 'patients.id', '=', 'appointments.patient_id')
         ->select('afya_users.*','patients.*','appointments.id', 'appointments.created_at', 'appointments.facility_id')
        //  ->where('appointments.created_at','>=',$today)
         ->where([
                       ['appointments.created_at','>=',$today],
                       ['appointments.status', '=', 1],
                      ])
         ->get();

       return view('doctor.newPatients')->with('patients',$patients);
     }


     public function all()
  {
    $today = Carbon::today();
      $allpatients = DB::table('afya_users')
        ->Join('patients', 'afya_users.id', '=', 'patients.afya_user_id')
        ->select('afya_users.*','patients.*')
        ->get();

            return view('doctor.allpatients')->with('allpatients',$allpatients);
          }

          public function seen()
     {
       $today = Carbon::today();

        $seenpatients = DB::table('patients')
          ->Join('afya_users', 'patients.afya_user_id', '=', 'afya_users.id')
          ->Join('patient_test', 'patients.id', '=', 'patient_test.patient_id')
          ->select('afya_users.*','patients.*', 'patient_test.test_status')
          ->where('patient_test.test_status','=','1')
          ->get();

        return view('doctor.seenpatients')->with('seenpatients',$seenpatients);}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

        {
          $this->validate($request, [
          'name' => 'required',
          'user_id' => 'required',
          'regno' => 'required|unique:doctors,RegNo',
          'address' => 'required',
          'phone' => 'required',
          'residence' => 'required',
          'speciality' => 'required'
          ]);

     Doctor::create($request->all());


return redirect()->route('doctor.index')
    ->with('success','User created successfully');

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
    function DocDetails(){

      $uid = Auth::user()->id;
      $DocDetails = DB::table('doctors')->where('user_id', '=', Auth::user()->id)->get();
     return $DocDetails;

}



}
