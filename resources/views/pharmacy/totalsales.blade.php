@extends('layouts.pharmacy')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-sm-12 ">


                                          <div class="panel-box">

                                                      <div class="table-responsive">
                                               <table class="table table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th><i class="fa fa-list fa-2x"></i> No</th>
                                                          <th><i class="fa fa-user fa-2x"></i> Name</th>
                                                           <th><i class="fa fa-medkit fa-2x"></i> Drug</th>
                                                          <th><i class="fa fa-spoon fa-2x"></i> Dosage</th>
                                                           <th><i class="fa fa-cart-plus fa-2x"></i> Quantity</th>
                                                          <th><i class="fa fa-cc fa-2x"></i> Price</th>
                                                          <th><i class="fa fa-shopping-cart fa-2x"></i> Amount</th>
                                                          <th><i class="fa fa-calendar fa-2x"></i> Date</th>
                                                          <th><i class="fa fa-gear fa-2x"></i> Action</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                         <?php $i =1; ?>
                                      @foreach($patients as $patient)
                                           <tr>
                                               <td>{{$i}}</a></td>
                                               <td>{{$patient->firstname}} {{$patient->secondName}}</td>
                                               
                                               <td>{{$patient->drugname}}</td>
                                               <td>{{$patient->dosage}}</td>
                                               
                                               <td>{{$patient->quantity}}</td>
                                               <td>{{$patient->price}}</td>
                                               <td><?php $price=$patient->price; $quantity=$patient->quantity; echo $amount=$price*$quantity;?></td>
                                               <td>{{$patient->date}}</td>
                                               <td><a class="btn btn-success" href="#"><i class="fa fa-file-pdf-o"></i></a> <a class="btn btn-info" href="#"><i class="fa fa-file"></i></a></td>



                                           </tr>
                                           <?php $i++; ?>

                                        @endforeach



                                                   </tbody>
                                                 </table>
                                               </div>


         </div>

          </div><!--content-->
      </div><!--content page-->

@endsection
