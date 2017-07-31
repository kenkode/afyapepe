<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Patienttest;
use Illuminate\Support\Facades\Input;
use Auth;
use Carbon\Carbon;

class PatientTestController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function xrayreports(Request $request)
     {
      $appointment=$request->get('appointment_id');
      $rtd_id = $request->get('rtd_id');

       $tsts1 = DB::table('radiology_test_details')
       ->Join('appointments', 'radiology_test_details.appointment_id', '=', 'appointments.id')
      ->Join('patient_test', 'radiology_test_details.patient_test_id', '=', 'patient_test.id')
    ->Join('facility_test', 'radiology_test_details.user_id', '=', 'facility_test.user_id')
       ->Join('facilities', 'facility_test.facilitycode', '=', 'facilities.FacilityCode')
      ->Join('test_categories', 'radiology_test_details.test_cat_id', '=', 'test_categories.id')
      ->Join('xray', 'radiology_test_details.test', '=', 'xray.id')
   ->select('appointments.*','appointments.persontreated','test_categories.name as category',
      'radiology_test_details.*','radiology_test_details.id as rtdid','facility_test.secondname',
      'xray.name as tstname','xray.technique','xray.id as xrayid','facilities.FacilityName','facility_test.firstname')
       ->where([['radiology_test_details.id', '=',$rtd_id],['radiology_test_details.appointment_id', '=',$appointment],])
       ->first();

       $patientD=DB::table('appointments')
       ->leftjoin('triage_details','appointments.id','=','triage_details.appointment_id')
      ->leftjoin('triage_infants','appointments.id','=','triage_infants.appointment_id')
    ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
     ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
     ->leftJoin('patient_admitted', 'appointments.id', '=', 'patient_admitted.appointment_id')
       ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
       ->select('appointments.*','afya_users.firstname','afya_users.dob','afya_users.secondName','afya_users.gender',
         'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
         'dependant.dob as depdob','facilities.FacilityName','facilities.set_up','patient_admitted.condition',
         'triage_details.lmp as almp','triage_details.pregnant as apregnant','triage_infants.lmp as dlmp','triage_infants.pregnant as dpregnant')
       ->where('appointments.id',$appointment)
       ->get();
    return view('doctor.reportxray')->with('tsts1',$tsts1)->with('patientD',$patientD);
     }



}
