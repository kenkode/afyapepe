 <div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
      <h3 class="text-center">{{$tsts1->category}} REPORT</h3>

      <div class="col-lg-7 br">
      <div class="ibox float-e-margins">
      <h5>{{$tsts1->name}} / {{$tsts1->sub_category}}</h5>
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
      <?php $i=1; $fh=DB::table('test_ranges')
         ->where('test_ranges.type', '=',$tsts1->tests_reccommended)->get(); ?>
      @foreach($fh as $fhtest)
      <?php  $fhresut=DB::table('test_results')
      ->where([ ['test_results.ptd_id', '=',$tsts1->id],
                ['test_results.test', '=',$fhtest->test],
                ['test_results.appointment_id', '=',$appId], ])
      //  ->orwhere('test_results.appointment_id', '=', $appId)
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
        <h5>RESULTS</h5>
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
        <div class="form-group">
        <label  class="">Film Report:</label>
        <select class="form-control" name ="film">
        <option value='Normocytic'>Normocytic</option>
        <option value='Normochromic'>Normochromic</option>
        <option value='Neutropenia'>Neutropenia</option>
        <option value='Adequate'>Adequate</option>
        </select>
        </div>
        <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
        <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">


    <div class="text-center">
    <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
    </div>
     {{ Form::close() }}


  <h5>FILM REPORT</h5>

{{ Form::open(array('route' => array('testfilm'),'method'=>'POST')) }}

        <label  class="">Comments:</label>
        <select class="form-control" name="comments" >
        <option value='Borderline neutropenia'>Borderline neutropenia</option>
        <option value='Normal peripherial blood picture'>Normal peripherial blood picture</option>
        </select>

        <label>Other Reports</label>
        <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>

      <input type="hidden" name="appointment_id" value="{{$appId}}" class="form-control">
      <input type="hidden" name="ptd_id" value="{{$ptdId}}" class="form-control">
      <input type="hidden" name="type" value="full-haemoglobin" class="form-control">
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
