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
      $id=$request->id;
      $descr=$request->docprescription;
      $quality=1;
      $drugs=$request->druglist;
      $dosage=$request->dosageamount;
      $price=300;
      $amount=$quality*$price;

      DB::table('totalsales')->insert(
    ['userId' => $id,
     'dosage'=>$dosage,
     'drugs_id'=>$drugs,
     'quantity'=> $quality,
     'price'=>$price,
     'amount'=> $amount
   ]
);
$patients=DB::table('patients')
->Join('totalsales', 'patients.id', '=', 'totalsales.userId')
->Join('druglists','totalsales.drugs_id','=','druglists.id')
->select('patients.*','totalsales.quantity','totalsales.price','totalsales.amount','totalsales.dosage',
'druglists.drugname')
->get();
  return view('pharmacy.totalsales')->with('patients',$patients);
    }

    public function totalsales()
    {
      $patients=DB::table('patients')
      ->Join('totalsales', 'patients.id', '=', 'totalsales.userId')
      ->Join('druglists','totalsales.drugs_id','=','druglists.id')
      ->select('patients.*','totalsales.quantity','totalsales.price','totalsales.amount','totalsales.dosage',
      'druglists.drugname')
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
