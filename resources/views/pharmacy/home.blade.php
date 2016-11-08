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
                                                          <th>Phone</th>
                                                          <th>Prescribing Doctor</th>
                                                          <th>Date</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                          <td><a href="{{route('pharmacy.show',$patient->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('pharmacy.show',$patient->id)}}">{{$patient->firstname}}</a></td>
                                                          <td><a href="{{route('pharmacy.show',$patient->id)}}">{{$patient->secondName}}</a></td>

                                                          <td>{{$patient->age}}</td>
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif
                                                          </td>
                                                          <td>{{$patient->msisdn}}</td>
                                                          <td>{{$patient->consulting_physician}}</td>
                                                          <td>{{$patient->consulting_physician}}</td>



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
