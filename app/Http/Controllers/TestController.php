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
      $tsts = DB::table('patient_test')
      ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
      ->leftJoin('doctors', 'patient_test.doc_id', '=', 'doctors.id')
      ->leftJoin('facilities', 'patient_test.facility_from', '=', 'facilities.FacilityCode')
      ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
      ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
   ->leftJoin('facility_test', 'patient_test.facility', '=', 'facility_test.facilitycode')
     ->select('afya_users.*','patient_test.id as tid','patient_test.created_at as date',
      'patient_test.test_status','doctors.name as doc','facilities.FacilityName as fac',
      'appointments.persontreated',
      'dependant.firstName as depname','dependant.secondName as depname2',
      'dependant.gender as depgender','dependant.dob as depdob')
      ->where([  ['patient_test.test_status', '=',0],

                   ])
        ->orwhere([  ['patient_test.test_status', '=',2],

                  ])
      ->get();

        return view('test.home')->with('tsts',$tsts);
    }

public function testdetails($id){

  $pdetails = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->leftJoin('doctors', 'patient_test.doc_id', '=', 'doctors.id')
  ->select('appointments.*','doctors.name as docname')
  ->where('patient_test.id', '=',$id)
  ->first();
$tsts = DB::table('patient_test')
    ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
    ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
    ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
    ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
    ->leftJoin('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
    ->leftJoin('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')

    ->select('patient_test_details.test_subcategories_id as subcat','diagnoses.name as disease','patient_test_details.created_at as date','patient_test_details.done',
    'patient_test_details.id as patTdid','tests.name as testname','test_categories.name as category','test_subcategories.name as sub_category')

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
  $film = $request->film;
  $egfr = $request->egfr;
$labd = $request->subcatid;
$appid = $request->appointment_id;
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
       'test_ranges_id' => $test1,
       'value' => $test2,
       'status' => 1,
   ]);
 }
 }
  $tsts1 = DB::table('patient_test_details')
  ->Join('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
  ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
  ->select('tests.name','test_categories.name as category',
  'test_subcategories.name as sub_category','patient_test_details.*')
  ->where('patient_test_details.id', '=',$ptd_id)
  ->first();
  return view('test.report')->with('tsts1',$tsts1);
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
      'note'  => $request['comments2'],
      'facility_done'  => $request['facility'],
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
//  return view('test.report')->with('tsts1',$tsts1);
}
public function testResult2(Request $request)

{
$now = Carbon::now();

  $test1 =$request->rangesId;
  $test2 =$request->test_value;
  $ptd_id =$request->ptd_id;
  $film = $request->film;
  $egfr = $request->egfr;
$labd = $request->subcatid;
$appid = $request->appointment_id;
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
       'tests_id' =>'N/A',
       'test_ranges_id' => $test1,
       'value' => $test2,
       'status' => 1,
   ]);
 }
 }
  if($film){
    $filmRslt1 = DB::table('film_reports')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'test' => $test1,
       'status' => $film,

]);  }
if($egfr){
  $filmRslt2 = DB::table('film_reports')->insert([
     'ptd_id' => $ptd_id,
     'appointment_id' => $appid,
     'test' =>'EGFR',
     'status' => $egfr,

]);  }

$query11 = DB::table('tests')
        ->select(DB::raw('count(id) as idt'))
        ->where('sub_categories_id', '=', $labd)
->first();

$count11 = $query11->idt;
$query22 = DB::table('test_results')
        ->select(DB::raw('count(id) as idp'))
        ->where([ ['appointment_id','=',$appid],
                 ['ptd_id', '=',$ptd_id],  ])
        ->first();
$count22 = $query22->idp;

if($count11 == $count22)
{
  $tsts1 = DB::table('patient_test_details')
->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
 ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
 ->Join('tests', 'patient_test_details.test_subcategories_id', '=', 'tests.sub_categories_id')
  ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
  ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
  ->select('doctors.name as docname','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
  'test_subcategories.name as sub_category','patient_test_details.*')
  ->where('patient_test_details.id', '=',$ptd_id)
  ->first();
  return view('test.report2')->with('tsts1',$tsts1);
}else {
return redirect()->route('perftest2',$ptd_id);
  }

}
public function testResult22(Request $request)
{
$now = Carbon::now();

  $testId =$request->testId;
  $test2 =$request->test_value;
  $ptd_id =$request->ptd_id;
  $film = $request->film;
  $egfr = $request->egfr;
$labd = $request->subcatid;
$appid = $request->appointment_id;
  if($testId){
$pttids=DB::table('test_results')
->where([ ['appointment_id','=',$appid],
         ['test_results.ptd_id', '=',$ptd_id],
         ['test_results.tests_id', '=',$testId],])

  ->first();

if (is_null($pttids)) {
    $testRslt = DB::table('test_results')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'tests_id' =>$testId,
       'test_ranges_id' => 'N/A',
       'value' => $test2,
       'status' => 1,
   ]);
 }
 }
  if($film){
    $filmRslt1 = DB::table('film_reports')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $appid,
       'test' => $test1,
       'status' => $film,

]);  }
if($egfr){
  $filmRslt2 = DB::table('film_reports')->insert([
     'ptd_id' => $ptd_id,
     'appointment_id' => $appid,
     'test' =>'EGFR',
     'status' => $egfr,

]);  }

