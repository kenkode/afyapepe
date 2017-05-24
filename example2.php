<div id="tab-44a" class="tab-pane active">
    <div class="panel-body">
      <div class="ibox float-e-margins">
         <div class="col-md-12">
              <div class="ibox-content">
                <?php

              $Drugy = DB::table('compe_drugs')->where('manu_id','>=',$Mid )->get();
         ?>
  @foreach($Drugy as $drt)
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
              <tr>
                <th>No</th>
                <th>Doctor</th>
                <th colspan="2">DIRECT SALES</th>
                <th colspan="2">SUBSTITUTED SALES</th>
                <th colspan="2">TOTAL Sales</th>
              </tr>
              <tr>
                <th></th>
                <th></th>
                <th>Units</th>
                <th>Value</th>
                <th>Units</th>
                <th>Value</th>
                <th colspan="2">#</th>
              </tr>
            </thead>
            <tbody>


                <tr>
                 <?php  $Drugy1 = DB::table('druglists')->where('id','>=',$drt->company )->first();
                  $drugsumy=DB::table('prescription_filled_status')
                  ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
                  ->select('prescription_filled_status.price as dprice')
                  ->selectRaw('SUM(quantity) as quantity')
                  ->selectRaw('SUM(price*quantity) as qprice')
                  ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                  ['prescription_filled_status.created_at','<=',$today],
                             ['prescription_details.drug_id','=',$drt->company], ])
                  ->whereNull('prescription_filled_status.substitute_presc_id')
                  ->first();

                  $subdrugsumy=DB::table('prescription_filled_status')
                  ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
                  ->select('prescription_filled_status.price as dprice')
                  ->selectRaw('SUM(quantity) as quantity')
                  ->selectRaw('SUM(price*quantity) as qprice')
                  ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                  ['prescription_filled_status.created_at','<=',$today],
                             ['substitute_presc_details.drug_id','=',$drt->company], ])
                  ->whereNotNull('prescription_filled_status.substitute_presc_id')
                  ->first();
                  ?>
                  <td>1</td>
                  <td>{{$Drugy1->drugname}}</td>
                  <td>{{$drugsumy->quantity}}</td>
                  <td>{{$drugsumy->qprice}}</td>
                  <td>{{$subdrugsumy->quantity}}</td>
                  <td>{{$subdrugsumy->qprice}}</td>
                  <td colspan="2">{{($drugsumy->qprice + $subdrugsumy->qprice)}}</td>

               </tr>
              <tr>
                <?php  $Drugy2 = DB::table('druglists')->where('id','>=',$drt->competition_1 )->first();
                $drugsumy1=DB::table('prescription_filled_status')
                ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
                ->select('prescription_filled_status.price as dprice')
                ->selectRaw('SUM(quantity) as quantity')
                ->selectRaw('SUM(price*quantity) as qprice')
                ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                ['prescription_filled_status.created_at','<=',$today],
                           ['prescription_details.drug_id','=',$drt->competition_1], ])
                ->whereNull('prescription_filled_status.substitute_presc_id')
                ->first();

                $subdrugsumy1=DB::table('prescription_filled_status')
                ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
                ->select('prescription_filled_status.price as dprice')
                ->selectRaw('SUM(quantity) as quantity')
                ->selectRaw('SUM(price*quantity) as qprice')
                ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                          ['prescription_filled_status.created_at','<=',$today],
                           ['substitute_presc_details.drug_id','=',$drt->competition_1], ])
                ->whereNotNull('prescription_filled_status.substitute_presc_id')
                ->first();
                ?>
                <td>2</td>
                <td>{{$Drugy2->drugname}}</td>
                <td>{{$drugsumy1->quantity}}</td>
                <td>{{$drugsumy1->qprice}}</td>
                <td>{{$subdrugsumy1->quantity}}</td>
                <td>{{$subdrugsumy1->qprice}}</td>
                <td colspan="2">{{($drugsumy1->qprice + $subdrugsumy1->qprice)}}</td>
             </tr>
             <tr>
               <?php  $Drugy3 = DB::table('druglists')->where('id','>=',$drt->competition_2 )->first();
               $drugsumy2=DB::table('prescription_filled_status')
               ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
               ->select('prescription_filled_status.price as dprice')
               ->selectRaw('SUM(quantity) as quantity')
               ->selectRaw('SUM(price*quantity) as qprice')
               ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                         ['prescription_filled_status.created_at','<=',$today],
                          ['prescription_details.drug_id','=',$drt->competition_2], ])
               ->whereNull('prescription_filled_status.substitute_presc_id')
               ->first();

               $subdrugsumy2=DB::table('prescription_filled_status')
               ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
               ->select('prescription_filled_status.price as dprice')
               ->selectRaw('SUM(quantity) as quantity')
               ->selectRaw('SUM(price*quantity) as qprice')
               ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                         ['prescription_filled_status.created_at','<=',$today],
                          ['substitute_presc_details.drug_id','=',$drt->competition_2], ])
               ->whereNotNull('prescription_filled_status.substitute_presc_id')
               ->first();
               ?>
               <td>3</td>
               <td>{{$Drugy3->drugname}}</td>
               <td>{{$drugsumy2->quantity}}</td>
               <td>{{$drugsumy2->qprice}}</td>
               <td>{{$subdrugsumy2->quantity}}</td>
               <td>{{$subdrugsumy2->qprice}}</td>
               <td colspan="2">{{($drugsumy2->qprice + $subdrugsumy2->qprice)}}</td>
            </tr>
            <tr>
              <?php  $Drugy4 = DB::table('druglists')->where('id','>=',$drt->competition_3 )->first();
              $drugsumy3=DB::table('prescription_filled_status')
              ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
              ->select('prescription_filled_status.price as dprice')
              ->selectRaw('SUM(quantity) as quantity')
              ->selectRaw('SUM(price*quantity) as qprice')
              ->where([  ['prescription_filled_status.created_at','>=',$one_year_ago],
                         ['prescription_filled_status.created_at','<=',$today],
                         ['prescription_details.drug_id','=',$drt->competition_3], ])
              ->whereNull('prescription_filled_status.substitute_presc_id')
              ->first();

              $subdrugsumy3=DB::table('prescription_filled_status')
              ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
              ->select('prescription_filled_status.price as dprice')
              ->selectRaw('SUM(quantity) as quantity')
              ->selectRaw('SUM(price*quantity) as qprice')
              ->where([  ['prescription_filled_status.created_at','>=',$one_year_ago],
                         ['prescription_filled_status.created_at','<=',$today],
                         ['substitute_presc_details.drug_id','=',$drt->competition_3], ])
              ->whereNotNull('prescription_filled_status.substitute_presc_id')
              ->first();
               ?>
              <td>4</td>
              <td>{{$Drugy4->drugname}}</td>
              <td>{{$drugsumy3->quantity}}</td>
              <td>{{$drugsumy3->qprice}}</td>
              <td>{{$subdrugsumy3->quantity}}</td>
              <td>{{$subdrugsumy3->qprice}}</td>
              <td colspan="2">{{($drugsumy3->qprice + $subdrugsumy3->qprice)}}</td>
           </tr>
           <tr>
             <?php  $Drugy5 = DB::table('druglists')->where('id','>=',$drt->competition_4 )->first();
             $drugsumy4=DB::table('prescription_filled_status')
             ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
             ->select('prescription_filled_status.price as dprice')
             ->selectRaw('SUM(quantity) as quantity')
             ->selectRaw('SUM(price*quantity) as qprice')
             ->where([  ['prescription_filled_status.created_at','>=',$one_year_ago],
                         ['prescription_filled_status.created_at','<=',$today],
                        ['prescription_details.drug_id','=',$drt->competition_4], ])
             ->whereNull('prescription_filled_status.substitute_presc_id')
             ->first();

             $subdrugsumy4=DB::table('prescription_filled_status')
             ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
             ->select('prescription_filled_status.price as dprice')
             ->selectRaw('SUM(quantity) as quantity')
             ->selectRaw('SUM(price*quantity) as qprice')
             ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
                        ['prescription_filled_status.created_at','<=',$today],
                        ['substitute_presc_details.drug_id','=',$drt->competition_4], ])
             ->whereNotNull('prescription_filled_status.substitute_presc_id')
             ->first();
             ?>
             <td>5</td>
             <td>{{$Drugy5->drugname}}</td>
             <td>{{$drugsumy4->quantity}}</td>
             <td>{{$drugsumy4->qprice}}</td>
             <td>{{$subdrugsumy4->quantity}}</td>
             <td>{{$subdrugsumy4->qprice}}</td>
             <td colspan="2">{{($drugsumy4->qprice + $subdrugsumy4->qprice)}}</td>
          </tr>
          <tr>
            <?php  $Drugy6 = DB::table('druglists')->where('id','>=',$drt->competition_5 )->first();
            $drugsumy5=DB::table('prescription_filled_status')
            ->join('prescription_details','prescription_filled_status.presc_details_id','=','prescription_details.id')
            ->select('prescription_filled_status.price as dprice')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price*quantity) as qprice')
            ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
            ['prescription_filled_status.created_at','<=',$today],
                       ['prescription_details.drug_id','=',$drt->competition_5], ])
            ->whereNull('prescription_filled_status.substitute_presc_id')
            ->first();

            $subdrugsumy5=DB::table('prescription_filled_status')
            ->join('substitute_presc_details','prescription_filled_status.substitute_presc_id','=','substitute_presc_details.id')
            ->select('prescription_filled_status.price as dprice')
            ->selectRaw('SUM(quantity) as quantity')
            ->selectRaw('SUM(price*quantity) as qprice')
            ->where([ ['prescription_filled_status.created_at','>=',$one_year_ago],
            ['prescription_filled_status.created_at','<=',$today],
                       ['substitute_presc_details.drug_id','=',$drt->competition_5], ])
            ->whereNotNull('prescription_filled_status.substitute_presc_id')
            ->first();
            ?>
            <td>6</td>
            <td>{{$Drugy6->drugname}}</td>
            <td>{{$drugsumy5->quantity}}</td>
            <td>{{$drugsumy5->qprice}}</td>
            <td>{{$subdrugsumy5->quantity}}</td>
            <td>{{$subdrugsumy5->qprice}}</td>
            <td colspan="2">{{($drugsumy5->qprice + $subdrugsumy5->qprice)}}</td>
         </tr>


                               </tbody>
                            </table>
                        </div>
                        @endforeach
                      </div>
                   </div>
               </div>
            </div>
        </div>
