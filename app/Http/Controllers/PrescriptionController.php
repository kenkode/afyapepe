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
      $Prescription=Prescription::create([
           'appointment_id' => $request['appointment_id'],
           'doc_id' => $request['doc_id'],
           'patient_id' => $request['patient_id'],
           'filled_status' => $request['filled_status'],
      ]);
      $id=$Prescription->id;


    Prescription_detail::create([

           'presc_id' => $id,
           'drug_id' => $request['drug_id'],
           'doseform' => $request['doseform'],
           'dosage' => $request['dosage'],
       ]);
       $triageid =$request['triage_id'];
       $presc =$request['drug_id'];
       $docnote=$request['doc_note'];


       DB::table('triage_details')
                 ->where('id',$triageid)
                 ->update(['Doctor_note'=>$docnote],['prescription'=>$presc]);






   return redirect()->route('newpatients');
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
