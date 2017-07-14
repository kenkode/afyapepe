
 <div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">

       <div class="col-lg-6">
      <div class="ibox float-e-margins">
     <div class="ibox-title">
        <h5> TEST RESULTS  </h5>

<div class="ibox-tools">
<a class="collapse-link">
</a>
</div>
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
        <?php $i=1; $fh01=DB::table('tests')
        ->Join('test_ranges', 'tests.id', '=', 'test_ranges.tests_id')
        ->where('tests.id', '=',$tsts1->tests_id)
        ->select('tests.id as tests_id','tests.name as tname','test_ranges.*','test_ranges.id as testranges','test_ranges.name as rangesname')
        ->get();
         ?>

        @foreach($fh01 as $fhtest)
      <?php  $fhresut=DB::table('test_results')
      ->where([ ['test_results.ptd_id', '=',$tsts1->id],
                ['test_results.test_ranges_id', '=',$fhtest->testranges],
                ['test_results.appointment_id', '=',$appId], ])

      ->first(); ?>
      <tr>
      <td>{{$i}}</td>
      <td> @if($fhtest->rangesname){{$fhtest->rangesname}}@else{{$fhtest->tname}} @endif</td>

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
  <?php
                $fh02=DB::table('test_ranges')
                ->Join('tests', 'test_ranges.tests_id', '=','tests.id' )
                ->whereNotExists(function($query)
                {
                    $query->select(DB::raw(1))
                          ->from('test_results')
                          ->whereRaw('test_ranges.id = test_results.test_ranges_id');
                })
            ->where('test_ranges.tests_id', '=',$tsts1->tests_id)
            ->select('tests.id as tests_id','tests.name as tname',
            'test_ranges.id as testranges','test_ranges.name as rangesname', 'test_ranges.units')
            ->get();
              ?>
                @foreach($fh02 as $fh1test)
      <option value='{{$fh1test->testranges}}'>@if($fh1test->rangesname){{$fh1test->rangesname}}@else{{$fh1test->tname}} @endif ({{$fh1test->units}})</option>
               @endforeach
               </select>
         </div>

  </div>
  <div class="col-lg-6">
    <div class="form-group"><label>Value</label>
    <input type="text" name="test_value" placeholder="Enter Value" class="form-control"></div>
  </div>
  <div class="form-group ">
  <label for="d_list2">Test Notes:</label>
  <textarea rows="4" name="comment" cols="50" placeholder="Any other Information" class="form-control"></textarea>
  </div>
  <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
  <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
  <input type="hidden" name="facility" value="{{$facilityId}}" class="form-control">
  <input type="hidden" name="test_id" value="{{$fh100->tests_id}}" class="form-control">


<div class="text-center">
<button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
</div>
{{ Form::close() }}

    </div>
  </div>
 </div>

 </div>
    </div>
