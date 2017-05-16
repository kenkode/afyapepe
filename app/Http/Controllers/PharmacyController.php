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
        $person_treated = ''; //Now it global
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
                ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
                ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
                ->join('dependant', 'dependant.afya_user_id', '=', 'afya_users.id')
                ->select('afya_users.*','prescriptions.created_at AS presc_date','prescriptions.id AS presc_id',
                'doctors.name','dependant.firstName AS fname', 'dependant.secondName AS sname',
                 'dependant.gender AS d_gender', 'dependant.dob AS d_dob', 'appointments.persontreated')
                ->where([
                  ['afyamessages.facilityCode', '=', $facility],
                  ['afyamessages.created_at','>=',$today],
                ])
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
        ->join('dependant', 'dependant.afya_user_id', '=', 'afya_users.id')
        ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'prescriptions.*','prescription_details.*',
        'afya_users.*', 'route.name','prescription_details.id AS presc_id','prescriptions.id AS the_id',
        'appointments.persontreated','dependant.firstName AS fname', 'dependant.secondName AS sname')
        ->where([
          ['prescriptions.id', '=', $id],
          ['afyamessages.facilityCode', '=', $facility],
          ['afyamessages.created_at','>=',$today]
        ])
        ->whereNull('prescription_filled_status.presc_details_id')
        ->whereIn('prescriptions.filled_status', [0, 2])
        ->groupBy('prescription_details.id')
        ->get();


      return view('pharmacy.show')->with('patients',$patients);
    }

