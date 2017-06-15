@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

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
                   <th>Dosage Prescribed</th>
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
               <td>{{$drug->strength}}{{$drug->strength_unit}}</td>
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
            $su = $query2->strength_unit;
            $final = $count2 - $count1;
             ?>

           <div class="form-group"><label>Drug</label> <input type="text" name="drug" value="{{$results->drugname}}"  class="form-control" readonly></div>
           <div class="form-group"><label>Strength</label> <input type="text" id="strength22" value="{{$final.$su}}"  class="form-control" readonly></div>

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
           <label>Strength</label>
            <select class="form-control" id="testsj" name="strength" >
              <?php $Strengths=DB::table('strength')->distinct()->get(['strength']); ?>
                @foreach($Strengths as $Strengthz)
                  <option value="{{$Strengthz->strength}}">{{ $Strengthz->strength  }}  </option>
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
         <div class="form-group"><label>Dose Given</label> <input type="number" name="dose_given2" id="sus"  class="form-control" oninput="calc2()" readonly></div>
         <div class="form-group"><label>Price</label> <input type="number" name="price1" id="price1" class="form-control" oninput="calculated()"></div>
         <div class="form-group">
         <label for="from">From</label>
         <input class="from"  type="text"  name="from2">
         <label for="to">to</label>
         <input class="to" type="text" name="to2">
         </div>
         <div class="form-group"><label>Total</label> <input type="number" name="total1" id="total1" class="form-control" readonly oninput="calculated()"></div>


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

             function calculated()
                 {
                   var myInput7 = document.getElementById('quantity1').value;
                   var myInput8 = document.getElementById('price1').value;

                   var h_change= document.getElementById('total1');

                    myResult4 =(+myInput7) * (+myInput8) ;
                    h_change.value = myResult4;
                 }


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
