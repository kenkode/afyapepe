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



    public function admit(Request $request)

    {
  $Now = Carbon::now();
      DB::table('patient_admitted')->insert([
          'appointment_id'  => $request->get('appointment_id'),
          'facility'  => $request->get('facility'),
          'date_admitted'  => $Now,
          'doc_id'  => $request->get('doc_id'),
      ]);

      DB::table('patientNotes')->insert([
          'appointment_id'  => $request->get('appointment_id'),
          'note'  => $request->get('doc_note'),
          'written_by'   => 'Doctor',
          'target'  => 'Admition',
      ]);

    $appid =$request['appointment_id'];
    $appstatus =$request['appointment_status'];

           DB::table('appointments')
                     ->where('id',$appid)
                     ->update(['status'=>$appstatus]);

     return redirect()->route('showPatient', ['id' => $appid]);
    }


public function discharge(Request $request)

{
$Now = Carbon::now();
  DB::table('patientNotes')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'note'  => $request->get('doc_note'),
      'written_by'   => 'Doctor',
      'target'  => 'Discharge',
  ]);

$appid =$request['appointment_id'];
$appstatus =$request['appointment_status'];

       DB::table('appointments')
                 ->where('id',$appid)
                 ->update(['status'=>$appstatus]);

                 DB::table('patient_admitted')
                           ->where('appointment_id',$appid)
                           ->update(['date_discharged'=> $Now,]);

 return redirect()->route('showPatient', ['id' => $appid]);
}

public function transfers(Request $request)

{

  DB::table('patient_transfer')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'facility_from'  => $request->get('facility_from'),
      'facility_to'  => $request->get('facility_to'),

  ]);

  DB::table('patientNotes')->insert([
      'appointment_id'  => $request->get('appointment_id'),
      'note'  => $request->get('doc_note'),
      'written_by'   => 'Doctor',
      'target'  => 'Admition',
  ]);

$appid =$request['appointment_id'];
$appstatus =$request['appointment_status'];

       DB::table('appointments')
                 ->where('id',$appid)
                 ->update(['status'=>$appstatus]);

 return redirect()->route('showPatient', ['id' => $appid]);
}



public function endvisits($id)

{
 DB::table('appointments')
           ->where('id',$id)
           ->update(['status'=> 3]);

 return redirect()->action('DoctorController@index');
}





}
