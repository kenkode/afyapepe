<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Illuminate\Support\Facades\Input;
use App\Prescription;
use App\Prescription_detail;
use Auth;
use Carbon\Carbon;
class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function diagnoses(Request $request)
    {
      $Now = Carbon::now();

      $appointment=$request->get('appointment_id');
      // Inserting  diagnosis tests
     $diagnosis= DB::table('patient_diagnosis')->insert([
                        'disease_id' => $request->get('disease'),
                        'level' => $request->get('level'),
                        'severity' => $request->get('severity'),
                        'chronic' => $request->get('chronic'),
                        'appointment_id' => $request->get('appointment_id'),
                        'date_diagnosed' => $Now,
]);
  return redirect()->route('diagnoses', ['id' => $appointment]);
    }
    public function prescriptions($id)
    {
      $patientD =DB::table('appointments')
      ->leftjoin('afya_users','appointments.afya_user_id','=','afya_users.id')
      ->leftjoin('dependant','appointments.persontreated','=','dependant.id')
      ->leftjoin('facilities','appointments.facility_id','=','facilities.FacilityCode')
      ->select('appointments.*','afya_users.firstname','afya_users.secondName','afya_users.gender',
        'dependant.firstName as dep1name','dependant.secondName as dep2name','dependant.gender as depgender',
        'dependant.dob as depdob','facilities.FacilityName')
      ->where('appointments.id',$id)
      ->get();

      $Pdiagnosis=DB::table('patient_diagnosis')
      ->leftjoin('diagnoses','patient_diagnosis.disease_id','=','diagnoses.id')
    ->select('diagnoses.name','diagnoses.id')
      ->where('patient_diagnosis.appointment_id',$id)
      ->get();
      return view('doctor.prescription')->with('patientD',$patientD)->with('Pdiagnosis',$Pdiagnosis);

    }
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   protected function store(Request $request)
   {
     $appid=$request['appointment_id'];

    $pttids= Prescription::where('appointment_id',$appid)
       ->first();

      if (is_null($pttids)) {
      //  - add new
      $Prescription=Prescription::create([
           'appointment_id' => $request['appointment_id'],
           'doc_id' => $request['doc_id'],
           'filled_status' => 0,
      ]);
      $id=$Prescription->id;
      } else {
      // Already exist - get the id the existing
       $id =$pttids->id;
      }

$prescrt=$request->prescription;
if ($prescrt) {
    Prescription_detail::create([
           'presc_id' => $id,
           'diagnosis' => $request['disease_id'],
           'drug_id' => $request['prescription'],
           'doseform' => $request['dosageform'],
           'strength' => $request['strength'],
           'strength_unit' => $request['strength_unit'],
           'routes' => $request['routes'],
           'frequency' => $request['frequency'],
       ]);
}

   return redirect()->route('medicines',$appid);
   }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
