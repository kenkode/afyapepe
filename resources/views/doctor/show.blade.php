@extends('layouts.doctor2')
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
              $status= $pdetails->status;
              if ($gender=1) {
                $gender='Male';
              }else{
                $gender='Female';
              }

              if ($status=1) {
                $status='queueing';
              }elseif($status=2) {
                $status='Active';
              }elseif($status=3) {
                $status='Discharged';
              }elseif($status=4) {
                $status='Admitted';
              }else{
                $status='Referred';
              }
      }
        ?>

    <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                  <div class="col-lg-12">
                      <div class="ibox float-e-margins">
                          <div class="ibox-title">
                              <h5>{{$facilty}}</h5>
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
                          <div class="row show-grid">
                              <div class="col-xs-6 col-sm-4">  <h4>NAME:<?php echo $pname;?>&nbsp<?php echo $lname;?></h4></div>

                              <!-- Optional: clear the XS cols if their content doesn't match in height -->
                              <div class="clearfix visible-xs"></div>
                              <div class="col-xs-6 col-sm-4"><h4>Phone:<?php echo $phone; ?></h4></div>
                              <div class="col-xs-6 col-sm-4">status&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs"><?php echo $status; ?>
                              </button></div>

                          </div>
                        </div>
                      </div>
                  </div>

        </div>

    <div class="row">

      @if (count($errors) > 0)
     <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
     <ul>
      @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
      @endforeach
     </ul>
     </div>
     @endif


</div>
    <!--Home tabs-->
    <div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

    <div class="tabs-container">
  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> HOME</a></li>
      <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">HISTORY</a></li>
      <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false">TESTS</a></li>
     <li class=""><a data-toggle="tab" href="#tab-4" aria-expanded="false">PRESCRIPTION</a></li>

  </ul>
  <div class="tab-content">
      <div id="tab-1" class="tab-pane active">
          <div class="panel-body">


<div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <h4>Basic Details</h4>

                     </tr>
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
      <!--History tabs-->
      <!--Patient controller @showpatient-->



      <div id="tab-2" class="tab-pane">
          <div class="panel-body">
            <div class="table-responsive">
              <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">

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


<!--Test tabs-->
            <div id="tab-3" class="tab-pane">
              <div class="panel-body">

                <!--Tests tart tabs-->
                <?php
              foreach($tstdone as $tstdn)  {
                 $stats = $tstdn->id;
        }
            if ( empty ($stats) ) {?>
              <style type="text/css">#testdat{
              display:none;
              }</style>
              <?php
              }
               else {?>
            <style type="text/css">#test{
            display:none;
            }</style>
            <?php
            }
              ?>

    <div id="test">
      <div class="table-responsive">
       <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
            <h4><strong>Tests</strong></h4>
               </tr>
           </thead>
      <tbody>
    <?php
                  $tst= (new \App\Http\Controllers\TestController);
                  $tests = $tst->TestList();
                  foreach($tests as $test){

                }
                  ?>
                  <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
              <tr><td>Select Test</td>
                <td>  <select name="test" id='pre-selected-options1' multiple='multiple'>
                    @foreach($tests as $test)
                     <option value="{{ $test->id }}">{{ $test->name }}</option>
                    @endforeach
                </select>
              </td>
               <td> </td>
            </tr>
