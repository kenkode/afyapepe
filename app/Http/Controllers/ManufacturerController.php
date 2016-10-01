<?php
  
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(){
     	$this->middleware('manufacturer');
     }
    public function index()
    {
        $manufacturers= Manufacturer::get();
        return view('manufacturer.index')->with('manufacturers',$manufacturers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manufacturer.create');
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
      $manufacturer= new Manufacturer();
      $manufacturer->name=$request->name;
      $manufacturer->save();




      Session::flash('success','The Manufacturer was successfully added!!');


     return redirect()->route('manufacturer.index');
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
      $manufacturer=Manufacturer::find($id);
      return view('manufacturer.edit')->with('manufacturer',$manufacturer);
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

$manufacturer=Manufacturer::find($id);
$manufacturer->name=$request->name;
$manufacturer->save();
Session::flash('success','The manufacturer was successfully updated!!');


return redirect()->route('manufacturer.index');
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
