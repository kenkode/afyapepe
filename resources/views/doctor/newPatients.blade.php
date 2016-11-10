
@extends('layouts.doctor')

@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
  @role('Doctor')

@include('doctor/doctor')
  @endrole
              <div class="row">

                <div class="pull-right">
                <!-- <a class="btn btn-success" href="{{ route('doctor.create') }}"> Create Your Profile</a> -->

              </div>
        <div class="col-sm-12 ">
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
                            <th>National ID</th>
                            <th>Mobile No</th>
                            <th>Mobile No</th>
                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>
  <!-- DoctorController@index -->
                    <tbody>
                      <?php $i =1; ?>
                   @foreach($patients as $patient)
                        <tr>
                            <td><a href="{{route('showPatient',$patient->id)}}">{{$i}}</a></td>
                            <td><a href="{{route('showPatient',$patient->id)}}">{{$patient->firstname}}</a></td>
                            <td><a href="{{route('showPatient',$patient->id)}}">{{$patient->secondName}}</a></td>
                            <td><?php $gender=$patient->gender;?>
                              @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                            </td>
                            <td>{{$patient->age}}</td>
                            <td>{{$patient->national_id}}</td>
                            <td>{{$patient->msisdn}}</td>
                            <td>{{$patient->id}}</td>




                        </tr>
                        <?php $i++; ?>

                     @endforeach

                     </tbody>
                   </table>
                 </div>

                </div>
                </div>
              </div><!--row-->


         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
