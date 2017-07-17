<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Auth;
use App\Druglist;
use App\Inventory;
use App\DrugSuppliers;
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
        $today2 = $today->toDateString();

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
                ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
                ->select('afya_users.*','prescriptions.created_at AS presc_date','prescriptions.id AS presc_id',
                'doctors.name', 'appointments.persontreated', 'afya_users.id AS af_id')
                ->where('afyamessages.facilityCode', '=', $facility)
                ->whereDate('afyamessages.created_at','=',$today2)
                ->whereIn('prescriptions.filled_status', [0, 2])
                ->orWhere(function ($query) use ($facility,$today2){
                $query->where('afyamessages.facilityCode', '=', $facility)
                      ->whereDate('afyamessages.created_at','=',$today2)
                      ->whereNull('prescriptions.filled_status');
                })
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
      $today2 = $today->toDateString();
      $user_id = Auth::user()->id;
      $id = $id;

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
        ->join('frequency', 'frequency.id', '=', 'prescription_details.frequency')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'druglists.id AS drug_id', 'prescriptions.*','prescription_details.*',
        'afya_users.*', 'route.name','prescription_details.id AS presc_id','prescriptions.id AS the_id',
        'appointments.persontreated', 'frequency.name AS freq_name', 'afya_users.id AS af_id')
        ->where([
          ['prescriptions.id', '=', $id],
          ['afyamessages.facilityCode', '=', $facility],
          ['prescription_details.is_filled', '=', 2]
        ])
        ->whereDate('afyamessages.created_at','=',$today2)
        ->orWhere(function ($query) use($id,$facility,$today2)
        {
        $query->whereNull('prescription_details.is_filled')
              ->where('prescriptions.id', '=', $id)
              ->where('afyamessages.facilityCode', '=', $facility)
              ->whereDate('afyamessages.created_at','=',$today2);
        })
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
        ->select('druglists.drugname', 'druglists.id AS drug_id', 'prescriptions.*','prescription_details.*',
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
          ->join('frequency', 'frequency.id', '=', 'prescription_details.frequency')
          ->join('route', 'prescription_details.routes', '=', 'route.id')
          ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
          ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
           'route.name AS route_name','prescription_details.id AS presc_id','frequency.name AS freq_name')
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
            ->join('frequency', 'frequency.id', '=', 'prescription_details.frequency')
            ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
            ->join('route', 'prescription_details.routes', '=', 'route.id')
            ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
            ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
             'route.name AS route_name','prescription_details.id AS presc_id','frequency.name AS freq_name')
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

    /**
    *  Substitute drug
    */
    public function subPresc($id)
    {

      $today = Carbon::today();

      $results = DB::table('prescriptions')
        ->join('appointments', 'prescriptions.appointment_id', '=', 'appointments.id')
        ->join('prescription_details', 'prescription_details.presc_id', '=', 'prescriptions.id')
        ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
        ->join('route', 'prescription_details.routes', '=', 'route.id')
        ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
        ->select('druglists.drugname', 'druglists.id AS drug_id', 'prescriptions.*','prescription_details.*',
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
          ->join('frequency', 'frequency.id', '=', 'prescription_details.frequency')
          ->join('route', 'prescription_details.routes', '=', 'route.id')
          ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
          ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
           'route.name AS route_name','prescription_details.id AS presc_id','frequency.name AS freq_name')
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
            ->join('frequency', 'frequency.id', '=', 'prescription_details.frequency')
            ->join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
            ->join('route', 'prescription_details.routes', '=', 'route.id')
            ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
            ->select('druglists.drugname', 'prescription_filled_status.*','prescription_details.*',
             'route.name AS route_name','prescription_details.id AS presc_id','frequency.name AS freq_name')
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
        return view('pharmacy.substitution')->with('results',$results)->with('drugs',$drugs)->with('diseases',$diseases)->with('allergies',$allergies);
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
        ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
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
          ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
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
            ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
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
              ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
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
                ->join('doctors', 'doctors.id', '=', 'prescriptions.doc_id')
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
      $reason = $request->reason22;
      $reason2 = $request->reason; //substitution reason
      $quantity = $request->quantity;
      $price = $request->price;
      $available = $request->availability;
      $total =$request->total;
      if($available == 'Yes')
      {

      $markup = $request->payment_options1;
      }
      else
      {

      $markup = $request->payment_options;
      }

      if(empty($reason))
      {
        $reason = NULL;
      }
      else
      {
        $reason = $reason;
      }

      $strength = $request->dose_given2;
      $frequency = $request->frequency;
      $doseform = $request->dosageform;
      $strength_unit = $request->strength_unit;
      $route = $request->routes;
      $drug = $request->prescription;
      $quantity1 = $request->quantity1;
      $price1 = $request->price1;
      $total1 =$request->total1;

      $start_date1 = date('Y-m-d',strtotime($request->from1));
      $end_date1 = date('Y-m-d',strtotime($request->to1));
      $start_date2 = date('Y-m-d',strtotime($request->from2));
      $end_date2 = date('Y-m-d',strtotime($request->to2));

      $user_id = Auth::user()->id;

      $data = DB::table('pharmacists')
                ->where('user_id', $user_id)
                ->first();

      $facility = $data->premiseid;

      $pay_op = DB::table('payment_options')->distinct()
                   ->join('pharmacy_payment', 'pharmacy_payment.option_id', '=', 'payment_options.id')
                   ->where([
                     ['pharmacy_payment.pharmacy_id', '=', $facility],
                     ['pharmacy_payment.markup', '=', $markup],
                   ])
                   ->first(['payment_options.name']);
      $pay_op = $pay_op->name;


      if($available == 'Yes')
      {

      DB::table('prescription_filled_status')->insert(
      ['presc_details_id'=>$id,
     'available'=>$available,
     'dose_given'=>$dose1,
     'dose_reason'=>$reason,
     'quantity'=>$quantity,
     'price'=>$price,
     'total'=>$total,
     'payment_option'=>$pay_op,
     'markup'=>$markup,
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
   'available'=>'No',
   'dose_given'=>$dose2,
   'quantity'=>$quantity1,
   'price'=>$price1,
   'total'=>$total1,
   'payment_option'=>$pay_op,
   'markup'=>$markup,
   'outlet_id'=>$facility,
   'submitted_by'=>$user_id,
   'substitute_presc_id'=>$idd,
   'substitution_reason'=>$reason2,
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

  /* Get total amount of that specific drug that has been given  */
  $query1 = DB::table('prescription_filled_status')
          ->select(DB::raw('SUM(dose_given) AS total_given'))
          ->where('presc_details_id','=',$id)
          ->first();
  $count1 = $query1->total_given;

  /*$query2 = DB::table('prescription_details')
          ->select(DB::raw('count(id) as ids'))
          ->where('presc_id', '=', $the_id)
          ->first();*/

  /* Get the prescribed strength of the drug($id) */
  $query2 = DB::table('prescription_details')
          ->where('id', '=', $id)
          ->first();
  $count2 = $query2->strength;

  if($count1 == $count2) //this means the dosage for this drug($id) has been given in full.
  {
    DB::table('prescription_details')
              ->where('id', $id)
              ->update(
                ['is_filled' => 1, 'updated_at'=> $now]
              );

  $counter1 = DB::table('prescription_details')
              ->select(DB::raw('count(is_filled) as count1'))
              ->where([
                ['presc_id', '=', $the_id],
                ['is_filled', '=', 2],
              ])
              ->orWhere(function ($query) use($the_id) {
                $query->where('presc_id', '=', $the_id)
                      ->whereNull('is_filled');
            })
              ->first();

  $counter11 = $counter1->count1;

    if($counter11 > 0)  // There are partially filled drugs in the general prescription
    {
      DB::table('prescriptions')
                ->where('id', $the_id)
                ->update(
                  ['filled_status' => 2, 'updated_at'=> $now]
                );
    }

    else
    {

    // $counter2 = DB::table('prescription_details')
    //             ->select(DB::raw('count(is_filled) as count2'))
    //             ->where([
    //               ['presc_id','=',$the_id],
    //               ['is_filled','<>',2],
    //             ])
    //             ->whereNotNull('is_filled')
    //             ->first();
    //
    // $counter22 = $counter2->count2;

      // if($counter22 >= 0)  // column (is_filled) in prescription_details has not null or 2 for this prescription($the_id)
      // {
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

    $counter1 = DB::table('prescription_details')
                ->select(DB::raw('count(is_filled) as count1'))
                ->where('presc_id', '=', $the_id)
                ->whereIn('is_filled', [1,2])
                ->orWhere(function ($query) use($the_id) {
                  $query->where('presc_id', '=', $the_id)
                        ->whereIn('is_filled', [1,2])
                        ->whereNull('is_filled');
              })
                ->first();

    $counter11 = $counter1->count1;

      if($counter11 >= 0)  // There are both partially & fully filled drugs in the general prescription
      {
        DB::table('prescriptions')
                  ->where('id', $the_id)
                  ->update(
                    ['filled_status' => 2, 'updated_at'=> $now]
                  );
      }
      else
      {

      // $counter2 = DB::table('prescription_details')
      //             ->select(DB::raw('count(is_filled) as count2'))
      //             ->where([
      //               ['presc_id','=',$the_id],
      //               ['is_filled','!=',2],
      //             ])
      //             ->whereNotNull('is_filled')
      //             ->first();
      //
      // $counter22 = $counter2->count2;

        // if($counter22 >= 0)  // column (is_filled) in prescription_details has not null or 2 for this prescription($the_id)
        // {
          DB::table('prescriptions')
                    ->where('id', $the_id)
                    ->update(
                      ['filled_status' => 1, 'updated_at'=> $now]
                    );
        }
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

/**
* Get suppliers
*/
     public function fetchSuppliers(Request $request)
      {

          $term = trim($request->q);
       if (empty($term))
         {
            return \Response::json([]);
         }
        $suppliers = DrugSuppliers::search($term)->limit(20)->get();

          $formatted_suppliers = [];
           foreach ($suppliers as $supplier)
           {
              $formatted_suppliers[] = ['id' => $supplier->id, 'text' => $supplier->name];
           }
      return \Response::json($formatted_suppliers);
      }

     public function trySomething(Request $request)
     {
       $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = DB::table("inventory")
            		->select("drugname","drug_id")
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
  *Inventory stuff
  */
  public function getManufacturer(Request $request)
  {
    $term = trim($request->q);
 if (empty($term))
   {
      return \Response::json([]);
    }
  $manufacturers = Druglist::search($term)->limit(20)->get();

    $manus = [];
     foreach ($manufacturers as $manufacturer)
     {
        $manus[] = ['id' => $manufacturer->id, 'text' => $manufacturer->Manufacturer];
     }
     return \Response::json($manus);

  }

  /**
  *Display all inventory
  */
  public function showInventory()
  {
    $inventory = DB::table('inventory')
                ->join('druglists','druglists.id','=','inventory.drug_id')
                ->join('strength','strength.strength','=','inventory.strength')
                ->select('druglists.Manufacturer','druglists.drugname','inventory.created_at AS entry_date','inventory.id AS inv_id',
                'druglists.id AS drug_id','strength.strength','inventory.*','inventory.id AS inventory_id')
                ->where([
                  ['inventory.quantity', '>', 0],
                  ['is_active', '=', 'yes'],
                ])
                ->orderBy('inventory.created_at', 'desc')
                ->get();

    return view('pharmacy.inventory')->with('inventory',$inventory);
  }

  /**
  * Store new inventory
  */
  public function addStock(Request $request)
  {
    $user_id = Auth::user()->id;

    $data = DB::table('pharmacists')
              ->where('user_id', $user_id)
              ->first();

    $facility = $data->premiseid;

    //$manufacturer = $request->manufacturer;

    $drug = $request->prescription;
    $supplier = $request->supplier;
    $strength = $request->strength;
    $strength_unit = $request->strength_unit;
    $quantity = $request->quantity;
    $price = $request->price;
    $retail_price = $request->retail_price;

    //get drug name. this will be useful during searching drug for substitution
    $dname = DB::table('druglists')
            ->select('drugname')
            ->where('id', '=', $drug)
            ->first();
    $drug_name = $dname->drugname;

    $id1 = DB::table('inventory')->insertGetId([
      'drug_id'=>$drug,
      'supplier'=>$supplier,
      'drugname'=>$drug_name,
      'strength'=>$strength,
      'strength_unit'=>$strength_unit,
      'quantity'=>$quantity,
      'price'=>$price,
      'recommended_retail_price'=>$retail_price,
      'submitted_by'=>$user_id,
      'outlet_id'=>$facility,
      'is_active'=>'yes',
      'created_at'=>Carbon::now(),
      'updated_at'=>Carbon::now()
    ]);

    DB::table('inventory_updates')->insert(
      [
      'inventory_id'=>$id1,
      'created_at'=>Carbon::now()
      ]
    );


    return redirect()->action('PharmacyController@showInventory');
  }

  public function getInventory(Request $request)
  {
    $idd = $request->selector;

    if(Input::get('submit_edit'))
    {
    return view('pharmacy.edit_inventory')->with('idd',$idd);
    }
    elseif(Input::get('submit_update'))
    {
    return view('pharmacy.update_inventory')->with('idd',$idd);
    }
    elseif(Input::get('submit_delete'))
    {
    return view('pharmacy.delete_inventory')->with('idd',$idd);
    }

  }

  public function getInventory2($id)
  {
    $inventory = DB::table('inventory')
                ->join('druglists','druglists.id','=','inventory.drug_id')
                ->join('strength','strength.strength','=','inventory.strength')
                ->select('druglists.Manufacturer','druglists.drugname',
                'druglists.id AS drug_id','strength.strength','inventory.*','inventory.id AS inventory_id')
                ->where([
                  ['inventory.id', '=', $id],
                  ['is_active', '=', 'yes'],
                ])
                ->get();

    return view('pharmacy.update_inventory')->with('inventory',$inventory);
  }

  public function editedInventory(Request $request)
  {
    $user_id = Auth::user()->id;

    $data = DB::table('pharmacists')
              ->where('user_id', $user_id)
              ->first();

    $facility = $data->premiseid;
    $id = $request->inventory_id;
    $count = count($id);

    for($i=0; $i<$count; $i++)
    {
      $drug = $request->prescription;
      $strength = $request->strength;
      $strength_unit = $request->strength_unit;
      $quantity = $request->quantity;
      $price = $request->price;
      $supplier = $request->supplier;
      $retail_price = $request->retail_price;

      $dname = DB::table('druglists')
              ->select('drugname')
              ->where('id', '=', $drug[$i])
              ->first();
      $drug_name = $dname->drugname;

    DB::table('inventory')
                    ->where('id', '=', $id[$i])
                    ->update([
                      'drug_id'=>$drug[$i],
                      'drugname'=>$drug_name,
                      'strength'=>$strength[$i],
                      'strength_unit'=>$strength_unit[$i],
                      'quantity'=>$quantity[$i],
                      'price'=>$price[$i],
                      'recommended_retail_price'=>$retail_price[$i],
                      'supplier'=>$supplier[$i],
                      'submitted_by'=>$user_id,
                      'outlet_id'=>$facility,
                      'updated_at'=>Carbon::now()
                    ]);

      }

    return redirect()->action('PharmacyController@showInventory');
  }

  public function updateInventory(Request $request)
  {

    $inv = $request->inventory_id;
    $id = $request->id;
    $quantity = $request->quantity;

    $user_id = Auth::user()->id;

    $data = DB::table('pharmacists')
              ->where('user_id', $user_id)
              ->first();

    $facility = $data->premiseid;

    $count = count($inv);

    for($i=0;$i<$count;$i++)
    {
      DB::table('inventory_updates')->where('id','=', $id[$i])
      ->update([
        'status'=>0,
        'updated_at'=>Carbon::now()
      ]);

    DB::table('inventory_updates')
    ->insert([
      'inventory_id'=>$inv[$i],
      'quantity'=>$quantity[$i],
      'status'=>1,
      'submitted_by'=>$user_id,
      'outlet_id'=>$facility,
      'created_at'=>Carbon::now(),
      'updated_at'=>Carbon::now()
    ]);

    }

    return redirect()->action('PharmacyController@showInventory');
  }

  public function deleteInventory(Request $request)
  {
    $user_id = Auth::user()->id;
    $id = $request->inventory_id;
    $count = count($id);

    for($i=0;$i<$count;$i++)
    {
    $results = DB::table('inventory')
          ->where('id', '=', $id[$i])
          ->update([
            'is_active'=>'deleted',
            'deleted_by'=>$user_id,
            'updated_at'=>Carbon::now()
          ]);

    }

    return redirect()->action('PharmacyController@showInventory');

  }

  public function inventoryReport()
  {
    $reports = DB::table('druglists')
              ->join('inventory', 'druglists.id', '=', 'inventory.drug_id')
              ->join('inventory_updates', 'inventory.id', '=', 'inventory_updates.inventory_id')
              ->join('prescription_details', 'druglists.id', '=', 'prescription_details.drug_id')
              ->join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
              ->select('inventory.quantity AS inv_qty', 'inventory_updates.quantity AS inv_qty2',
              'druglists.drugname', 'prescription_filled_status.quantity AS qty3')
              ->groupBy('druglists.drugname')
              ->get();

      return view('pharmacy.inventory_report')->with('reports',$reports);
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
