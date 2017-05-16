<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Manufacturer;
use App\DruglistController;
use DB;
use Carbon\Carbon;


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


    public function Trends(){
      return view ('manufacturer.trends');
    }

    public function SectorSummary(){
      return view('manufacturer.sectorsummary');
    }

   public function todaysales(){
      $today = Carbon::today();

     $drugs = DB::table('prescriptions')
      ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
      ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
      ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
      ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
      ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
      ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
      ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
      ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
      'prescription_details.doseform',
      'prescription_filled_status.substitute_presc_id')
    ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
            ['prescription_filled_status.created_at','>=',$today],
          ])

    ->get();
    $yesterday = Carbon::now();
    $one_week_ago = Carbon::now()->subWeeks(1);
    $drugw = DB::table('prescriptions')
     ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
     ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
     ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
     ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
     ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
     ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
     ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
     ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
     'prescription_details.doseform',
     'prescription_filled_status.substitute_presc_id')
   ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
           ['prescription_filled_status.created_at','>=',$one_week_ago],
           ['prescription_filled_status.created_at','<=',$yesterday],
         ])

   ->get();
     return view('manufacturer.todaysales')->with('drugs',$drugs)->with('drugw',$drugw);

  }

    public function manuDoctor(){
       return view('manufacturer.manudoctor');


    return view ('manufacturer.todaysales');
   }

 public function drugsubstitution(){

  return view('manufacturer.drugsubstitutions');
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
