
@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">

<?php
use Carbon\Carbon;
$current = Carbon::now();


 ?>

                    <div class="row">
                                      <div class="col-sm-12 ">
                                       <h1>Waiting Patients</h1>

                                          <div class="panel-box">

                                                        <div class="table-responsive">
                                                     <table class="table table-small-font table-bordered table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>FirstName</th>
                                                          <th>Surname</th>
                                                          <th>Gender</th>
                                                          <th>Age</th>
                                                          <th>Time waited to see the Doctor</th>

                                                    </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                          <td>{{$i}}</td>
                                                          <td>{{$patient->firstname}}</a></td>
                                                          <td>{{$patient->secondName}}</a></td>
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                                                          </td>
                                                          <td>{{$patient->age}}</td>

                                                          <td><?php $startTime = Carbon::parse($patient->dateCreated);
                                                             $finishTime = Carbon::parse($current);

                                                             $totalDuration = $finishTime->diffForHumans($startTime,true);

                                                               ?>
                                                              	{{$totalDuration}}
                                                              </td>



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
