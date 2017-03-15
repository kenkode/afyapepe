<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Patient;
use App\Druglist;
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

        return view('test.home');
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
 $routem = DB::table('Route')
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
