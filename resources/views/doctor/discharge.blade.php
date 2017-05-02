@extends('layouts.show')
@section('content')
<!--tabs3-->
<?php
      foreach ($patientD as $pdetails) {
        // $patientid = $pdetails->pat_id;
        //  $facilty = $pdetails->FacilityName;
         $stat= $pdetails->status;
         $afyauserId= $pdetails->afya_user_id;
          $dependantId= $pdetails->persontreated;
          $app_id= $pdetails->id;
          $doc_id= $pdetails->doc_id;
          $fac_id= $pdetails->facility_id;
          $dependantAge= $pdetails->depdob;
          $name= $pdetails->firstname;

 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;

 $dependantdays= floor($datediff / (60 * 60 * 24));



}
?>



   <div class="ibox float-e-margins">
     <div class="ibox-title">
       <?php if ($dependantId =='Self') { ?>
      <h5>{{$pdetails->firstname}} {{$pdetails->secondName}}</h5>
         <div class="ibox-tools">
           <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
         </div>

    <?php     }else{ if($dependantdays <='28') { ?>
       <h5>{{$pdetails->dep1name}} {{$pdetails->dep2name}}</h5>
      <div class="ibox-tools">
        <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
      </div>
      <?php  }   } ?>
       </div>
   <div class="ibox-content col-md-12">
     <ul class="nav nav-tabs">

         <li><a  href="{{route('showPatient',$app_id)}}">Home</a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li class=""><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
         <li class=""><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
         <li class="active"><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
 </ul>
 <div class="ibox-content">
 <div class="row">
     <div class="col-sm-4 b-r"><h3 class="m-t-none m-b">Sign in</h3>

       <div class="table-responsive ibox-content">
         <table class="table table-striped table-bordered table-hover " >
          <thead>
       <tr>
         <th>Diagnosis</th>
         <th>Level</th>
         <th>Severity</th>
     </tr>
       </thead>
       <tbody>
         <?php
         $Pdiagnosis=DB::table('patient_diagnosis')
         ->join('diagnoses','patient_diagnosis.disease_id','=','diagnoses.id')
         ->join('severity','patient_diagnosis.severity','=','severity.id')
         ->select('patient_diagnosis.level','diagnoses.name','diagnoses.id','severity.name as severity')
         ->where('patient_diagnosis.appointment_id',$app_id)
         ->get();
         ?>
@foreach($Pdiagnosis as $tstdn)
         <tr>
         <td>{{$tstdn->name}}</td>
         <td>{{$tstdn->level}}</td>
         <td>{{$tstdn->severity}}</td>
        </tr>
       @endforeach
      </tbody>
     </table>
          </div>
     </div>
     <div class="col-sm-8"><h4>All Test Done</h4>
<?php $i =1;
       $tstdone = DB::table('patient_test')
        ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
        ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
        ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
        ->leftJoin('patient_cond_diagnosis', 'patient_test.appointment_id', '=', 'patient_cond_diagnosis.appointment_id')
        ->Join('diagnoses', 'patient_cond_diagnosis.disease_id', '=', 'diagnoses.id')
        ->Join('diseases', 'patient_cond_diagnosis.other_disease_id', '=', 'diseases.code')
        ->select('patient_test_details.*','facilities.*','lab_test.name','diseases.name as disease','diagnoses.name as diagnoses')
        ->where('patient_test.appointment_id', '=',$app_id)
        ->orderBy('created_at', 'desc')
        ->get();

     ?>

     <div class="table-responsive ibox-content">
      <table class="table table-striped table-bordered table-hover dataTables-conditional" >
        <thead>
     <tr>
      <th></th>

        <th>Test Name</th>
        <th>Conditional Diagnosis</th>
        <th>Other Diagnosis</th>
        <th>Status</th>
        <th>Result</th>

     </tr>
     </thead>

     <tbody>

     @foreach($tstdone as $tstdn)
       <tr>
       <td>{{ +$i }}</td>
      <td>{{$tstdn->name}}</td>
      <td>{{$tstdn->diagnoses}}</td>
       <td>{{$tstdn->disease}}</td>
       <td><?php
       $prescs=$tstdn->done;
       if (is_null($prescs)) {
         $prescs= 'N/A';
       }
       elseif ($prescs==0) {
         $prescs= 'Pending';
       } elseif($prescs==1) {
         $prescs= 'Complete';
       }
         ?>  {{$prescs}}</td>
        <td>{{$tstdn->results}}</td>


     </tr>
     <?php $i++; ?>

     @endforeach

     </tbody>
   </table>

     </div> <!-- div id="testR" -->

   </div>
