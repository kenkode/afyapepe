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


}


if ( empty ($Name ) ) {
// return view('doctor.create');

return redirect('doctor.create');

}
?>

<?php
      foreach ($patientdetails as $pdetails) {
        // $patientid = $pdetails->pat_id;
        $pname = $pdetails->firstname;
        $lname = $pdetails->secondName;
        $age = $pdetails->dob;
        $nid = $pdetails->nationalId;
        $appoid = $pdetails->app_id;
        $appdate = $pdetails->created_at;
        $facilty = $pdetails->FacilityName;
        $weight = $pdetails->current_weight;
        $height = $pdetails->current_height;
        $temperature = $pdetails->temperature;
        $systolic = $pdetails->systolic_bp;
        $diastolic = $pdetails->diastolic_bp;

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


$date1=date_create("1907-08-22");
$date2=date_create( date("Y-m-d"));
$diff=date_diff($date2,$date1);


// show difference in days between now and end dates

?>

<div class="row">

  <div class="col-lg-6">
      <div class="ibox float-e-margins">
          <div class="ibox-content">
              <div>
        <span class="pull-right text-right">
       <strong><?php echo $pname;?>&nbsp;<?php echo $lname;?></strong>
       <small>Age<?php echo $diff->format("%y years");?></small>

        </span>
                  <h3 class="font-bold no-margins">
                    Patient's Triage Details
                  </h3>

              </div>

              <div class="m-t-sm">

                  <div class="row">
                      <div class="col-md-3">
                          <div>
                            <label for="name">Weight</label>
                            <input type="text" class="form-control" value="<?php echo $weight;?>" readonly="readonly">
                           </div>
                          <div>
                            <label for="name">Height</label>
                            <input type="text" class="form-control" value="<?php echo $height;?>" readonly="readonly">
                       </div>
                       <div>
                         <label for="name">Temperature</label>
                         <input type="text" class="form-control" value="<?php echo $temperature;?>" readonly="readonly">
                    </div>
                      </div>


                      <div class="col-md-3">
                          <div>
                            <label for="name">Weight</label>
                            <input type="text" class="form-control" value="<?php echo $systolic;?>" readonly="readonly">
                           </div>
                          <div>
                            <label for="name">Height</label>
                            <input type="text" class="form-control" value="<?php echo $diastolic;?>" readonly="readonly">
                       </div>

                      </div>
                      <div class="col-md-4">
                          <ul class="stat-list m-t-lg">
                              <li>
                                  <h2 class="no-margins">Complain</h2>
                                  <small><p><?php echo $complain;?></p></small>
                                  <div class="progress progress-mini">
                                      <div class="progress-bar" style="width: 48%;"></div>
                                  </div>
                              </li>
                              <li>
                                  <h2 class="no-margins ">Observation</h2>
                                  <small><p><?php echo $observations;?></p></small>
                                  <div class="progress progress-mini">
                                      <div class="progress-bar" style="width: 60%;"></div>
                                  </div>
                              </li>
                          </ul>
                      </div>

                  </div>

              </div>

              <div class="m-t-md">
                  <small class="pull-right">
                      <i class="fa fa-clock-o"> </i>
                      Update on 16.07.2015
                  </small>
                  <small>
                      <strong>Analysis of sales:</strong> The value has been changed over time, and last month reached a level over $50,000.
                  </small>
              </div>

          </div>
      </div>
  </div>











<div class="col-lg-6">
<div class="ibox float-e-margins">
<div class="ibox-title">
  <h5>Patient Details</h5>
  <div class="ibox-tools">
      <a class="collapse-link">
          <i class="fa fa-chevron-up"></i>
      </a>
       <a class="close-link">
          <i class="fa fa-times"></i>
      </a>
  </div>
</div>
<div class="ibox-content">
      <form class="form-horizontal" role="form" method="POST" action="/nextkin" novalidate>
   <input type="hidden" name="_token" value="{{ csrf_token() }}">
   <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $pname;?>&nbsp<?php echo $lname;?>" name="id"  required>

    <div class="form-group">
   <label for="name">Name</label>
   <input type="text" class="form-control" id="name" name="name" value="<?php echo $pname;?>&nbsp;<?php echo $lname;?>" readonly="readonly">
   </div>
</div>
</div>
</div>

</div>
<div class="row">
  <div class="col-lg-8">
  <div class="ibox float-e-margins">
  <div class="ibox-title">
    <h5>Patient History</h5>
    <div class="ibox-tools">
        <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
        </a>
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
        <th>view more</th>
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
            <td><a href="{{route('visit',$appoid)}}" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i></a></td>
         </tr>
        <?php $i++; ?>
          @endforeach
   </tbody>
    <tfoot>
      <tr>
        <th></th>
          <th>Date of visit</th>
          <th>Chief Complain</th>
          <th>observations</th>
          <th>Prescription</th>
          <th>Prescription</th>
      </tr>
    </tfoot>
    </table>
  </div>



  </div>
  </div>
  </div>
</div>




























    <div class="ibox-title">
        <h5>{{$facilty}}</h5>
        <div class="ibox-tools">
          <a class="collapse-link">{{$Name}}  </a>
        </div>
      </div>
      <div class="panel-body">

          <h5><strong>Patient Name</strong>&nbsp;&nbsp;&nbsp;<?php echo $pname;?>&nbsp<?php echo $lname;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          Phone:<?php echo $phone; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          status&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs"><?php echo $stat; ?>
        </h5></div>

<!--tabs-->
        <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Home</button></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">History</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Tests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li>
                </ul>
              <!-- </div> -->
                <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
              <div class="col-md-4">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>Observation's</h5>
                      </div>
                      <div>

                          <div class="ibox-content profile-content">

                              <h5>Chief Complaint:</h5>
                              <p><?php echo $complain;?> </p>
                              <h5>Observation's:</h5>
                              <p><?php echo $observations;?></p>

                          </div>
                  </div>
              </div>
                  </div>
              <div class="col-md-8">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Vitals</button>
                    </div>
                      <div class="ibox-content">

                          <div>
                              <div class="feed-activity-list">

                                  <div class="row m-t-lg">
                                      <div class="col-md-4">
                                       <h5><strong>Age</strong> <?php echo $age;?></h5>
                                      </div>
                                      <div class="col-md-4">
                                       <h5><strong>D.O.B</strong> <?php echo $age;?></h5>
                                      </div>
                                      <div class="col-md-4">
                                      <h5><strong>National ID</strong><?php echo $nid;?></h5>
                                      </div>

                                    </div>
                                  <div class="row m-t-lg">
                                      <div class="col-md-4">
                                       <h5><strong>weight</strong> <?php echo $weight;?></h5>
                                      </div>
                                      <div class="col-md-4">
                                      <h5><strong>height</strong><?php echo $height;?></h5>
                                      </div>
                                      <div class="col-md-4">
                                       <h5><strong>Temperature</strong><?php echo $temperature;?></h5>
                                      </div>
                                    </div>
                                  <div class="row m-t-lg">
                                      <div class="col-md-4">
                                       <h5><strong>Systolic BP:</strong> <?php echo $systolic;?></h5>
                                      </div>
                                      <div class="col-md-4">
                                      <h5><strong>Diastolic BP</strong><?php echo $diastolic;?></h5>
                                      </div>

                                    </div>
                              </div>

                              <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-up"></i>Vitals</button>

                          </div>

                      </div>
                  </div>

              </div>
          </div>
      </div>
</div>
</div><!--tabs1-->
<!--tabs2-->
<div id="tab-2" class="tab-pane">
    <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Patient Visit History</h5>

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
                <th>view more</th>
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
                    <td><a href="{{route('visit',$appoid)}}" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i></a></td>
                 </tr>
                <?php $i++; ?>
                  @endforeach
           </tbody>
            <tfoot>
              <tr>
                <th></th>
                  <th>Date of visit</th>
                  <th>Chief Complain</th>
                  <th>observations</th>
                  <th>Prescription</th>
                  <th>Prescription</th>
              </tr>
            </tfoot>
            </table>
          </div>
         </div>
      </div>

</div><!--2 tabs-->
<!--tabs3-->
<div id="tab-3" class="tab-pane">
<div class="ibox float-e-margins">
<div class="ibox-content">
{{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
<!-- {{ Form::open(array('id' => 'ptest')) }} -->

<div class="col-md-4">

<div class="form-group ">
    <label for="d_list2">Conditional Diagnosis:</label>
    <select id="d_list2" name="conditional" class="d_list2 form-control"></select>
</div>

<div class="form-group">
    <label for="tag_list">Select Test:</label>
    <select id="tag_list" name="test" class="form-control tag_list1" ></select>
</div>
</div>




{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

<div class="form-group  text-center">
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
</div>
</div>


<!--Test result tabs PatientController@testdone-->
<div id="testR">
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
   <td>{{$tstdn->facility_id}}</td>
   <td>{{$tstdn->note}}</td>
   <td>{{$tstdn->created_at}}</td>
</tr>
<?php $i++; ?>

@endforeach

</tbody>
</table>
</div>
</div>

</div><!--3tabs-->

<!--tabs4-->
                    <div id="tab-4" class="tab-pane">

        {{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}

                  <?php  $routem= (new \App\Http\Controllers\TestController);
                        $routems = $routem->RouteM();
                    ?>
                  <?php $Strength= (new \App\Http\Controllers\TestController);
                        $Strengths = $Strength->Strength();
                    ?>
                  <?php $frequency= (new \App\Http\Controllers\TestController);
                        $frequent = $frequency->Frequency();
                    ?>


                      <div class="ibox float-e-margins">
                        <div class="ibox-content">


                          <div class="form-group ">
                              <label for="d_list3">Confirmed Diagnosis:</label>
                              <select id="d_list3" name="diagnosis" class="form-control d_list2"></select>
                          </div>
                          <div class="form-group">
                              <label for="presc">Prescription:</label>
                              <select id="presc" name="prescription" class="form-control presc1" ></select>
                          </div>
                            <div class="form-group">
                              <label for="dosage" class="col-md-2 control-label">Dosage</label></td>
                               <select class="form-control m-b" name="dosage" id="example-getting-started" >
                                       <option value='Full'>FULL</option>
                                       <option value='Half'>HALF</option>
                                       <option value='Quater'>QUATER</option>
                              </select>
                            </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-2 control-label">Strength</label></td>
                               <select class="js-example-placeholder-single" id="testsj" name="strength">
                                   @foreach($Strengths as $Strengthz)
                                     <option value="{{$Strengthz->id }}">{{ $Strengthz->strength  }} </option>
                                  @endforeach
                               </select>
                            </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-2 control-label">Route</label></td>
                               <select class="js-example-placeholder-single" name="routes">
                                   @foreach($routems as $routemz)
                                     <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                              <div class="form-group">
                              <label for="dosage" class="col-md-2 control-label">Frequency</label></td>
                               <select class="js-example-placeholder-single"  name="frequency">
                                   @foreach($frequent as $freq)
                                     <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                                  @endforeach
                               </select>
                            </div>
                             {{ Form::hidden('facility',$pdetails->FacilityCode, array('class' => 'form-control')) }}
                             {{ Form::hidden('triage_id',$pdetails->triage_id, array('class' => 'form-control')) }}
                             {{ Form::hidden('filled_status', 1, array('class' => 'form-control')) }}

                            {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                            {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                            {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

                            <!-- <div class="form-group">
                             <label for="dosage" class="col-md-2 control-label">Doctor note</label></td>
                              <div class="col-md-4">
                                  {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                                </div>
                            </div> -->

                                    <div class="form-group  text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                                     </div>

                                {{ Form::close() }}

                                   </div>
                                </div>
                               </div><!--4 tabs-->

                    <!--tabs5 Admit-->
                    <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" ></select>
                                    </div>
                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Appointment Date</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',4, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}
                        </div><!--panel body-->
                    </div><!--5 tabs Admit-->

                    <!--tabs6 Discharge-->
                    <div id="tab-6" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}


                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Appointment Date</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',3, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}


                          </div><!--panel body-->
                    </div><!--6tabs Discharged-->
                    <!--tabs7 Transfer-->
                    <div id="tab-7" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}
                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" ></select>
                                    </div>


                                   {{ Form::hidden('appointment_status',5, array('class' => 'form-control')) }}

                                  {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                  {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                  {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                      <div class="form-group col-md-8 col-md-offset-1">
                       <label for="role" class="control-label">Doctor note</label>
                        {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                    </div>


                    <div class="form-group  col-md-8 col-md-offset-1">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                    </div>
                  {{ Form::close() }}

                          </div><!--panel body-->
                    </div><!--7tabs-->

















              </div><!--tabcontent-->
          </div><!--tabs-container-->
        </div><!--col12-->
        <!--tabs-->

        </div><!--row-->
  </div><!--wrapper-->


</body>
</html>
@endsection