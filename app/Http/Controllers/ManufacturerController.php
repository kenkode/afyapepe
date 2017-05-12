<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Manufacturer;
use App\DruglistController;
use DB;


class ManufacturerController extends Controller
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
        return view('manufacturer.home');
    }

   
   public function todaysales(){

    return view ('manufacturer.todaysales');
   }

 public function drugsubstitution(){

  return view('manufacturer.drugsubstitutions');
 }
    public function manuDrug(){
       return view('manufacturer.manufacturedrug');

    }
   
    public function manuStock(){
      return view('manufacturer.manustock');

    }
    public function Competition(){
      return view('manufacturer.competition');

    }

  public function toCompany(){
    return view('manufacturer.to');

  }

    public function show()
    {

      $id1 = Auth::user()->name;
      $id2 = DB::table('manufacturers')
            ->where('manufacturer', '=', $id1)
            ->pluck('manufacturer');

      $manuf = DB::table('druglists')
              ->Join('manufacturers', 'manufacturers.id', '=', 'druglists.Manufacturer' )
              ->select('druglists.*','manufacturers.manufacturer')
              ->where('manufacturers.id', '=', '2')
              ->get();

              return view('manufacturer.show')->with('manuf',$manuf);
    }


}
