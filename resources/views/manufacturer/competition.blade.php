@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
                <?php
                $id=Auth::id();
                $manufacturer=DB::table('manufacturers')->where('user_id', Auth::id())->first();
                $Mname = $manufacturer->name;
                $Mid = $manufacturer->id;
                ?>
<div class="row">
<h1>Competition Analysis</h1>
              <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">By Sales</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">By Region</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-3">By Doctors</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-4">By Drug</a></li>


                        </ul>
                        <br>
                        <div class="tab-content">

                             <div id="tab-1" class="tab-pane active">
                             <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1a">Today</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2a">This Week</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-3a">This Month</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-4a">This Year</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-5a">Max</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-6a">Custom</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                          <div id="tab-1a" class="tab-pane active">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                            <tr>
                            <th>No</th>
                             <th>Company Name</th>
                             <th>Direct Sales (Units)</th>
                             <th>Price (/Units)</th>
                             <th>Substitute Sales (Units)</th>
                             <th>Price (/Units)</th>
                             <th>Total Sales</th>
                            </tr>

                          </thead>
                          <?php
                          use Carbon\Carbon;
                          $today = Carbon::today();

                           $i =1; $Companies=DB::table('compe_manufacturer')
                          ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                          ->select('compe_manufacturer.id','druglists.Manufacturer')
                           ->where('compe_manufacturer.company', '=',$Mid)
                           ->get(); ?>
                          <tbody>
                          @foreach($Companies as $cos)
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$cos->Manufacturer}}</td>
  <?php    $d1t=DB::table('prescription_filled_status')
  ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
  ->join('druglists','druglists.id','=','prescription_details.drug_id')
  ->select('prescription_filled_status.price as dprice')
  ->selectRaw('SUM(quantity) as quantity')
  ->where([ ['prescription_filled_status.created_at','>=',$today],
            ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
  ->whereNull('prescription_filled_status.substitute_presc_id')
  ->first();
                             ?>
<td>@if($d1t->quantity){{$d1t->quantity}} @else 0 @endif</td>
<td>@if($d1t->dprice){{$d1t->dprice}}@else - @endif</td>
<?php    $d2t=DB::table('prescription_filled_status')
->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
->select('prescription_filled_status.price as sprice')
->selectRaw('SUM(quantity) as quantity')
->where([ ['prescription_filled_status.created_at','>=',$today],
          ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->first();           ?>
                            <td>@if($d2t->quantity){{$d2t->quantity}}@else 0 @endif</td>
                            <td>@if($d2t->sprice){{$d2t->sprice}}@else - @endif</td>
                            <td><?php $d3t=($d1t->quantity * $d1t->dprice) + ($d2t->quantity * $d2t->sprice)  ?>
                              {{$d3t}}</td>
                            </tr>
                              <?php $i++;  ?>
                              @endforeach
                          </tbody>

                         </table>
                         </div>
                         </div>
                         </div>

        </div>
        </div>
        <!--................................. THIS WEEK ...........................-->
                                <div id="tab-2a" class="tab-pane ">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                              <tr>
                              <th>No</th>
                               <th>Company Name</th>
                               <th>Direct Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Substitute Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Total Sales</th>
                              </tr>

                            </thead>
                            <?php
                             $one_week_ago = Carbon::now()->subWeeks(1);
                             $i =1;   ?>
                            <tbody>
                            @foreach($Companies as $cos)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$cos->Manufacturer}}</td>
    <?php    $d1w=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->select('prescription_filled_status.price as dprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_week_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
    <td>@if($d1w->quantity){{$d1w->quantity}} @else 0 @endif</td>
    <td>@if($d1w->dprice){{$d1w->dprice}}@else - @endif</td>
    <?php    $d2w=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_week_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($d2w->quantity){{$d2w->quantity}}@else 0 @endif</td>
                              <td>@if($d2w->sprice){{$d2w->sprice}}@else - @endif</td>
                              <td><?php $d3w=($d1w->quantity * $d1w->dprice) + ($d2w->quantity * $d2w->sprice)  ?>
                                {{$d3w}}</td>
                              </tr>
                                <?php $i++;  ?>
                                @endforeach
                            </tbody>
                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>

                                </div>
                                </div>
                                  <!--................................. THIS MONTH...........................-->
                                <div id="tab-3a" class="tab-pane ">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                              <tr>
                              <th>No</th>
                               <th>Company Name</th>
                               <th>Direct Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Substitute Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Total Sales</th>
                              </tr>

                            </thead>
                            <?php
                $one_mon_ago = Carbon::now()->subMonths(1);
                $i =1;
                ?>
                            <tbody>
                            @foreach($Companies as $cos)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$cos->Manufacturer}}</td>
    <?php    $d1m=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->select('prescription_filled_status.price as dprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_mon_ago ],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
  <td>@if($d1m->quantity){{$d1m->quantity}} @else 0 @endif</td>
  <td>@if($d1m->dprice){{$d1m->dprice}}@else - @endif</td>
  <?php    $d2m=DB::table('prescription_filled_status')
  ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
  ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
  ->select('prescription_filled_status.price as sprice')
  ->selectRaw('SUM(quantity) as quantity')
  ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
  ['prescription_filled_status.created_at','>=',$one_mon_ago ],
  ['prescription_filled_status.created_at','<=',$today],])
  ->whereNotNull('prescription_filled_status.substitute_presc_id')
  ->first();           ?>
                              <td>@if($d2m->quantity){{$d2m->quantity}}@else 0 @endif</td>
                              <td>@if($d2m->sprice){{$d2m->sprice}}@else - @endif</td>
                              <td><?php $d3m=($d1m->quantity * $d1m->dprice) + ($d2m->quantity * $d2m->sprice)  ?>
                                {{$d3m}}</td>
                              </tr>
                                <?php $i++;  ?>
                                @endforeach
                            </tbody>
                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>

                                </div>
                                </div>
                                  <!--................................. THIS YEAR...........................-->
                                <div id="tab-4a" class="tab-pane ">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                              <tr>
                              <th>No</th>
                               <th>Company Name</th>
                               <th>Direct Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Substitute Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Total Sales</th>
                              </tr>

                            </thead>
                            <?php
                 $one_year_ago = Carbon::now()->subYears(1);
                 $i =1;
                 ?>
                            <tbody>
                            @foreach($Companies as $cos)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$cos->Manufacturer}}</td>
    <?php    $d1y=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->select('prescription_filled_status.price as dprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_year_ago ],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
    <td>@if($d1y->quantity){{$d1y->quantity}} @else 0 @endif</td>
    <td>@if($d1y->dprice){{$d1y->dprice}}@else - @endif</td>
    <?php    $d2y=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_year_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($d2y->quantity){{$d2y->quantity}}@else 0 @endif</td>
                              <td>@if($d2y->sprice){{$d2y->sprice}}@else - @endif</td>
                              <td><?php $d3y=($d1y->quantity * $d1y->dprice) + ($d2y->quantity * $d2y->sprice)  ?>
                                {{$d3y}}</td>
                              </tr>
                                <?php $i++;  ?>
                                @endforeach
                            </tbody>
                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>

                                </div>
                                </div>
                                  <!--................................. ALL TIME ...........................-->
                                <div id="tab-5a" class="tab-pane">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                              <tr>
                              <th>No</th>
                               <th>Company Name</th>
                               <th>Direct Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Substitute Sales (Units)</th>
                               <th>Price (/Units)</th>
                               <th>Total Sales</th>
                              </tr>

                            </thead>
                            <?php
                            $i =1; ?>
                            <tbody>
                            @foreach($Companies as $cos)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$cos->Manufacturer}}</td>
    <?php    $d1a=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->select('prescription_filled_status.price as dprice')
    ->selectRaw('SUM(quantity) as quantity')
      ->where('druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%')
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
    <td>@if($d1a->quantity){{$d1a->quantity}} @else 0 @endif</td>
    <td>@if($d1a->dprice){{$d1a->dprice}}@else - @endif</td>
    <?php    $d2a=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where('druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%')
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($d2a->quantity){{$d2a->quantity}}@else 0 @endif</td>
                              <td>@if($d2a->sprice){{$d2a->sprice}}@else - @endif</td>
                              <td><?php $d3a=($d1a->quantity * $d1a->dprice) + ($d2a->quantity * $d2a->sprice)  ?>
                                {{$d3a}}</td>
                              </tr>
                                <?php $i++;  ?>
                                @endforeach
                            </tbody>
                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>

                                </div>
                                </div>
                                  <!--................................. CUSTOM ...........................-->
                                <div id="tab-6a" class="tab-pane">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>



                                                      <tr>
                                                      <th>No</th>
                                                     <th>Company Name</th>
                                                     <th>Sales (Units)</th>
                                                          <th>Total Sales</th>


                                                         </tr>

                                                  </thead>

                                                  <tbody>


                                                   </tbody>

                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>

                                </div>
                                </div>
                            </div>
                            </div>
                            <!-- REGION -->
             @include('manufacturer.competitionregion')
                              <!-- Doctors -->

                                <!-- Drugs -->

                                  <!-- Drugs -->
                                     </div>
                        </div>


                    </div>
                </div>


             @include('includes.default.footer')
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
