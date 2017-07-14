<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Patient;
use App\Druglist;
use App\Test;
use App\TestDetails;
use Carbon\Carbon;
use Auth;
class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $facid = DB::table('facility_test')->where('user_id', '=', Auth::user()->id)->first();

      $tsts = DB::table('patient_test')
      ->Join('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
      ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
      ->Join('afyamessages', 'afya_users.msisdn', '=', 'afyamessages.msisdn')
      ->leftJoin('dependant', 'afya_users.id', '=', 'dependant.afya_user_id')
      ->Join('facilities', 'patient_test.facility_from', '=', 'facilities.FacilityCode')
      ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
      ->select('afya_users.*','patient_test.id as tid','patient_test.created_at as date',
      'patient_test.test_status','doctors.name as doc','facilities.FacilityName as fac',
      'appointments.persontreated',
      'dependant.firstName as depname','dependant.secondName as depname2',
      'dependant.gender as depgender','dependant.dob as depdob')
      ->where([  ['patient_test.test_status', '!=',1],
                 ['afyamessages.test_center_code', '=',$facid->facilitycode],

                           ])
     ->whereNull('afyamessages.status')
     ->get();
    return view('test.home')->with('tsts',$tsts);
    }

public function testdetails($id){

  $pdetails = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('doctors', 'patient_test.doc_id', '=', 'doctors.id')
  ->select('appointments.*','doctors.name as docname','patient_test_details.appointment_id as appid',
  'patient_test_details.id as ptd_id','patient_test.id as ptid')
  ->where('patient_test.id', '=',$id)
  ->first();
$tsts = DB::table('patient_test')
    ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
    ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
    ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
    ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
    ->leftJoin('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
    ->leftJoin('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')

    ->select('tests.name as tname','test_subcategories.name as tsname','diagnoses.name as dname','patient_test_details.created_at as date',
    'patient_test_details.id as patTdid','test_categories.name as tcname','patient_test_details.testmore')

    ->where([
                  ['patient_test.id', '=',$id],
                  ['patient_test_details.done', '=',0],

                 ])
    ->get();
return view('test.pdetails')->with('tsts',$tsts)->with('pdetails',$pdetails);
}

    public function testSales(){
        return view('test.testsales');

    }
public function testAnalytics(){
  return view('test.testanalytics');

}

public function testResult(Request $request)
{
$now = Carbon::now();

  $test1 =$request->testrangesId;
  $test2 =$request->test_value;
  $ptd_id =$request->ptd_id;
  $comment =$request->comment;
  $appid = $request->appointment_id;
  $test_id = $request->test_id;
  if($test2){
$pttids=DB::table('test_results')
->where([ ['appointment_id','=',$appid],
         ['test_results.ptd_id', '=',$ptd_id],
         ['test_results.test_ranges_id', '=',$test1],])
  ->first();

if (is_null($pttids)) {
    $testRslt = DB::table('test_results')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'test_ranges_id' => $test1,
       'value' => $test2,
       'comments' => $comment,
       'tests_id' => $test_id,
   ]);
 }
 }
 $query11 = DB::table('test_ranges')
         ->select(DB::raw('count(id) as idt'))
         ->where('tests_id', '=', $test_id)
 ->first();

 $count11 = $query11->idt;
 $query22 = DB::table('test_results')
         ->select(DB::raw('count(id) as idp'))
         ->where([ ['appointment_id','=',$appid],
                  ['ptd_id', '=',$ptd_id],
                  ['tests_id', '=',$test_id],
                 ])
         ->first();
 $count22 = $query22->idp;

 if($count11 == $count22)
 {

   $tsts1 = DB::table('patient_test_details')
   ->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
   ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
   ->Join('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
   ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
   ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
   ->select('doctors.name as docname','tests.id as tests_id','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
   'test_subcategories.name as sub_category','patient_test_details.*')
   ->where('patient_test_details.id', '=',$ptd_id)
   ->first();
   return view('test.report2')->with('tsts1',$tsts1);
 }else {
  return redirect()->action('TestController@actions', ['id' => $ptd_id]);

   }
}
public function testResult3(Request $request)
{
$now = Carbon::now();
  $units=$request->units;
  $test1 =$request->tests_id;
  $test2 =$request->value;
  $ptd_id =$request->ptd_id;
  $appid = $request->appointment_id;
  $com = $request->comments;
  $com2= $request->comments2;
  $facility= $request->facility;
  if($test1){
$pttids=DB::table('test_results')
->where([ ['appointment_id','=',$appid],
         ['test_results.ptd_id', '=',$ptd_id],
         ['test_results.test_ranges_id', '=',$test1],])
  ->first();

if (is_null($pttids)) {
    $testRslt = DB::table('test_results')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'tests_id' => $test1,
       'value' => $test2,
       'units' => $units,
       'status' => 1,
   ]);
 }
 }

 if($com){
   DB::table('patient_test_details')
     ->where('id',$ptd_id)
     ->update(['done'  =>1,
      'results'  => $com,
      'note'  => $com2,
      'facility_done'  => $facility,
      'updated_at'  => $now,
    ]);

    $tsts = DB::table('patient_test_details')->where('id', '=', $ptd_id)->first();
    $ptid=$tsts->patient_test_id;
    $appid=$tsts->appointment_id;

    $tsts11 = DB::table('patient_test_details')
    ->where([ ['patient_test_id', '=', $ptid],
             ['appointment_id', '=', $appid],
            ['done', '=', '0'], ])
    ->first();
 if($tsts11){
     DB::table('patient_test')
                ->where('id', $ptid)
               ->update(
                 ['test_status' => 2, 'updated_at'=> $now]
               );
 }else{
   DB::table('patient_test')
              ->where('id', $ptid)
             ->update(
               ['test_status' => 1, 'updated_at'=> $now]
             );
 }
  }