</div>
</div>
<div class="ibox-content">
<div class="row">
  {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}
    <div class="col-sm-4 b-r"><h3 class="m-t-none m-b">Discharge DIagnosis</h3>
      <?php  if ($dependantdays <='28') { ?>

        <div class="form-group">
            <label for="tag_list" class=""> Diagnosis:</label>
                 <select class="test-multiple" name="disease"  style="width: 100%" >
                   <?php $diagnoses=DB::table('diagnoses')->where(function($query)
            {
                $query->where('target', '=','28 ')
                      ->orWhere('target', '=','28-29');
            })
            ->get();
              ?><option value=''>Choose one</option>
                   @foreach($diagnoses as $diag)
                          <option value='{{$diag->id}}'>{{$diag->name}}</option>
                   @endforeach
                   </select>
             </div>
             <?php } if ($dependantdays >='28') { ?>
             <div class="form-group">
                 <label for="tag_list" class="">Diagnosis:</label>
                      <select class="test-multiple" name="disease"  style="width: 100%" >
                        <?php $diagnoses=DB::table('diagnoses')->where(function($query)
                 {
                     $query->where('target', '=','29 ')
                           ->orWhere('target', '=','28-29');
                 })
                 ->get();
                   ?>
                          <option value=''>Choose one</option>
                        @foreach($diagnoses as $diag)
                               <option value='{{$diag->id}}'>{{$diag->name}}</option>
                        @endforeach
                        </select>
                  </div>
                  <?php }  ?>
                  <div class="form-group">
                      <label for="tag_list" class="">Type of Diagnosis:</label>
                           <select class="test-multiple" name="level"  style="width: 100%" >
                             <option value=''>Choose one</option>
                               <option value='Primary'>Primary</option>
                               <option value='Secondary'>Secondary</option>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="tag_list" class="">Chronic:</label>
                                  <select class="test-multiple" name="chronic"  style="width: 100%" >
                                    <option value=''>Choose one</option>
                                      <option value='Y'>YES</option>
                                      <option value='N'>No</option>
                                    </select>
                             </div>
                         <div class="form-group">
                             <label for="tag_list" class="">Level of Severity:</label>
                                  <select class="test-multiple" name="severity"  style="width: 100%" >
                                    <?php $severeity=DB::table('severity')->get();
                               ?>
                          <option value=''>Choose one</option>
                                    @foreach($severeity as $diag)
                        <option value='{{$diag->id}}'>{{$diag->name}}</option>
                                    @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                   <label for="tag_list" class="">Supportive Care:</label>
                                        <select class="test-multiple" name="care"  style="width: 100%" >
                                          <?php $scare=DB::table('supportive_care')->get();
                                          ?>
                                          <option value=''>Choose one</option>
                                          @foreach($scare as $sup)
                                                 <option value='{{$sup->name}}'>{{$sup->name}}</option>
                                          @endforeach
                                          </select>
                                    </div>

                                       {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}




          <div class="ibox-content">
                                    <div class="text-center">
                                    <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Form in simple modal box</a>
                                    </div>
                                    <div id="modal-form" class="modal fade" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>

                                                            <p>Sign in today for more expirience.</p>

                                                            <form role="form">
                                                                <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter email" class="form-control"></div>
                                                                <div class="form-group"><label>Password</label> <input type="password" placeholder="Password" class="form-control"></div>
                                                                <div>
                                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>
                                                                    <label> <input type="checkbox" class="i-checks"> Remember me </label>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="col-sm-6"><h4>Not a member?</h4>
                                                            <p>You can create an account:</p>
                                                            <p class="text-center">
                                                                <a href=""><i class="fa fa-sign-in big-icon"></i></a>
                                                            </p>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
          <div>
              <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Log in</strong></button>

          </div>
      </form>



    </div>
    <div class="col-sm-8"><h4>All Prescription Given</h4>
<?php $i =1;
$prescription= DB::table('prescriptions')
->leftJoin('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
->leftJoin('diagnoses', 'prescription_details.diagnosis', '=', 'diagnoses.id')
->leftJoin('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
->leftJoin('frequency', 'prescription_details.frequency', '=', 'frequency.id')
->leftJoin('route', 'prescription_details.routes', '=', 'route.id')
->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
->select('diagnoses.name','druglists.drugname','frequency.name as frequency','prescriptions.created_at',
'route.name as route','prescription_filled_status.start_date','prescription_filled_status.end_date')
->where('prescriptions.appointment_id', '=',$app_id)
->orderBy('created_at', 'desc')
->get();

    ?>

    <div class="table-responsive ibox-content">
     <table class="table table-striped table-bordered table-hover dataTables-conditional" >
       <thead>
         <tr>
           <th></th>
              <th>Diagnosis</th>
              <th>Drug Name</th>
              <th>Start Date</th>
              <th>Stop Date</th>
              <th>Frequeny</th>
              <th>Route</th>
       </tr>
     </thead>

     <tbody>
       <?php $i =1; ?>

            @foreach($prescription as $presc)
            <tr>
            <td>{{ +$i }}</td>
             <td>{{$presc->name}}</td>
             <td>{{$presc->drugname}}</td>
              <td>{{$presc->start_date}}</td>
              <td>{{$presc->end_date}}</td>
              <td>{{$presc->frequency}}</td>
              <td>{{$presc->route}}</td>

    </tr>
    <?php $i++; ?>

    @endforeach

    </tbody>
  </table>

    </div> <!-- div id="testR" -->

  </div>
</div>
</div>



      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
