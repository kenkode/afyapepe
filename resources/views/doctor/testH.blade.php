  <div id="tab-1" class="tab-pane">
                    <div class="panel-body">
                      <!--Test result tabs PatientController@testdone-->
                  <?php

if ($dependantId =='Self') {
  $tstdone = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.id')
  ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
  ->select('patient_test_details.id as ptdid','patient_test_details.*','facilities.*','tests.name','diagnoses.name as diagnoses')
 ->where('appointments.afya_user_id', '=',$afyauserId)
  ->orderBy('created_at', 'desc')
  ->get();
  $radiology = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->leftJoin('radiology_test_details', 'patient_test.appointment_id', '=', 'radiology_test_details.appointment_id')
->select('radiology_test_details.*')
 ->where('appointments.afya_user_id', '=',$afyauserId)
  ->orderBy('created_at', 'desc')
  ->get();
}else{
  $tstdone = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
 ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.id')
  ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
  ->select('patient_test_details.id as ptdid','patient_test_details.*','facilities.*','tests.name','diagnoses.name as diagnoses')
  ->Where('appointments.persontreated', '=',$dependantId)
  ->orderBy('created_at', 'desc')
  ->get();
  $radiology = DB::table('patient_test')
  ->leftJoin('appointments', 'patient_test.appointment_id', '=', 'appointments.id')
  ->leftJoin('radiology_test_details', 'patient_test.appointment_id', '=', 'radiology_test_details.appointment_id')
->select('radiology_test_details.*')
 ->where('appointments.persontreated', '=',$dependantId)
  ->orderBy('created_at', 'desc')
  ->get();

}
?>
<div class="table-responsive ibox-content">
                       <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                         <thead>
                      <tr>
                       <th></th>

                         <th>Date </th>
                        <th>Clinical Information</th>
                        <th>Test</th>
                        <th>Conclusion</th>
                        <th>Cat id</th>
                        <th>Action</th>

                    </tr>
                    </thead>

                      <tbody>
                        <?php $i =1; ?>
@foreach($radiology as $tstdn)

<?php
if ($tstdn->test_cat_id== '9') {
  $ct=DB::table('ct_scan')->where('id', '=',$tstdn->test) ->first();
  $test = $ct->name;
} elseif ($tstdn->test_cat_id== 10) {
  $xray=DB::table('x-ray')->where('id', '=',$tstdn->test) ->first();
  $test = $xray->name;
} elseif ($tstdn->test_cat_id== 11) {
  $mri=DB::table('mri_tests')->where('id', '=',$tstdn->test) ->first();
  $test = $mri->name;
}elseif ($tstdn->test_cat_id== 12) {
  $ultra=DB::table('ultrasound')->where('id', '=',$tstdn->test) ->first();
  $test = $ultra->name;
}
$cat=DB::table('test_categories')->where('id', '=',$tstdn->test_cat_id) ->first();
?>
                        <tr>
                        <td>{{ +$i }}</td>
                       <td>{{$tstdn->created_at}}</td>
                       <td>{{$tstdn->clinicalinfo}} </td>
                       <td>{{$test or ''}}</td>
                       <td>{{$tstdn->conclusion}}{{$tstdn->test}}</td>
                       <td>{{$cat->name or ''}}</td>
                 @if($tstdn->confirm =='N')
                         @if($tstdn->done =='1')
                        <td>
                           {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
                             {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                             {{ Form::hidden('pat_details_id',$ptdid, array('class' => 'form-control')) }}
                             <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
                            {{ Form::close() }}
                        </td>
                         @else
                         <td>
                           {{ Form::open(['method' => 'DELETE','route' => ['Rady.deletes', $tstdn->id],'style'=>'display:inline']) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                          @endif
                    @else
                    <td> Confirmed</td>
                    @endif
                  </tr>
                      <?php $i++; ?>
                  @endforeach
                      </tbody>
                    </table>
          </div>
   </div>
</div>
<!--lab test-->
<div id="tab-11" class="tab-pane active">
  <div class="panel-body">

  <?php $i =1; ?>
        <div class="table-responsive ibox-content">
         <table class="table table-striped table-bordered table-hover dataTables-conditional" >
           <thead>
        <tr>
         <th></th>
         <th>Date </th>
        <th>Test Name</th>
        <th>Conditional Diagnosis</th>
        <th>Result</th>
        <th>Note</th>
        <th>Action</th>
      </tr>
        </thead>

        <tbody>

        @foreach($tstdone as $tstdn)
    <?php    $ptdid =$tstdn->ptdid;
      $prescs=$tstdn->done;
      if (is_null($prescs)) {
        $prescs= 'N/A';
      }
      elseif ($prescs==0) {
        $prescs= 'Pending';
      } elseif($prescs==1) {
        $prescs= 'Complete';
      }
        ?>
          <tr>
          <td>{{ +$i }}</td>
         <td>{{$tstdn->created_at}}</td>
         <td>@if($tstdn->name){{$tstdn->name}}
           @else{{$tstdn->testmore}}
           @endif
         </td>
         <td>{{$tstdn->diagnoses}}</td>
         <!-- <td>  {{$prescs}}</td> -->
           <td>{{$tstdn->results}}</td>
           <td>{{$tstdn->note}}</td>
   @if($tstdn->confirm =='N')
           @if($tstdn->done =='1')
          <td>
             {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
               {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
               {{ Form::hidden('pat_details_id',$ptdid, array('class' => 'form-control')) }}
               <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
              {{ Form::close() }}
          </td>
           @else
           <td>
             {{ Form::open(['method' => 'DELETE','route' => ['test.deletes', $tstdn->ptdid],'style'=>'display:inline']) }}
              {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
              {{ Form::close() }}
          </td>
            @endif
      @else
      <td> Confirmed</td>
      @endif
    </tr>
        <?php $i++; ?>
    @endforeach
        </tbody>
      </table>
  </div>
</div>
</div>