return redirect()->route('patientTests',$ptid);

}

public function testResult4(Request $request)
{
$now = Carbon::now();
  $units=$request->units;
  $test1 =$request->test;
  $test2 =$request->value;
  $ptd_id =$request->ptd_id;
  $appid = $request->appointment_id;
  $com = $request->comments;
  $com2= $request->comments2;
  $facility= $request->facility;


    $testRslt = DB::table('test_results')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'result_name' => $test1,
       'value' => $test2,
       'comments' => $com,
       'notes' => $com2,
       'units' =>$units,

   ]);
   return redirect()->action('TestController@actions', ['id' => $ptd_id]);


}
public function testResult5(Request $request)
{
$now = Carbon::now();
  $ptd_id =$request->ptd_id;
  $appid = $request->appointment_id;
$facility= $request->facility;


   DB::table('patient_test_details')
     ->where('id',$ptd_id)
     ->update(['done'  =>1,
      'facility_done'  => $facility,
      'updated_at'  => $now,
    ]);

    $tsts = DB::table('patient_test_details')->where('id', '=', $ptd_id)->first();
    $ptid=$tsts->patient_test_id;
    $appid=$tsts->appointment_id;

    $tsts11 = DB::table('patient_test_details')
    ->where([ ['patient_test_id', '=', $ptid],
             ['appointment_id', '=', $appid],
            ['done', '=', '0'], ])
    ->first();
 if($tsts11){
     DB::table('patient_test')
                ->where('id', $ptid)
               ->update(
                 ['test_status' => 2, 'updated_at'=> $now]
               );
 }else{
   DB::table('patient_test')
              ->where('id', $ptid)
             ->update(
               ['test_status' => 1, 'updated_at'=> $now]
             );
 }

return redirect()->route('patientTests',$ptid);

}
public function ctest(Request $request)
{
$now = Carbon::now();
  $ptd_id =$request->ptd_id;
  $appid = $request->appointment_id;
  $test =$request->test;
  $value =$request->value;
  $units =$request->units;
  $comment =$request->comments;
  $comment2 =$request->comments2;
  $reason =$request->reason;
  $ptid=$request->ptid;


$testRslt6 = DB::table('test_results')->insert([
   'ptd_id' => $ptd_id,
   'appointment_id' => $appid,
   'result_name' => $test,
   'value' => $value,
   'units' => $units,
   'comments' => $comment,
   'notes' => $comment2,
   'reason' => $reason,
]);
return redirect()->action('TestController@testdetails', ['id' => $ptid]);

//return redirect()->route('patientTests',$ptid);
}
public function testreport(Request $request)
{
$now = Carbon::now();

  $com1 =$request->comments;
  $com2 =$request->comments2;
  $ptd_id =$request->ptd_id;
  $facility =$request->facility;



if($com1){
  DB::table('patient_test_details')
    ->where('id',$ptd_id)
    ->update(['done'  =>1,
     'results'  => $com1,
     'note'  => $com2,
     'facility_done'  => $facility,
     'updated_at'  => $now,
   ]);

   $tsts = DB::table('patient_test_details')->where('id', '=', $ptd_id)->first();
   $ptid=$tsts->patient_test_id;
   $appid=$tsts->appointment_id;

   $tsts11 = DB::table('patient_test_details')
   ->where([ ['patient_test_id', '=', $ptid],
            ['appointment_id', '=', $appid],
           ['done', '=', '0'], ])
   ->first();
if($tsts11){
    DB::table('patient_test')
               ->where('id', $ptid)
              ->update(
                ['test_status' => 2, 'updated_at'=> $now]
              );
}else{
  DB::table('patient_test')
             ->where('id', $ptid)
            ->update(
              ['test_status' => 1, 'updated_at'=> $now]
            );
}

}
return redirect()->route('patientTests',$ptid);

}

        public function actions($id)
        {
          $tsts1 = DB::table('patient_test_details')
        ->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
         ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
         ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
          ->leftJoin('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
          ->leftJoin('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
          ->select('doctors.name as docname','tests.id as tests_id','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
          'test_subcategories.name as sub_category','patient_test_details.*')
          ->where('patient_test_details.id', '=',$id)
          ->first();
           return view('test.action')->with('tsts1',$tsts1);
        }


public function testupdate(Request $request){
  $now = Carbon::now();
  $test1 =$request->test_rid;
  $value =$request->value;
  $ptd_id= $request->ptd_id;
if($test1){
  DB::table('test_results')
    ->where('id', $test1)
    ->update(
      ['value' => $value , 'updated_at'=> $now]  );
    }
    $tsts1 = DB::table('patient_test_details')
  ->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
   ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
   ->Join('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
    ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
    ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
    ->select('doctors.name as docname','tests.id as tests_id','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
    'test_subcategories.name as sub_category','patient_test_details.*')
    ->where('patient_test_details.id', '=',$ptd_id)
    ->first();

  return view('test.report2')->with('tsts1',$tsts1);

}

function Strength(){
 $Strength = DB::table('strength')
 ->get();
return $Strength;
}
function RouteM(){
 $routem = DB::table('route')
 ->get();
return $routem;
}
function Frequency(){
 $frequency = DB::table('frequency')
 ->get();
return $frequency;
}
  public function TestListdetails(){
    $testsd = DB::table('test_details')
    ->get();
   return $testsd;
}

public function fdrugs(Request $request)
 {
     $term = trim($request->q);
  if (empty($term)) {
       return \Response::json([]);
     }
   $drugs = Druglist::search($term)->limit(50)->get();
     $formatted_drugs = [];
      foreach ($drugs as $drug) {
         $formatted_drugs[] = ['id' => $drug->id, 'text' => $drug->drugname];
     }
 return \Response::json($formatted_drugs);
 }
 function TDetails(){

   $TDetails = DB::table('facility_test')
   ->leftJoin('facilities', 'facility_test.facilitycode', '=', 'facilities.FacilityCode')
   ->where('facility_test.user_id', '=', Auth::user()->id)->get();
  return $TDetails;
}


}
