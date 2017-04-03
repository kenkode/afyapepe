<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Patient;
use App\Druglist;
use App\Test;
use App\TestDetails;
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
      ->Join('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
      ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
      ->Join('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
      ->Join('diseases', 'patient_test_details.conditional_diagnosis', '=', 'diseases.code')
      ->select('afya_users.*','diseases.name as disease','patient_test_details.created_at as date')
      ->where('patient_test.test_status', '=',0)
      ->get();

        return view('test.home')->with('tsts',$tsts);
    }

public function testdetails($id){
  $tsts = DB::table('patient_test')
  ->Join('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->Join('afya_users', 'appointments.afya_user_id', '=', 'afya_users.id')
  ->Join('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->Join('diseases', 'patient_test_details.conditional_diagnosis', '=', 'diseases.code')
  ->Join('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
  ->select('afya_users.*','diseases.name as disease','patient_test_details.created_at as date','patient_test_details.done',
  'lab_test.test_type_id','lab_test.name as test','lab_test.sub_category','lab_test.category','lab_test.id as testid')
  ->where('patient_test.id', '=',$id)
  ->get();
return view('test.pdetails')->with('tsts',$tsts);
}

public function testing(){

    return view('test.test');

}
    public function testSales(){
        return view('test.testsales');

    }
public function testAnalytics(){
  return view('test.testanalytics');

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
        public function update(Request $request, $id)
        {

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
   $drugs = Druglist::search($term)->limit(20)->get();
     $formatted_drugs = [];
      foreach ($drugs as $drug) {
         $formatted_drugs[] = ['id' => $drug->id, 'text' => $drug->drugname];
     }
 return \Response::json($formatted_drugs);
 }


}
