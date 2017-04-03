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
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'prescriptions.*','prescription_details.*',
        'afya_users.*', 'route.name','prescription_details.id AS presc_id','prescriptions.id AS the_id')
        ->where([
          ['prescriptions.id', '=', $id],
          ['afyamessages.facilityCode', '=', $facility],
          ['afyamessages.created_at','>=',$today],
        ])
        ->whereNull('prescription_filled_status.presc_details_id')
        ->whereIn('prescriptions.filled_status', [0, 2])
        ->groupBy('prescription_details.id')
        ->get();

      return view ('pharmacy.show')->with('patients',$patients);
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
      $now = Carbon::now()->toDateTimeString();

      $user_id = Auth::user()->id;

      $data = DB::table('pharmacists')
                ->where('user_id', $user_id)
                ->first();

      $facility = $data->premiseid;
      $the_id = $request->p_id;

      $id = $request->presc_id;
      $dose = $request->dose_given;
      $reason = $request->reason;
      $quantity = $request->quantity;
      $price = $request->price;
      $available = $request->availability;

      DB::table('prescription_filled_status')->insert(
    ['presc_details_id'=>$id,
     'available'=>$available,
     'dose_given'=>$dose,
     'quantity'=>$quantity,
     'price'=>$price,
     'outlet_id'=>$facility,
     'submitted_by'=>$user_id,
     'created_at'=>Carbon::now(),
     'updated_at'=> Carbon::now()
   ]
);

  $query1 = DB::table('prescription_filled_status')
          ->select(DB::raw('count(presc_details_id) as presc_ids'))
          ->whereNotNull('replacement_drug_id')
          ->orWhere('available', '=', 'Yes')
          ->first();
  $count1 = $query1->presc_ids;

  $query2 = DB::table('prescription_details')
          ->select(DB::raw('count(id) as ids'))
          ->where('presc_id', '=', $the_id)
          ->first();
  $count2 = $query2->ids;

  if($count1 == $count2)
  {
   DB::table('prescriptions')
             ->where('id', $the_id)
             ->update(
               ['filled_status' => 1, 'updated_at'=> $now]
             );
  }

  else
  {
    DB::table('prescriptions')
              ->where('id', $the_id)
              ->update(
                ['filled_status' => 2, 'updated_at'=> $now]
              );
  }

  return redirect()->action('PharmacyController@show',[$the_id]);
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
