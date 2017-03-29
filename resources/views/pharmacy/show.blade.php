@extends('layouts.pharmacy')
@section('content')

<script type="text/javascript">

function calculate()
    {
   	var myInput7 = document.getElementById('quantity').value;
        var myInput8 = document.getElementById('price').value;

        var h_change= document.getElementById('total');

         myResult4 =(+myInput7) * (+myInput8) ;
         h_change.value = myResult4;
    }
</script>



 <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="row">
                      <div class="col-lg-12">
               <div class="ibox float-e-margins">
                   <div class="ibox-title">
                       <h5>Prescription Details</h5>

                   </div>


                         {!! Form::open(array('route' => 'pharmacy.store')) !!}

                         <div class="ibox-content">

                         <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover dataTables-example" >
                     <thead>
                     <tr>
                         <th>Name</th>
                         <th>Drug</th>
                         <th>Dosage Form</th>
                         <th>Strength</th>
                         <th>Strength Unit</th>
                         <th>Route</th>
                         <th>Frequency</th>
                         <th>Dose Given</th>
                         <th>Reason</th>
                         <th>Quantity</th>
                         <th>Price</th>
                         <th>Total</th>
                     </tr>
                     </thead>
                     <tbody>
                       <?php
                       foreach ($patients as $patient)
                       {
                         ?>
                     <tr class="gradeX">
                         <td>{{$patient->firstname.' '.$patient->secondName}}</td>
                         <td>{{$patient->drugname}}</td>
                         <td>{{$patient->doseform}}</td>
                         <td>{{$patient->strength}}</td>
                         <td>{{$patient->strength_unit}}</td>
                         <td>{{$patient->name}}</td>
                         <td>{{$patient->frequency}}</td>
                         <td><input type="number" placeholder="dose given" name="dose_given" class="form-control" required=""></td>
                         <td><textarea></textarea></td>
                         <td><input type="number" placeholder="quantity" id="quantity" name="quantity" class="form-control" oninput="calculate()" required=""></td>
                         <td><input type="number" placeholder="price" id="price" name="price" class="form-control" oninput="calculate()" required=""></td>
                         <td><input type="number" placeholder="Total" id="total" name="total" class="form-control" oninput="calculate()" required=""></td>

                     </tr>
                     <?php
                   }
                    ?>
                   </tbody>
                  <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Drug</th>
                    <th>Dosage Form</th>
                    <th>Strength</th>
                    <th>Strength Unit</th>
                    <th>Route</th>
                    <th>Frequency</th>
                    <th>Dose Given</th>
                    <th>Reason</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                  </tr>
                  </tfoot>
                  </table>
                      </div>

                  </div>

                 </div>
                 </div>

          </div><!--content-->
      </div><!--content page-->


@endsection
