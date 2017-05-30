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
      ->select('afya_users.*','patient_test.id as tid','patient_test.created_at as date',
      'patient_test.test_status','appointments.persontreated','dependant.firstName as depname',
      'dependant.firstName as depname','dependant.secondName as depname2','dependant.gender as depgender',
      'dependant.dob as depdob')
      ->where('patient_test.test_status', '=',0)

      ->get();

        return view('test.home')->with('tsts',$tsts);
    }

public function testdetails($id){

  $triage = DB::table('patient_test')
  ->Join('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->Join('triage_details', 'patient_test.appointment_id', '=', 'triage_details.appointment_id')
  ->Join('triage_infants', 'patient_test.appointment_id', '=', 'triage_infants.appointment_id')
  ->select('triage_details.*','appointments.*','triage_infants.*')
  ->where('patient_test.id', '=',$id)
  ->get();




  $tsts = DB::table('patient_test')
  ->Join('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
  ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
  ->Join('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->Join('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
  ->Join('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
  ->select('afya_users.*','diagnoses.name as disease','patient_test_details.created_at as date','patient_test_details.done',
  'patient_test_details.id as patTdid','triage_details.*','lab_test.name as testname','lab_test.category','lab_test.sub_category')

  ->where([
                ['patient_test.id', '=',$id],
                ['patient_test_details.done', '=',0],

               ])
  ->get();

return view('test.pdetails')->with('tsts',$tsts)->with('triage',$triage);
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
  $testId =$request->testId;
  DB::table('patient_test_details')
    ->where('id',$testId)
    ->update(['done'  =>1,
    'results'  => $request['results'],
     'note'  => $request['notes'],
     'updated_at'  => $request['notes'],
   ]);

   $tsts = DB::table('patient_test_details')->where('id', '=', $testId)->first();
   $appid=$tsts->patient_test_id;


   $query1 = DB::table('patient_test_details')
           ->select(DB::raw('count(id) as idz'))
           ->where([
                     ['patient_test_id', '=', $appid],
                      ['done', '=', 1],
                        ])

           ->first();
   $count1 = $query1->idz;
   $query2 = DB::table('patient_test_details')
           ->select(DB::raw('count(id) as ids'))
           ->where('patient_test_id', '=', $appid)
           ->first();
   $count2 = $query2->ids;

   if($count1 == $count2)
   {
    DB::table('patient_test')
              ->where('id', $appid)
              ->update(
                ['test_status' => 1, 'updated_at'=> $now]
              );
   }else {
     DB::table('patient_test')
               ->where('id', $appid)
               ->update(
                 ['test_status' => 2, 'updated_at'=> $now]
               );
             }


   return redirect()->route('patientTest',$appid);
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

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {

        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {

        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */



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


// DB::table('users')->orderBy('id')->chunk(100, function($users)
// $categories = \DB::table('categories')->orderBy('name')->take(10)->get();

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


}
