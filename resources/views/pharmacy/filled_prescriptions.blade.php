@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')


               <!-- Begin Sales Summary -->

               <div class="tabs-container">
                 <!-- <div class="col-lg-12 tbg"> -->
                   <ul class="nav nav-tabs">
                       <li class="active"><a data-toggle="tab" href="#tab-1">Today</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-2">This Week</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-3">This Month</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-4">This Year</a></li>
                       <li class=""><a data-toggle="tab" href="#tab-5">All</a></li>
                   </ul>
                   <br>
             <div class="tab-content">
               <!-- Today's Sale -->
                         <div id="tab-1" class="tab-pane active">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">
                       <div class="ibox-title">
                           <h5>Sales Summary </h5>

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
                         $date = strtotime($today->prescription_date);
                         $date  = date('Y-m-d',$date);
                       ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$today->Manufacturer}}</td>
                            <?php
                            if($today->available == 'Yes')
                            {

                             ?>
                            <td>{{$today->drugname}}</td>
                            <?php
                            }
                            elseif($today->available == 'No')
                            {

                              ?>
                              <td>{{$today->inv_drug}}</td>
                            <?php
                            }
                             ?>
                            <td>{{$date}}</td>
                            <td>{{$today->doc}}</td>
                            <td>{{$today->dose_given.' '.$today->strength_unit}}</td>
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
                     <div class="ibox-title">
                         <h5>Sales Summary</h5>
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

                         foreach($weeks as $week)
                         {
                           $date = strtotime($week->prescription_date);
                           $date = date('Y-m-d',$date);
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$week->Manufacturer}}</td>
                              <?php
                              if($week->available == 'Yes')
                              {

                               ?>
                              <td>{{$week->drugname}}</td>
                              <?php
                              }
                              elseif($week->available == 'No')
                              {

                                ?>
                                <td>{{$week->inv_drug}}</td>
                              <?php
                              }
                               ?>
                              <td>{{$date}}</td>
                              <td>{{$week->doc}}</td>
                              <td>{{$week->dose_given.' '.$week->strength_unit}}</td>
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
                           <h5>Sales Summary</h5>
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
                           $date = strtotime($month->prescription_date);
                           $date = date('Y-m-d',$date);
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$month->Manufacturer}}</td>
                              <?php
                              if($month->available == 'Yes')
                              {

                               ?>
                              <td>{{$month->drugname}}</td>
                              <?php
                              }
                              elseif($month->available == 'No')
                              {

                                ?>
                                <td>{{$month->inv_drug}}</td>
                              <?php
                              }
                               ?>
                              <td>{{$date}}</td>
                              <td>{{$month->doc}}</td>
                              <td>{{$month->dose_given.' '.$month->strength_unit}}</td>
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
                           <h5>Sales Summary</h5>

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
                           $date = strtotime($year->prescription_date);
                           $date = date('Y-m-d',$date);
                         ?>
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$year->Manufacturer}}</td>
                              <?php
                              if($year->available == 'Yes')
                              {

                               ?>
                              <td>{{$year->drugname}}</td>
                              <?php
                              }
                              elseif($year->available == 'No')
                              {

                                ?>
                                <td>{{$year->inv_drug}}</td>
                              <?php
                              }
                               ?>
                              <td>{{$date}}</td>
                              <td>{{$year->doc}}</td>
                              <td>{{$year->dose_given.' '.$year->strength_unit}}</td>
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

              <!-- All Sales -->
              <div id="tab-5" class="tab-pane">
               <div class="row">
                   <div class="col-lg-11">
                   <div class="ibox float-e-margins">
                     <div class="ibox-title">
                         <h5>Sales Summary</h5>
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

                           $dose = $presc->dose_given.' '.$presc->strength_unit;

                           $quantity = $presc->quantity;
                           $price = $presc->price;
                           $totals = $presc->total;

                       ?>
                           <tr>
                               <td>{{$i}}</td>
                               <td>{{$manufacturer}}</td>
                               <?php
                               if($presc->available == 'Yes')
                               {

                                ?>
                               <td>{{$presc->drugname}}</td>
                               <?php
                               }
                               elseif($presc->available == 'No')
                               {

                                 ?>
                                 <td>{{$presc->inv_drug}}</td>
                               <?php
                               }
                                ?>
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
