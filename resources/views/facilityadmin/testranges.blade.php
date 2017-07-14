@extends('layouts.facilityadmin')
@section('title', 'Dashboard')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
          <div class="content">
              <div class="container">




                <div  class="row white-bg">
                  <div class="col-lg-11">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>TEST DETAILS</h5>
                      </div>
                  <!-- <div class="row wrapper border-bottom white-bg page-heading col-lg-11"> -->


                               <form class="form-horizontal" role="form" method="POST" action="/rangesadd" novalidate>
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="col-lg-3">
                         <div class="form-group">
                        <label for="tag_list" class="">Tests:</label>
                        <select class="test-multiple" name="tests_id"  style="width: 100%">
                        <?php $tests=DB::table('tests')
                        ->join('test_subcategories','tests.sub_categories_id', '=','test_subcategories.id')
                       ->distinct()->get(['tests.id','tests.name','test_subcategories.name as subname']); ?>
                        @foreach($tests as $tsts)
                        <option value='{{$tsts->id}}'>{{$tsts->name}} ({{$tsts->subname}})</option>
                        @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                       <label>Units:</label>
                       <input type="text" name="units" class="form-control">
                       </div>
                       <div class="form-group">
                      <label>Subt Test:</label>
                      <input type="text" name="sub_test" class="form-control">
                      </div>
         </div>
                 <div class="col-lg-1 col-md-offset-1">
                              <div class="form-group">
                             <label>Low Female:</label>
                             <input type="text" name="low_female" class="form-control">
                             </div>
                             <div class="form-group">
                            <label>Low Male:</label>
                            <input type="text" name="low_male" class="form-control">
                            </div>
                </div>
                <div class="col-lg-1 col-sm-offset-1">
                  <div class="form-group">
                  <label>High Female:</label>
                  <input type="text" name="high_female" class="form-control">
                  </div>
                  <div class="form-group">
                  <label>High Male:</label>
                  <input type="text" name="high_male" class="form-control">
                  </div>
                </div>
                <div class="col-lg-3 col-sm-offset-1">
                  <div class="form-group">
                  <label>Machine:</label>
                  <input type="text" name="machine_name" class="form-control">
                  </div>
                  <div class="form-group">
                 <label for="tag_list" class="">Machine:</label>
                 <select class="test-multiple" name="machine_name"  style="width: 100%">
                 <?php $testm=DB::table('test_machines')
                 ->distinct()->get(['id','name']); ?>
                 <option value=''>choose one</option>
                 @foreach($testm as $tstms)
                 <option value='{{$tstms->id}}'>{{$tstms->name}}</option>
                 @endforeach
                 </select>
                 </div>
                  

                </div>
                <div class="col-md-12 col-md-offset-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                     {!! Form::close() !!}

                  </div>  </div>  </div>

                <div class="row" id="">

                        <div class="ibox float-e-margins">
                          <div class="col-lg-11">
                            <div class="ibox-title">
                                <h5>TEST DETAILS</h5>

                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                              <tr>
                              <th>No</th>
                              <th>Tests</th>
                              <th>Sub Test</th>
                              <th>Machine Name</th>
                              <th>Low Female</th>
                              <th>High Female</th>
                              <th>Low Male</th>
                              <th>High Male</th>
                              <th>Units</th>
                              <th>Action</th>

                           </tr>
                            </thead>
                            <tbody>
                        <?php
                        $i=1;
                      $testranges=DB::table('test_ranges')
                      ->leftjoin('tests','test_ranges.tests_id','=','tests.id')
                       ->leftjoin('test_machines','test_ranges.machine_id','=','test_machines.id')
                       ->select('test_ranges.*','tests.name as tname','test_machines.name as machine')
                      ->get();?>
                        @foreach ($testranges as $fact)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$fact->tname}}</td>
                            <td>{{$fact->name}}</td>
                            <td>{{$fact->machine}}</td>
                            <td>{{$fact->low_female}}</td>
                            <td>{{$fact->high_female}}</td>
                            <td>{{$fact->low_male}}</td>
                            <td>{{$fact->high_male}}</td>
                            <td>{{$fact->units}}</td>
                            <td><a  href="{{route('testsRang',$fact->id)}}">update</a>

                          {!! Form::open(['method' => 'DELETE','route' => ['ranges.destroy', $fact->id],'style'=>'display:inline']) !!}
                           {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                           {!! Form::close() !!}
                            </td>
                            </tr>
                              <?php $i++;  ?>
                              @endforeach
                         </tbody>

                            </tbody>
                            <tfoot>
                            <tr>

                            </tr>
                            </tfoot>
                            </table>
                                </div>

                            </div>
                        </div>
                    </div>
                    </div>


</div>

</div>
</div><!--container-->

@include('includes.default.footer')

@endsection
