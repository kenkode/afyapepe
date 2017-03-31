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
          'biotests' => 'required',
          'coagtests' => 'required',
          'haemtests' => 'required',
          'inftests' => 'required',
          'autotests' => 'required',
          'microtests' => 'required',
          ]);

 $appointment=$request->get('appointment_id');
 $pttids= Patienttest::where('appointment_id',$appointment)
  ->first();

     if (is_null($pttids)) {
     //  - add new
   $PatientTest = Patienttest ::create([
  'doc_id' => $request->get('doc_id'),
  'appointment_id' => $request->get('appointment_id'),
              ]);
    $ptid = $PatientTest->id;
     } else {
     // Already test exist - just get the id
      $ptid =$pttids->id;
     }
// Inserting Biochemistry tests
     $Rtests=$request->biotests;
     foreach($Rtests as $key) {
   $patienttd = DB::table('patient_test_details')->insert([
                'conditional_diagnosis' => $request->get('conditional'),
                'patient_test_id' => $ptid,
                'tests_reccommended' => $key,
             ]);
            }

            // Inserting Coagulation tests
                 $Ctests=$request->coagtests;
                 foreach($Ctests as $key) {
               $patienttd = DB::table('patient_test_details')->insert([
                            'conditional_diagnosis' => $request->get('conditional'),
                            'patient_test_id' => $ptid,
                            'tests_reccommended' => $key,
                         ]);
                        }
                // Inserting Haematology tests
                     $Htests=$request->haemtests;
                     foreach($Htests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'conditional_diagnosis' => $request->get('conditional'),
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                             ]);
                            }
                  // Inserting Immunology_Infective tests
                       $Intests=$request->inftests;
                       foreach($Intests as $key) {
                     $patienttd = DB::table('patient_test_details')->insert([
                                  'conditional_diagnosis' => $request->get('conditional'),
                                  'patient_test_id' => $ptid,
                                  'tests_reccommended' => $key,
                               ]);
                              }
                // Inserting Immunology-Auto-Immune tests
                     $Atests=$request->autotests;
                     foreach($Atests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'conditional_diagnosis' => $request->get('conditional'),
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                             ]);
                            }
                // Inserting Microbiology tests
                     $Mtests=$request->microtests;
                     foreach($Mtests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'conditional_diagnosis' => $request->get('conditional'),
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                             ]);
                            }
  return redirect()->route('showPatient', ['id' => $appointment]);
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
