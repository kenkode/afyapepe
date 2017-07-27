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
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',
        
    ]);
    $id=$request->radiology_td_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {           
        

        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        
    }
    }
   
return redirect()->action('TestController@grapherxray',['id'=> $id]);
    
  }

  public function fileUploads(Request $request) {
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',
        
    ]);
    $id=$request->radiology_td_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {           
        

        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        
    }
    }
   
return redirect()->action('TestController@grapherct',['id'=> $id]);
    
  }
  public function fileUploade(Request $request) {
    $this->validate($request, [
        'image' => 'required',
        'radiology_td_id' => 'required',
        
    ]);
    $id=$request->radiology_td_id;

    $document = new Document($request->input()) ;

     if($file = $request->hasFile('image')) {

        $files = $request->file('image') ;
        foreach ($files as $file) {           
        

        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images/' ;
        $file->move($destinationPath,$fileName);

        DB::table('radiology_images')->insert(['radiology_td_id'=>$id,
            'image'=>$fileName,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()]);
        
    }
    }
   
return redirect()->action('TestController@graphermri',['id'=> $id]);
    
  }
    public function file_Uploads(Request $request)
{

        $this->validate($request, [
   'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);


        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
        $this->postImage->add($input);


        return back()->with('success','Image Upload successful');
    }


}



