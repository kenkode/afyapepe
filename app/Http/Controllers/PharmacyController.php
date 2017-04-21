<?php


namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Auth;
use App\Druglist;
use Response;

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
                ->join('dependant', 'dependant.afya_user_id', '=', 'afya_users.id')
                ->select('afya_users.*','prescriptions.created_at AS presc_date','prescriptions.id AS presc_id',
                'doctors.name','dependant.firstName AS fname', 'dependant.secondName AS sname',
                 'dependant.gender AS d_gender', 'dependant.dob AS d_dob', 'appointments.persontreated')
                ->where([
                  ['afyamessages.facilityCode', '=', $facility],
                  ['afyamessages.created_at','>=',$today],
                ])
              //  ->whereDate('afyamessages.created_at','=',$today)
              //  ->whereRaw('DATE(prescriptions.created_at) = CURDATE()')
                ->whereIn('prescriptions.filled_status', [0, 2])
                ->groupBy('appointments.id')
                ->get();

                $drugs = DB::table('druglists')->distinct()->get(['drugname']);
                // $drugs = array($drugs);
              //  return response(view('drug',array('drug'=>$drug)),200, ['Content-Type' => 'application/json']);

        return view('pharmacy.home')->with('results',$results)->with('drugs', $drugs);

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



      //return response()->view('pharmacy.show')->with('patients',$patients)->header('Content-Type', $type);
      return view('pharmacy.show')->with('patients',$patients);
    }

/**
* Get prescription details from show.blade.php
*/
    public function fillPresc($id)
    {

      $results = DB::table('prescriptions')
        ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'prescriptions.*','prescription_details.*',
         'route.name','prescription_details.id AS presc_id','prescriptions.id AS the_id')
        ->where([
          ['prescription_details.id', '=', $id],
        ])
        ->groupBy('prescription_details.id')
        ->first();

      return view('pharmacy.fill_prescription')->with('results',$results);
    }

    public function FilledPresc()
    {

      $user_id = Auth::user()->id;

      $data = DB::table('pharmacists')
                ->where('user_id', $user_id)
                ->first();

      $facility = $data->premiseid;

      $prescs = DB::table('prescriptions')
        ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
        ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
        ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
        ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
        ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
        'prescription_filled_status.created_at AS date_filled')
        ->where([
          ['afyamessages.facilityCode', '=', $facility],
        ])
        ->groupBy('prescription_filled_status.id')
        ->get();

        return view('pharmacy.filled_prescriptions')->with('prescs',$prescs);
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

      $strength = $request->strength;
      $frequency = $request->frequency;
      $doseform = $request->dosageform;
      $strength_unit = $request->strength_unit;
      $route = $request->routes;
      $drug = $request->prescription;
      $quantity1 = $request->quantity1;
      $price1 = $request->price1;


      if($available == 'Yes')
      {

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

    }

    else
    {

      if(isset($drug))
      {
    $idd=  DB::table('substitute_presc_details')->insertGetId(
    [
     'drug_id'=>$drug,
     'doseform'=>$doseform,
     'strength'=>$strength,
     'routes'=>$route,
     'frequency'=>$frequency,
     'strength_unit'=>$strength_unit,
     'created_at'=>Carbon::now(),
     'updated_at'=> Carbon::now()
   ]
    );
  }

    DB::table('prescription_filled_status')->insert(
  ['presc_details_id'=>$id,
   'available'=>$available,
   'dose_given'=>$dose,
   'quantity'=>$quantity1,
   'price'=>$price1,
   'outlet_id'=>$facility,
   'submitted_by'=>$user_id,
   'substitute_presc_id'=>$idd,
   'created_at'=>Carbon::now(),
   'updated_at'=> Carbon::now()
 ]
  );

  }

  $query1 = DB::table('prescription_filled_status')
          ->select(DB::raw('count(presc_details_id) as presc_ids'))
          ->whereNotNull('substitute_presc_id')
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

    public function fdrugs(Request $request)
     {
         $term = trim($request->q);
      if (empty($term)) {
           return \Response::json([]);
         }
       $drugs = Druglist::search($term)->limit(20)->get();
         $formatted_drugs = [];
          foreach ($drugs as $drug) {
             $formatted_drugs[] = ['id' => $drug->id, 'text' => $drug->drugname];
         }
     return \Response::json($formatted_drugs);
     }

     public function trySomething(Request $request)
     {
       $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("druglists")
            		->select("drugname")
            		->where('drugname','LIKE',"%$search%")
            		->get();
        }

        return response()->json($data);
     }

     public function finalHope(Request $request)
     {
       $data = DB::table("druglists")
           ->select("drugname")
           ->where('drugname','LIKE',"%{$request->input('query')}%")
           ->get();

           return response()->json($data);
     }

     //SearchController.php
public function autocomplete()
{
	$term = Input::get('term');

	$results = array();

	$queries = DB::table('druglists')
		->where('drugname', 'LIKE', '%'.$term.'%')
		->get();

	foreach ($queries as $query)
	{
	    $results[] = [ 'id' => $query->id, 'value' => $query->drugname ];
	}
return Response::json($results);
  }

  public function find(Request $request)
  {
      return User::search($request->get('q'))->with('profile')->get();
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
