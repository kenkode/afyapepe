<div class="row">
<?php if ($pdetails->persontreated=='Self') { ?>
<div class="col-sm-6 b-r">
<label>Patient Allergy To:</label>
<?php $allergy=DB::table('afya_users_allergy')
->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
->where('afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>

@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach
</div>
<div class="col-sm-6">
<label>Patient Chronic Disease:</label>
<?php $chronic=DB::table('appointments')
->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
->Join('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
->where('appointments.afya_user_id', '=',$afyauserId)->distinct()->get(['name']); ?>
@foreach($chronic as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach

</div>
<?php } else { ?>
<div class="col-sm-6">
<label>Patient Allergy To:</label>
<?php $allergy=DB::table('afya_users_allergy')
->Join('allergies_type', 'afya_users_allergy.allergies_type_id',  '=', 'allergies_type.id')
->where('dependant_id', '=',$dependantId)->distinct()->get(['name']); ?>

@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach

<label>Patient Chronic Disease:</label>
<?php $allergy=DB::table('appointments')
->Join('patient_diagnosis', 'appointments.id',  '=', 'patient_diagnosis.appointment_id')
->Join('diagnoses', 'patient_diagnosis.disease_id',  '=', 'diagnoses.id')
->where([ ['appointments.persontreated', '=',$dependantId],['patient_diagnosis.chronic', '=','Y'],])->distinct()->get(['name']); ?>

@foreach($allergy as $micrtest)
<input type="text" value="{{$micrtest->name}}" class="form-control" readonly="readonly">
@endforeach

</div>
<?php } ?>
</div>
