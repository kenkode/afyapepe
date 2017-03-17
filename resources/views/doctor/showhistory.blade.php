@extends('layouts.show')
@section('content')


      <?php
    $doc = (new \App\Http\Controllers\DoctorController);
    $Docdatas = $doc->DocDetails();
    foreach($Docdatas as $Docdata){


      $Did = $Docdata->doc_id;
    	$Name = $Docdata->name;
    	$Address = $Docdata->address;
    	$RegNo = $Docdata->regno;
    	$RegDate = $Docdata->regdate;
    	$Speciality = $Docdata->speciality;
    	$Sub_Speciality = $Docdata->subspeciality;
      $Facility = "Afyapepe";

    }


    if ( empty ($Name ) ) {
    // return view('doctor.create');

    return redirect('doctor.create');


    // return redirect()->action('DoctorController@create');

    }
    ?>
    <!--Patient controller @showpatient-->
    <?php
            foreach ($patientdetails as $pdetails) {
              $patientid = $pdetails->pat_id;
              $pname = $pdetails->firstname;
              $lname = $pdetails->secondName;
              $age = $pdetails->dob;
              $nid = $pdetails->national_id;
              $appoid = $pdetails->app_id;
              $appdate = $pdetails->created_at;
              $facilty = $pdetails->FacilityName;
              $weight = $pdetails->current_weight;
              $height = $pdetails->current_height;
              $temperature = $pdetails->temperature;
              $systolic = $pdetails->systolic_bp;
              $diastolic = $pdetails->diastolic_bp;
              $allergies = $pdetails->allergies;
              $complain = $pdetails->chief_compliant;
              $observations = $pdetails->observation;
              $gender = $pdetails->gender;
              $phone = $pdetails->msisdn;
              $stat= $pdetails->appstatus;
              if ($gender=1) {
                $gender='Male';
              }else{
                $gender='Female';
              }

              if ($stat=="1") {
                $stat='queueing';
              }elseif($stat=="2") {
                $stat='Active';
              }elseif($stat=="3") {
                $stat='Discharged';
              }elseif($stat=='4') {
              $stat='Admitted';
              }else{
                $stat='Referred';
              }
      }
      ?>

    <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                  <div class="col-lg-11">
                      <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{$facilty}}</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                  {{$Name}}
                                </a>
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

                          <div class="ibox-content">
                          <div class="row show-grid">
                              <div class="col-xs-6 col-sm-4">  <h4>NAME:<?php echo $pname;?>&nbsp<?php echo $lname;?></h4></div>

                              <!-- Optional: clear the XS cols if their content doesn't match in height -->
                              <div class="clearfix visible-xs"></div>
                              <div class="col-xs-6 col-sm-4"><h4>Phone:<?php echo $phone; ?></h4></div>
                              <div class="col-xs-6 col-sm-4">status&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs"><?php echo $stat; ?>
                              </button></div>

                          </div>
                        </div>
                      </div>
                  </div>
             </div>
         </div>


    <!--Home tabs-->
    <div class="col-lg-12">


    <div class="tabs-container">
  <ul class="nav nav-tabs tbg">
      <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> HOME</a></li>
      <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">HISTORY</a></li>
      <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">TESTS</a></li>
     <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">PRESCRIPTION</a></li>

  </ul>
  <div class="tab-content">
      <div id="tab-1" class="tab-pane active">
        <div class="panel-body">
        <div class="col-lg-11">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Last Visit Data</h5>
                <div class="ibox-tools">

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
            <table class="table table-striped table-bordered table-hover" >
            <thead>

                  </thead>

                  <tbody>
                     <tr>
                        <td>Name</td>
                        <td><?php echo $pname;?>&nbsp<?php echo $lname;?></td>
                        <td><strong>Age:</strong></td>
                        <td><?php echo $age;?></td>
                     </tr>
                     <tr>
                        <td><strong>National ID:</strong></td>
                        <td><?php echo $nid;?></td>
                        <td><strong>Appointment Date:</strong></td>
                        <td><?php echo $appdate;?></td>
                     </tr>
                     <tr>

                        <td><strong>Facility Name:</strong></td>
                        <td><?php echo $facilty;?></td>
                        <td></td>
                        <td></td>

                     </tr>
                     <tr>
                          <td><strong>VITALS</strong></td>
                    </tr>
                     <tr>
                        <td><strong>Weight:</strong></td>
                        <td><?php echo $weight;?></td>
                        <td><strong>Height:</strong></td>
                        <td><?php echo $height;?></td>
                     </tr>
                     <tr>
                        <td><strong>Temperature:</strong></td>
                        <td><?php echo $temperature;?></td>
                        <td><strong>Systolic BP:</strong></td>
                        <td><?php echo $systolic;?></td>
                     </tr>
                     <tr>
                        <td><strong>Diastolic BP:</strong></td>
                        <td><?php echo $diastolic;?></td>
                        <td><strong>Allergies:</strong></td>
                        <td><?php echo $allergies;?></td>

                     </tr>



                  </tbody>
               </table>
            </div>
         </div>
        </div>
      </div>
     </div>
