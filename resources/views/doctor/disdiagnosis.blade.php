@extends('layouts.show')
@section('content')
<?php
$doc = (new \App\Http\Controllers\DoctorController);
$Docdatas = $doc->DocDetails();
foreach($Docdatas as $Docdata){


$Did = $Docdata->doc_id;
$Name = $Docdata->name;
$Address = $Docdata->address;
$RegNo = $Docdata->regno;
$RegDate = $Docdata->regdate;
$Speciality = $Docdata->speciality;
$Sub_Speciality = $Docdata->subspeciality;
}

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

$now = time(); // or your date as well
$your_date = strtotime($dependantAge);
$datediff = $now - $your_date;

$dependantdays= floor($datediff / (60 * 60 * 24));



}
?>

     <div class="ibox-title">
       <?php if ($dependantId =='Self') { ?>
      <h5>{{$pdetails->firstname}} {{$pdetails->secondName}}</h5>
         <div class="ibox-tools">
           <a class="collapse-link">{{$pdetails->FacilityName }}</a>
         </div>

    <?php     }else{ if($dependantdays <='28') { ?>
       <h5>{{$pdetails->dep1name}} {{$pdetails->dep2name}}</h5>
      <div class="ibox-tools">
        <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
      </div>
      <?php  }   } ?>
       </div>

     <div class="ibox float-e-margins">
       <div class="col-lg-12">
         <div class="tabs-container">
      <ul class="nav nav-tabs">
      <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
      <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
      <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
      <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
      <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
      @if ($condition =='Admitted')
      <li><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
      @else  <li><a href="{{route('admit',$app_id)}}">Admit</a></li>@endif
      <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
      <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
      </ul>

<ul class="nav nav-tabs">
<li class=""><a href="{{route('discharge',$app_id)}}"> Discharge Condition</a></li>
<li class="active"><a href="{{route('disdiagnosis',$app_id)}}"> Discharge Diagnosis</a></li>
<li class=""><a href="{{route('disprescription',$app_id)}}">Discharge Prescription</a></li>
</ul>

     <!--Test result tabs PatientController@testdone-->



<div class="col-sm-6 b-r">
<div class="ibox-content">
    {{ Form::open(array('route' => array('confdiag'),'method'=>'POST')) }}
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
                             </div>

          <div class="col-sm-6">
            <div class="ibox-content">
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
                           {{ Form::hidden('facility_id',$fac_id, array('class' => 'form-control')) }}
                           {{ Form::hidden('doc_id',$Did, array('class' => 'form-control')) }}
  <div class="col-lg-offset-5">
    <button class=" mtop btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>
  </div>
  {{ Form::close() }}
      </div>
   </div>
</div><!-- testes -->
</div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
