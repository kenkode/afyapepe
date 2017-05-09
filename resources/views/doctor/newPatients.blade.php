@extends('layouts.doctor')
  @section('content')
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
                    <table class="table table-striped table-bordered table-hover dataTables-main" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Appointment</th>
                            <th>Chief Complain</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Temperature</th>
                            <th>Systolic BP</th>
                            <th>Diastolic BP</th>
                            <!-- <th>Constituency</th> -->

                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                      <?php $i =1; ?>
                   @foreach($patients as $apatient)
                        <tr>

                            <td><a href="{{route('showPatient',$apatient->appid)}}">{{$i}}</a></td>
                            <td><a href="{{route('showPatient',$apatient->appid)}}">
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->firstname ;  echo $apatient->secondName;}
                              else {echo $apatient->Infname; echo $apatient->InfName;}
                             ?></a></td>

                             <td> <?php if ($apatient->appointment_made=='Y'){ ?>
                               Yes
                             <?php }else{ ?>
                               No
                             <?php } ?>


                            </td>
                            <td><a href="{{route('showPatient',$apatient->appid)}}">
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->chief_compliant;}
                              else {echo $apatient->Infcompliant;}
                             ?>
                              {{$apatient->chief_compliant}}</a></td>
                            <td><?php
                             if ($apatient->persontreated=='Self') { $gender=$apatient->gender;}
                            else {$gender=$apatient->Infgender;}?>
                              @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                            </td>
                            <td><?php
                            if ($apatient->persontreated=='Self') { $dob=$apatient->dob;}
                            else {$dob=$apatient->Infdob;}


                             $interval = date_diff(date_create(), date_create($dob));
                             $age= $interval->format(" %Y Year, %M Months, %d Days Old");?>

                              {{$age}}</td>
                            <td>
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->current_weight;}
                              else {echo $apatient->Infweight;}
                             ?></td>
                            <td>  <?php if ($apatient->persontreated=='Self') {echo $apatient->current_height;}
                              else {echo $apatient->Infheight;}
                             ?></td>
                            <td>
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->temperature;}
                               else {echo $apatient->Inftemp;}
                              ?></td>
                            <td>
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->systolic_bp;}
                               else { echo $apatient->Infsysto; }
                              ?></td>
                            <td>
                              <?php if ($apatient->persontreated=='Self') {echo $apatient->diastolic_bp;}
                               else {echo $apatient->Infdiasto; }
                              ?>
                              <!-- <td>{{$apatient->Constituency}}</td> -->

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


@endsection
