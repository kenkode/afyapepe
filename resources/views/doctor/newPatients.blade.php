
@extends('layouts.doctor')
@section('title', 'patients')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
  @role('Doctor')

@include('doctor/doctor')
  @endrole
  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Users Management</h5>
                        <div class="ibox-tools">
                      @role('Admin')	<a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>@endrole
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">

                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>FirstName</th>
                            <th>Surname</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Mobile No</th>
                            <th>Appointment No</th>
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
           </div>
           </div>
       </div>
       @include('includes.admin_inc.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
