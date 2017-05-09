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
       <div class="col-lg-12">
           <div class="tabs-container">
     <ul class="nav nav-tabs">
       <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li class="active"><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
         <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
          <?php if ($stat==2) { ?>
         <li class=""><a href="{{route('admit',$app_id)}}">Admit</a></li>
         <?php } ?>
          <?php if ($stat==4) { ?>
         <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
          <?php } ?>
           <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
     <?php if ($stat==2) { ?>
         <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
     <?php } ?>
   </ul>

     <!--Test result tabs PatientController@testdone-->
     <div id="testR">
       <?php $i =1;

        if ($dependantdays <='28') {
          $tstdone = DB::table('appointments')
          ->leftJoin('patient_test', 'appointments.id', '=', 'patient_test.appointment_id')
         ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
         ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
         ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
         ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
         ->select('patient_test_details.*','patient_test_details.id as ptdid','facilities.*','lab_test.name','diagnoses.id as diseaseid','diagnoses.name as diagnoses')
         ->where([
                ['appointments.persontreated', '=',$dependantId],
                ['patient_test_details.confirm', '=','Y'],
               ])

          ->orderBy('created_at', 'desc')
          ->get();

       }if ($dependantId =='Self') {
         $tstdone = DB::table('appointments')
          ->leftJoin('patient_test', 'appointments.id', '=', 'patient_test.appointment_id')
         ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
         ->leftJoin('facilities', 'patient_test_details.facility_id', '=', 'facilities.FacilityCode')
         ->leftJoin('lab_test', 'patient_test_details.tests_reccommended', '=', 'lab_test.id')
         ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
         ->select('patient_test_details.*','patient_test_details.id as ptdid','facilities.*','lab_test.name','diagnoses.id as diseaseid','diagnoses.name as diagnoses')

         ->where([
                ['appointments.afya_user_id', '=',$afyauserId],
                ['patient_test_details.confirm', '=','N'],
               ])
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
             <th>Test Name</th>
             <th>Conditional Diagnosis</th>
             <th>Status</th>
             <th>Result</th>
             <th>Note</th>


          </tr>
          </thead>

          <tbody>

          @foreach($tstdone as $tstdn)
            <tr>
            <td>{{ +$i }}</td>
           <td>{{$tstdn->created_at}}</td>
            <td>{{$tstdn->name}}</td>
           <td>{{$tstdn->diagnoses}}</td>

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
             <td>{{$tstdn->note}}</td>
        <td>
          <div>
            {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
            {{ Form::text('appointment_id',$app_id, array('class' => 'form-control')) }}
            {{ Form::text('pat_details_id',$tstdn->ptdid, array('class' => 'form-control')) }}
            <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
           {{ Form::close() }}
        </td>
     </tr>
     <?php $i++; ?>

     @endforeach

     </tbody>
   </table>
        </div>

     </div> <!-- div id="testR" -->

     <div class="ibox-content">

<div id="edit-modal" class="modal fade" aria-hidden="true">
<div class="modal-dialog">

<div class="modal-body" style="overflow:hidden;">
<div class="row">


         <div class="ibox-content col-md-12">
        <div id="" class="">
          {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

        <div class="col-md-6 b-r">


            <div class="form-group"><label>Disease Name</label>
                  <input type="text" name="disease" id="edit-content" class="form-control" >
               </div>
               <div class="form-group">
                     <input type="hidden" name="ptdid" id="diseaseid" class="form-control" >
                  </div>

                      <div class="form-group">
                          <label for="tag_list" class="">Type of Diagnosis:</label>
                               <select id="test-multiple" name="level"  style="width: 100%" >
                                 <option value=''>Choose one</option>
                                   <option value='Primary'>Primary</option>
                                   <option value='Secondary'>Secondary</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label for="tag_list" class="">Chronic:</label>
                                      <select class="" name="chronic"  style="width: 100%" >
                                        <option value=''>Choose one</option>
                                          <option value='Y'>YES</option>
                                          <option value='N'>No</option>
                                        </select>
                                 </div>
                             <div class="form-group">
                                 <label for="tag_list" class="">Level of Severity:</label>
                                      <select class="" name="severity"  style="width: 100%" >
                                        <?php $severeity=DB::table('severity')->get();
                                   ?>
                              <option value=''>Choose one</option>
                                        @foreach($severeity as $diag)
                            <option value='{{$diag->id}}'>{{$diag->name}}</option>
                                        @endforeach
                                        </select>
                                     </div>

                           </div>
                           <div class="col-sm-6">
                             <div class="form-group">
                               <label for="tag_list" class="">Supportive Care:</label>
                                    <select class="" name="care"  style="width: 100%" >
                                      <?php $scare=DB::table('supportive_care')->get();
                                      ?>
                                      <option value=''>Choose one</option>
                                      @foreach($scare as $sup)
                                             <option value='{{$sup->name}}'>{{$sup->name}}</option>
                                      @endforeach
                                      </select>
                                </div>
                                   {{ Form::hidden('state','Normal', array('class' => 'form-control')) }}
                                   {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                                   {{ Form::hidden('dependant_id',$dependantId, array('class' => 'form-control')) }}
                                   {{ Form::hidden('afya_user_id',$afyauserId, array('class' => 'form-control')) }}
                                </div>
                       </div>

          <div class="col-lg-offset-5">
            <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>

          </div>


          {{ Form::close() }}
        </div>

</div>
</div>
</div>
</div>
</div>
</div>
     <button id="diag" class="btn btn-primary btn-block btn-outline">Confirm Diagnosis</button>


 <div class="ibox-content col-md-12">
<div id="confdiag" class="divtest">
  {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

<div class="col-sm-6 b-r">

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





                   </div>
                   <div class="col-sm-6">
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
                           {{ Form::hidden('state','Normal', array('class' => 'form-control')) }}
                           {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}

                        </div>
               </div>

  <div class="col-lg-offset-5">
    <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>

  </div>


  {{ Form::close() }}
</div>
</div><!-- tabs-container -->
      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection