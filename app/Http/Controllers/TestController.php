<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

use App\Patient;
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

        function drugList(){
       $drugs = DB::table('druglists')
       ->get();
      return $drugs;
      }


    function TestList(){
   $tests = DB::table('test_details')
   ->Join('tests', 'test_details.test_id', '=', 'tests.id')
   ->select('test_details.*','tests.name')
   ->get();
  return $tests;
  }
function Diseases(){
 $diseases = DB::table('diseases') ->get();
return $diseases;
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

}
