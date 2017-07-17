<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;

class TestsaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{

    $this->validate($request, [
    'doc_id' => 'required',
    'appointment_id' => 'required', ]);
     $afya_user_id=$request->get('afya_user_id');
     $dependant_id=$request->get('dependant_id');
     $appointment=$request->get('appointment_id');
     $facility=$request->get('facility_from');
     $conditional_diag_id =$request->get('mainconditional');
     $doc_id =$request->get('doc_id');


 $pttids= Patienttest::where('appointment_id',$appointment)
  ->first();

     if (is_null($pttids)) {
$PatientTest = Patienttest ::create([
  'doc_id' => $request->get('doc_id'),
  'appointment_id' => $request->get('appointment_id'),
  //'facility' => $request->get('facility'),
  'facility_from' => $request->get('facility_from'),
  'test_status' => 0,
]);
    $ptid = $PatientTest->id;
     } else {
     // Already test exist - just get the id
      $ptid =$pttids->id;
      DB::table('patient_test')->where('id', $ptid)
      ->update(['test_status' => 0,]);
     }
     DB::table('appointments')->where('id', $appointment)
     ->update(['p_status' => 11,]);

     // Inserting patientNotes tests
     $docnote=$request->docnote;
     if ($docnote) {
  $patientNotes = DB::table('patientNotes')->insert([
              'appointment_id' => $appointment,
              'doc_id' => $doc_id,
              'note' => $docnote,
              'target' => 'Test',
              'facility' => $facility,
               ]);
              }

// Inserting testmore tests
$testmore=$request->testmore;
if ($testmore) {
$patienttd = DB::table('patient_test_details')->insert([
             'patient_test_id' => $ptid,
             'afya_user_id'=> $afya_user_id,
             'dependant_id' => $dependant_id,
             'appointment_id' => $appointment,
             'conditional_diag_id'=> $conditional_diag_id,
             'testmore' => $testmore,
             'done' => 0,
          ]);

}
     // Inserting Renal tests
     $renal=$request->renal;
     if ($renal) {
       foreach($renal as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting liverand Pancreatic tests
     $liverp=$request->liverp;
     if ($liverp) {
       foreach($liverp as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting lipids tests
     $lipid=$request->lipid;
     if ($lipid) {
       foreach($lipid as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting diabetic tests
     $diabetic =$request->diabetic;
     if ($diabetic) {
       foreach($diabetic as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting card tests
     $card =$request->card;
     if ($card) {
       foreach($card as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting others tests
     $others =$request->others;
     if ($others) {
       foreach($others as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting bone tests
     $bone =$request->bone;
     if ($bone) {
       foreach($bone as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting urine tests
     $urine =$request->urine;
     if ($urine) {
       foreach($urine as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting endo tests
     $endo =$request->endo;
     if ($endo) {
       foreach($endo as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting tumour tests
     $tumour =$request->tumour;
     if ($tumour) {
       foreach($tumour as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting nutrition tests
     $nutrition =$request->nutrition;
     if ($nutrition) {
       foreach($nutrition as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting drugs tests
     $drugs =$request->drugs;
     if ($drugs) {
       foreach($drugs as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting stool tests
     $stool =$request->stool;
     if ($stool) {
       foreach($stool as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }


     // Inserting coagu tests
     $coagu =$request->coagu;
     if ($coagu) {
       foreach($coagu as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting haema tests
     $haema =$request->haema;
     if ($haema) {
       foreach($haema as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting serology tests
     $serology =$request->serology;
     if ($serology) {
       foreach($serology as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting microbiology tests
     $microbiology =$request->microbiology;
     if ($microbiology) {
       foreach($microbiology as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting tb tests
     $tb =$request->tb;
     if ($tb) {
       foreach($tb as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting allergy tests
     $allergy =$request->allergy;
     if ($allergy) {
       foreach($allergy as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting immuno tests
     $immuno =$request->immuno;
     if ($immuno) {
       foreach($immuno as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting hiv tests
     $hiv =$request->hiv;
     if ($hiv) {
       foreach($hiv as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting linus tests
     $linus =$request->linus;
     if ($linus) {
       foreach($linus as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting olab tests
     $olab =$request->olab;
     if ($olab) {
       foreach($olab as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
     // Inserting common tests
     $common =$request->common;
     if ($common) {
       foreach($common as $key) {
     $patienttd = DB::table('patient_test_details')->insert([
                  'patient_test_id' => $ptid,
                  'afya_user_id'=> $afya_user_id,
                  'dependant_id' => $dependant_id,
                  'appointment_id' => $appointment,
                  'conditional_diag_id'=> $conditional_diag_id,
                  'tests_reccommended' => $key,
                  'done' => 0,
               ]);
              }
     }
  return redirect()->route('testes', ['id' => $appointment]);
      }

}
