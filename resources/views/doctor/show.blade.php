@extends('layouts.doctor2')
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
            <div class="ibox-title">
                        <h5>{{$facilty}}</h5>
                        <div class="ibox-tools">
                          <a class="collapse-link">
                            {{$Name}}
                          </a>
                          </div>
                    </div>
            <div class="panel-body">

                <h5><strong>Patient Name</strong>&nbsp;&nbsp;&nbsp;<?php echo $pname;?>&nbsp<?php echo $lname;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Phone:<?php echo $phone; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                status&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs"><?php echo $stat; ?>
              </h5></div>
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Home</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">History</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3">Tests</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-5">End Visit</a></li>
                    </ul>
                    <div class="tab-content">

                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                              <div class="col-lg-12">
                              <div class="ibox float-e-margins">
                                  <div class="ibox-title">
                                      <h5>Basic Data</h5>
                                      <div class="ibox-tools">

              </div>
              <div class="ibox-content">
                <table class="table table-striped">
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
                      <tr>
                           <td><strong>VITALS</strong></td>
                     </tr>
                      <tr>
                         <td><strong>Chief Complaint:</strong></td>
                         <td><?php echo $complain;?></td>
                         <td></td>
                         <td></td>
                      </tr>

                      <tr>
                         <td><strong>Observation's:</strong></td>
                         <td><?php echo $observations;?></td>
                         <td></td>
                         <td></td>
                      </tr>

                      </tbody>
                  </table>

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

          {{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
        <?php
                      $tst= (new \App\Http\Controllers\TestController);
                      $tests = $tst->TestList();
                      foreach($tests as $test){

                    }
                      ?>
<div class="ibox float-e-margins">
  <div class="ibox-content">
  {{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
    <div class="hr-line-dashed"></div>


        <div class="form-group"><label>Conditional Diagnosis</label>
          <select class="js-example-placeholder-single chosen-select" id="testsj" name="conditional" class= "form-control">
           @foreach($tests as $test)
             <option value="{{$test->tests_id}}">{{$test->name}} {{$test->test_name}} </option>
          @endforeach
        </select>
      </div>
  <div class="hr-line-dashed"></div>

    <div class="form-group"><label>Select Test</label>
              <select class="js-example-placeholder-single" id="testsj" name="test[]" multiple="multiple" class= "form-control">
               @foreach($tests as $test)
                 <option value="{{$test->tests_id}}">{{$test->name}} {{$test->test_name}} </option>
              @endforeach
            </select>
       </div>
       <div class="hr-line-dashed"></div>
      {{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
      {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
      {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
      {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


               <div class="form-group text-center">
                <strong>Doctor note:</strong></td>
                {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
              </div><br />

              <div class="hr-line-dashed"></div>
              <div class="form-group  text-center">
              <button type="submit" class="btn btn-primary">Submit</button>  </td>
               </div>
                 {{ Form::close() }}

             </div>
          </div>

          <!--Test result tabs PatientController@testdone-->
                        <div id="testdat">
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
                          <td>{{$tstdn->test_reccommended}}</td>
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
 </div><!--3tabs-->
    <!--tabs4-->
                        <div id="tab-4" class="tab-pane">

                                    {{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}
                    <?php  $dizeases= (new \App\Http\Controllers\TestController);
                          $disease = $dizeases->Diseases();
                          foreach($disease as $dis){
                      }?>
                      <?php  $routem= (new \App\Http\Controllers\TestController);
                            $routems = $routem->RouteM();
                        ?>
                      <?php $Strength= (new \App\Http\Controllers\TestController);
                            $Strengths = $Strength->Strength();
                        ?>
                      <?php $frequency= (new \App\Http\Controllers\TestController);
                            $frequent = $frequency->Frequency();
                        ?>

                          <?php
                          $drgs= (new \App\Http\Controllers\TestController);
                          $drugs = $drgs->drugList();
                          ?>
                          <div class="ibox float-e-margins">
                            <div class="ibox-content">

                              <div class="hr-line-dashed"></div>

                                  <div class="form-group"><label>Confirmed Diagnosis</label>
                                    <select class="js-example-placeholder-single "  name="diagnosis" class= "form-control">
                                     @foreach($disease as $diseaselist)
                                       <option value="{{$diseaselist->code }}">{{$diseaselist->code }}---{{ $diseaselist->short_desc  }} </option>
                                    @endforeach
                                  </select>
                                </div>
                            <div class="hr-line-dashed"></div>

                              <div class="form-group"><label>Prescription</label>
                                        <select class="js-example-placeholder-single"  name="prescription"  class= "form-control">
                                          @foreach($drugs as $druglist)
                                            <option value="{{$druglist->id }}">{{ $druglist->drugname  }}----{{ $druglist->DosageForm  }} </option>
                                         @endforeach
                                      </select>
                                 </div>
                                 <div class="form-group">
                                  <label for="dosage" class="col-md-2 control-label">Dosage</label></td>
                                   <div class="col-md-4"><select class="form-control m-b" name="dosage" id="example-getting-started" >
                                           <option value='Full'>FULL</option>
                                           <option value='Half'>HALF</option>
                                           <option value='Quater'>QUATER</option>

                                           </select>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                  <label for="dosage" class="col-md-2 control-label">Strength</label></td>
                                   <div class="col-md-4"><select class="js-example-placeholder-single" id="testsj" name="strength">
                                       @foreach($Strengths as $Strengthz)
                                         <option value="{{$Strengthz->id }}">{{ $Strengthz->strength  }} </option>
                                      @endforeach
                                   </select>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                  <label for="dosage" class="col-md-2 control-label">Route</label></td>
                                   <div class="col-md-4">  <select class="js-example-placeholder-single" name="routes">
                                       @foreach($routems as $routemz)
                                         <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                                      @endforeach
                                   </select>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                  <label for="dosage" class="col-md-2 control-label">Frequency</label></td>
                                   <div class="col-md-4">  <select class="js-example-placeholder-single"  name="frequency">
                                       @foreach($frequent as $freq)
                                         <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                                      @endforeach
                                   </select>
                                     </div>
                                 </div>



                                 <div class="hr-line-dashed"></div>
                                 {{ Form::hidden('triage_id',$pdetails->triage_id, array('class' => 'form-control')) }}
                                 {{ Form::hidden('filled_status', 1, array('class' => 'form-control')) }}
                                {{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
                                {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                                {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                                {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

                                <!-- <div class="form-group">
                                 <label for="dosage" class="col-md-2 control-label">Doctor note</label></td>
                                  <div class="col-md-4">
                                      {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                                    </div>
                                </div> -->
                            <div class="hr-line-dashed"></div>
                                        <div class="form-group  text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>  </td>
                                         </div>
                                           {{ Form::close() }}

                                       </div>
                                    </div>

                        </div><!--4 tabs-->

                        <!--tabs5-->
                        <div id="tab-5" class="tab-pane">

                                    {{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
                                    <?php
                                       use App\Facility;
                                       $facilities = DB::table('facilities')
                                       ->select('FacilityCode','FacilityName','KEPHLevel','Type','Beds',
                                       'County','Constituency','Ward')
                                       ->get();
                                  ?>


 <div class="col-lg-8">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-51"> Admit/Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-52">Refer</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-51" class="tab-pane active">
                        <div class="panel-body">
                          {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}
                          <div class="form-group">
                          <label for="role" class="col-md-4 control-label">Action</label>
                          <div class="col-md-6"><select class="form-control m-b" name="appointment_status" id="action" required >
                          <option value=''>Select ...</option>
                          <option value='4'>Admit</option>
                          <option value='3'>Discharge</option>
                         </select>
                          </div>
                          </div>
                            <div class="form-group" id="data_1">
                                <label class="font-normal">Next Appointment Date</label>
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="next_appointment" value="">
                                </div>
                            </div>
                      {{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
                      {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                      {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                      {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


                               <div class="form-group">
                                 <br />
                                 <label for="role" class="col-md-4 control-label">Doctor note</label>

                                {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
                              </div>


                    <div class="form-group  text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>  </td>
                     </div>
                       {{ Form::close() }}
                        </div>
                    </div>
                    <div id="tab-52" class="tab-pane">
                        <div class="panel-body">
                          {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}


                            <div class="form-group">
                            <label for="role" class="col-md-2 control-label">Facility</label>
                            <div class="col-md-8"><select class="js-example-placeholder-single " name="facility" id="js-example-placeholder-single">
                              @foreach($facilities as $fac)
                            <option value="{{$fac->FacilityCode}}">{{$fac->FacilityName}}  {{$fac->Type}} </option>
                            @endforeach
                            </select>
                            </div>
                            </div>
                              <div class="hr-line-dashed"></div>


{{ Form::hidden('facility_from',$pdetails->FacilityName, array('class' => 'form-control')) }}
{{ Form::hidden('appointment_status',5, array('class' => 'form-control')) }}
{{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}

{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


<div class="form-group text-center">
  <label for="role" class="col-md-4 control-label">Doctro Note</label>
{{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control col-lg-8')) }}
</div><br />


<div class="form-group  text-center">
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
                        </div>
                    </div>
                </div>


            </div>
        </div>









                                       </div>
                                    </div>

                        </div><!--5 tabs-->




                    </div><!--tab content-->
                </div><!--tabs-->
            </div><!--col12-->
         </div><!--row-->
      </div><!--wrapper-->

@endsection
