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

    public function addManu(Request $request){
             $this->validate($request, [
      'user_id'=>'required',
        'name' => 'required',
        'location' => 'required',
        'address' => 'required',
        'box' => 'required',
        'tel' => 'required',
        'logo' => 'required',
    ]);
    $document = new Manufacturer($request->input()) ;

     if($file = $request->hasFile('logo')) {

        $file = $request->file('logo') ;

        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/img/' ;
        $file->move($destinationPath,$fileName);
        $document->logo = $fileName ;
    }
    $document->save() ;
     return redirect()->action('ManufacturerController@index');

    }

    public function Trends(){
      return view ('manufacturer.trends');
    }

    public function SectorSummary(){
      $companies=DB::table('prescription_filled_status')
                                                  ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                                                  ->join('druglists','druglists.id','=','prescription_details.drug_id')
                                                 ->select('druglists.manufacturer as name','druglists.drugname as drugname','druglists.DosageForm as DosageForm','druglists.id as id')
                                                 ->selectRaw('SUM(price * quantity) as total')->orderby('total','DESC')->limit(10)->get();

      return view('manufacturer.sectorsummary')->with('companies',$companies);
    }

   public function todaysales(){
      $today = Carbon::today();
      $prescribed = DB::table('prescriptions')
       ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
       ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
       ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
       ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
       ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
       ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
       ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
        'pharmacy.county','prescription_details.doseform',
       'prescription_filled_status.substitute_presc_id')
     ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
             ['prescription_filled_status.created_at','>=',$today],
           ])
    ->whereNull('prescription_filled_status.substitute_presc_id');

      $Dsales=DB::table('prescriptions')
     ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
       ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
       ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
       ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
       ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
      ->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
 ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')

       ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
       'pharmacy.county','substitute_presc_details.doseform',
       'prescription_filled_status.substitute_presc_id')
     ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
             ['prescription_filled_status.created_at','>=',$today],
           ])
     ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->union($prescribed)
    ->get();






    $todaysales = Carbon::now();
    $one_week_ago = Carbon::now()->subWeeks(1);
    $drugwprsc = DB::table('prescriptions')
    ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
    ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
    ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
    ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
    ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
    ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
    ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
    'pharmacy.county','prescription_details.doseform',
    'prescription_filled_status.substitute_presc_id')
  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
  ['prescription_filled_status.created_at','>=',$one_week_ago],
  ['prescription_filled_status.created_at','<=',$todaysales],])
 ->whereNull('prescription_filled_status.substitute_presc_id');

   $drugw=DB::table('prescriptions')
  ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
  ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
  ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
  ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
  ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
  ->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
  ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
    'pharmacy.county','substitute_presc_details.doseform',
    'prescription_filled_status.substitute_presc_id')
  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
  ['prescription_filled_status.created_at','>=',$one_week_ago],
  ['prescription_filled_status.created_at','<=',$todaysales],
        ])
  ->whereNotNull('prescription_filled_status.substitute_presc_id')
 ->union($drugwprsc)
 ->get();
     return view('manufacturer.todaysales')->with('Dsales',$Dsales)->with('drugw',$drugw);

  }

    public function manuDoctor(){
       return view('manufacturer.manudoctor');

   }

 public function drugsubstitution(){
   $today = Carbon::today();
   $prescribed = DB::table('prescriptions')
    ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
    ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
    ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
    ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
    ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
    ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
    ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
     'pharmacy.county','prescription_details.doseform',
    'prescription_filled_status.substitute_presc_id')
  ->where([ ['druglists.Manufacturer','like', 'MERCK%'],
          ['prescription_filled_status.created_at','>=',$today],
        ])
 ->whereNotNull('prescription_filled_status.substitute_presc_id');

   $drugsubst=DB::table('prescriptions')
  ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
    ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
    ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
    ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
    ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
   ->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')

    ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
    'pharmacy.county','substitute_presc_details.doseform',
    'prescription_filled_status.substitute_presc_id')
  ->where([ ['druglists.Manufacturer',' like', 'MERCK%'],
          ['prescription_filled_status.created_at','>=',$today],

        ])
  ->whereNotNull('prescription_filled_status.substitute_presc_id')
 ->unionAll($prescribed)
 ->get();

return view('manufacturer.drugsubstitutions')->with('drugsubst',$drugsubst);
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
