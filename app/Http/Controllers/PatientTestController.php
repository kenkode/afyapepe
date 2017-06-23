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
    public function testdata($id)
    {

      $patientD=DB::table('appointments')
      ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
      ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
    ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
      ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
      ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
        'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
        'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
      ->where('appointments.id',$id)
      ->get();



      return view('doctor.test')->with('patientD',$patientD);


    }

public function diagnoses($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();


  return view('doctor.diagnosis')->with('patientD',$patientD);


}
public function diagnosesconf(Request $request)
{
 $appointment=$request->get('appointment_id');
 $pat_details_id = $request->get('pat_details_id');

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','patient_admitted.condition','facilities.set_up')
  ->where('appointments.id',$appointment)
  ->get();

  $patientT=DB::table('patient_test_details')
  ->join('diagnoses','patient_test_details.conditional_diag_id','=','diagnoses.id')
  ->select('diagnoses.id','diagnoses.name','patient_test_details.id as ptdid','patient_test_details.tests_reccommended as ptest')
  ->where('patient_test_details.id', $pat_details_id)
  ->first();

  return view('doctor.diagnosisconfirm')->with('patientD',$patientD)->with('patientT',$patientT);
}
public function discharges($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
 ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.discharge')->with('patientD',$patientD);
}

public function admit($id)
{

  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();


  return view('doctor.admit')->with('patientD',$patientD);


}


public function transfer($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();

  return view('doctor.transfer')->with('patientD',$patientD);


}
public function disdiagnosis($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();
  return view('doctor.disdiagnosis')->with('patientD',$patientD);
}

public function disprescription($id)
{
  $patientD=DB::table('appointments')
  ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
  ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
  ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
  ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
  ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
    'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
    'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition')
  ->where('appointments.id',$id)
  ->get();

  $Pdiagnosis=DB::table('patient_diagnosis')
  ->leftjoin('diagnoses','patient_diagnosis.disease_id','=','diagnoses.id')
  ->leftjoin('severity','patient_diagnosis.severity','=','severity.id')
  ->select('diagnoses.name','patient_diagnosis.level','severity.name as severity','diagnoses.id')

  ->where([
                ['patient_diagnosis.appointment_id',$id],
                ['patient_diagnosis.state', '=', 'Discharge'],

               ])
  ->get();

  return view('doctor.disprescription')->with('patientD',$patientD)->with('Pdiagnosis',$Pdiagnosis);
}





public function store(Request $request)
{

    $this->validate($request, [
    'doc_id' => 'required',
    'appointment_id' => 'required', ]);

     $afya_user_id=$request->get('afya_user_id');
     $dependant_id=$request->get('dependant_id');
     $appointment=$request->get('appointment_id');
 $pttids= Patienttest::where('appointment_id',$appointment)
  ->first();

     if (is_null($pttids)) {
$PatientTest = Patienttest ::create([
  'doc_id' => $request->get('doc_id'),
  'appointment_id' => $request->get('appointment_id'),
  'facility' => $request->get('facility'),
  'facility_from' => $request->get('facility_from'),
  'test_status' => 0,
]);
    $ptid = $PatientTest->id;
     } else {
     // Already test exist - just get the id
      $ptid =$pttids->id;
     }


     // Insertingmalaria2 tests
     $malaria2=$request->malaria2;
     if ($malaria2) {
       foreach($malaria2 as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,

                  'appointment_id' => $request->get('appointment_id'),
                  'conditional_diag_id' => $request->get('mainconditional'),
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
                 'afya_user_id'=> $afya_user_id,
                 'dependant_id' => $dependant_id,
                 'appointment_id' => $request->get('appointment_id'),
                  'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                  'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                    'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                    'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                  'conditional_diag_id' => $request->get('mainconditional'),
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
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $request->get('appointment_id'),
                  'conditional_diag_id' => $request->get('mainconditional'),
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
                 'afya_user_id'=> $afya_user_id,
                 'dependant_id' => $dependant_id,
                 'appointment_id' => $request->get('appointment_id'),
                 'conditional_diag_id' => $request->get('mainconditional'),
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
             'afya_user_id'=> $afya_user_id,
             'dependant_id' => $dependant_id,
             'appointment_id' => $request->get('appointment_id'),
             'conditional_diag_id' => $request->get('mainconditional'),
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
                            'afya_user_id'=> $afya_user_id,
                            'dependant_id' => $dependant_id,
                            'appointment_id' => $request->get('appointment_id'),
                            'conditional_diag_id' => $request->get('mainconditional'),
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
                                'afya_user_id'=> $afya_user_id,
                                'dependant_id' => $dependant_id,
                                'appointment_id' => $request->get('appointment_id'),
                                'conditional_diag_id' => $request->get('mainconditional'),
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
                                  'afya_user_id'=> $afya_user_id,
                                  'dependant_id' => $dependant_id,
                                  'appointment_id' => $request->get('appointment_id'),
                                  'conditional_diag_id' => $request->get('mainconditional'),
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
                                'afya_user_id'=> $afya_user_id,
                                'dependant_id' => $dependant_id,
                                'appointment_id' => $request->get('appointment_id'),
                                'conditional_diag_id' => $request->get('mainconditional'),
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
                                'afya_user_id'=> $afya_user_id,
                                'dependant_id' => $dependant_id,
                                'appointment_id' => $request->get('appointment_id'),
                                'conditional_diag_id' => $request->get('mainconditional'),
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
                                          'note' => $request->get('docnote'),
                                          'target' => 'Test',
                                          'created_at' => $Now,

                                       ]);

                                    }
  return redirect()->route('testes', ['id' => $appointment]);
      }


          public function Testconfirm($id){
          DB::table('patient_test_details')->where('id', $id)
          ->update(['confirm' =>'Y']);

          $appid = DB::table('patient_test_details')->where('id', $id)
          ->first();

          $tNY = DB::table('patient_test_details')
          ->where([['appointment_id',$appid->appointment_id],['confirm','N'],])
          ->first();
        if ($tNY){
        return redirect()->route('testes',$appid->appointment_id);
        }else{
        return redirect()->route('medicines',$appid->appointment_id);

        }


      }




}
