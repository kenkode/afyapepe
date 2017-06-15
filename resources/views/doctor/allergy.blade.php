<div class="row">
<?php if ($pdetails->persontreated=='Self') { ?>
  <?php $allergy=DB::table('afya_users_allergy')
  ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
  ->where('afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>
  <?php if ($allergy) { ?>
<div class="col-sm-6  b-r ">
    <div class="ibox-content">
<label>Patient Allergy To:</label>
@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
</div>
</div>
<?php  } ?>

  <?php $chronic=DB::table('appointments')
  ->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
  ->Join('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
  ->where('appointments.afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>
<?php if ($chronic) { ?>
<div class="col-sm-6">
    <div class="ibox-content">
<label>Patient Chronic Disease:</label>
@foreach($chronic as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
</div>
</div>
<?php } ?>

<?php } else { ?>
  <?php $allergy=DB::table('afya_users_allergy')
  ->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
  ->where('dependant_id', '=',$dependantId)->distinct()->get(['name']); ?>
<?php if ($allergy) { ?>
<div class="col-sm-6 b-r">
    <div class="ibox-content">
<label>Patient Allergy To:</label>
@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
</div>
</div>
<?php } ?>

<?php $Chronic=DB::table('appointments')
->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
->Join('diagnoses', 'patient_diagnosis.disease_id',  '=', 'diagnoses.id')
->where([ ['appointments.persontreated', '=',$dependantId],['patient_diagnosis.chronic', '=','Y'],])->distinct()->get(['name']); ?>
<?php if ($Chronic) { ?>
  <div class="col-sm-6">
    <div class="ibox-content">
<label>Patient Chronic Disease:</label>
@foreach($Chronic as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
<?php } ?>
</div>
  </div>
<?php } ?>
</div>
