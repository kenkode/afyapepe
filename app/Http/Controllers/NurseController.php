<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Carbon;
use App\Http\Requests;
class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
      $patients = DB::table('patients')
        ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
        ->select('patients.*', 'constituencies.name')
        ->get();

      return view('nurse.home')->with('patients',$patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nurse.create');
        
    }

    public function wList(){
    $patients = DB::table('patients')
        ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
        ->select('patients.*', 'constituencies.name')
        ->get();

     return view('nurse.waitingList')->with('patients',$patients);

    }

    public function newPatient(){
    $patients = DB::table('patients')
        ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
        ->select('patients.*', 'constituencies.name')
        ->get();
        return view('nurse.newpatient')->with('patients',$patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $patient = DB::table('patients')
        ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
        ->select('patients.*', 'constituencies.name')
        ->where('patients.id',$id)
        ->first();
      $vaccines =DB::table('vaccination')
        ->Join('diseases','vaccination.diseaseId','=','diseases.id')
        ->Join('patients','vaccination.userId','=','patients.id')
        ->select('vaccination.*', 'diseases.name')
        ->where('vaccination.userId',$id)
        ->get();
        return view('nurse.show')->with('patient',$patient)->with('vaccines',$vaccines);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $patient = DB::table('patients')
      ->Join('constituencies', 'patients.constituency_id', '=', 'constituencies.id')
      ->select('patients.*', 'constituencies.name')
       ->where('patients.id','=', $id)->first();


     return view('nurse.edit',compact('patient'));
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
    $name=$request->name;
    $idno=$request->idno;
    $relationship=$request->relationship;
    $phone=$request->phone;
    $weight=$request->weight;
    $temperature=$request->temperature;
    $systolic=$request->systolic;
    $diastolic=$request->diastolic;
    $height=$request->current_height;
    $nurse=$request->nurse;
    $chief=$request->chiefcompliant;
    $observation=$request->observation;
    $doctor=$request->doctor;
    $diseases=$request->diseases;
    $vaccines=$request->vaccinename;
    $yes=$request->yes;
    $date=$request->dates;

DB::table('patients')->where('id', $id)
            ->update(
                       array(
                             'next_kin' => $name,
                             'nextkinID' => $idno,
                             'relation_kin' => $relationship,
                             'phone_kin' => $phone,
                             'current_weight' => $weight,
                             'temperature' => $temperature,
                             'systolic_bp' => $systolic,
                             'diastolic_bp' => $diastolic,
                             'current_height' => $height,
                             'nurse_note' => $nurse,
                             'chief_compliant' => $chief,
                             'observation'=> $observation,
                             'consulting_physician'=> $doctor

                             )
                       );
      DB::table('vaccination')->insert(
    ['userId' => $id,
     'diseaseId' =>$diseases,
     'vaccine_name'=>$vaccines,
     'Yes'=>$yes,
     'yesdate'=>$date
   ]
);




    return Redirect::route('nurse.show', [$id]);

    }

    public function patient(Request $request, $id)
    {
        return 'awesome';

    }

    public function vaccine($id)
    {
        return view('nurse.vaccine');
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
