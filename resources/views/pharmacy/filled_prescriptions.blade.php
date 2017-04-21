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
                          <th>Date of Prescription</th>
                          <th>Drug given</th>
                          <th>Dose</th>
                          <th>Quantity</th>
                          <th>Price</th>
                          <th>Total</th>

                    </tr>
                  </thead>

                          <tbody>
                            <?php $i =1;

                            foreach($prescs as $presc)
                            {

                              $presc_date = $presc->date_filled;
                              $my_date = strtotime($presc_date);
                              $presc_date = date("Y-m-d",$my_date);

                              $dose = $presc->strength.' '.$presc->strength_unit;
                              $drug = $presc->drugname;
                              $quantity = $presc->quantity;
                              $price = $presc->price;
                              $total = $quantity * $price;

                          ?>
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$presc_date}}</td>
                                  <td>{{$drug}}</td>
                                  <td>{{$dose}}</td>
                                  <td>{{$quantity}}</td>
                                  <td>{{$price}}</td>
                                  <td>{{$total}}</td>

                              </tr>
                              <?php $i++;
                              }
                               ?>

                           </tbody>
                           <tr>
                               <th>No</th>
                               <th>Date of Prescription</th>
                               <th>Drug given</th>
                               <th>Dose</th>
                               <th>Quantity</th>
                               <th>Price</th>
                               <th>Total</th>

                         </tr>

                         </table>
                      </div>

                           </div>
                       </div>
                   </div>
                   </div>

               </div>

@endsection
