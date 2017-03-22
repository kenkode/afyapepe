<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Facility;
use Session;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $facilities=Facility::get();
      return view('facility.index')->with('facilities',$facilities);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('facility.create');
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
      $facility= new Facility();
      $facility->name=$request->name;
      $facility->save();




      Session::flash('success','The facility was successfully added!!');


     return redirect()->route('facility.index');
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
      $facility=Facility::find($id);
      return view('facility.edit')->with('facility',$facility);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,array(
        'name'=>'required|max:250',
      ));

$facility=Facility::find($id);
$facility->name=$request->name;
$facility->save();
Session::flash('success','The facility was successfully updated!!');


return redirect()->route('facility.index');
    }

    public function ffacility(Request $request)
     {
         $term = trim($request->q);
             if (empty($term)) {
              return \Response::json([]);
         }

         $facility = Facility::search($term)->limit(20)->get();
          $formatted_facility = [];
     foreach ($facility as $fac) {
             $formatted_facility[] = ['id' => $fac->id, 'text' => $fac->FacilityName];
         }

         return \Response::json($formatted_facility);
     }


}
