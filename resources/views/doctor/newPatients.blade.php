
@extends('layouts.doctor')

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
                        <h5>Patients List</h5>
                        <div class="ibox-tools">
                          @role('Doctor')
                           <a class="collapse-link">
                            {{$Name}}
                          </a>  @endrole
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
                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                      <?php $i =1; ?>
                   @foreach($patients as $apatient)
                        <tr>

                            <td><a href="{{route('showPatient',$apatient->appid)}}">{{$i}}</a></td>
                            <td><a href="{{route('showPatient',$apatient->appid)}}">{{$apatient->firstname}}</a></td>
                            <td><a href="{{route('showPatient',$apatient->appid)}}">{{$apatient->secondName}}</a></td>
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
           </div>
           </div>
       </div>
       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
