
 <div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">

       <div class="col-lg-6">
      <div class="ibox float-e-margins">
     <div class="ibox-title">
        <h5> TEST RESULTS  </h5>
     </div>
     <div class="ibox-content">
      <table class="table table-bordered">
      <thead>
      <tr>
      <th>#</th>
      <th>TEST</th>
      <th>VALUE</th>
      <th>UNITS</th>
    </tr>
      </thead>
      <tbody>
        <?php $i=1; $fh=DB::table('tests')
        ->Join('test_ranges', 'tests.id', '=', 'test_ranges.tests_id')
        ->where('tests.id', '=',$tsts1->tests_reccommended)
        ->where('test_ranges.facility_id', '=','19310')
        ->select('tests.id as tests_id','tests.*','test_ranges.*','test_ranges.id as testrangesId')
        ->get();
         ?>
        @foreach($fh as $fhtest)
      <?php  $fhresut=DB::table('test_results')
      ->where([ ['test_results.ptd_id', '=',$tsts1->id],
                ['test_results.test_ranges_id', '=',$fhtest->testrangesId],
                ['test_results.appointment_id', '=',$appId], ])

      ->first(); ?>
      <tr>
      <td>{{$i}}</td>
      <td>{{$fhtest->name}}</td>

@if($gender == 'Male')
    @if(is_null($fhresut))<td>Pending</td>
         @else
         <?php if($fhtest->low_male <= $fhresut->value AND  $fhresut->value <= $fhtest->high_male) { ?>
         <td class="font-bold text-navy"> {{$fhresut->value}}</td>
          <?php }else{ ?>
         <td class="font-bold text-danger"> {{$fhresut->value}}</td>
         <?php } ?>
    @endif

@else
   @if(is_null($fhresut))<td>Pending</td>
   <?php if($fhtest->low_female <= $fhresut->value AND  $fhresut->value <= $fhtest->high_female) { ?>
   <td class="font-bold text-navy"> {{$fhresut->value}}</td>
    <?php }else{ ?>
   <td class="font-bold text-danger"> {{$fhresut->value}}</td>
   <?php } ?>
  @endif
@endif
<td>{{$fhtest->units}}</td>

      <?php $i ++ ?>
      </tr>
      @endforeach

      </tbody>
      </table>
      </div>
      </div>

</div>


<div class="col-lg-6">
 <div class="ibox float-e-margins">
   <div class="ibox-title">
     <h5>RESULTS</h5>
   </div>
  <div class="ibox-content">
{{ Form::open(array('route' => array('testResult'),'method'=>'POST')) }}
  <div class="col-lg-6 b-r">
    <div class="form-group">
        <label for="tag_list" class="">Test:</label>
             <select class="test-multiple" name="testrangesId"  style="width: 100%">

               @foreach($fh as $fh1test)
                      <option value='{{$fh1test->testrangesId}}'>{{$fh1test->name}} ({{$fh1test->units}})</option>
               @endforeach
               </select>
         </div>

  </div>
  <div class="col-lg-6">
    <div class="form-group"><label>Value</label>
    <input type="text" name="test_value" placeholder="Enter Value" class="form-control"></div>
  </div>

  <?php $fh11=DB::table('tests')->where('id', '=',$tsts1->tests_reccommended)->first(['id']); ?>
  @if($fh11->id == '175')
  <div class="form-group">
  <label  class="">Film Report:(for RBC,WBC,Platelets)</label>
  <select class="form-control" name ="film">
<option value=''>Choose one ..</option>
  <option value='Normocytic'>Normocytic</option>
  <option value='Normochromic'>Normochromic</option>
  <option value='Neutropenia'>Neutropenia</option>
  <option value='Adequate'>Adequate</option>
  </select>
  </div>
@endif

  <input type="hidden" name="subcatid" value="{{$tsts1->subcatid}}" class="form-control">
  <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
  <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
  <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">


<div class="text-center">
<button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
</div>
{{ Form::close() }}

    </div>
  </div>
 </div>

 </div>
    </div>
