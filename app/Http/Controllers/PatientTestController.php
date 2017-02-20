<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;

use Auth;

class PatientTestController extends Controller
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
     public function store(Request $request)

         {
           $this->validate($request, [
           'patient_id' => 'required',
           'doc_id' => 'required',
           'test_status' => 'required',
           'appointment_id' => 'required',
           'test_reccommended' => 'required',


           ]);
                $id = $request->input('appointment_id');
                $testRecmd = $request->test_reccommended;

      foreach($testRecmd as $key) {
          $PatientTest = Patienttest ::create([
                 'test_reccommended' => $key,
                 'committee_id' => $request->get('committee_id'),

                 'patient_id' => $request->get('patient_id'),
                 'doc_id' => $request->get('doc_id'),
                 'test_status' => $request->get('test_status'),
                 'appointment_id' => $request->get('appointment_id'),
                 'conditional_diagnosis' => $request->get('conditional_diagnosis'),
               ]);
        }


 return redirect()->route('showPatient', ['id' => $id]);
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
