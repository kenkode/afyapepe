@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

          <?php

          $user_id = Auth::user()->id;

          $data = DB::table('pharmacists')
                    ->where('user_id', $user_id)
                    ->first();

          $facility = $data->premiseid;
           ?>

          <!-- Display patient allergies if any -->
          <?php
          if(empty($allergies))
          {
           ?>
           <div class="ibox-title">
           <h5>Allergies : NONE</h5>
            </div>
            <?php
          }
          else
          {
             ?>

             <div class="ibox-title">
             <h5>Patient Allergies.</h5>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>

                  <tr>
                      <th>No</th>
                      <th>Allergy Type</th>
                      <th>Allergy Name</th>
                      <th>Date of Diagnosis</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($allergies as $allergy)
                    {
                      ?>
                  <tr class="gradeX">
                  <td>{{$i}}</td>
                  <td>{{$allergy->name}}</td>
                  <td>{{$allergy->a_name}} </td>
                  <td>
                    <?php
                    echo date("Y-m-d",strtotime($allergy->created_at));
                     ?>
                  </td>

                  </tr>
                  <?php
                  $i++;
                   }
                 ?>
                </tbody>
               <tfoot>
                 <!-- <tr>
                   <th>Illness</th>
                   <th>Date Diagnosed</th>
                 </tr> -->
                 </tfoot>
                 </table>
                     </div>
                 <?php
                 }
                  ?>

          <!-- Display chronic diseases if any -->
          <?php
          if(empty($diseases))
          {
           ?>
           <div class="ibox-title">
           <h5>Chronic Illnesses : NONE</h5>
            </div>
            <?php
          }
          else
          {
             ?>

             <div class="ibox-title">
             <h5>Chronic Illnesses.</h5>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>

                  <tr>
                      <th>No</th>
                      <th>Illness</th>
                      <th>Date Diagnosed</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($diseases as $disease)
                    {
                      ?>
                  <tr class="gradeX">
                  <td>{{$i}}</td>
                  <td>{{$disease->disease}}</td>
                  <td>{{$disease->date_diagnosed}} </td>

                  </tr>
                  <?php
                  $i++;
                   }
                 ?>
                </tbody>
               <tfoot>
                 <!-- <tr>
                   <th>Illness</th>
                   <th>Date Diagnosed</th>
                 </tr> -->
                 </tfoot>
                 </table>
                     </div>
                 <?php
                 }
                  ?>

          <!-- Show medication patient is taking currently-->
          <?php
          if(empty($drugs))
          {
           ?>
           <div class="ibox-title">
           <h5>Current Medication : NONE</h5>
            </div>
            <?php
          }
          else
          {
             ?>

             <div class="ibox-title">
             <h5>Current Medication.</h5>
              </div>

           <div class="table-responsive">
             <table class="table table-striped table-bordered table-hover dataTables-example" >
             <thead>

               <tr>
                   <th>No</th>
                   <th>Drug</th>
                   <!-- <th>Dosage Prescribed</th> -->
                   <th>Dosage Given</th>
                   <th>Route</th>
                   <th>Frequency</th>
               </tr>
               </thead>
               <tbody>
                 <?php
                 $i = 1;
                 foreach ($drugs as $drug)
                 {
                   ?>
               <tr class="gradeX">
               <td>{{$i}}</td>
               <td>{{$drug->drugname}}</td>
               <!-- <td>{{$drug->strength}}{{$drug->strength_unit}}</td> -->
               <td>{{$drug->dose_given}}{{$drug->strength_unit}}</td>
               <td>{{$drug->route_name}} </td>
               <td>{{$drug->freq_name}} </td>

               </tr>
               <?php
               $i++;
                }
              ?>
             </tbody>
            <tfoot>
              <!-- <tr>
                <th>Drug</th>
                <th>Dosage Prescribed</th>
                <th>Dosage Given</th>
                <th>Route</th>
                <th>Frequency</th>
              </tr> -->
              </tfoot>
              </table>
                  </div>
              <?php
              }
               ?>

            <div class="col-lg-9">
              <div class="ibox-content">

              {!! Form::open(array('route' => 'pharmacy.store','method'=>'POST','class'=>'form-horizontal')) !!}

            <input type="hidden" name="p_id" value="<?php echo $results->the_id; ?>" />
            <input type="hidden" name="presc_id" value="<?php echo $results->presc_id; ?>" />
            <?php
            $query1 = DB::table('prescription_filled_status')
                    ->select(DB::raw('SUM(dose_given) AS total_given'))
                    ->where('presc_details_id','=',$results->presc_id)
                    ->first();
            $count1 = $query1->total_given;

            $query2 = DB::table('prescription_details')
                    ->where('id', '=', $results->presc_id)
                    ->first();
            $count2 = $query2->strength;
            $final = $count2 - $count1;
             ?>

           <div class="form-group"><label>Drug</label> <input type="text" name="drug" value="{{$results->drugname}}"  class="form-control" readonly></div>
           <div class="form-group"><label>Strength</label> <input type="text" id="strength22" value="{{$final}}"  class="form-control" readonly></div>
           <div class="form-group">
               <label>Is the drug prescribed issued as written?</label>

           <div class="radio radio-info radio-inline">
          <input type="radio" name="availability" value="Yes" id="yeah" >
          <label for="radio3">
              Yes
          </label>
                </div>
          <div class="radio radio-info radio-inline">
              <input type="radio" name="availability" value="No" id="nah" >
              <label for="radio4">
                  No
              </label>
          </div>
          </div>

              <script type="text/javascript">
                     $('input[type="radio"]').attr('checked', 'checked').on( "change", function(){
                         if($(this).attr("value")=="No")
                         {
                             $(".Box1").show('slow');
                             $(".Box").hide('slow');
                         }

                         if($(this).attr("value")=="Yes")
                         {
                             $(".Box").show('slow');
                             $(".Box1").hide('slow');
                         }
                     });
                  $('input[type="radio"]').trigger('click');

               </script>

               <div class="Box" style="display:none">


               <div class="form-group"><label>Weight</label> <input type="number" id="weight1" name="weight1"  class="form-control" oninput="calc1()"></div>

               <div class="form-group"><label>Quantity</label> <input type="number" name="quantity" id="quantity" class="form-control" oninput="calc1()"></div>

               <div class="form-group"><label>Dose Given</label> <input type="number" id="sub2" name="dose_given1"  class="form-control" readonly></div>

               <div class="form-group" id="subs" style="display:none">
                 <label>Reason</label>
                  <select class="form-control" name="reason22" >
                    <option value="" selected disabled>Select reason</option>
                   <?php $reasons = DB::table('substitution_reason')->distinct()->get(['reason','id']); ?>
                   @foreach($reasons as $reason)
                          <option value='{{$reason->id}}'>{{$reason->reason}}</option>
                   @endforeach
                 </select>
               </div>


               <?php
               $prices = DB::table('inventory')
                        ->select('recommended_retail_price')
                        ->where('drug_id', '=', $results->drug_id)
                        ->orderBy('updated_at', 'desc')
                        ->first();
                $recommended_price = $prices->recommended_retail_price;
                ?>

               <div class="form-group"><label>Recommended Price</label> <input type="number" name="rec_price" value="{{$recommended_price}}"  class="form-control" disabled></div>

               <div class="form-group"><label>Price</label> <input type="number" name="price" id="price" class="form-control" ></div>

               <div class="form-group">
                 <label>Payment options</label>
                  <select class="form-control" name="payment_options1" id="pay_option1" >
                    <option value="" selected disabled>Select payment option</option>
                   <?php $options = DB::table('payment_options')->distinct()
                                ->join('pharmacy_payment', 'pharmacy_payment.option_id', '=', 'payment_options.id')
                                ->where('pharmacy_payment.pharmacy_id', '=', $facility)
                                ->get(['payment_options.name','pharmacy_payment.markup']); ?>
                   @foreach($options as $option)
                          <option value='{{$option->markup}}'>{{$option->name}}</option>
                   @endforeach
                 </select>

               </div>

               <div class="form-group"><label>Total</label> <input type="number" name="total" id="total" class="form-control" readonly oninput="calculate()"></div>

               <div class="form-group">
               <label for="from">From</label>
               <input class="from"  type="text" id="date1"  name="from1">
               <label for="to">to</label>
               <input class="to" type="text" id="date2" name="to1">
               </div>


               </div>

               <div class="Box1" style="display:none">
                 <p>  </p>
                 <div class="form-group">
                   <label>Reason</label>
                    <select class="form-control" name="reason" >
                     <?php $reasons = DB::table('substitution_reason')->distinct()->get(['reason','id']); ?>
                     @foreach($reasons as $reason)
                            <option value='{{$reason->id}}'>{{$reason->reason}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="form-group">
                     <label >Prescription:</label>
                     <select id="presc1" name="prescription" class="form-control presc1" style="width:50%"></select>
                 </div>

                 <p></p>
                 <p></p>
                 <p></p>
                 <p></p>

       <div class="form-group">
           <label>Dosage Form</label>
            <select class="form-control" name="dosageform" id="example-getting-started" >
             <?php $druglists=DB::table('druglists')->distinct()->get(['DosageForm']); ?>
             @foreach($druglists as $druglist)
                    <option value='{{$druglist->DosageForm}}'>{{$druglist->DosageForm}}</option>
             @endforeach
           </select>
         </div>


           <div class="form-group">
           <label>Strength Unit</label>

           <div class="radio radio-info radio-inline">
               <input type="radio" id="inlineRadio1" value="ml" name="strength_unit" >
               <label for="inlineRadio1"> Ml</label>
           </div>
           <div class="radio radio-inline">
               <input type="radio" id="inlineRadio2" value="mg" name="strength_unit">
               <label for="inlineRadio2"> Mg </label>
           </div>
           </div>

          <div class="form-group">
           <label>Route</label>
            <select class="form-control" name="routes" >
              <?php $routems=DB::table('route')->distinct()->get(['name','id','abbreviation']); ?>
                @foreach($routems as $routemz)
                  <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
               @endforeach
            </select>
         </div>

           <div class="form-group">
           <label>Frequency</label></td>
            <select class="form-control"  name="frequency" >
              <?php $frequent=DB::table('frequency')->distinct()->get(['name','id','abbreviation']); ?>
                @foreach($frequent as $freq)
                  <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
               @endforeach
            </select>
         </div>


         <div class="form-group"><label>Weight</label> <input type="number" id="weight2" name="weight2"  class="form-control" oninput="calc2()"></div>

         <div class="form-group"><label>Quantity</label> <input type="number" name="quantity1" id="quantity1" class="form-control" oninput="calc2();calculated();"></div>

         <div class="form-group"><label>Dose Given / Strength</label> <input type="number" name="dose_given2" id="sus"  class="form-control" oninput="calc2()" readonly></div>

         <div class="form-group"><label>Price</label> <input type="number" name="price1" id="price1" class="form-control" oninput="calculated()"></div>

         <div class="form-group">
           <label>Payment options</label>
            <select class="form-control" name="payment_options" id="pay_option" >
              <option value="" selected disabled>Select payment option</option>
             <?php $options = DB::table('payment_options')->distinct()
                          ->join('pharmacy_payment', 'pharmacy_payment.option_id', '=', 'payment_options.id')
                          ->where('pharmacy_payment.pharmacy_id', '=', $facility)
                          ->get(['payment_options.name','pharmacy_payment.markup']); ?>
             @foreach($options as $option)
                    <option value='{{$option->markup}}'>{{$option->name}}</option>
             @endforeach
           </select>
         </div>

         <div class="form-group"><label>Total</label> <input type="number" name="total1" id="total1" class="form-control" readonly oninput="calculated()"></div>


         <div class="form-group">
         <label for="from">From</label>
         <input class="from"  type="text" id="date3" name="from2">
         <label for="to">to</label>
         <input class="to" type="text" id="date4" name="to2">
         </div>


         </div>

         <script type="text/javascript">
         function calc1()
             {
           var myInput8 = document.getElementById('quantity').value;
           var myInput7 = document.getElementById('weight1').value;

           var h_change= document.getElementById('sub2');

            myResult4 =(+myInput7) * (+myInput8) ;
            h_change.value = myResult4;
             }

         function calc2()
             {
             var myInput8 = document.getElementById('quantity1').value;
             var myInput7 = document.getElementById('weight2').value;

             var h_change= document.getElementById('sus');

              myResult4 =(+myInput7) * (+myInput8) ;
              h_change.value = myResult4;
             }

         function calculate()
             {
               var myInput7 = document.getElementById('quantity').value;
               var myInput8 = document.getElementById('price').value;

               var h_change= document.getElementById('total');

                myResult4 =(+myInput7) * (+myInput8) ;
                h_change.value = myResult4;
             }

            //  function calculated()
            //      {
            //        var myInput7 = document.getElementById('quantity1').value;
            //        var myInput8 = document.getElementById('price1').value;
             //
            //        var h_change= document.getElementById('total1');
             //
            //         myResult4 =(+myInput7) * (+myInput8) ;
            //         h_change.value = myResult4;
            //      }


         </script>

         <!-- function for getting total during normal filling of prescription -->
         <script>
         $('#price, #pay_option1, #quantity').change(function(){
          var price = parseFloat($('#price').val()) || 0;
          var pay = parseFloat($('#pay_option1').val()) || 0;
          var quantity = parseFloat($('#quantity').val()) || 0;

         $('#total').val(Math.round(quantity*price*pay));
          });
         </script>

         <!-- function for getting total during substitution -->
         <script>
         $('#price1, #pay_option, #quantity1').change(function(){
          var price = parseFloat($('#price1').val()) || 0;
          var pay = parseFloat($('#pay_option').val()) || 0;
          var quantity = parseFloat($('#quantity1').val()) || 0;

         $('#total1').val(Math.round(quantity*price*pay));
          });
         </script>

         <!-- function for making prescription start and end date required -->
         <script>
         $('#yeah').change(function ()
         {
           if($(this).is(':checked'))
           {
             $('#date1').attr('required');
             $('#date2').attr('required');
           }
           else
           {
             $('#date1').removeAttr('required');
             $('#date2').removeAttr('required');
           }
         });
         </script>

         <script>
         $('#nah').change(function()
         {
           if($(this).is(':checked'))
           {
             $('#date3').attr('required');
             $('#date4').attr('required');
           }
           else
           {
             $('#date3').removeAttr('required');
             $('#date4').removeAttr('required');
           }
         });
         </script>


         <p> </p>
         <p> </p>
         <p> </p>
         <div class="form-group">
           <div >
           <button class="btn btn-w-m btn-primary" type="submit">Submit</button>
           </div>
         </div>

           {{ Form::close() }}

                   </div>
                 </div>
                   </div>
         <a href="{{route('pharmacy.show',$results->the_id)}}"><button type="button" class="btn btn-w-m btn-primary">Back</button></a>


               </div>

@endsection
