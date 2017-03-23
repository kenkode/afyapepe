<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
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


public function store(Request $request)
{

            $this->validate($request, [

          'doc_id' => 'required',
          'conditional' => 'required',
          'appointment_id' => 'required',
          ]);
       $id = $request->input('appointment_id');
                     $PatientTest = Patienttest ::create([
                        'test_reccommended' => $request->get('test'),
                        'doc_id' => $request->get('doc_id'),
                        'appointment_id' => $request->get('appointment_id'),
                                  ]);
    $ptid = $PatientTest->id;

   $patienttd = DB::table('patient_test_details')->insertGetId(
             [
               'conditional_diagnosis' => $request->get('conditional'),
               'patient_test_id' => $ptid,
               'tests_reccommended' => $request->get('test'),
               'appointment_id'=> $request->get('appointment_id')

             ]
           );
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
