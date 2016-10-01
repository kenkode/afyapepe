<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
      $pharmacys=Pharmacy::get();
      return view('pharmacyconf.index')->with('pharmacys',$pharmacys);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function create()
    {
        return view('pharmacyconf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,array(
          'name'=>'required|max:255',

  ));
      $pharmacy= new Pharmacy();
      $pharmacy->name=$request->name;
      $pharmacy->save();




      Session::flash('success','The pharmacy was successfully added!!');


     return redirect()->route('pharmacyconf.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $pharmacy=Pharmacy::find($id);
      return view('pharmacyconf.edit')->with('pharmacy',$pharmacy);
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
      $this->validate($request,array(
        'name'=>'required|max:250',
      ));

$pharmacy=Pharmacy::find($id);
$pharmacy->name=$request->name;
$pharmacy->save();
Session::flash('success','The pharmacy was successfully updated!!');


return redirect()->route('pharmacyconf.index');
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
}
