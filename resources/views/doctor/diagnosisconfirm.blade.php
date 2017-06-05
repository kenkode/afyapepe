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
    $condition = $pdetails->condition;
    //$name= $pdetails->firstname;

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
          <?php if ($condition =='Admitted') { ?>
         <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
          <?php } ?>
           <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
     <?php if ($stat==2) { ?>
         <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
     <?php } ?>
   </ul>



<div class="row">
   <div class="ibox-content col-md-12">
        <div id="" class="">
          {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}

        <div class="col-md-6 b-r">


            <div class="form-group"><label>Disease Name</label>
                  <input type="text"  value="{{ $patientT->name }}" class="form-control" >
               </div>
               <div class="form-group">
                     <input type="hidden" name="disease" value="{{$patientT->id}}" class="form-control" >
                     <input type="hidden" name="ptdid" value="{{$patientT->ptdid}}" class="form-control" >
                  </div>

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
</div><!-- tabs-container -->
      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
