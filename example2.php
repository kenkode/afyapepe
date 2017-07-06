
<div class="ibox-content">
<div class="col-lg-8 b-r">
   <div class="ibox-content">

       <div class="form-group">
       <label>Biochestry Test:</label>
       <select class="test-multiple" name="biotests[]" multiple="multiple" style="width: 100%">
       <?php $biotests=DB::table('lab_test')->where('category', '=','Biochemistry')->distinct()->get(['id','name']); ?>
       @foreach($biotests as $biotest)
       <option value='{{$biotest->id}}'>{{$biotest->name}}</option>
       @endforeach
       </select>
       </div>
   <div class="form-group">
   <label>Coagulation  Test:</label>
   <select class="test-multiple" name="coagtests[]" multiple="multiple" style="width: 100%">
   <?php $coagtests=DB::table('lab_test')->where('category', '=','Coagulation')->distinct()->get(['id','name']); ?>
   @foreach($coagtests as $coagtest)
   <option value='{{$coagtest->id}}'>{{$coagtest->name}}</option>
   @endforeach
   </select>
   </div>
       <div class="form-group">
       <label>Haematology Test:</label>
       <select class="test-multiple" name="haemtests[]" multiple="multiple" style="width: 100%">
       <?php $haemtests=DB::table('lab_test')->where('category', '=','Haematology')->distinct()->get(['id','name']); ?>
       @foreach($haemtests as $haemtest)
       <option value='{{$haemtest->id}}'>{{$haemtest->name}}</option>
       @endforeach
       </select>
       </div>


</div>
</div>

<div class="col-lg-8">
<div class="ibox-content">

<div class="form-group">
<label>Immunology Infective Test:</label>
<select class="test-multiple" name="inftests[]" multiple="multiple" style="width: 100%">
<?php $imitests=DB::table('lab_test')->where('category', '=','Immunology_Infective')->distinct()->get(['id','name']); ?>
@foreach($imitests as $imitest)
<option value='{{$imitest->id}}'>{{$imitest->name}}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Immunology Auto Immune Test:</label>
<select class="test-multiple" name="autotests[]" multiple="multiple" style="width: 100%">
<?php $imatests=DB::table('lab_test')->where('category', '=','Immunology-Auto-Immune')->distinct()->get(['id','name']); ?>
@foreach($imatests as $imatest)
<option value='{{$imatest->id}}'>{{$imatest->name}}</option>
@endforeach
</select>
</div>

<div class="form-group">
<label>Microbiologye  Test:</label>
<select class="test-multiple" name="microtests[]" multiple="multiple" style="width: 100%">
<?php $micrtests=DB::table('lab_test')->where('category', '=','Microbiology')->distinct()->get(['id','name']); ?>
@foreach($micrtests as $micrtest)
<option value='{{$micrtest->id}}'>{{$micrtest->name}}</option>
@endforeach
</select>
</div>


</div>
</div>
</div>
