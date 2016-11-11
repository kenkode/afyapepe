
@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-sm-12 ">
                                      <h1>New Patients</h1>

                                          <div class="panel-box">

                                                        <div class="table-responsive">
                                               <table class="table table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th><i class="fa fa-list fa-2x"></i> No</th>
                                                          <th><i class="fa fa-user fa-2x"></i> Name</th>
                                                          <th><i class="fa fa-genderless fa-2x"></i> Gender</th>
                                                          <th><i class="fa fa-font fa-2x"></i> Age</th>

                                                          <th><i class="fa fa-calendar fa-2x"></i> Date</th>
                                                    </tr>
                                                  </thead>


                                                  <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                          <td><a href="{{route('nurse.show',$patient->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('nurse.show',$patient->id)}}">{{$patient->firstname}} {{$patient->secondName}}</a></td>
                                                          
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                                                          </td>
                                                          <td>{{$patient->age}}</td>

                                                          <td>{{$patient->dateCreated}}</td>



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
