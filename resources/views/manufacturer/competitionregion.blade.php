 <div id="tab-2" class="tab-pane">
                             <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-21a">Today</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-22a">This Week</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-23a">This Month</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-24a">This Year</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-25a">Max</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-26a">Custom</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                          <div id="tab-21a" class="tab-pane active">
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
                            <th>Region</th>
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


  <?php    $r1t=DB::table('prescription_filled_status')
  ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
  ->join('druglists','druglists.id','=','prescription_details.drug_id')
  ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
  ->select('prescription_filled_status.price as dprice','pharmacy.county')
  ->selectRaw('SUM(quantity) as quantity')
  ->where([ ['prescription_filled_status.created_at','>=',$today],
            ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
  ->whereNull('prescription_filled_status.substitute_presc_id')
  ->first();
                             ?>
<td>{{$r1t->county}}</td>
  <td>{{$cos->Manufacturer}}</td>
<td>@if($r1t->quantity){{$r1t->quantity}} @else 0 @endif</td>
<td>@if($r1t->dprice){{$r1t->dprice}}@else - @endif</td>
<?php    $r2t=DB::table('prescription_filled_status')
->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
->select('prescription_filled_status.price as sprice')
->selectRaw('SUM(quantity) as quantity')
->where([ ['prescription_filled_status.created_at','>=',$today],
          ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->first();           ?>
                            <td>@if($r2t->quantity){{$r2t->quantity}}@else 0 @endif</td>
                            <td>@if($r2t->sprice){{$r2t->sprice}}@else - @endif</td>
                            <td><?php $R3t=($r1t->quantity * $r1t->dprice) + ($r2t->quantity * $r2t->sprice)  ?>
                              {{$R3t}}</td>
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
                                <div id="tab-22a" class="tab-pane ">
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
                              <th>Region</th>
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

    <?php    $r1w=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
    ->select('prescription_filled_status.price as dprice','pharmacy.county')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_week_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
   <td>{{$r1w->county}}</td>
     <td>{{$cos->Manufacturer}}</td>
    <td>@if($r1w->quantity){{$r1w->quantity}} @else 0 @endif</td>
    <td>@if($r1w->dprice){{$r1w->dprice}}@else - @endif</td>
    <?php    $r2w=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_week_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($r2w->quantity){{$r2w->quantity}}@else 0 @endif</td>
                              <td>@if($r2w->sprice){{$r2w->sprice}}@else - @endif</td>
                              <td><?php $R3w=($r1w->quantity * $r1w->dprice) + ($r2w->quantity * $r2w->sprice)  ?>
                                {{$R3w}}</td>
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
                                <div id="tab-23a" class="tab-pane ">
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
                              <th>Region</th>
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

    <?php    $r1m=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
    ->select('prescription_filled_status.price as dprice','pharmacy.county')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_mon_ago ],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
   <td>{{$r1m->county}}</td>
   <td>{{$cos->Manufacturer}}</td>
  <td>@if($r1m->quantity){{$r1m->quantity}} @else 0 @endif</td>
  <td>@if($r1m->dprice){{$r1m->dprice}}@else - @endif</td>
  <?php    $r2m=DB::table('prescription_filled_status')
  ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
  ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
  ->select('prescription_filled_status.price as sprice')
  ->selectRaw('SUM(quantity) as quantity')
  ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
  ['prescription_filled_status.created_at','>=',$one_mon_ago ],
  ['prescription_filled_status.created_at','<=',$today],])
  ->whereNotNull('prescription_filled_status.substitute_presc_id')
  ->first();           ?>
                              <td>@if($r2m->quantity){{$r2m->quantity}}@else 0 @endif</td>
                              <td>@if($r2m->sprice){{$r2m->sprice}}@else - @endif</td>
                              <td><?php $r3m=($r1m->quantity * $r1m->dprice) + ($r2m->quantity * $r2m->sprice)  ?>
                                {{$r3m}}</td>
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
                                <div id="tab-24a" class="tab-pane ">
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
                              <th>Region</th>
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

    <?php    $r1y=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
    ->select('prescription_filled_status.price as dprice','pharmacy.county')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_year_ago ],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
   <td>{{$r1y->county}}</td>
   <td>{{$cos->Manufacturer}}</td>
   <td>@if($r1y->quantity){{$r1y->quantity}} @else 0 @endif</td>
    <td>@if($r1y->dprice){{$r1y->dprice}}@else - @endif</td>
    <?php    $r2y=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where([ ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'],
    ['prescription_filled_status.created_at','>=',$one_year_ago],
    ['prescription_filled_status.created_at','<=',$today],])
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($r2y->quantity){{$r2y->quantity}}@else 0 @endif</td>
                              <td>@if($r2y->sprice){{$r2y->sprice}}@else - @endif</td>
                              <td><?php $r3y=($r1y->quantity * $r1y->dprice) + ($r2y->quantity * $r2y->sprice)  ?>
                                {{$r3y}}</td>
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
                                <div id="tab-25a" class="tab-pane">
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
                              <th>Region</th>
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

    <?php    $r1a=DB::table('prescription_filled_status')
    ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
    ->join('druglists','druglists.id','=','prescription_details.drug_id')
    ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
    ->select('prescription_filled_status.price as dprice','pharmacy.county')
    ->selectRaw('SUM(quantity) as quantity')
      ->where('druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%')
    ->whereNull('prescription_filled_status.substitute_presc_id')
    ->first();
                               ?>
     <td>{{$r1a->county}}</td>
     <td>{{$cos->Manufacturer}}</td>
    <td>@if($r1a->quantity){{$r1a->quantity}} @else 0 @endif</td>
    <td>@if($r1a->dprice){{$r1a->dprice}}@else - @endif</td>
    <?php    $r2a=DB::table('prescription_filled_status')
    ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
    ->join('druglists','substitute_presc_details.drug_id','=','druglists.id')
    ->select('prescription_filled_status.price as sprice')
    ->selectRaw('SUM(quantity) as quantity')
    ->where('druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%')
    ->whereNotNull('prescription_filled_status.substitute_presc_id')
    ->first();           ?>
                              <td>@if($r2a->quantity){{$r2a->quantity}}@else 0 @endif</td>
                              <td>@if($r2a->sprice){{$r2a->sprice}}@else - @endif</td>
                              <td><?php $r3a=($r1a->quantity * $r1a->dprice) + ($r2a->quantity * $r2a->sprice)  ?>
                                {{$r3a}}</td>
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
                                <div id="tab-26a" class="tab-pane">
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
                                                    <th>Region</th>
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