/**
* Get prescription details from show.blade.php
*/

    public function fillPresc($id)
    {

      $today = Carbon::today();

      $results = DB::table('prescriptions')
        ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
        ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'prescriptions.*','prescription_details.*',
         'route.name','prescription_details.id AS presc_id','prescriptions.id AS the_id',
         'prescriptions.appointment_id','appointments.persontreated','appointments.afya_user_id')
        ->where([
          ['prescription_details.id', '=', $id]
        ])
        ->groupBy('prescription_details.id')
        ->first();

        //$appointment_id = $results->appointment_id;

        $person_treated = $results->persontreated;
        $afya_user_id = ''; //Initializing variable to make it global
        $drugs = ''; //just making this variable global for later use

        if($person_treated === 'Self')
        {

        $afya_user_id = $results->afya_user_id;

        $drugs = DB::table('prescriptions')
          ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
          ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
          ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
          ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
          ->join('route', 'prescription_details.routes', '=', 'route.id')
          ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
          ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
           'route.name AS route_name','prescription_details.id AS presc_id')
          ->where([
            ['afya_users.id', '=', $afya_user_id],
            ['prescription_filled_status.end_date', '>=', $today],
          ])
          ->groupBy('prescription_details.id')
          ->get();

        }
        else
        {
          $afya_user_id = $person_treated;

          $drugs = DB::table('prescriptions')
            ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
            ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
            ->join('dependant', 'dependant.afya_user_id', '=', 'afya_users.id')
            ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
            ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
            ->join('route', 'prescription_details.routes', '=', 'route.id')
            ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
            ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
             'route.name AS route_name','prescription_details.id AS presc_id')
            ->where([
              ['dependant.id', '=', $afya_user_id],
              ['prescription_filled_status.end_date', '>=', $today],
            ])
            ->groupBy('prescription_details.id')
            ->get();

        }

        if($person_treated === 'Self')
        {

        $afya_user_id = $results->afya_user_id;

        $diseases = DB::table('patient_chronic')
                  ->join('chronic_illnesses', 'chronic_illnesses.id', '=', 'patient_chronic.disease_id')
                  ->join('afya_users', 'afya_users.id', '=', 'patient_chronic.afya_user_id')
                  ->select('chronic_illnesses.disease','patient_chronic.date_diagnosed')
                  ->where('patient_chronic.afya_user_id', '=' , $afya_user_id)
                  ->get();
        }
        else
        {

        $afya_user_id = $person_treated;

        $diseases = DB::table('patient_chronic')
                  ->join('chronic_illnesses', 'chronic_illnesses.id', '=', 'patient_chronic.disease_id')
                  ->join('dependant', 'dependant.id', '=', 'patient_chronic.dependant_id')
                  ->select('chronic_illnesses.disease','patient_chronic.date_diagnosed')
                  ->where('patient_chronic.dependant_id','=',$afya_user_id)
                  ->get();
        }

        if($person_treated === 'Self')
        {

        $afya_user_id = $results->afya_user_id;

        $allergies = DB::table('allergies')
                  ->join('allergies_type', 'allergies.id', '=', 'allergies_type.allergies_id')
                  ->join('patient_allergy', 'patient_allergy.allergy_id', '=', 'allergies_type.id')
                  ->select('patient_allergy.created_at','allergies.name','allergies_type.name AS a_name')
                  ->where('patient_allergy.afya_user_id', '=' , $afya_user_id)
                  ->get();
        }
        else
        {

        $afya_user_id = $person_treated;

        $allergies = DB::table('allergies_type')
                  ->join('allergies', 'allergies.id', '=', 'allergies_type.allergies_id')
                  ->join('patient_allergy', 'patient_allergy.allergy_id', '=', 'allergies_type.id')
                  ->select('patient_allergy.created_at','allergies.name','allergies_type.name AS a_name')
                  ->where('patient_allergy.dependant_id', '=' , $afya_user_id)
                  ->get();
        }

      if(empty($results))
      {
        return redirect()->route('pharmacy');
      }
      else
      {
        return view('pharmacy.fill_prescription')->with('results',$results)->with('drugs',$drugs)->with('diseases',$diseases)->with('allergies',$allergies);
      }
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
        ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
        ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
        ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
        ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
        ->select('druglists.drugname','druglists.Manufacturer','prescription_filled_status.*','prescription_details.*',
        'prescription_filled_status.created_at AS date_filled','doctors.name AS doc','prescriptions.created_at AS prescription_date')
        ->where([
          ['afyamessages.facilityCode', '=', $facility],
        ])
        ->groupBy('prescription_filled_status.id')
        ->get();

        /* Get today's sales*/
        $todays = DB::table('prescriptions')
          ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
          ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
          ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
          ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
          ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
          ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
          ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
          ->select('druglists.drugname','druglists.Manufacturer','prescription_filled_status.*','prescription_details.*',
          'prescription_filled_status.created_at AS date_filled','doctors.name AS doc',
          DB::raw('prescription_filled_status.quantity * prescription_filled_status.price AS total'),
          'prescriptions.created_at AS prescription_date')
          ->where([
            ['afyamessages.facilityCode', '=', $facility],
          ])
          ->whereRaw('date(prescription_filled_status.created_at) = CURDATE()')
          ->orderby('prescription_filled_status.created_at','desc')
          ->groupBy('prescription_filled_status.id')
          ->get();

          /* Get this week's sales*/
          $weeks = DB::table('prescriptions')
            ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
            ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
            ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
            ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
            ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
            ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
            ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
            ->select('druglists.drugname','druglists.Manufacturer','prescription_filled_status.*','prescription_details.*',
            'prescription_filled_status.created_at AS date_filled','doctors.name AS doc',
            DB::raw('prescription_filled_status.quantity * prescription_filled_status.price AS total'),
            'prescriptions.created_at AS prescription_date')
            ->where([
              ['afyamessages.facilityCode', '=', $facility],
            ])
            ->whereBetween('prescription_filled_status.created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(),
            ])
            ->orderby('prescription_filled_status.created_at','desc')
            ->groupBy('prescription_filled_status.id')
            ->get();

            /* Get this month's sales*/
            $months = DB::table('prescriptions')
              ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
              ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
              ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
              ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
              ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
              ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
              ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
              ->select('druglists.drugname','druglists.Manufacturer','prescription_filled_status.*','prescription_details.*',
              'prescription_filled_status.created_at AS date_filled','doctors.name AS doc',
              DB::raw('prescription_filled_status.quantity * prescription_filled_status.price AS total'),
              'prescriptions.created_at AS prescription_date')
              ->where([
                ['afyamessages.facilityCode', '=', $facility],
              ])
              ->whereBetween('prescription_filled_status.created_at', [
              Carbon::now()->startOfMonth(),
              Carbon::now()->endOfMonth(),
              ])
              ->orderby('prescription_filled_status.created_at','desc')
              ->groupBy('prescription_filled_status.id')
              ->get();

              /* Get this year's sales*/
              $years = DB::table('prescriptions')
                ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
                ->join('doctors', 'doctors.doc_id', '=', 'prescriptions.doc_id')
                ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
                ->join('afya_users', 'afya_users.id', '=', 'appointments.afya_user_id')
                ->join('afyamessages', 'afyamessages.msisdn', '=', 'afya_users.msisdn')
                ->join('prescription_filled_status', 'prescription_filled_status.presc_details_id', '=', 'prescription_details.id')
                ->select('druglists.drugname','druglists.Manufacturer','prescription_filled_status.*','prescription_details.*',
                'prescription_filled_status.created_at AS date_filled','doctors.name AS doc',
                DB::raw('prescription_filled_status.quantity * prescription_filled_status.price AS total'),
                'prescriptions.created_at AS prescription_date')
                ->where([
                  ['afyamessages.facilityCode', '=', $facility],
                ])
                ->whereRaw('YEAR(prescription_filled_status.created_at) = YEAR(CURDATE())')
                ->orderby('prescription_filled_status.created_at','desc')
                ->groupBy('prescription_filled_status.id')
                ->get();

        return view('pharmacy.filled_prescriptions')->with('prescs',$prescs)->with('todays',$todays)
                ->with('weeks',$weeks)->with('months',$months)->with('years',$years);
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
      $dose1 = $request->dose_given1;
      $dose2 = $request->dose_given2;
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

      $start_date1 = date('Y-m-d',strtotime($request->from1));
      $end_date1 = date('Y-m-d',strtotime($request->to1));
      $start_date2 = date('Y-m-d',strtotime($request->from2));
      $end_date2 = date('Y-m-d',strtotime($request->to2));


      if($available == 'Yes')
      {

      DB::table('prescription_filled_status')->insert(
      ['presc_details_id'=>$id,
     'available'=>$available,
     'dose_given'=>$dose1,
     'quantity'=>$quantity,
     'price'=>$price,
     'outlet_id'=>$facility,
     'submitted_by'=>$user_id,
     'start_date'=>$start_date1,
     'end_date'=>$end_date1,
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
   'dose_given'=>$dose2,
   'quantity'=>$quantity1,
   'price'=>$price1,
   'outlet_id'=>$facility,
   'submitted_by'=>$user_id,
   'substitute_presc_id'=>$idd,
   'substitution_reason'=>$reason,
   'start_date'=>$start_date2,
   'end_date'=>$end_date2,
   'created_at'=>Carbon::now(),
   'updated_at'=> Carbon::now()
 ]
  );

  }

  /*$query1 = DB::table('prescription_filled_status')
          ->select(DB::raw('count(presc_details_id) as presc_ids'))
          ->where('presc_details_id','=',$id)
          ->whereNotNull('substitute_presc_id')
          ->orWhere('available', '=', 'Yes')
          ->first();*/
  $query1 = DB::table('prescription_filled_status')
          ->select(DB::raw('SUM(dose_given) AS total_given'))
          ->where('presc_details_id','=',$id)
          ->first();
  $count1 = $query1->total_given;

  /*$query2 = DB::table('prescription_details')
          ->select(DB::raw('count(id) as ids'))
          ->where('presc_id', '=', $the_id)
          ->first();*/

  $query2 = DB::table('prescription_details')
          ->where('id', '=', $id)
          ->first();
  $count2 = $query2->strength;

  if($count1 == $count2)
  {
    DB::table('prescription_details')
              ->where('id', $id)
              ->update(
                ['is_filled' => 1, 'updated_at'=> $now]
              );

  $counter1 = DB::table('prescription_details')
              ->select(DB::raw('count(is_filled) as count1'))
              ->where('is_filled','=',2)
              ->first();

  $counter1 = $counter1->count1;

    if($counter1 >= 0)
    {
      DB::table('prescriptions')
                ->where('id', $the_id)
                ->update(
                  ['filled_status' => 2, 'updated_at'=> $now]
                );
    }

    $counter2 = DB::table('prescription_details')
                ->select(DB::raw('count(is_filled) as count1'))
                ->where('is_filled','!=',2)
                ->whereNotNull('is_filled')
                ->first();

      if($counter1 >= 0)
      {
        DB::table('prescriptions')
                  ->where('id', $the_id)
                  ->update(
                    ['filled_status' => 1, 'updated_at'=> $now]
                  );
      }

  }
  else
  {
    DB::table('prescription_details')
              ->where('id', $id)
              ->update(
                ['is_filled' => 2, 'updated_at'=> $now]
              );

    // DB::table('prescriptions')
    //           ->where('id', $the_id)
    //           ->update(
    //             ['filled_status' => 2, 'updated_at'=> $now]
    //           );
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
      //  if($person_treated == 'Self')
      //  {
      //  $allergies = DB::table('allergies_type')
      //            ->join('allergies', 'allergies.id', '=', 'allergies_type.allergies_id')
      //            ->join('patient_allergy', 'patient_allergy.allergy_id', '=', 'allergies_type.id')
      //            ->select('patient_allergy.created_at','allergies.name','allergies_type.name AS a_name')
      //            ->where('patient_allergy.afya_user_id', '=' , $person_treated)
      //            ->get();
      //   }
      //   else
      //   {
      //   $allergies = DB::table('allergies_type')
      //             ->join('allergies', 'allergies.id', '=', 'allergies_type.allergies_id')
      //             ->join('patient_allergy', 'patient_allergy.allergy_id', '=', 'allergies_type.id')
      //             ->select('patient_allergy.created_at','allergies.name','allergies_type.name AS a_name')
      //             ->where('patient_allergy.dependant_id', '=' , $person_treated)
      //             ->get();
       //
      //   }
      $person_treated = 2;
         $term = trim($request->q);
      if (empty($term))
        {
           return \Response::json([]);
         }
       $drugs = Druglist::search($term)->limit(20)->get();

         $formatted_drugs = [];
          foreach ($drugs as $drug)
          {
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
