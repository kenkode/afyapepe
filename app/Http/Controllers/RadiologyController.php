<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;

class RadiologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{

    $this->validate($request, [
    'appointment_id' => 'required', ]);
    $appointment=$request->get('appointment_id');


$pttids= Patienttest::where('appointment_id',$appointment)
  ->first();

     if (is_null($pttids)) {
$PatientTest = Patienttest ::create([
  'appointment_id' => $request->get('appointment_id'),
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

$now = Carbon::now();


// Inserting Xray tests
 $xray=$request->xray;
     if ($xray) {
       foreach($xray as $key) {
     $xraydetails = DB::table('radiology_test_details')->insert([
                 'patient_test_id' => $ptid,
                 'appointment_id' => $appointment,
                 'clinicalinfo' => $request->get('cixray'),
                 'test_cat_id' => $request->get('xray_catid'),
                 'target' => $request->get('xraytarget'),
                 'test' => $key,
                 'done' => 0,
                 'confirm' => 'N',
                 'created_at' => $now,
              ]);
              }
     }
     // Inserting ct scan tests
      $ctscans=$request->ctscan;
          if ($ctscans) {
            foreach($ctscans as $key) {
          $ctdetails = DB::table('radiology_test_details')->insert([
                      'patient_test_id' => $ptid,
                      'appointment_id' => $appointment,
                      'clinicalinfo' => $request->get('cict'),
                      'test_cat_id' => $request->get('ct_catid'),
                      'target' => $request->get('cttarget'),
                      'test' => $key,
                      'done' => 0,
                      'confirm' => 'N',
                      'created_at' => $now,
                   ]);
                   }
          }
          // Inserting MRI tests
           $mri=$request->mri;
               if ($mri) {
                 foreach($mri as $key) {
               $mridetails = DB::table('radiology_test_details')->insert([
                           'patient_test_id' => $ptid,
                           'appointment_id' => $appointment,
                           'clinicalinfo' => $request->get('cimri'),
                           'test_cat_id' => $request->get('mri_catid'),
                           'target' => $request->get('mritarget'),
                           'test' => $key,
                           'done' => 0,
                           'confirm' => 'N',
                           'created_at' => $now,
                        ]);
                        }
               }
               // Inserting ultrasound tests
                $ultra=$request->ultra;
                    if ($ultra) {
                      foreach($ultra as $key) {
                    $ultradetails = DB::table('radiology_test_details')->insert([
                                'patient_test_id' => $ptid,
                                'appointment_id' => $appointment,
                                'clinicalinfo' => $request->get('ciultra'),
                                'test_cat_id' => $request->get('ultra_catid'),
                                'target' => $request->get('ultratarget'),
                                'test' => $key,
                                'done' => 0,
                                'confirm' => 'N',
                                'created_at' => $now,
                             ]);
                             }
                    }
  return redirect()->route('testes', ['id' => $appointment]);
      }
      public function destroytest($id)
      {
        $pttd=DB::table('radiology_test_details')
        ->where('id',$id)
        ->first();
        DB::table("radiology_test_details")->where('id',$id)->delete();

  return redirect()->route('testes',$pttd->appointment_id);
  }




}
