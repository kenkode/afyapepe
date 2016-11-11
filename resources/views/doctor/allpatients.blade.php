
@extends('layouts.doctor')

@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
  @role('Doctor')

@include('doctor/doctor')
  @endrole
    <div class="row">


        <div class="col-sm-12 ">
            <div class="panel-box">
              <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>FirstName</th>
                            <th>Surname</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Mobile No</th>
                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                      <?php $i =1; ?>
                   @foreach($allpatients as $apatient)
                        <tr>

                            <td><a href="{{route('showPatient',$apatient->id)}}">{{$i}}</a></td>
                            <td><a href="{{route('showPatient',$apatient->id)}}">{{$apatient->firstname}}</a></td>
                            <td><a href="{{route('showPatient',$apatient->id)}}">{{$apatient->secondName}}</a></td>
                            <td><?php $gender=$apatient->gender;?>
                              @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                            </td>
                            <td>{{$apatient->age}}</td>
                            <td>{{$apatient->age}}</td>
                            <td>{{$apatient->msisdn}}</td>




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
