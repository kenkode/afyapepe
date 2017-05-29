<div id="tab-1a" class="tab-pane">
  <div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5><h1>Gainers</h1> </h5>
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
<table class="table borderless dataTables-example">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Company</th>
                    <th>Change</th>
                    <th>Total Sales</th>
                </tr>
                </thead>
                <tbody>
                <?php
              $Trendsalew = DB::table('prescription_filled_status')
                     ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                     ->join('druglists','druglists.id','=','prescription_details.drug_id')
                     ->select('Manufacturer','prescription_filled_status.created_at', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                       ->groupBy('Manufacturer','created_at')
                       ->whereNull('prescription_filled_status.substitute_presc_id')
                       ->where([ ['prescription_filled_status.created_at','<',$today],
                                 ['prescription_filled_status.created_at','>=',$one_week_ago],
                                ])
                        ->orderBy('totalq', 'desc')
                        ->LIMIT(10)
                         ->get();
                         $i=1;
                      ?>

            @foreach($Trendsalew as $trend)

        <?php  $Trendsoldw = DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                ->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->select('Manufacturer','prescription_filled_status.created_at', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                  ->groupBy('Manufacturer','created_at')
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->where([ ['prescription_filled_status.created_at','<',$one_week_ago],
                            ['prescription_filled_status.created_at','>=',$two_week_ago],
                            ['druglists.Manufacturer','like','%'.$trend->Manufacturer.'%'],

                           ])
                   ->orderBy('totalq', 'desc')
                    ->first();
            ?>
      <?php    if($Trendsoldw && ($trend->totalq > $Trendsoldw->totalq))  { ?>
              <tr>
                <td>{{$i}}</td>
                <td>{{$trend->Manufacturer}}</td>
                <td class="text-navy"> <i class="fa fa-level-up"></i><?php echo (round((($trend->totalq - $Trendsoldw->totalq)/$trend->totalq)*100,2)).'%' ;?></td>
                <td>{{$trend->totalq}}</td>
                </tr>
                  <?php  $i++  ?>
              <?php   } ?>
              @endforeach
             <tr><td><h1>Losers</h1></td></tr>
            <?php   $TrendsalewL = DB::table('prescription_filled_status')
                  ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
                  ->join('druglists','druglists.id','=','prescription_details.drug_id')
                  ->select('Manufacturer','prescription_filled_status.created_at', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
                    ->groupBy('Manufacturer','created_at')
                    ->whereNull('prescription_filled_status.substitute_presc_id')
                    ->where([ ['prescription_filled_status.created_at','<',$today],
                              ['prescription_filled_status.created_at','>=',$one_week_ago],
                             ])
                     ->orderBy('totalq', 'desc')
                     ->LIMIT(10)
                      ->get();
                      $i=1;
                   ?>

              @foreach($TrendsalewL as $trendL)

              <?php  $TrendsoldwL = DB::table('prescription_filled_status')
              ->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')
              ->join('druglists','druglists.id','=','prescription_details.drug_id')
              ->select('Manufacturer','prescription_filled_status.created_at', DB::raw('SUM(quantity) as totalq'), DB::raw('SUM(price * quantity) as total'))
               ->groupBy('Manufacturer','created_at')
               ->whereNull('prescription_filled_status.substitute_presc_id')
               ->where([ ['prescription_filled_status.created_at','<',$one_week_ago],
                         ['prescription_filled_status.created_at','>=',$two_week_ago],
                         ['druglists.Manufacturer','like','%'.$trendL->Manufacturer.'%'],

                        ])
                ->orderBy('totalq', 'desc')
                 ->first();
              ?>
              <?php    if($TrendsoldwL && ($trendL->totalq < $TrendsoldwL->totalq))  { ?>
              <tr>
              <td>{{$i}}</td>
              <td>{{$trendL->Manufacturer}}</td>
              <td class="text-danger"><i class="fa fa-level-down"></i><?php echo (round((($trendL->totalq - $TrendsoldwL->totalq)/$trendL->totalq)*100,2)).'%' ;?></td>
              <td>{{$trendL->totalq}}</td>
              </tr>
               <?php  $i++  ?>
              <?php   } ?>
              @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>
