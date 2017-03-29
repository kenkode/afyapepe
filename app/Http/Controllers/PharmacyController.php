<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;

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
        /*$patients = DB::table('afya_users')
                  ->Join('triage_details', 'afya_users.id', '=', 'triage_details.patient_id')
                  ->Join('doctors', 'triage_details.consulting_physician', '=', 'doctors.doc_id')
                  ->select('afya_users.*', 'triage_details.*','doctors.name')
                  ->where('triage_details.updated_at','>=',$today)
                  ->get(); */


        $user_id = Auth::user()->id;

        $data = DB::table('pharmacists')
                  ->where('user_id', $user_id)
                  ->first();

        $facility = $data->premiseid;

        $results = DB::table('afya_users')
                ->join('afyamessages', 'afya_users.msisdn', '=', 'afyamessages.msisdn')
                ->join('appointments', 'appointments.afya_user_id', '=', 'afya_users.id')
                ->join('prescriptions', 'prescriptions.appointment_id', '=', 'appointments.id')
                ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
                ->select('afya_users.*','prescriptions.created_at AS presc_date','prescriptions.id AS presc_id','doctors.name')
                ->where([
                  ['afyamessages.facilityCode', '=', $facility],
                  ['afyamessages.created_at','>=',$today],
                ])
              //  ->whereDate('afyamessages.created_at','=',$today)
              //  ->whereRaw('DATE(prescriptions.created_at) = CURDATE()')
                ->whereIn('prescriptions.filled_status', [0, 2])
                ->groupBy('appointments.id')
                ->get();

        return view('pharmacy.home')->with('results',$results);

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
      $today = Carbon::today();
      $user_id = Auth::user()->id;

      $data = DB::table('pharmacists')
                ->where('user_id', $user_id)
                ->first();

      $facility = $data->premiseid;

      $patients = DB::table('prescriptions')
        ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
        ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
        ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->select('druglists.drugname', 'prescriptions.*','prescription_details.*','afya_users.*', 'route.name')
        ->where([
          ['prescriptions.id', '=', $id],
          ['afyamessages.facilityCode', '=', $facility],
          ['afyamessages.created_at','>=',$today],

        ])
      //  ->whereDate('afyamessages.created_at','=',$today)
      //  ->whereRaw('DATE(prescriptions.created_at) = CURDATE()')
        ->whereIn('prescriptions.filled_status', [0, 2])
        ->groupBy('appointments.id')
        ->get();

      return view ('pharmacy.show')->with('patients',$patients);
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


    public function Available(){
 return view('pharmacy.available');
    }


    public function Analytics(){
      return view('pharmacy.analytics');
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
