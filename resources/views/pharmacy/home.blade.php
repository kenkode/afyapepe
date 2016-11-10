@extends('layouts.pharmacy')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-lg-12">


                                          <div class="panel-box">

                                                        <div class="table-responsive">
                                               <table class="table table-striped table-advance table-hover">
                                                  <thead>
                                                      <tr>
                                                          <th><i class="fa fa-list fa-2x"></i> No</th>
                                                          <th><i class="fa fa-user  fa-2x"></i> Full Name</th>
                                                          

                                                          <th><i class="fa fa-font  fa-2x"></i> Age</th>
                                                          <th><i class="fa fa-genderless  fa-2x"></i> Gender</th>
                                                          <th><i class="fa fa-mobile fa-2x"></i> Phone</th>
                                                          <th><i class="fa fa-user-md fa-2x"></i> Prescribing Doctor</th>
                                                          <th><i class="fa fa-calendar fa-2x"></i> Date</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                          <td><a href="{{route('pharmacy.show',$patient->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('pharmacy.show',$patient->id)}}">{{$patient->firstname}} {{$patient->secondName}}</a></td>
                                                          

                                                          <td>{{$patient->age}}</td>
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif
                                                          </td>
                                                          <td>{{$patient->msisdn}}</td>
                                                          <td>{{$patient->name}}</td>
                                                          <td>{{$patient->updated_at}}</td>



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
