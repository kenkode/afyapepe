@extends('layouts.show')
@section('content')
<!--tabs3-->
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
$Duser = $Docdata->user_id;

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
       <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
         <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
         <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
         <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
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
<div class="col-md-8">
   <div class="tabs-container">
         <ul class="nav nav-tabs">
            <li class="active"><a href="{{route('discharge',$app_id)}}"> Discharge Condition</a></li>
             <li class=""><a href="{{route('disdiagnosis',$app_id)}}"> Discharge Diagnosis</a></li>
             <li class=""><a href="{{route('disprescription',$app_id)}}">Discharge Prescription</a></li>
         </ul>
 </div>
</div>
<div class="ibox-content">
<div class="row">

    <div class="col-sm-4 b-r"><h3 class="m-t-none m-b">Discharge Condition</h3>


      <div class="form-group">
          <label for="tag_list" class="">Discharge Condition:</label>
               <select id="dcond" class="form-control" name="disconditions"  style="width: 100%" >
                 <option value=''>Choose one</option>
                 <option value="1">Discharge Referral</option>
                 <option value="2">Discharge Home</option>
                 <option value="3">Discharge Home With Follow up </option>
                 <option value="4">Dead</option>
                 </select>
      </div>


    </div>

    <div class="col-sm-8"><h4>Action</h4>

      <div id="hidden_div1" style="display: none;">
        <div id="transfer" class="panel-body">
          {{ Form::open(array('route' => array('discharging'),'method'=>'POST')) }}

                <div class="form-group ">
                    <label for="presc" class="col-md-6">Facility:</label>
                    <select id="facility" name="facility_to" class="form-control facility1" style="width: 100%"></select>
                </div>

               {{ Form::hidden('facility_from','facility id', array('class' => 'form-control')) }}
               {{ Form::hidden('appointment_status',5, array('class' => 'form-control')) }}
               {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
               {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
               {{ Form::hidden('target','Transfer', array('class' => 'form-control')) }}
             {{ Form::hidden('discondition','Discharg Transfer', array('class' => 'form-control')) }}


      <div class="form-group ">
      <label for="role" class="control-label">Doctor note</label>
      {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
      </div>
      <div class="form-group  col-md-offset-1">
      <button type="submit" class="btn btn-primary">Submit</button>  </td>
      </div>
      {{ Form::close() }}

      </div><!--panel body-->
      </div>
<!--Discharge home -->
      <div id="hidden_div2" style="display: none;">
  {{ Form::open(array('route' => array('discharging'),'method'=>'POST')) }}


       {{ Form::hidden('appointment_status',3, array('class' => 'form-control')) }}
       {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
       {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
       {{ Form::hidden('target','Discharge', array('class' => 'form-control')) }}
     {{ Form::hidden('discondition','Discharg Home', array('class' => 'form-control')) }}


      <div class="form-group ">
      <label for="role" class="control-label">Doctor note</label>
      {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
      </div>
      <div class="form-group  col-md-offset-1">
      <button type="submit" class="btn btn-primary">Submit</button>  </td>
      </div>
      {{ Form::close() }}
  </div>
<!--Discharge home with follow up-->
  <div id="hidden_div3" style="display: none;">
    {{ Form::open(array('route' => array('discharging'),'method'=>'POST')) }}
    <div class="form-group" id="data_1">
        <label class="font-normal">Next Doctor Visit</label>
        <div class="input-group date">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control" name="next_appointment" value="">
        </div>
    </div>



   {{ Form::hidden('appointment_status',1, array('class' => 'form-control')) }}
   {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
   {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
   {{ Form::hidden('target','Discharge', array('class' => 'form-control')) }}
   {{ Form::hidden('discondition','Discharg Home Follow Up', array('class' => 'form-control')) }}
  {{ Form::hidden('docr',$Duser, array('class' => 'form-control')) }}
  {{ Form::hidden('afyaUser',$afyauserId, array('class' => 'form-control')) }}
  {{ Form::hidden('dependt',$dependantId, array('class' => 'form-control')) }}
  {{ Form::hidden('facility_id',$fac_id, array('class' => 'form-control')) }}


  <div class="form-group ">
  <label for="role" class="control-label">Doctor note</label>
  {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
  </div>
  <div class="form-group  col-md-offset-1">
  <button type="submit" class="btn btn-primary">Submit</button>  </td>
  </div>
  {{ Form::close() }}
</div>
<!--Discharge Death-->
<div id="hidden_div4" style="display: none;">
  {{ Form::open(array('route' => array('discharging'),'method'=>'POST')) }}
  <div class="form-group" id="data_1">
      <label class="font-normal">Date of Death</label>
      <div class="input-group date">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          <input type="text" class="form-control" name="date_of_death">
      </div>
  </div>
  <div class="form-group">
    <label class="font-normal">Time of Death</label>
  <div class="input-group clockpicker" data-autoclose="true">
      <input type="text" class="form-control"name="time_of_death" placeholder="09:30" >
      <span class="input-group-addon">
          <span class="fa fa-clock-o"></span>
      </span>
    </div>
  </div>


  {{ Form::hidden('appointment_status',0, array('class' => 'form-control')) }}
  {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
  {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
  {{ Form::hidden('target','Discharge', array('class' => 'form-control')) }}
  {{ Form::hidden('discondition','Discharg Death', array('class' => 'form-control')) }}

<div class="form-group ">
<label for="role" class="control-label">Doctor note</label>
{{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
</div>
<div class="form-group  col-md-offset-1">
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
</div>


      </div>
  </div>
</div>



      </div><!-- col md 12" -->
   </div><!-- emargis" -->

@endsection
