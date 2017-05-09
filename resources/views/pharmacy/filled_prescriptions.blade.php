@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-11">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                  <h5>Prescription Details</h5>

                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                      <tr>
                          <th>No</th>
                          <th>Manufacturer</th>
                          <th>Drug</th>
                          <th>Date of Prescription</th>
                          <th>Prescribing Doctor</th>
                          <th>Dose</th>
                          <th>Quantity</th>
                          <th>Total</th>

                    </tr>
                  </thead>

                          <tbody>
                            <?php $i =1;

                            foreach($prescs as $presc)
                            {

                              $presc_date = $presc->prescription_date;
                              $my_date = strtotime($presc_date);
                              $presc_date = date("Y-m-d",$my_date);
                              $manufacturer = $presc->Manufacturer;
                              $doc = $presc->doc;

                              $dose = $presc->strength.' '.$presc->strength_unit;
                              $drug = $presc->drugname;
                              $quantity = $presc->quantity;
                              $price = $presc->price;
                              $totals = $quantity * $price;

                          ?>
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$manufacturer}}</td>
                                  <td>{{$drug}}</td>
                                  <td>{{$presc_date}}</td>
                                  <td>{{$doc}}</td>
                                  <td>{{$dose}}</td>
                                  <td>{{$quantity}}</td>
                                  <td>{{$totals}}</td>

                              </tr>
                              <?php $i++;
                              }
                               ?>

                           </tbody>
                           <tr>
                             <th>No</th>
                             <th>Manufacturer</th>
                             <th>Drug</th>
                             <th>Date of Prescription</th>
                             <th>Prescribing Doctor</th>
                             <th>Dose</th>
                             <th>Quantity</th>
                             <th>Total</th>

                         </tr>

                         </table>
                      </div>

                           </div>
                       </div>
                   </div>
                   </div>

               </div>

               <!-- Begin Sales Summary -->

               <div class="tabs-container">
                 <!-- <div class="col-lg-12 tbg"> -->
                   <ul class="nav nav-tabs">
                       <li class="active"><a data-toggle="tab" href="#tab-1">Today</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-2">This Week</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-3">This Month</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-4">This Year</a></li>


                   </ul>
                   <br>
             <div class="tab-content">
               <!-- Today's Sale -->
                         <div id="tab-1" class="tab-pane active">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <h5>Health Expenditures </h5>

                       </div>
                       <div class="ibox-content">

                           <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables-example" >
                       <thead>
                           <tr>
                             <th>No</th>
                             <th>Manufacturer</th>
                             <th>Drug</th>
                             <th>Date of Prescription</th>
                             <th>Prescribing Doctor</th>
                             <th>Dose</th>
                             <th>Quantity</th>
                             <th>Total</th>
                         </tr>
                       </thead>
                       <tbody>
                       <?php $i = 1;

                       foreach($todays as $today)
                       {
                       ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$today->Manufacturer}}</td>
                            <td>{{$today->drugname}}</td>
                            <td>{{$today->prescription_date}}</td>
                            <td>{{$today->doc}}</td>
                            <td>{{$today->strength.' '.$today->strength_unit}}</td>
                            <td>{{$today->quantity}}</td>
                            <td>{{$today->total}}</td>
                          </tr>
                         <?php
                         $i++;
                        }
                         ?>
                        </tbody>
                      </table>
                          </div>

                      </div>
                  </div>
              </div>
              </div>
              </div>

              <!-- Current Week Sale -->
              <div id="tab-2" class="tab-pane">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">

                       <div class="ibox-content">

                           <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables-example" >
                       <thead>
                           <tr>
                             <th>No</th>
                             <th>Manufacturer</th>
                             <th>Drug</th>
                             <th>Date of Prescription</th>
                             <th>Prescribing Doctor</th>
                             <th>Dose</th>
                             <th>Quantity</th>
                             <th>Total</th>

                         </tr>
                       </thead>

                       <tbody>
                         <?php $i = 1;

                         foreach($weeks as $week)
                         {
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$week->Manufacturer}}</td>
                              <td>{{$week->drugname}}</td>
                              <td>{{$week->prescription_date}}</td>
                              <td>{{$week->doc}}</td>
                              <td>{{$week->strength.' '.$week->strength_unit}}</td>
                              <td>{{$week->quantity}}</td>
                              <td>{{$week->total}}</td>
                            </tr>
                           <?php
                           $i++;
                          }
                           ?>
                        </tbody>
                      </table>
                          </div>

                      </div>
                  </div>
              </div>
              </div>
              </div>

              <!-- Current Month Sale -->
              <div id="tab-3" class="tab-pane">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <h5>Health Expenditures </h5>

                       </div>
                       <div class="ibox-content">

                           <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables-example" >
                       <thead>
                           <tr>
                             <th>No</th>
                             <th>Manufacturer</th>
                             <th>Drug</th>
                             <th>Date of Prescription</th>
                             <th>Prescribing Doctor</th>
                             <th>Dose</th>
                             <th>Quantity</th>
                             <th>Total</th>

                         </tr>
                       </thead>

                       <tbody>
                         <?php $i = 1;

                         foreach($months as $month)
                         {
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$month->Manufacturer}}</td>
                              <td>{{$month->drugname}}</td>
                              <td>{{$month->prescription_date}}</td>
                              <td>{{$month->doc}}</td>
                              <td>{{$month->strength.' '.$month->strength_unit}}</td>
                              <td>{{$month->quantity}}</td>
                              <td>{{$month->total}}</td>
                            </tr>
                           <?php
                           $i++;
                          }
                           ?>
                        </tbody>
                      </table>
                          </div>

                      </div>
                  </div>
              </div>
              </div>
              </div>

              <!-- Current Year sales -->
              <div id="tab-4" class="tab-pane">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <h5>Health Expenditures </h5>

                       </div>
                       <div class="ibox-content">

                           <div class="table-responsive">
                       <table class="table table-striped table-bordered table-hover dataTables-example" >
                       <thead>
                           <tr>
                             <th>No</th>
                             <th>Manufacturer</th>
                             <th>Drug</th>
                             <th>Date of Prescription</th>
                             <th>Prescribing Doctor</th>
                             <th>Dose</th>
                             <th>Quantity</th>
                             <th>Total</th>

                         </tr>
                       </thead>

                       <tbody>
                         <?php $i = 1;

                         foreach($years as $year)
                         {
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$year->Manufacturer}}</td>
                              <td>{{$year->drugname}}</td>
                              <td>{{$year->prescription_date}}</td>
                              <td>{{$year->doc}}</td>
                              <td>{{$year->strength.' '.$year->strength_unit}}</td>
                              <td>{{$year->quantity}}</td>
                              <td>{{$year->total}}</td>
                            </tr>
                           <?php
                           $i++;
                          }
                           ?>
                        </tbody>
                      </table>
                          </div>

                      </div>
                  </div>
              </div>
              </div>
              </div>




              </div>
          </div>

@endsection
