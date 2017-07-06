<div class="row">
<?php if ($pdetails->persontreated=='Self') { ?>
  <?php $allergy=DB::table('afya_users_allergy')
  ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
  ->where('afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>

<div class="col-sm-6  b-r ">
    <div class="ibox-content">
<label>Patient Allergy:</label>
@if ($allergy)
@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
@else
<input type="text" value="N/A" class="form-control" readonly="readonly">
@endif
</div>
</div>


  <?php $chronic=DB::table('appointments')
  ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
  ->Join('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
  ->where('appointments.afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>

<div class="col-sm-6">
    <div class="ibox-content">
<label>Patient Chronic Disease:</label>
@if($chronic)
@foreach($chronic as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
@else
<input type="text" value="N/A" class="form-control" readonly="readonly">
@endif
</div>
</div>


<?php } else { ?>
  <?php $allergy=DB::table('afya_users_allergy')
  ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
  ->where('dependant_id', '=',$dependantId)->distinct()->get(['name']); ?>

<div class="col-sm-6 b-r">
    <div class="ibox-content">
<label>Patient Allergy:</label>
@if($allergy)
@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
@else
<input type="text" value="N/A" class="form-control" readonly="readonly">
@endif
</div>
</div>


<?php $Chronic=DB::table('appointments')
->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
->Join('diagnoses', 'patient_diagnosis.disease_id',  '=', 'diagnoses.id')
->where([ ['appointments.persontreated', '=',$dependantId],['patient_diagnosis.chronic', '=','Y'],])->distinct()->get(['name']); ?>

  <div class="col-sm-6">
    <div class="ibox-content">
<label>Patient Chronic Disease:</label>
@if($Chronic)
@foreach($Chronic as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
@else
<input type="text" value="N/A" class="form-control" readonly="readonly">
@endif
</div>
  </div>
<?php } ?>
</div>
