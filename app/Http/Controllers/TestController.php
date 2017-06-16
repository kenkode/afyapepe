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
      ->leftJoin('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
      ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
   ->leftJoin('facility_test', 'patient_test.facility', '=', 'facility_test.facilitycode')
     ->select('afya_users.*','patient_test.id as tid','patient_test.created_at as date',
      'patient_test.test_status','appointments.persontreated',
      'dependant.firstName as depname','dependant.secondName as depname2',
      'dependant.gender as depgender','dependant.dob as depdob')
      ->where([  ['patient_test.test_status', '=',0],
                 ['facility_test.user_id', '=',Auth::user()->id],
                   ])
     ->orwhere([  ['patient_test.test_status', '=',2],
                ['facility_test.user_id', '=',Auth::user()->id],
                  ])
      ->get();

        return view('test.home')->with('tsts',$tsts);
    }

public function testdetails($id){

  $pdetails = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->select('appointments.*')
  ->where('patient_test.id', '=',$id)
  ->first();
$tsts = DB::table('patient_test')
    ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
    ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
    ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
    ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
    ->select('diagnoses.name as disease','patient_test_details.created_at as date','patient_test_details.done',
    'patient_test_details.id as patTdid','lab_test.name as testname','lab_test.category','lab_test.sub_category')

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

  $com1 =$request->comments;
  $test1 =$request->test;
  $ptd_id =$request->ptd_id;
  $film = $request->film;
  $egfr = $request->egfr;


  if($test1){
    $testRslt = DB::table('test_results')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $request->get('appointment_id'),
       'test' => $test1,
       'value' => $request->get('value'),
   ]);
 }
  if($film){
    $filmRslt1 = DB::table('film_reports')->insert([
       'ptd_id' => $ptd_id,
       'appointment_id' => $request->get('appointment_id'),
       'test' => $request->get('test'),
       'status' => $film,

]);  }
if($egfr){
  $filmRslt2 = DB::table('film_reports')->insert([
     'ptd_id' => $ptd_id,
     'appointment_id' => $request->get('appointment_id'),
     'test' =>'EGFR',
     'status' => $egfr,

]);  }

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


   $query1 = DB::table('patient_test_details')
           ->select(DB::raw('count(id) as idz'))
           ->where([  ['patient_test_id', '=', $ptid],
                      ['done', '=', 1],
                        ])
  ->first();

   $count1 = $query1->idz;
   $query2 = DB::table('patient_test_details')
           ->select(DB::raw('count(id) as ids'))
           ->where('patient_test_id', '=', $ptid)
           ->first();
   $count2 = $query2->ids;

   if($count1 == $count2)
   {
    DB::table('patient_test')
               ->where('id', $ptid)
              ->update(
                ['test_status' => 1, 'updated_at'=> $now]
              );
   }else {
     DB::table('patient_test')
               ->where('id', $ptid)
               ->update(
                 ['test_status' => 2, 'updated_at'=> $now]
               );
             }

}
$testDdone=DB::table('patient_test_details')->where('id', '=',$ptd_id)->distinct()->first(['results','patient_test_id']);

if ($testDdone->results) {
  return redirect()->route('patientTests',$testDdone->patient_test_id);
} else { return redirect()->route('perftest',$ptd_id); }
}

        public function actions($id)
        {
          $tsts1 = DB::table('patient_test_details')
          ->Join('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
          ->select('lab_test.name','lab_test.sub_category','lab_test.category','patient_test_details.*')
          ->where('patient_test_details.id', '=',$id)
          ->first();
           return view('test.action')->with('tsts1',$tsts1);
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
