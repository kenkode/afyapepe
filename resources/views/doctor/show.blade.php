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
       if ($pdetails->persontreated=='Self') {
         $pname = $pdetails->firstname;
         $lname = $pdetails->secondName;
         $facilty = $pdetails->FacilityName;
         $phone = $pdetails->msisdn;
         $stat= $pdetails->appstatus;
         $afyauserId= $pdetails->afyaId;

        }
        else {
          $dependantId= $pdetails->Infid;
          $pname = $pdetails->Infname;
          $lname = $pdetails->InfName;
          $facilty = $pdetails->FacilityName;
          $phone = $pdetails->msisdn;
          $stat= $pdetails->appstatus;
          $afyauserId= $pdetails->afyaId;
         }



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
                    <li class="active"><a data-toggle="tab" href="#tab-1">Today's Triage</button></a></li>
                    <li><a data-toggle="tab" href="#tab-2">History</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Tests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li>
                </ul>
              <!-- </div> -->
                <div class="tab-content">
                  <!--tabs1-->
                  <div id="tab-1" class="tab-pane active">
                      <div class="ibox float-e-margins">
                        <div class="table-responsive ibox-content">
                        <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                           <thead>
                        <tr>
                         <th></th>
                           <th>Weight </th>
                           <th>Height</th>
                           <th>Temperature</th>
                           <th>Systolic BP</th>
                           <th>Diastolic BP</th>
                           <th>BMI</th>
                           <th>Chief Compliant</th>
                           <th>Observations</th>
                           <th>Symptoms</th>
                           <th>Nurse Notes</th>
                      </tr>
                        </thead>

                        <tbody>
                        <?php $i =1; ?>

                        @foreach($patientdetails as $pdetails)
                          <tr>
                          <td>{{ +$i }}</td>
                         <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->current_weight;}
                         else {echo $pdetails->Infweight;}
                         ?>
                           </td>
                          <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->current_height;}
                          else {echo $pdetails->Infheight;}
                          ?></td>
                          <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->temperature;}
                            else {echo $pdetails->Inftemp;}
                            ?></td>
                          <td>
                            <?php if ($pdetails->persontreated=='Self') {echo $pdetails->systolic_bp;}
                              else {echo $pdetails->Infsysto;}
                              ?></td>
                           <td>
                             <?php if ($pdetails->persontreated=='Self') {echo $pdetails->diastolic_bp;}
                               else {echo $pdetails->Infdiasto;}
                               ?></td>
                           <td>
                             <?php if ($pdetails->persontreated=='Self') {$height=$pdetails->current_height; $weight=$pdetails->current_weight;}
                               else {$height=$pdetails->Infheight; $weight=$pdetails->Infweight;}
                                         $bmi =$weight/($height*$height);
                                      echo number_format($bmi, 2);
                                   ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->chief_compliant;}
                             else {echo $pdetails->Infcompliant;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->observation;}
                             else {echo $pdetails->Infobservation;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->symptoms;}
                             else {echo $pdetails->Infsymptoms;}
                             ?></td>
                           <td><?php if ($pdetails->persontreated=='Self') {echo $pdetails->nurse_notes;}
                             else {echo $pdetails->nurse_notes;}
                             ?>
                               </td>
                         </tr>
                        <?php $i++; ?>

                        @endforeach

                        </tbody>
                        </table>
                        </div>
                         </div>
                      </div>
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
                <th>Chief Complaint</th>
                <th>Doctor's Note</th>
                <th>Test</th>
                <th>Prescription</th>
                <th>view more</th>
            </tr>
            </thead>
            <tbody>
              <?php
              $pathists = DB::table('appointments')
              ->leftJoin('triage_details', 'appointments.id', '=', 'triage_details.appointment_id')
              ->leftJoin('patient_test', 'appointments.id',  '=', 'patient_test.appointment_id')
              ->leftJoin('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
              ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
              ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
              ->select('triage_details.chief_compliant','triage_details.updated_at',
              'patient_test.test_status','prescriptions.filled_status','appointments.id',
              'appointments.persontreated',

              'triage_infants.chief_compliant as Infcompliant','triage_infants.updated_at as Infupdated')

              ->where('appointments.afya_user_id',$afyauserId)
              ->get();
              ?>
              <?php $i =1; ?>
           @foreach($pathists as $pathist)
                <tr>
                    <td>{{ +$i }}</td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->updated_at;}
                    else {echo $pathist->Infupdated;}?></td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->chief_compliant;}
                    else {echo $pathist->Infcompliant;}?></td>
                    <td><?php if ($pathist->persontreated=='Self') {echo $pathist->chief_compliant;}
                    else {echo $pathist->Infcompliant;}?></td>
                    <td><?php
                    if ($pathist->persontreated=='Self') {$tests=$pathist->test_status;}
                    else {$tests=$pathist->test_status;}


                    if (is_null($tests)) {
                      $tests= 'N/A';
                    }
                    elseif($tests==0) {
                     $tests= 'Pending';
                   } elseif($tests==1) {
                      $tests= 'Done';
                    }else {
                        $tests= 'Partial';
                    }
                      ?>  {{$tests}}</td>
                      <td><?php
                      $prescs=$pathist->filled_status;
                      if (is_null($prescs)) {
                        $prescs= 'N/A';
                      }
                      elseif ($prescs==0) {
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
                  <th>Chief Complaint</th>
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
<!--3tabs-->
@include('doctor.test')
<!--3tabs-->

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
                                     <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                              <div class="form-group">
                              <label for="dosage" class="col-md-4 control-label">Frequency</label></td>
                               <select class="form-control"  name="frequency" style="width: 50%">
                                   @foreach($frequent as $freq)
                                     <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                                  @endforeach
                               </select>
                            </div>

                            {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                            {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}



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
                                        <table class="table table-striped table-bordered table-hover dataTables-conditional" >
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