$query11 = DB::table('tests')
        ->select(DB::raw('count(id) as idt'))
        ->where('sub_categories_id', '=', $labd)
->first();

$count11 = $query11->idt;
$query22 = DB::table('test_results')
        ->select(DB::raw('count(id) as idp'))
        ->where([ ['appointment_id','=',$appid],
                 ['ptd_id', '=',$ptd_id],  ])
        ->first();
$count22 = $query22->idp;

if($count11 == $count22)
{
  $tsts1 = DB::table('patient_test_details')
->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
 ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
 ->Join('tests', 'patient_test_details.test_subcategories_id', '=', 'tests.sub_categories_id')
  ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
  ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
  ->select('doctors.name as docname','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
  'test_subcategories.name as sub_category','patient_test_details.*')
  ->where('patient_test_details.id', '=',$ptd_id)
  ->first();
  return view('test.report2')->with('tsts1',$tsts1);
}else {
return redirect()->route('perftest2',$ptd_id);
  }

}

public function testreport(Request $request)
{
$now = Carbon::now();

  $com1 =$request->comments;
  $ptd_id =$request->ptd_id;



if($com1){
  DB::table('patient_test_details')
    ->where('id',$ptd_id)
    ->update(['done'  =>1,
    'results'  => $request['comments'],
     'note'  => $request['comments2'],
     'facility_done'  => $request['facility'],
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
         ->Join('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
          ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
          ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
          ->select('doctors.name as docname','tests.id as tests_id','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
          'test_subcategories.name as sub_category','patient_test_details.*')
          ->where('patient_test_details.id', '=',$id)
          ->first();
           return view('test.action')->with('tsts1',$tsts1);
        }

        public function actions2($id)
        {
          $tsts1 = DB::table('patient_test_details')
        ->Join('patient_test', 'patient_test_details.patient_test_id', '=', 'patient_test.id')
         ->Join('doctors', 'patient_test.doc_id', '=', 'doctors.id')
         ->Join('tests', 'patient_test_details.test_subcategories_id', '=', 'tests.sub_categories_id')
          ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
          ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
          ->select('doctors.name as docname','tests.name','test_categories.name as category','test_subcategories.id as subcatid',
          'test_subcategories.name as sub_category','patient_test_details.*')
          ->where('patient_test_details.id', '=',$id)
          ->first();
           return view('test.action2')->with('tsts1',$tsts1);
        }
public function testupdate(Request $request){
  $now = Carbon::now();
  $test1 =$request->test_rid;
  $value =$request->value;
  $film = $request->film;
 $labd = $request->subcatid;
  $ptd_id= $request->ptd_id;
  $filmrept= $request->filmrept;
  $Rprt1= $request->report1;
  if($test1){
  DB::table('test_results')
    ->where('id', $test1)
    ->update(
      ['value' => $value , 'updated_at'=> $now]  );
    }
if($film){
DB::table('film_reports')
          ->where('id',$filmrept)
          ->update(
            ['status' => $film, 'updated_at'=> $now]
          );
        }

        $tsts1 = DB::table('patient_test_details')
        ->Join('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
        ->Join('test_subcategories', 'tests.sub_categories_id', '=', 'test_subcategories.id')
        ->Join('test_categories', 'test_subcategories.categories_id', '=', 'test_categories.id')
        ->select('tests.name','test_categories.name as category',
        'test_subcategories.name as sub_category','patient_test_details.*')
        ->where('patient_test_details.id', '=',$ptd_id)
        ->first();
        if($Rprt1){
        return view('test.report')->with('tsts1',$tsts1)->with('labd',$labd);
   }else{
     return view('test.report2')->with('tsts1',$tsts1)->with('labd',$labd);
  }
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
