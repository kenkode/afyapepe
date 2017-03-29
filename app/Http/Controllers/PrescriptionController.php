<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Input;
use App\Prescription;
use App\Prescription_detail;
use Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
  //   public function store(Request $request){
  //     Prescription::create($request->all());
  //     Prescription_detail::create($request->all());
  //     return redirect()->route('newpatients');
  //   // return view('doctor.newPatients');
  //  }
   protected function store(Request $request)
   {
     $appid=$request['appointment_id'];



      $pttids= Prescription::where('appointment_id',$appid)
       ->first();

      if (is_null($pttids)) {
      //  - add new
      $Prescription=Prescription::create([
           'appointment_id' => $request['appointment_id'],
           'doc_id' => $request['doc_id'],
           'filled_status' => 0,
      ]);
      $id=$Prescription->id;
      } else {
      // Already favorited - delete the existing
       $id =$pttids->id;
      }

    Prescription_detail::create([
           'presc_id' => $id,
           'drug_id' => $request['prescription'],
           'diagnosis' => $request['diagnosis'],
           'doseform' => $request['dosageform'],
           'strength' => $request['strength'],
           'strength_unit' => $request['strength_unit'],
           'routes' => $request['routes'],
           'frequency' => $request['frequency'],
       ]);


   return redirect()->route('showPatient',$appid);
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
