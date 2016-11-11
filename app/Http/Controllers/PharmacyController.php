<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class PharmacyController extends Controller
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
        $today = Carbon::today();
      $patients = DB::table('afya_users')
        ->Join('triage_details', 'afya_users.id', '=', 'triage_details.patient_id')
        ->Join('doctors', 'triage_details.consulting_physician', '=', 'doctors.doc_id')
        ->select('afya_users.*', 'triage_details.*','doctors.name')
        ->where('triage_details.updated_at','>=',$today)
        ->get();

        return view('pharmacy.home')->with('patients',$patients);
    }
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $today = Carbon::today();
      $id=$request->id;
      $notes=$request->reasons;
      $quality=$request->quantity;
      $drugs=$request->druglist;
      $dosage=$request->dosageamount;
      $price=$request->price;
      $amount=$price*$quality;
      

      DB::table('prescription_filled_status')->insert(
    ['presc_id' => $id,
     'drug_id'=>$drugs,
     'available'=>1,
     'dosage'=>'full',
     'dose_given'=>$dosage,
     'quantity'=> $quality,
     'price'=>$price,
     'amount'=>$amount,
     'notes'=>$notes,
     'outlet_id'=>19310,
     'date'=>Carbon::now(),
     'updatedOn'=>Carbon::now()
   ]
);

  return redirect('totalsales');
    }

    public function totalsales()
    {
        $today = Carbon::today();
      $patients=DB::table('afya_users')
->Join('prescription_filled_status', 'afya_users.id', '=', 'prescription_filled_status.presc_id')
->Join('druglists','prescription_filled_status.drug_id','=','druglists.id')
->select('afya_users.*','prescription_filled_status.*','druglists.*')
->where('prescription_filled_status.date','>=',$today)
->get();
        return view('pharmacy.totalsales')->with('patients',$patients);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patient = DB::table('afya_users')
        ->Join('triage_details', 'afya_users.id', '=', 'triage_details.patient_id')
        ->select('afya_users.*', 'triage_details.*')
        ->where('triage_details.id',$id)
        ->first();
      return view ('pharmacy.show')->with('patient',$patient);
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
        //
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
