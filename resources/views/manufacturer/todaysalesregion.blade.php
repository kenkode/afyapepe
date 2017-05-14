<div id="tab-3" class="tab-pane active">
 <ul class="nav nav-tabs">
<li class="active"><a data-toggle="tab" href="#tab-3-1a">Today</a></li>
<li class=""><a data-toggle="tab" href="#tab-3-2a">This Week</a></li>
 <li class=""><a data-toggle="tab" href="#tab-3-3a">This Month</a></li>
<li class=""><a data-toggle="tab" href="#tab-3-4a">This Year</a></li>
<li class=""><a data-toggle="tab" href="#tab-3-5a">Max</a></li>
 <li class=""><a data-toggle="tab" href="#tab-3-6a">Custom</a></li>
</ul>
<br>
<div class="tab-content">
    <div id="tab-3-1a" class="tab-pane active">
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
  <!-- sales Today -->
  <div class="ibox-content">
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                        <th>No</th>
                          <th>Region</th>
                         <th>Prescribing Doctor</th>
                          <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total </th>
                             </tr>

                      </thead>

                      <tbody>
                        <?php $i =1;
                        use Carbon\Carbon;
                        $today = Carbon::today();

                       $Regionnow = DB::table('prescriptions')
                        ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
                        ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                        ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
                        ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
                        ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
                        ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                        ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
                        ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
                        'pharmacy.county','prescription_details.doseform',
                        'prescription_filled_status.substitute_presc_id')
                      ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                              ['prescription_filled_status.created_at','>=',$today],
                            ])

                      ->get();


                        ?>
                     @foreach($Regionnow as $mandrug)
                     <?php $total= ($mandrug->quantity * $mandrug->price);

                     ?>
                          <tr>
                              <td>{{$i}}</td>
                                <td>{{$mandrug->county}}</td>
                               <td>{{$mandrug->name}}</td>
                              <td> <?php if($mandrug->substitute_presc_id){
                                  $drugs = DB::table('substitute_presc_details')
                                  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                  ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                                          ['substitute_presc_details.id','=',$mandrug->substitute_presc_id],
                                        ])
                                  ->first();
                                  echo $drugs->subdrugname;
                              }
                                else{ echo $mandrug->drugname;   } ?>

                                </td>
                              <td>{{$mandrug->FacilityName}}</td>
                              <td>{{$mandrug->pharmacy}}</td>
                              <td>{{$mandrug->quantity}}</td>
                              <td>{{$mandrug->dose_given}}</td>
                              <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                              else { echo $mandrug->doseform; }?> </td>
                              <td>{{$mandrug->price}}</td>
                              <td>{{$total}}</td>
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
<div id="tab-3-2a" class="tab-pane ">
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
<!-- sales This week -->
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                              <th>No</th>
                              <th>Region</th>
                              <th>Prescribing Doctor</th>
                               <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total  </th>
                             </tr>

                      </thead>

                      <tbody>
                        <?php $i =1;
                        $yesterday = Carbon::now();
                        $one_week_ago = Carbon::now()->subWeeks(1);
                        $Regionw = DB::table('prescriptions')
                         ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
                         ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                         ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
                         ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
                         ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
                         ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                         ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
                         ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
                         'pharmacy.county','prescription_details.doseform',
                         'prescription_filled_status.substitute_presc_id')
                        ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                               ['prescription_filled_status.created_at','>=',$one_week_ago],
                               ['prescription_filled_status.created_at','<=',$yesterday],
                             ])

                        ->get();
                        ?>
                     @foreach($Regionw as $mandrug)
                     <?php $total= ($mandrug->quantity * $mandrug->price);

                     ?>
                          <tr>
                              <td>{{$i}}</td>
                                <td>{{$mandrug->county}}</td>
                              <td>{{$mandrug->name}}</td>
                              <td> <?php if($mandrug->substitute_presc_id){
                                  $drugs = DB::table('substitute_presc_details')
                                  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                  ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                                          ['substitute_presc_details.id','=',$mandrug->substitute_presc_id],
                                        ])
                                  ->first();
                                  echo $drugs->subdrugname;
                              }
                                else{ echo $mandrug->drugname;   } ?>

                                </td>

                              <td>{{$mandrug->FacilityName}}</td>
                              <td>{{$mandrug->pharmacy}}</td>
                              <td>{{$mandrug->quantity}}</td>
                              <td>{{$mandrug->dose_given}}</td>
                              <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                              else { echo $mandrug->doseform; }?> </td>
                              <td>{{$mandrug->price}}</td>
                              <td>{{$total}}</td>
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
    <div id="tab-3-3a" class="tab-pane ">
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
<!-- sales This Month -->
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                              <th>No</th>
                              <th>Region</th>
                              <th>Prescribing Doctor</th>
                               <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total  </th>
                             </tr>

                      </thead>

                      <tbody>
                        <?php $i =1;

                        $yesterday = Carbon::now();
                        $one_week_ago = Carbon::now()->subMonths(1);
                        $drugM = DB::table('prescriptions')
                         ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
                         ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                         ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
                         ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
                         ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
                         ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                         ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
                         ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
                         'pharmacy.county','prescription_details.doseform',
                         'prescription_filled_status.substitute_presc_id')
                       ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                               ['prescription_filled_status.created_at','>=',$one_week_ago],
                               ['prescription_filled_status.created_at','<=',$yesterday],
                             ])

                       ->get();


                        ?>
                     @foreach($drugM as $mandrug)
                     <?php $total= ($mandrug->quantity * $mandrug->price);

                     ?>
                          <tr>
                              <td>{{$i}}</td>
                                <td>{{$mandrug->county}}</td>
                              <td>{{$mandrug->name}}</td>
                              <td> <?php if($mandrug->substitute_presc_id){
                                  $drugs = DB::table('substitute_presc_details')
                                  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                  ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                                          ['substitute_presc_details.id','=',$mandrug->substitute_presc_id],
                                        ])
                                  ->first();
                                  echo $drugs->subdrugname;
                              }
                                else{ echo $mandrug->drugname;   } ?>

                                </td>

                              <td>{{$mandrug->FacilityName}}</td>
                              <td>{{$mandrug->pharmacy}}</td>
                              <td>{{$mandrug->quantity}}</td>
                              <td>{{$mandrug->dose_given}}</td>
                              <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                              else { echo $mandrug->doseform; }?> </td>
                              <td>{{$mandrug->price}}</td>
                              <td>{{$total}}</td>
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
<div id="tab-3-4a" class="tab-pane">
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
<!-- sales This Year -->
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                              <th>No</th>
                              <th>Region</th>
                              <th>Prescribing Doctor</th>
                               <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total  </th>
                             </tr>

                      </thead>

                      <tbody>
                        <?php $i =1;
                        // use Carbon\Carbon;
                        $yesterday = Carbon::now();
                        $one_week_ago = Carbon::now()->subYears(1);
                        $drugY = DB::table('prescriptions')
                         ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
                         ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                         ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
                         ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
                         ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
                         ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                         ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
                         ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
                         'pharmacy.county','prescription_details.doseform',
                         'prescription_filled_status.substitute_presc_id')
                       ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                               ['prescription_filled_status.created_at','>=',$one_week_ago],
                               ['prescription_filled_status.created_at','<=',$yesterday],
                             ])

                       ->get();


                        ?>
                     @foreach($drugY as $mandrug)
                     <?php $total= ($mandrug->quantity * $mandrug->price);

                     ?>
                          <tr>
                              <td>{{$i}}</td>
                                <td>{{$mandrug->county}}</td>
                              <td>{{$mandrug->name}}</td>
                              <td> <?php if($mandrug->substitute_presc_id){
                                  $drugs = DB::table('substitute_presc_details')
                                  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                  ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                                          ['substitute_presc_details.id','=',$mandrug->substitute_presc_id],
                                        ])
                                  ->first();
                                  echo $drugs->subdrugname;
                              }
                                else{ echo $mandrug->drugname;   } ?>

                                </td>

                              <td>{{$mandrug->FacilityName}}</td>
                              <td>{{$mandrug->pharmacy}}</td>
                              <td>{{$mandrug->quantity}}</td>
                              <td>{{$mandrug->dose_given}}</td>
                              <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                              else { echo $mandrug->doseform; }?> </td>
                              <td>{{$mandrug->price}}</td>
                              <td>{{$total}}</td>
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
<div id="tab-3-5a" class="tab-pane">
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
<!-- sales All times-->
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                              <th>No</th>
                              <th>Region</th>
                              <th>Prescribing Doctor</th>
                               <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total  </th>
                             </tr>

                      </thead>

                      <tbody>
                        <?php $i =1;
                        // use Carbon\Carbon;

                        $drugall = DB::table('prescriptions')
                         ->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
                         ->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                         ->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
                         ->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
                         ->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
                         ->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
                         ->leftJoin('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
                         ->select('prescription_filled_status.*','facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
                         'pharmacy.county','prescription_details.doseform',
                         'prescription_filled_status.substitute_presc_id')
                       ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],

                             ])

                       ->get();


                        ?>
                     @foreach($drugall as $mandrug)
                     <?php $total= ($mandrug->quantity * $mandrug->price);

                     ?>
                          <tr>
                              <td>{{$i}}</td>
                                <td>{{$mandrug->county}}</td>
                              <td>{{$mandrug->name}}</td>
                              <td> <?php if($mandrug->substitute_presc_id){
                                  $drugs = DB::table('substitute_presc_details')
                                  ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                  ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                  ->where([ ['druglists.Manufacturer','like', '%' . 'MERCK' . '%'],
                                          ['substitute_presc_details.id','=',$mandrug->substitute_presc_id],
                                        ])
                                  ->first();
                                  echo $drugs->subdrugname;
                              }
                                else{ echo $mandrug->drugname;   } ?>

                                </td>

                              <td>{{$mandrug->FacilityName}}</td>
                              <td>{{$mandrug->pharmacy}}</td>
                              <td>{{$mandrug->quantity}}</td>
                              <td>{{$mandrug->dose_given}}</td>
                              <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                              else { echo $mandrug->doseform; }?> </td>
                              <td>{{$mandrug->price}}</td>
                              <td>{{$total}}</td>
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
<div id="tab-3-6a" class="tab-pane">
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
<!-- sales All Custom-->
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>


                          <tr>
                              <th>No</th>
                              <th>Region</th>
                              <th>Prescribing Doctor</th>
                               <th>Drug Name</th>
                               <th>Facility</th>
                              <th>Pharmacy  name</th>
                             <th> Quantity</th>
                             <th>Dosage</th>
                              <th>Dosage form</th>
                             <th>Unit Cost</th>
                             <th>Total  </th>
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