</div>
      <!--History tabs-->
      <!--Patient controller @showpatient-->



      <div id="tab-2" class="tab-pane">
<div class="panel-body">
    <div class="col-lg-12">

        <div class="ibox-title">
            <h5>All Visits</h5>
            <div class="ibox-tools">

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
        <table class="table table-striped table-bordered table-hover dataTables-conditional" >
        <thead>
          <tr>
            <th></th>
              <th>Date of visit</th>
              <th>Chief Complain</th>
              <th>observations</th>
              <th>Prescription</th>
              <th>Prescription</th>
        </tr>
      </thead>

      <tbody>
        <?php $i =1; ?>
     @foreach($patientdetails as $triageDetails)
          <tr>
              <td>{{ +$i }}</td>
              <td>{{$triageDetails->updated_at}}</td>
              <td>{{$triageDetails->chief_compliant}}</td>
              <td>{{$triageDetails->observation}}</td>
              <td>{{$triageDetails->observation}}</td>
              <td><a href="{{route('visit',$appoid)}}" class="btn btn-default btn-xs">View</a></td>


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


<!--Test result tabs PatientController@testdone-->
            <div id="tab-3" class="tab-pane">
              <div class="panel-body">
  <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Test Done</h5>
                <div class="ibox-tools">

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
                   <table class="table table-striped table-bordered table-hover dataTables-conditional" >

            <thead>
              <tr>
                <th></th>

                  <th>Test Recommended</th>
                  <th>Done</th>
                  <th>Result</th>
                  <th>Faciity</th>
                  <th>Apointment Id</th>
                   <th>Note</th>
                  <th>Date Test Done</th>

            </tr>
          </thead>

          <tbody>
            <?php $i =1; ?>

         @foreach($tstdone as $tstdn)
                 <tr>
                    <td>{{ +$i }}</td>
                 <td>{{$tstdn->tests_reccommended}}</td>
                  <td>{{$tstdn->done}}</td>
                  <td>{{$tstdn->results}}</td>
                  <td>{{$tstdn->facility_id}}</td>
                  <td>{{$tstdn->appointment_id}}</td>
                  <td>{{$tstdn->note}}</td>
                  <td>{{$tstdn->created_at}}</td>
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



<!--Prescription tabs-->
      <div id="tab-4" class="tab-pane">
        <div class="panel-body">
         <div class="col-lg-12">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Prescription List</h5>
                <div class="ibox-tools">

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
              <table class="table table-striped table-bordered table-hover dataTables-conditional" >
            <thead>
           <tr>
             <th></th>

               <th>Drug Name</th>
               <th>Facility Name</th>
                <th>Dose given</th>
               <th>Date given</th>
         </tr>
       </thead>

       <tbody>
         <?php $i =1; ?>

      @foreach($prescription as $presc)
              <tr>
                 <td>{{ +$i }}</td>
               <td>{{$presc->drugname}}</td>
               <td>{{$presc->FacilityName}}</td>
               <td>{{$presc->dosage}}</td>
               <td>{{$presc->created_at}}</td>

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
  </div><!--Prescription tabs-->
    </div><!-- tab-content -->
  </div><!--tabs container-->


  </div><!--col-md 12-->
</div><!--wrapper-->


@endsection
