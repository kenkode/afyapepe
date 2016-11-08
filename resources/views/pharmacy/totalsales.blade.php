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
                                                     <table class="table table-small-font table-bordered table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>FirstName</th>
                                                          <th>Surname</th>
                                                          <th>Age</th>
                                                          <th>Gender</th>
                                                          <th>Drug</th>
                                                          <th>Dosage</th>
                                                          <th>Quantity</th>
                                                          <th>Price</th>
                                                          <th>Amount</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                         <?php $i =1; ?>
                                      @foreach($patients as $patient)
                                           <tr>
                                               <td>{{$i}}</a></td>
                                               <td>{{$patient->firstname}}</td>
                                               <td>{{$patient->lastname}}</td>
                                               <td>{{$patient->age}}</td>
                                               <td><?php $gender=$patient->gender;?>
                                                 @if($gender==1){{"Male"}}@else{{"Female"}}@endif
                                               </td>
                                               <td>{{$patient->drugname}}</td>
                                               <td>{{$patient->dosage}}</td>
                                               <td>{{$patient->quantity}}</td>
                                               <td>{{$patient->price}}</td>
                                               <td>{{$patient->amount}}</td>



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
