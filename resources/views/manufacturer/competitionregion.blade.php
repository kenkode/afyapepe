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

                              <?php
                              use Carbon\Carbon;
                              $todaysales = Carbon::today();

                               $Companies=DB::table('compe_manufacturer')
                              ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                              ->select('compe_manufacturer.id','druglists.Manufacturer')
                               ->where('compe_manufacturer.company', '=',$Mid)
                               ->get(); ?>
                               @foreach($Companies as $cos)
                               <div class="col-md-6">
                              <div class="ibox-content">
                                    <div class="">
                                      {{$cos->Manufacturer}}
                                    </div>

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover" >
                              <thead>
                            <tr>
                            <th>No</th>
                            <th>Region</th>
                             <th>Direct Sales (Units)</th>
                             <th>Value(price)</th>

                            </tr>

                          </thead>

                          <tbody>
      <?php  $i =1;   $r1t=DB::table('prescription_filled_status')
              ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
              ->join('druglists','druglists.id','=','prescription_details.drug_id')
              ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
              ->select('county', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                ->groupBy('county')
                ->whereNull('prescription_filled_status.substitute_presc_id')
                ->where([  ['prescription_filled_status.created_at','>=',$todaysales],
                          ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
                 ->orderBy('totalq', 'desc')
                ->LIMIT(5)
                ->get();



                 ?>
                @foreach($r1t as $r1ts)

                <tr>
                  <td>{{$i}}</td>
                  <td>{{$r1ts->county}}</td>
                  <td>{{$r1ts->totalq}}</td>
                  <td>{{$r1ts->total}}</td>

                  </tr>
                              <?php $i++;  ?>
                              @endforeach

                                </tbody>
                            </table>
                             </div>
                          </div>
                         </div>
                         @endforeach
                   </div>
            </div>
        </div>
        <!--................................. THIS WEEK ...........................-->
                                <div id="tab-22a" class="tab-pane ">
                                  <div class="panel-body">
                                  <div class="ibox float-e-margins">

                                <?php
                                $one_week_ago = Carbon::now()->subWeeks(1);
                                 $Companies=DB::table('compe_manufacturer')
                                ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                                ->select('compe_manufacturer.id','druglists.Manufacturer')
                                 ->where('compe_manufacturer.company', '=',$Mid)
                                 ->get(); ?>
                                 @foreach($Companies as $cos)
                                 <div class="col-md-6">
                                <div class="ibox-content">
                                      <div class="">
                                        {{$cos->Manufacturer}}
                                      </div>

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                <thead>
                              <tr>
                              <th>No</th>
                              <th>Region</th>
                               <th>Direct Sales (Units)</th>
                               <th>Value(price)</th>

                              </tr>

                            </thead>

                            <tbody>
        <?php  $i =1;   $r1t=DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                ->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
                ->select('county', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                  ->groupBy('county')
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->where([   ['prescription_filled_status.created_at','>=',$one_week_ago],
                             ['prescription_filled_status.created_at','<=',$todaysales],
                             ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
                   ->orderBy('totalq', 'desc')
                  ->LIMIT(5)
                  ->get();



                   ?>
                  @foreach($r1t as $r1ts)

                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$r1ts->county}}</td>
                    <td>{{$r1ts->totalq}}</td>
                    <td>{{$r1ts->total}}</td>

                    </tr>
                                <?php $i++;  ?>
                                @endforeach

                                  </tbody>
                              </table>
                               </div>
                            </div>
                           </div>
                           @endforeach
                     </div>
              </div>
    </div>
  <!--................................. THIS MONTH...........................-->
                                <div id="tab-23a" class="tab-pane ">
                                  <div class="panel-body">
                                  <div class="ibox float-e-margins">

                                <?php
                                 $one_mon_ago = Carbon::now()->subMonths(1);
                                 $Companies=DB::table('compe_manufacturer')
                                ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                                ->select('compe_manufacturer.id','druglists.Manufacturer')
                                 ->where('compe_manufacturer.company', '=',$Mid)
                                 ->get(); ?>
                                 @foreach($Companies as $cos)
                                 <div class="col-md-6">
                                <div class="ibox-content">
                                      <div class="">
                                        {{$cos->Manufacturer}}
                                      </div>

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                <thead>
                              <tr>
                              <th>No</th>
                              <th>Region</th>
                               <th>Direct Sales (Units)</th>
                               <th>Value(price)</th>

                              </tr>

                            </thead>

                            <tbody>
        <?php  $i =1;   $r1t=DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                ->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
                ->select('county', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                  ->groupBy('county')
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->where([   ['prescription_filled_status.created_at','>=',$one_mon_ago],
                             ['prescription_filled_status.created_at','<=',$todaysales],
                             ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
                   ->orderBy('totalq', 'desc')
                  ->LIMIT(5)
                  ->get();



                   ?>
                  @foreach($r1t as $r1ts)

                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$r1ts->county}}</td>
                    <td>{{$r1ts->totalq}}</td>
                    <td>{{$r1ts->total}}</td>

                    </tr>
                                <?php $i++;  ?>
                                @endforeach

                                  </tbody>
                              </table>
                               </div>
                            </div>
                           </div>
                           @endforeach
                     </div>
              </div>
      </div>
  <!--................................. THIS YEAR...........................-->
                                <div id="tab-24a" class="tab-pane ">
                                  <div class="panel-body">
                                  <div class="ibox float-e-margins">

                                <?php
                               $one_year_ago = Carbon::now()->subYears(1);
                                 $Companies=DB::table('compe_manufacturer')
                                ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                                ->select('compe_manufacturer.id','druglists.Manufacturer')
                                 ->where('compe_manufacturer.company', '=',$Mid)
                                 ->get(); ?>
                                 @foreach($Companies as $cos)
                                 <div class="col-md-6">
                                <div class="ibox-content">
                                      <div class="">
                                        {{$cos->Manufacturer}}
                                      </div>

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                <thead>
                              <tr>
                              <th>No</th>
                              <th>Region</th>
                               <th>Direct Sales (Units)</th>
                               <th>Value(price)</th>

                              </tr>

                            </thead>

                            <tbody>
        <?php  $i =1;   $r1t=DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                ->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
                ->select('county', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                  ->groupBy('county')
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->where([   ['prescription_filled_status.created_at','>=',$one_year_ago],
                             ['prescription_filled_status.created_at','<=',$todaysales],
                             ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
                   ->orderBy('totalq', 'desc')
                  ->LIMIT(5)
                  ->get();



                   ?>
                  @foreach($r1t as $r1ts)

                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$r1ts->county}}</td>
                    <td>{{$r1ts->totalq}}</td>
                    <td>{{$r1ts->total}}</td>

                    </tr>
                                <?php $i++;  ?>
                                @endforeach

                                  </tbody>
                              </table>
                               </div>
                            </div>
                           </div>
                           @endforeach
                     </div>
              </div>
            </div>
  <!--................................. ALL TIME ...........................-->
                                <div id="tab-25a" class="tab-pane">
                                  <div class="panel-body">
                                  <div class="ibox float-e-margins">

                                <?php

                                 $Companies=DB::table('compe_manufacturer')
                                ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
                                ->select('compe_manufacturer.id','druglists.Manufacturer')
                                 ->where('compe_manufacturer.company', '=',$Mid)
                                 ->get(); ?>
                                 @foreach($Companies as $cos)
                                 <div class="col-md-6">
                                <div class="ibox-content">
                                      <div class="">
                                        {{$cos->Manufacturer}}
                                      </div>

                                    <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                <thead>
                              <tr>
                              <th>No</th>
                              <th>Region</th>
                               <th>Direct Sales (Units)</th>
                               <th>Value(price)</th>

                              </tr>

                            </thead>

                            <tbody>
        <?php  $i =1;   $r1t=DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                ->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->join('pharmacy','prescription_filled_status.outlet_id','=','pharmacy.id')
                ->select('county', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                  ->groupBy('county')
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->where([  ['druglists.Manufacturer','like', '%' .$cos->Manufacturer. '%'], ])
                   ->orderBy('totalq', 'desc')
                  ->LIMIT(5)
                  ->get();



                   ?>
                  @foreach($r1t as $r1ts)

                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$r1ts->county}}</td>
                    <td>{{$r1ts->totalq}}</td>
                    <td>{{$r1ts->total}}</td>

                    </tr>
                                <?php $i++;  ?>
                                @endforeach

                                  </tbody>
                              </table>
                               </div>
                            </div>
                           </div>
                           @endforeach
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
