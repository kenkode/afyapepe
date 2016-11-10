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
                                                          <th>No</th>
                                                          <th>FirstName</th>
                                                          <th>Surname</th>
                                                          <th>Age</th>
                                                          <th>Gender</th>
                                                          <th>Drug</th>
                                                          <th>Dosage</th>
                                                          <th>Dosage Given</th>
                                                          <th>Reasons</th>
                                                          <th>Quantity</th>
                                                          <th>Price</th>
                                                          <th>Amount</th>
                                                          <th>Date</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                         <?php $i =1; ?>
                                      @foreach($patients as $patient)
                                           <tr>
                                               <td>{{$i}}</a></td>
                                               <td>{{$patient->firstname}}</td>
                                               <td>{{$patient->secondName}}</td>
                                               <td>{{$patient->age}}</td>
                                               <td><?php $gender=$patient->gender;?>
                                                 @if($gender==1){{"Male"}}@else{{"Female"}}@endif
                                               </td>
                                               <td>{{$patient->drugname}}</td>
                                               <td>{{$patient->dosage}}</td>
                                               <td>{{$patient->dose_given}}</td>
                                               <td>{{$patient->notes}}</td>
                                               <td>{{$patient->quantity}}</td>
                                               <td>{{$patient->price}}</td>
                                               <td><?php $price=$patient->price; $quantity=$patient->quantity; echo $amount=$price*$quantity;?></td>
                                               <td>{{$patient->date}}</td>



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
