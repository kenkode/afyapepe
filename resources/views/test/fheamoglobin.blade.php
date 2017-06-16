 <div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">

       <div class="col-lg-7">
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
      @if($gender == 'Male')
      <th><button type="button" class="btn btn-primary">NORMAL MALE</button></th>
      <th>NORMAL FEMALE</th>
      @else
      <th>NORMAL MALE</th>
      <th><button type="button" class="btn btn-primary">NORMAL FEMALE</button></th>
      @endif
      </tr>
      </thead>
      <tbody>
        @foreach($fh as $fhtest)
      <?php  $fhresut=DB::table('test_results')
      ->where([ ['test_results.ptd_id', '=',$tsts1->id],
                ['test_results.test', '=',$fhtest->id],
                ['test_results.appointment_id', '=',$appId], ])

      ->first(); ?>
      <tr>
      <td>{{$i}}</td>
      <td>{{$fhtest->test}}</td>
      <td>@if(is_null($fhresut)) Pending @else {{$fhresut->value}} @endif </td>
      <td>{{$fhtest->units}}</td>
      <td>{{$fhtest->normal_male}}</td>
      <td>{{$fhtest->normal_female}}</td>
      <?php $i ++ ?>
      </tr>
      @endforeach

      </tbody>
      </table>
      </div>
      </div>

</div>


<div class="col-lg-5">
 <div class="ibox float-e-margins">
   <div class="ibox-title">
     <h5>RESULTS</h5>
   </div>
  <div class="ibox-content">
{{ Form::open(array('route' => array('testResult'),'method'=>'POST')) }}
  <div class="col-lg-6 b-r">
    <div class="form-group">
        <label for="tag_list" class="">Test:</label>
             <select class="test-multiple" name="test"  style="width: 100%">
               <?php $fh1=DB::table('test_ranges')->where('test_ranges.type', '=',$tsts1->tests_reccommended)
               ->distinct()->get(['id','test']); ?>
               @foreach($fh1 as $fh1test)
                      <option value='{{$fh1test->id}}'>{{$fh1test->test}}</option>
               @endforeach
               </select>
         </div>

  </div>
  <div class="col-lg-6">
    <div class="form-group"><label>Value</label>
    <input type="text" name="value" placeholder="Enter Value" class="form-control"></div>
  </div>

  <?php $fh11=DB::table('lab_test')->where('id', '=',$tsts1->tests_reccommended)->first(['id']); ?>
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
 <?php $i=1; $fhfilmr = DB::table('film_reports')
 ->Join('test_ranges', 'film_reports.test', '=', 'test_ranges.id')
 ->where('film_reports.ptd_id', '=',$ptdId)
 ->select('film_reports.status','test_ranges.test')
 ->get(); ?>
@if($fhfilmr)
<div class="col-lg-5">
  <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Film Reports</h5>
      </div>
      <div class="ibox-content">

            @foreach($fhfilmr as $fhfilm)
               <div class="form-group"><label>{{$fhfilm->test}}</label>
                 <input type="text"  value="{{$fhfilm->status}}" class="form-control" >
                 </div>
            @endforeach

      </div>
  </div>
              </div>
          @endif

           <?php $i=1; $fh2=DB::table('interpretations')
              ->where('lab_test_id', '=',$tsts1->tests_reccommended)->get(); ?>
              @if($fh2)
          <div class="col-lg-7">
           <div class="ibox float-e-margins">
             <div class="ibox-title">
               <h5>Interpretations</h5>
             </div>
           <div class="ibox-content">
           <table class="table table-bordered">
           <thead>
           <tr>
           <th>#</th>
           <th>Units</th>
           <th>Interpretations</th>
           </tr>
           </thead>
           <tbody>

           @foreach($fh2 as $fhtest)
           <tr>
           <td>{{$i}}</td>
           <td>{{$fhtest->ranges}}</td>
           <td>{{$fhtest->status}}</td>
           <?php $i ++ ?>
           </tr>
           @endforeach

           </tbody>
           </table>
           </div>
           </div>
           </div>
           @endif

      <div class="col-lg-5">
       <div class="ibox float-e-margins">
         <div class="ibox-title">
           <h5>Comments</h5>
         </div>
        <div class="ibox-content">
{{ Form::open(array('route' => array('testfilm'),'method'=>'POST')) }}

     <div class="form-group">
        <label  class="">Comments:</label>
        <select class="form-control" name="comments" required >
        <option value=''>Choose one ..</option>
        <option value='Normal'>Normal</option>
        <option value='Severe'>Severe</option>
        <option value='High'>High</option>
        <option value='Efficient'>Efficient</option>
        <option value='Inefficient'>Inefficient</option>
        <option value='Borderline neutropenia'>Borderline neutropenia</option>
        <option value='Normal peripherial blood picture'>Normal peripherial blood picture</option>
        </select>
      </div>
    <div class="form-group">
        <label>Other Reports</label>
        <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>
    </div>
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
