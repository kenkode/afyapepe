
@extends('layouts.doctor')
@section('title', 'patients')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">


  <?php
  $doc = (new \App\Http\Controllers\DoctorController);
  $Docdatas = $doc->DocDetails();
  foreach($Docdatas as $Docdata){
  $Did = $Docdata->doc_id;
  $Name = $Docdata->name;
}

  if ( empty ($Name ) ) {
  // return view('doctor.create');

  return redirect('doctor.create');
  }
  ?>


  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Patient List</h5>
                        <div class="ibox-tools">

                            @role('Doctor')  <a class="collapse-link">
                              {{$Name}}
                            </a>  @endrole
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>

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
                            <td><a href="{{route('showPatient',$patient->appid)}}">{{$i}}</a></td>
                            <td><a href="{{route('showPatient',$patient->appid}}">{{$patient->firstname}}</a></td>
                            <td clall="inline"><a href="{{route('showPatient',$patient->appid)}}">{{$patient->secondName}}</a>  </td>
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
       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
