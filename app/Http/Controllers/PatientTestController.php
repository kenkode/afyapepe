<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;

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

          'appointment_id' => 'required',

          ]);

 $appointment=$request->get('appointment_id');
 $pttids= Patienttest::where('appointment_id',$appointment)
  ->first();

     if (is_null($pttids)) {
     //  - add new
   $PatientTest = Patienttest ::create([
  'doc_id' => $request->get('doc_id'),
  'appointment_id' => $request->get('appointment_id'),
  'test_status' => 0,
              ]);
    $ptid = $PatientTest->id;
     } else {
     // Already test exist - just get the id
      $ptid =$pttids->id;
     }
// Inserting  conditional_diagnosis tests

     $conditional= DB::table('patient_cond_diagnosis')->insert([
                  'disease_id' => $request->get('mainconditional'),
                  'other_disease_id' => $request->get('conditional'),
                  'appointment_id' => $request->get('appointment_id'),
                  'patient_test_id' => $ptid,

               ]);
     // Insertingmalaria2 tests
     $malaria2=$request->malaria2;
     if ($malaria2) {
       foreach($malaria2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting Haematology2 tests
     $haematology2=$request->haematology2;
     if ($haematology2) {
       foreach($haematology2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
         'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting chemistry2 tests
     $chemistry2=$request->chemistry2;
     if ($chemistry2) {
       foreach($chemistry2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting hiv2 tests
     $hiv2=$request->hiv2;
     if ($hiv2) {
       foreach($hiv2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting glucose2 tests
     $glucose2=$request->glucose2;
     if ($glucose2) {
       foreach($glucose2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting microbiology2 tests
     $microbiology2=$request->microbiology2;
     if ($microbiology2) {
       foreach($microbiology2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting xray2 tests
     $xray2=$request->xray2;
     if ($xray2) {
       foreach($xray2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting TB tests
     $tb=$request->tb2;
     if ($tb) {
       foreach($tb as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting TB tests
     $urine=$request->urine2;
     if ($urine) {
       foreach($urine as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                 'patient_test_id' => $ptid,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
// Inserting Biochemistry tests
$Rtests=$request->biotests;
if ($Rtests) {
  foreach($Rtests as $key) {
$patienttd = DB::table('patient_test_details')->insert([
             'patient_test_id' => $ptid,
             'tests_reccommended' => $key,
             'done' => 0,
          ]);
         }
}


            // Inserting Coagulation tests
                 $Ctests=$request->coagtests;
                 if ($Ctests) {
                 foreach($Ctests as $key) {
               $patienttd = DB::table('patient_test_details')->insert([
                            'patient_test_id' => $ptid,
                            'tests_reccommended' => $key,
                            'done' => 0,
                         ]);
                        }
                      }
                // Inserting Haematology tests
                     $Htests=$request->haemtests;
                     if ($Htests) {
                     foreach($Htests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                                'done' => 0,
                             ]);
                            }
                          }
                  // Inserting Immunology_Infective tests
                       $Intests=$request->inftests;
                       if ($Intests) {
                       foreach($Intests as $key) {

                     $patienttd = DB::table('patient_test_details')->insert([
                                  'patient_test_id' => $ptid,
                                  'tests_reccommended' => $key,
                                  'done' => 0,
                               ]);
                              }
                            }
                // Inserting Immunology-Auto-Immune tests
                     $Atests=$request->autotests;
                     if ($Atests) {
                     foreach($Atests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                                'done' => 0,
                             ]);
                            }
                          }
                // Inserting Microbiology tests
                $Mtests=$request->microtests;
                if ($Mtests) {
                  foreach($Mtests as $key) {
                   $patienttd = DB::table('patient_test_details')->insert([
                                'patient_test_id' => $ptid,
                                'tests_reccommended' => $key,
                                'done' => 0,
                             ]);
                            }
                          }
                          // Inserting tests Notes
                          $Note=$request->docnote;
                          if ($Note) {
                            $Now = Carbon::now();
                             $patientNote = DB::table('patientNotes')->insert([
                                          'appointment_id' => $request->get('appointment_id'),
                                          'written_by' => 'Doctor',
                                          'note' => 'Doctor',
                                          'target' => 'Test',
                                          'created_at' => $Now,

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
