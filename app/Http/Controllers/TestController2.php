<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\Patient;
use App\Druglist;
use App\Test;
use App\TestDetails;
use App\Document;
use Carbon\Carbon;
use Auth;
class TestController2 extends Controller
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
public function fileUpload(Request $request) {
  $now = Carbon::now();
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',

    ]);
    $ptid=$request->patient_test_id;
    $id=$request->radiology_td_id;
    $user_id=$request->user_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {


        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'user_id'=>$user_id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
             'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

    }
    }
    DB::table('radiology_test_details')
                     ->where('id',$id)
                     ->update(['done'  =>1,
                      'updated_at'  => $now,
                    ]);


return redirect()->action('TestController@radydetails', ['id' => $ptid]);
  }

  public function fileUploads(Request $request) {
    $now = Carbon::now();
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',

    ]);
    $ptid=$request->patient_test_id;
    $id=$request->radiology_td_id;
    $user_id=$request->user_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {


        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'user_id'=>$user_id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

    }
    }
    DB::table('radiology_test_details')
                     ->where('id',$id)
                     ->update(['done'  =>1,
                      'updated_at'  => $now,
                    ]);

return redirect()->action('TestController@radydetails', ['id' => $ptid]);

  }
  public function fileUploade(Request $request) {
    $now = Carbon::now();
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',

    ]);
    $ptid=$request->patient_test_id;
    $id=$request->radiology_td_id;
    $user_id=$request->user_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {


        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'user_id'=>$user_id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

    }
    }
    DB::table('radiology_test_details')
                     ->where('id',$id)
                     ->update(['done'  =>1,
                      'updated_at'  => $now,
                    ]);
return redirect()->action('TestController@radydetails', ['id' => $ptid]);

  }

   public function fileUploady(Request $request) {
     $now = Carbon::now();
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',

    ]);
    $ptid=$request->patient_test_id;
    $id=$request->radiology_td_id;
    $user_id=$request->user_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {


        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'user_id'=>$user_id,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);

    }
    }
    DB::table('radiology_test_details')
                     ->where('id',$id)
                     ->update(['done'  =>1,
                      'updated_at'  => $now,
                    ]);
return redirect()->action('TestController@radydetails', ['id' => $ptid]);

  }




    public function xrayfindings(Request $request)
    {
    $now = Carbon::now();

      $findingsId =$request->findingsId;
      $r_td_id =$request->radiology_td_id;
      $result =$request->result;
$findingsRslt = DB::table('radiology_test_result')->insert([
           'radiology_td_id' => $r_td_id,
           'findings_id' => $findingsId,
           'results' => $result,
           'created_at' => $now,
                   ]);
return redirect()->action('TestController@grapherxray', ['id' => $r_td_id]);
}
public function mrifindings(Request $request)
{
$now = Carbon::now();

  $findingsId =$request->findingsId;
  $r_td_id =$request->radiology_td_id;
  $result =$request->result;
$findingsRslt = DB::table('radiology_test_result')->insert([
       'radiology_td_id' => $r_td_id,
       'findings_id' => $findingsId,
       'results' => $result,
       'created_at' => $now,
               ]);
return redirect()->action('TestController@graphermri', ['id' => $r_td_id]);
}
public function ultrafindings(Request $request)
{
$now = Carbon::now();

  $findingsId =$request->findingsId;
  $r_td_id =$request->radiology_td_id;
  $result =$request->result;
$findingsRslt = DB::table('radiology_test_result')->insert([
       'radiology_td_id' => $r_td_id,
       'findings_id' => $findingsId,
       'results' => $result,
       'created_at' => $now,
               ]);
return redirect()->action('TestController@grapherultra', ['id' => $r_td_id]);
}
public function ctfindings(Request $request)
{
$now = Carbon::now();

  $findingsId =$request->findingsId;
  $r_td_id =$request->radiology_td_id;
  $result =$request->result;
$findingsRslt = DB::table('radiology_test_result')->insert([
       'radiology_td_id' => $r_td_id,
       'findings_id' => $findingsId,
       'results' => $result,
       'created_at' => $now,
               ]);
return redirect()->action('TestController@grapherct', ['id' => $r_td_id]);
}

public function xrayreports(Request $request)
{
$now = Carbon::now();
$user_id =$request->user_id;
  $technique =$request->technique;
  $r_td_id =$request->radiology_td_id;
  $impression =$request->impression;
DB::table('radiology_test_details')
                 ->where('id',$r_td_id)
                 ->update(['done'  =>2,
                  'technique'  => $technique,
                  'conclusion'  => $impression,
                   'updated_at'  => $now,
                ]);
return redirect()->action('TestController@index');
}
public function mrireports(Request $request)
{
$now = Carbon::now();

$user_id =$request->user_id;
  $technique =$request->technique;
  $r_td_id =$request->radiology_td_id;
  $impression =$request->impression;
DB::table('radiology_test_details')
                 ->where('id',$r_td_id)
                 ->update(['done'  =>2,
                  'technique'  => $technique,
                  'conclusion'  => $impression,
                   'updated_at'  => $now,
                ]);
return redirect()->action('TestController@index');
}
public function ctreports(Request $request)
{
$now = Carbon::now();
$user_id =$request->user_id;
  $technique =$request->technique;
  $r_td_id =$request->radiology_td_id;
  $impression =$request->impression;
DB::table('radiology_test_details')
                 ->where('id',$r_td_id)
                 ->update(['done'  =>2,
                  'technique'  => $technique,
                  'conclusion'  => $impression,
                   'updated_at'  => $now,
                ]);
return redirect()->action('TestController@index');
}
public function ultrareports(Request $request)
{
$now = Carbon::now();
  $user_id =$request->user_id;
  $technique =$request->technique;
  $r_td_id =$request->radiology_td_id;
  $impression =$request->impression;
DB::table('radiology_test_details')
                 ->where('id',$r_td_id)
                 ->update(['done'  =>2,
                  'technique'  => $technique,
                  'conclusion'  => $impression,
                   'updated_at'  => $now,
                   'updated_at'  => $now,
                   $user_id
                ]);
return redirect()->action('TestController@index');
}







}
