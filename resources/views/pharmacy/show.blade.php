@extends('layouts.pharmacy')
@section('content')



<!-- <script type="text/javascript">
       $(document).ready(function() {
           $('.noCheck').click(function() {
               $('td:nth-child(9),th:nth-child(9)').hide();
               $('td:nth-child(10),th:nth-child(10)').hide();
               $('td:nth-child(11),th:nth-child(11)').hide();
               $('td:nth-child(12),th:nth-child(12)').hide();
               $('td:nth-child(13),th:nth-child(13)').hide();
               // if your table has header(th), use this
               //$('td:nth-child(2),th:nth-child(2)').hide();
           });

     $('.yesCheck').click(function() {
                $('td:nth-child(9),th:nth-child(9)').show();
                $('td:nth-child(10),th:nth-child(10)').show();
                $('td:nth-child(11),th:nth-child(11)').show();
                $('td:nth-child(12),th:nth-child(12)').show();
                $('td:nth-child(13),th:nth-child(13)').show();
               // if your table has header(th), use this
               //$('td:nth-child(2),th:nth-child(2)').hide();
           });

       });
   </script> -->



 <div class="wrapper wrapper-content animated fadeInRight">

                    <div class="row">
                      <div class="col-lg-12">
               <div class="ibox float-e-margins">
                   <div class="ibox-title">
                       <h5>Prescription Details</h5>

                   </div>


                         {!! Form::open(array('route' => 'pharmacy.store','method'=>'POST')) !!}


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
                         <th></th>
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
                           <td>
                            <div class="text-center">
                            <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Fill Prescription</a>
                            </div>
                            </td>

                            <div id="modal-form" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Prescription Form</h3>

                               {!! Form::open(array('route' => 'pharmacy.store','method'=>'POST')) !!}

                               <input type="hidden" name="p_id" value="<?php echo $patient->the_id; ?>" />
                               <input type="hidden" name="presc_id" value="<?php echo $patient->presc_id; ?>" />
                                  <div class="form-group"><label>Drug</label> <input type="text" name="drug" value="{{$patient->drugname}}"  class="form-control" readonly></div>
                                  <div class="form-group"><label>Strength</label> <input type="text" value="{{$patient->strength}} {{$patient->strength_unit}}"  class="form-control" readonly></div>
                                  <div class="radio radio-danger">
                                       <input type="radio" name="availability" value="Yes" id="yeah"  >
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
                                                  $(".Box").hide('slow');
                                              }
                                              if($(this).attr("value")=="Yes"){
                                                  $(".Box").show('slow');

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
                                  </div>
                                  <div>
                                      <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Submit</strong></button>

                                  </div>
                              {{ Form::close() }}
                                </div>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>

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
                    <th></th>
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
