@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')

        <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-9">
              <div class="ibox-content">

              {!! Form::open(array('route' => 'pharmacy.store','method'=>'POST','class'=>'form-horizontal')) !!}

            <!-- <div class="form-group">
                <label >Prescription::</label>
               <select class="presc1 form-control" style="width:500px;" name="itemName"></select>
            </div> -->

            <input type="hidden" name="p_id" value="<?php echo $results->the_id; ?>" />
            <input type="hidden" name="presc_id" value="<?php echo $results->presc_id; ?>" />

           <div class="form-group"><label>Drug</label> <input type="text" name="drug" value="{{$results->drugname}}"  class="form-control" readonly></div>
           <div class="form-group"><label>Strength</label> <input type="text" value="{{$results->strength}} {{$results->strength_unit}}"  class="form-control" readonly></div>
           <div class="form-group">
               <label>Is drug available?</label>
           </div>
           <div class="radio radio-danger">
          <input type="radio" checked="" name="availability" value="Yes" id="yeah">
          <label for="radio3">
              Yes
                    </label>
                </div>
          <div class="radio radio-danger">
              <input type="radio" name="availability" value="No" id="nah">
              <label for="radio4">
                  No
              </label>
          </div>

              <script type="text/javascript">
                     $('input[type="radio"]').click(function(){
                         if($(this).attr("value")=="No"){
                             $(".Box1").show('slow');
                             $(".Box").hide('slow');
                         }
                         if($(this).attr("value")=="Yes"){
                             $(".Box").show('slow');
                             $(".Box1").hide('slow');

                         }
                     });
                  $('input[type="radio"]').trigger('click');
               </script>

               <div class="Box" style="display:none">
               <div class="form-group"><label>Dose Given</label> <input type="number" name="dose_given"  class="form-control"></div>
               <div class="form-group"><label>Reason</label> <textarea class="form-control" name="reason"></textarea></div>
               <div class="form-group"><label>Quantity</label> <input type="number" name="quantity" id="quantity" class="form-control" oninput="calculate()"></div>
               <div class="form-group"><label>Price</label> <input type="number" name="price" id="price" class="form-control" oninput="calculate()"></div>
               <div class="form-group"><label>Total</label> <input type="number" name="total" id="total" class="form-control" readonly oninput="calculate()"></div>
               </div>

               <div class="Box1" style="display:none">

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

         <div class="form-group"><label>Dose Given</label> <input type="number" name="dose_given"  class="form-control"></div>
         <!-- <div class="form-group"><label>Reason</label> <textarea class="form-control" name="reason"></textarea></div> -->
         <div class="form-group"><label>Quantity</label> <input type="number" name="quantity1" id="quantity1" class="form-control" oninput="calculated()"></div>
         <div class="form-group"><label>Price</label> <input type="number" name="price1" id="price1" class="form-control" oninput="calculated()"></div>
         <div class="form-group"><label>Total</label> <input type="number" name="total1" id="total1" class="form-control" readonly oninput="calculated()"></div>


         </div>

         <script type="text/javascript">
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
         <div class="form-group">
           <div class="col-lg-offset-2 col-lg-10">
               <button class="btn btn-sm btn-primary" type="submit">Submit</button>
           </div>
         </div>

           {{ Form::close() }}

                   </div>
                 </div>
                   </div>

               </div>

@endsection