</div>
</div>


            <?php
            $tstd= (new \App\Http\Controllers\TestController);
            $testsd = $tstd->TestListdetails();
            foreach($testsd as $testd){

            }
            ?>
            <tr><td> Test Details</td>
            <td>  <select name="test_reccommended[]" id='pre-selected-options' multiple='multiple'>
            @foreach($testsd as $testd)
             <option value="{{ $testd->tests_id }}">{{ $testd->test_name }}</option>
            @endforeach
            </select>
            </td>
            <td>  </td>
            </tr>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <tr>

              <td>{{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
            </td>

              <td>{{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
            </td>
            </tr>
            <tr>
            <td>{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
            </td>

              <td>{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}
              </td></tr>
              </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <tr> <td>  </td>
                <td><button type="submit" class="btn btn-primary">Submit</button>  </td>

              </tr>
              </div>
                {{ Form::close() }}

             </tbody>
           </table>
              </div>
              </div>
<!--Test result tabs PatientController@testdone-->
              <div id="testdat">
              <div class="table-responsive">
          <table id="basic-datatables" class="table table-bordered" cellspacing="0" width="100%">
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
  </div>
</div>



<!--Prescription tabs-->
      <div id="tab-4" class="tab-pane">

        {{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}

        <div class="panel-body">
              <div class="table-responsive">
           <table class="table table-small-font table-bordered table-striped">
         <thead>
          <tr>
          <td>
             </td>
          </tr>
         </thead>

         <tbody>



          <?php
          $drgs= (new \App\Http\Controllers\TestController);
          $drugs = $drgs->drugList();
          foreach($drugs as $druglist){

          }
          ?>
          <tr>
            <td> Drug List</td>
          <td><select name="drug_id[]" id="druglist" multiple='multiple'class="form-control m-b" >
        @foreach($drugs as $druglist)
           <option value="{{$druglist->id }}">{{ $druglist->drugname  }}</option>
          @endforeach
          </select>
          </td>
      </tr>

      <tr>
    <td>
    </td>
    <td>{{ Form::hidden('filled_status', 1, array('placeholder' => 'FullName','class' => 'form-control')) }}</td>
    </tr>

      <tr><td>
      <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
          <label for="role" class="col-md-4 control-label">Dosage</label></td>
        <td>  <div class="col-md-6"><select class="form-control m-b" name="dosage" id="example-getting-started" >
                <option value='Full'>FULL</option>
                <option value='Half'>HALF</option>
                <option value='Quater'>QUATER</option>

                </select>
              @if ($errors->has('role'))
                  <span class="help-block">
                      <strong>{{ $errors->first('role') }}</strong>
                  </span>
              @endif
          </div>
      </div>  </td>
      </tr>
      <tr>
        <td>
         </td>
        <td>{{ Form::hidden('doc_id',$Did, array('class' => 'form-control')) }}</td>
      </tr>
      <tr><td>
      <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
          <label for="role" class="col-md-4 control-label">Doseform</label></td>
        <td>  <div class="col-md-6"><select class="form-control m-b" name="doseform" id="doseform" >
                <option value='Cream'>CREAM</option>
                <option value='Dental'>DENTAL</option>
                <option value='Infusion'>INFUSION</option>
                <option value='Injection'>INJECTION</option>
                <option value='Tablets'>TABLETS</option>

                </select>
              @if ($errors->has('role'))
                  <span class="help-block">
                      <strong>{{ $errors->first('role') }}</strong>
                  </span>
              @endif
          </div>
      </div>  </td>
      </tr>


<tr>
  <td>
    </td>
 <td>{{ Form::hidden('triage_id',$pdetails->triage_id, array('class' => 'form-control')) }}</td>
</tr>
<tr>
 <td>
  </td>
 <td>{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}</td>
</tr>

<tr>      <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
          <td><strong>Doctor note:</strong></td>
        <td>  {{ Form::textarea('doc_note', null, array('placeholder' => 'facility','class' => 'form-control')) }}
          </td></div>
          </div>

      </tr>
      <tr><td>
         </td>
       <td>{{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}</td>
      </tr>
      <div class="col-xs-12 col-sm-12 col-md-12 text-center">
      <tr><td>

      </td> <td>

       <button type="submit" class="btn btn-primary">Submit</button>
      </td>
      </tr>
      </div>
          </tbody>
        </table>
        </div>
      </div>

      </div>
          </div>
      </div>
  </div>


  </div>
    </div>
     </div>

</div>


@endsection
