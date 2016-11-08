@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-sm-12 ">
                                       <h1>Total Patients</h1>
                                       
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
                                                          
                                                          <th>Date</th>
                                                    </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                          <td><a href="{{route('nurse.show',$patient->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('nurse.show',$patient->id)}}">{{$patient->firstname}}</a></td>
                                                          <td><a href="{{route('nurse.show',$patient->id)}}">{{$patient->lastname}}</a></td>
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                                                          </td>
                                                          <td>{{$patient->age}}</td>
                                                          
                                                          <td>{{$patient->created_at}}</td>



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
