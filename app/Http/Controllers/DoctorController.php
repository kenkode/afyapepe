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

       $patients = DB::table('patients')
         ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
         ->select('patients.*', 'constituencies.name')
         ->where('patients.updated_at','>=',$today)
         ->get();
      $tdpatients = DB::table('patients')
         ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
         ->select('patients.*', 'constituencies.name')
         ->get();
       return view('doctor.home')->with('tdpatients',$tdpatients)->with('patients',$patients);;
     }

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
//     public function showPatient($id)
//     {
//
// $pid = Patient::find($id);
//       $patientsdata = DB::table('patients')
//
//         ->select('patients.*')
//         ->where('patients.id',$pid)
//         ->get();
//
//
//     return view('doctor.show')->with('patientsdata',$patientsdata);
//
//    }
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
