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
        $dob = $pdetails->dob;
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
        $afyauserId= $pdetails->afyaId;
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


 $interval = date_diff(date_create(), date_create($dob));
 $age= $interval->format(" %Y Year, %M Months, %d Days Old");

}
?>

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
                    <!-- <li class="active"><a data-toggle="tab" href="#tab-1">Home</button></a></li> -->
                    <li class="active"><a data-toggle="tab" href="#tab-2">History</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Tests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li>
                </ul>
              <!-- </div> -->
                <div class="tab-content">

<!--tabs2-->
<div id="tab-2" class="tab-pane active">
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
                <th>Doctor's Note</th>
                <th>Test</th>
                <th>Prescription</th>
                <th>view more</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $pathists = DB::table('appointments')
              ->Join('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
              ->Join('patient_test', 'appointments.id',  '=', 'patient_test.appointment_id')
              ->Join('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
              ->select('triage_details.chief_compliant','triage_details.updated_at',
              'patient_test.test_status','prescriptions.filled_status','appointments.id')

              ->where('appointments.afya_user_id',$afyauserId)
              ->get();
              ?>
              <?php $i =1; ?>
           @foreach($pathists as $pathist)
                <tr>
                    <td>{{ +$i }}</td>
                    <td>{{$pathist->updated_at}}</td>
                    <td>{{$pathist->chief_compliant}}</td>
                    <td>{{$pathist->chief_compliant}}</td>
                    <td><?php
                    $tests=$pathist->test_status;
                    if ($tests==0) {
                      $tests= 'Pending';
                    } elseif($tests==1) {
                      $tests= 'Done';
                    }else {
                        $tests= 'Partial';
                    }
                      ?>  {{$tests}}</td>
                      <td><?php
                      $prescs=$pathist->filled_status;
                      if ($prescs==0) {
                        $prescs= 'Pending';
                      } elseif($prescs==1) {
                        $prescs= 'Complete';
                      }else {
                          $prescs= 'Partial';
                      }
                        ?>  {{$prescs}}</td>
                    <td><a href="{{route('visit',$pathist->id)}}" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i></a></td>
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
                    <th>view more</th>
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
<div class="ibox-content col-md-12">
{{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
<!-- {{ Form::open(array('id' => 'ptest')) }} -->

<div class="col-md-6">

<div class="form-group ">
    <label for="d_list2">Conditional Diagnosis:</label>
    <select id="d_list2" name="conditional" class="d_list2 form-control" style="width: 100%"></select>
</div>

<div class="form-group">
    <label for="tag_list" class="col-md-4">Select Test:</label>
    <select id="tag_list" name="test" class="form-control tag_list1" style="width: 100%"></select>
</div>
</div>
<div class="form-group  text-center col-md-2">
{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

<br /><br /><br />
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
</div>
</div>


<!--Test result tabs PatientController@testdone-->
<div id="testR">
<div class="table-responsive ibox-content">
<table class="table table-striped table-bordered table-hover dataTables-conditional" >
   <thead>
<tr>
 <th></th>
    <th>Date </th>
   <th>Test Name</th>
   <th>Conditional Diagnosis</th>
   <th>Status</th>
   <th>Result</th>
   <th>Faciity</th>
   <th>Note</th>


</tr>
</thead>

<tbody>
<?php $i =1; ?>

@foreach($tstdone as $tstdn)
  <tr>
  <td>{{ +$i }}</td>
 <td>{{$tstdn->created_at}}</td>
  <td>{{$tstdn->name}}</td>
  <td>{{$tstdn->disease}}</td>
  <td>{{$tstdn->done}}</td>
   <td>{{$tstdn->results}}</td>
   <td>{{$tstdn->FacilityName}}</td>
   <td>{{$tstdn->note}}</td>

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
                        <div class="ibox-content col-md-12">
                    <div class="ibox-content col-md-8 col-md-offset-2">

                          <div class="form-group ">
                              <label for="d_list3" class="col-md-4">Confirmed Diagnosis:</label>
                              <select  name="diagnosis" class="form-control d_list2" style="width: 50%"></select>
                          </div>
                          <div class="form-group">
                              <label for="presc" class="col-md-4">Prescription:</label>
                              <select id="presc" name="prescription" class="form-control presc1" style="width: 50%"></select>
                          </div>
                          <div class="form-group">
                              <label for="dosage" class="col-md-4">Dosage Form</label></td>
                               <select class="form-control m-b col-md-4" name="dosageform" id="example-getting-started" style="width: 50%">
                                <?php $druglists=DB::table('druglists')->distinct()->get(['DosageForm']); ?>
                                @foreach($druglists as $druglist)
                                       <option value='{{$druglist->DosageForm}}'>{{$druglist->DosageForm}}</option>
                                @endforeach
                              </select>
                            </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Strength</label></td>
                               <select class="form-control" id="testsj" name="strength" style="width: 25%">
                                   @foreach($Strengths as $Strengthz)
                                     <option value="{{$Strengthz->strength}}">{{ $Strengthz->strength  }}  </option>
                                  @endforeach
                              </select>

                        <input type="radio" name="strength_unit" value="ml"> Ml &nbsp;&nbsp;<input type="radio" name="strength_unit" value="mg"> Mg

                           </div>

                             <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Route</label></td>
                               <select class="form-control" name="routes" style="width: 50%">
                                   @foreach($routems as $routemz)
                                     <option value="{{$routemz->abbreviation }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                              <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Frequency</label></td>
                               <select class="form-control"  name="frequency" style="width: 50%">
                                   @foreach($frequent as $freq)
                                     <option value="{{$freq->abbreviation }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

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
                                    <div class="col-lg-12">
                                      <div class="ibox float-e-margins">
                                        <div class="ibox-content col-md-12">
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
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                        <thead>
                                       <tr>
                                         <th></th>


                                            <th>Diagnosis</th>
                                            <th>Drug Name</th>
                                            <th>Dosage Form</th>
                                           <th>Strength</th>
                                           <th>Strength Unit</th>
                                           <th>Date given</th>
                                     </tr>
                                   </thead>

                                   <tbody>
                                     <?php $i =1; ?>

                                  @foreach($prescription as $presc)
                                          <tr>
                                             <td>{{ +$i }}</td>
                                           <td>{{$presc->name}}</td>
                                           <td>{{$presc->drugname}}</td>
                                           <td>{{$presc->doseform}}</td>
                                           <td>{{$presc->strength}}</td>
                                           <td>{{$presc->strength_unit}}</td>
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
                                   </div>
                               </div>
                      </div><!--4 tabs-->

                    <!--tabs5 Admit-->
                    <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
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
                                        <label for="presc" class="col-md-6">Facility:</label>
                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
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
