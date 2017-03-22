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

                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Conditional Diseases</h5>
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

                                    {{ Form::open(array('route' => array('patienttest'),'method'=>'POST')) }}
                              <?php
                                            $tst= (new \App\Http\Controllers\TestController);
                                            $tests = $tst->TestList();
                                            foreach($tests as $test){

                                          }
                                            ?>
                                    <div class="ibox-content">

                                        <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                                    <thead>
                                    <tr>
                                        <th></th>

                                        <th>Category</th>
                                        <th>Disease</th>
                                        <th>Select Disease</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                      <?php $i =1; ?>
                                   @foreach($tests as $test)
                                        <tr>
                                            <td>{{ +$i }}</td>
                                            <td>{{$test->name}}</td>
                                            <td>{{$test->test_name}}</td>
                                            <td>
                                               <!-- <input type="checkbox" id="inlineCheckbox2" name="conditional[]" value="{{$test->tests_id}}"> </td> -->
                                         </tr>
                                        <?php $i++; ?>
                                          @endforeach
                                        </tbody>
                                    <tfoot>
                                      <tr>
                                          <th></th>

                                          <th>Category</th>
                                          <th>Disease</th>
                                          <th>Select Disease</th>

                                      </tr>
                                    </tfoot>
                                    </table>
                                  </div>
                                 </div>
                              </div>
                              <div class="ibox float-e-margins">
                                  <div class="ibox-title">
                                      <h5>Available Tests List</h5>
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

                                      <th>Category</th>
                                      <th>Test</th>
                                      <th>Select Test</th>
                                  </tr>
                                  </thead>
                                  <tbody>

                                    <?php $i =1; ?>

                                 @foreach($tests as $test)
                                      <tr>
                                          <td>{{ +$i }}</td>
                                          <td>{{$test->tests_id}}</td>
                                          <td>{{$test->test_name}}</td>

                                        <!-- <td>  {{ Form::checkbox('test[]',$test->tests_id)}}</td> -->
                                        <td><input type="checkbox" name="test[{{$test->tests_id}}]" value="{{$test->tests_id}}"> </td>

                                       </tr>
                                      <?php $i++; ?>
                                        @endforeach
                                      </tbody>
                                  <tfoot>
                                    <tr>
                                        <th></th>

                                        <th>Category</th>
                                        <th>Test</th>
                                        <th>Select Test</th>

                                    </tr>
                                  </tfoot>
                                  </table>
                                </div>
                               </div>
                            </div>
      
                          {{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
                          {{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
                          {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                          {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}

                            <div class="col-xs-8 col-sm-8 col-md-8 text-center">
                                <div class="form-group">
                                      <strong>Doctor note:</strong></td>
                                      {{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control text-center')) }}
                                    </div>
                                      </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>  </td>
                                 </div>
                                 </div>
                                {{ Form::close() }}

                        </div><!--3tabs-->
                        <!--tabs4-->
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis</strong>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Basic Data Tables example with responsive plugin</h5>
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
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="gradeC">
                                        <td>Tasman</td>
                                        <td>Internet Explorer 5.2</td>
                                        <td>Mac OS 8-X</td>
                                        <td class="center">1</td>
                                        <td class="center">C</td>
                                    </tr>
                                    </tfoot>
                                    </table>
                                  </div>
                                 </div>
                              </div>
                            </div>
                        </div><!--4 tabs-->

                        <!--tabs5-->
                        <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                <strong>Donec quam felis5</strong>
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Basic Data Tables example with responsive plugin</h5>
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
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>
                                        <th>Engine version</th>
                                        <th>CSS grade</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr class="gradeC">
                                        <td>Tasman</td>
                                        <td>Internet Explorer 5.2</td>
                                        <td>Mac OS 8-X</td>
                                        <td class="center">1</td>
                                        <td class="center">C</td>
                                    </tr>
                                    </tfoot>
                                    </table>
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
