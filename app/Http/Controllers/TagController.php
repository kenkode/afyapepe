<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Auth;
use App\Test;
use Carbon\Carbon;
class TagController extends Controller
{


   public function ftest(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $tests = Test::search($term)->limit(20)->get();

        $formatted_tests = [];

        foreach ($tests as $test) {
            $formatted_tests[] = ['id' => $test->id, 'text' => $test->name];
        }

        return \Response::json($formatted_tests);
    }



    public function admitts(Request $request)

    {
  $Now = Carbon::now();
  $nextappointment=$request->next_appointment;
  $doc_note=$request->doc_notedoc_note;

  if ($nextappointment) {
    DB::table('appointments')->insert([
        'status'  => $request->get('appointment_status'),
        'afya_user_id'  => $request->get('afyaUser'),
        'persontreated'  => $request->get('dependt'),
        'appointment_made'  => 'Y',
        'appointment_date'  => $nextappointment,
        'created_by_users_id'  => $request->get('docr'),
  ]);
  }
    if ($doc_note) {
  DB::table('patientNotes')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'note'  => $request->get('doc_note'),
      'written_by'   => 'Doctor',
      'target'  => 'Admition',
  ]);
}

      DB::table('patient_admitted')->insert([
          'appointment_id'  => $request->get('appointment_id'),
          'facility'  => $request->get('facility'),
          'date_admitted'  => $Now,
          'doc_id'  => $request->get('doc_id'),
      ]);


    $appid =$request['appointment_id'];
    $appstatus =$request['appointment_status'];

           DB::table('appointments')
                     ->where('id',$appid)
                     ->update(['status'=>$appstatus]);

        $setUp= DB::table('facility_doctor')
        ->leftJoin('facilities', 'facility_doctor.facilitycode', '=', 'facilities.FacilityCode')
        ->where('facility_doctor.user_id', '=', Auth::user()->id)
        ->select('facilities.set_up')
        ->first();
        if ($setUp->set_up == 'Partial') {
          return redirect()->action('privateController@privatepatient');
        } else {
        return redirect()->route('doctor');
        }


    }


public function discharge(Request $request)

{
$Now = Carbon::now();

$doc_note=$request->doc_note;
if ($doc_note) {
  DB::table('patientNotes')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'note'  => $request->get('doc_note'),
      'written_by'   => 'Doctor',
      'target'  => $request->get('target'),

  ]);
}
$nextappointment=$request->next_appointment;
if ($nextappointment) {
  DB::table('appointments')->insert([
      'status'  => $request->get('appointment_status'),
      'afya_user_id'  => $request->get('afyaUser'),
      'persontreated'  => $request->get('dependt'),
      'appointment_made'  => 'Y',
      'appointment_date'  => $nextappointment,
      'facility_id'  => $request->get('facility_id'),
      'created_by_users_id'  => $request->get('docr'),


  ]);
}
$facility_to=$request->facility_to;

if ($facility_to) {
DB::table('patient_transfer')->insert([
    'appointment_id'  => $request->get('appointment_id'),
    'facility_from'  => $request->get('facility_from'),
    'facility_to'  => $request->get('facility_to'),
]);
}

$appid =$request['appointment_id'];
$appstatus =$request['appointment_status'];
$disconditions =$request['discondition'];
$date_of_death =$request['date_of_death'];
$time_of_death =$request['time_of_death'];

       DB::table('appointments')
                 ->where('id',$appid)
                 ->update(['status'=>$appstatus]);

   DB::table('patient_admitted')
         ->where('appointment_id',$appid)
         ->update(['date_discharged'=> $Now,
                  'condition'=> $disconditions,
                  'date_of_death'=> $date_of_death,
                  'time_of_death'=> $time_of_death]);
$setUp= DB::table('facility_doctor')
->leftJoin('facilities', 'facility_doctor.facilitycode', '=', 'facilities.FacilityCode')
->where('facility_doctor.user_id', '=', Auth::user()->id)
->select('facilities.set_up')
->first();

if ($date_of_death) {
  if ($setUp->set_up == 'Partial') {
  return redirect()->action('privateController@privatepatient');
  } else {
  return redirect()->route('doctor');
  }
//return redirect()->route('showPatient', ['id' => $appid]);
} else {
return redirect()->route('discharge', ['id' => $appid]);
}


}

public function transfers(Request $request)

{

  DB::table('patient_transfer')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'facility_from'  => $request->get('facility_from'),
      'facility_to'  => $request->get('facility_to'),

  ]);
  $doc_note=$request->doc_note;
  if ($doc_note) {
  DB::table('patientNotes')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'note'  => $request->get('doc_note'),
      'written_by'   => 'Doctor',
      'target'  => 'Admition',
  ]);
}
$appid =$request['appointment_id'];
$appstatus =$request['appointment_status'];

       DB::table('appointments')
                 ->where('id',$appid)
                 ->update(['status'=>$appstatus]);
$setUp= DB::table('facility_doctor')
->leftJoin('facilities', 'facility_doctor.facilitycode', '=', 'facilities.FacilityCode')
->where('facility_doctor.user_id', '=', Auth::user()->id)
->select('facilities.set_up')
->first();
if ($setUp->set_up == 'Partial') {
return redirect()->action('privateController@privatepatient');
} else {
return redirect()->route('doctor');
}
 //return redirect()->route('showPatient', ['id' => $appid]);
}



public function endvisits($id)

{
 DB::table('appointments')
           ->where('id',$id)
           ->update(['status'=> 3]);
  $setUp= DB::table('facility_doctor')
  ->leftJoin('facilities', 'facility_doctor.facilitycode', '=', 'facilities.FacilityCode')
  ->where('facility_doctor.user_id', '=', Auth::user()->id)
  ->select('facilities.set_up')
  ->first();
  if ($setUp->set_up == 'Partial') {
  return redirect()->action('privateController@privatepatient');
   
  } else {
   return redirect()->action('DoctorController@index');
  }

}





}
