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
         $facilty = $pdetails->FacilityName;
         $phone = $pdetails->msisdn;
         $stat= $pdetails->appstatus;
         $afyauserId= $pdetails->afyaId;

          $dependantId= $pdetails->Infid;
          $app_id= $pdetails->app_id;
          $pname = $pdetails->Infname;
          $lname = $pdetails->InfName;
          $facilty = $pdetails->FacilityName;
          $phone = $pdetails->msisdn;

          $dependantAge= $pdetails->Infdob;

           $interval = date_diff(date_create(), date_create($dependantAge));
           $dependantage= $interval->format(" %Y Year, %M Months, %d Days Old");


 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;

 $dependantdays= floor($datediff / (60 * 60 * 24));




}
?>

    <div class="ibox-title">
        <h5>{{$pname }}{{$lname}}</h5>
        <div class="ibox-tools">
          <a class="collapse-link">{{$facilty}}  </a>
        </div>
      </div>


<!--tabs-->
        <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Today's Triage</button></a></li>
                    <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
                    <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
                    <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
                    <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Admit</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Discharge</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Transfer</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">End Visit</a></li>
                </ul>
              <!-- </div> -->
                <div class="tab-content">
                  <!--tabs1-->
                  <div id="tab-1" class="tab-pane active">
                   @include('doctor.triage')
                   </div><!--tabs1-->

<!--tabs2-->
<div id="tab-2" class="tab-pane">
    <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>All Patient Visit History</h5>
            </div>
            <div class="ibox-content">
            <div class="table-responsive">
              <?php if ($pdetails->persontreated=='Self') {
              ?>
            <table class="table table-striped table-bordered table-hover dataTables-conditional" >
            <thead>
            <tr>
              <th></th>
                <th>Date of visit</th>
                <th>Chief Complaint</th>
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
              ->select('triage_details.chief_compliant','triage_details.updated_at',
              'patient_test.test_status','prescriptions.filled_status','appointments.id',
              'appointments.persontreated' )
              ->where('appointments.afya_user_id',$afyauserId)
              ->get();
              ?>
              <?php $i =1; ?>
           @foreach($pathists as $pathist)
                <tr>
                    <td>{{ +$i }}</td>
                    <td>{{ $pathist->updated_at}}</td>
                    <td> {{$pathist->chief_compliant}}</td>

                    <td><?php
                    $tests=$pathist->test_status;
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
                  <th>Test</th>
                  <th>Prescription</th>

                    <th>view more</th>
              </tr>
            </tfoot>
            </table>
            <?php }
            if ($dependantdays <='28') {
              ?>
              <table class="table table-striped table-bordered table-hover dataTables-conditional" >
              <thead>
              <tr>
                <th></th>
                  <th>Date of visit</th>
                  <th>Chief Complaint</th>
                  <th>Test</th>
                  <th>Prescription</th>
                  <th>view more</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $pathists = DB::table('appointments')

                ->leftJoin('patient_test', 'appointments.id',  '=', 'patient_test.appointment_id')
                ->leftJoin('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
                ->leftJoin('dependant', 'appointments.persontreated', '=', 'dependant.id')
                ->leftJoin('triage_infants', 'appointments.id', '=', 'triage_infants.appointment_id')
                ->select('patient_test.test_status','prescriptions.filled_status','appointments.id',
                'appointments.persontreated',
                 'triage_infants.chief_compliant as Infcompliant','triage_infants.updated_at as Infupdated')
                ->where('appointments.persontreated',$dependantId)
                ->get();
                ?>
                <?php $i =1; ?>
              @foreach($pathists as $pathist)
                  <tr>
                      <td>{{ +$i }}</td>
                      <td>{{$pathist->Infupdated}}</td>
                      <td>{{$pathist->Infcompliant}}</td>
                      <td><?php
                    $tests=$pathist->test_status;
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
                      <td><a href="{{route('dependantvisit',$pathist->id)}}" class="btn btn-default btn-xs"><i class="fa fa-search-plus"></i></a></td>
                   </tr>

                  <?php $i++; ?>
                    @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                    <th>Date of visit</th>
                    <th>Chief Complaint</th>
                    <th>Test</th>
                     <th>Prescription</th>
                      <th>view more</th>
                </tr>
              </tfoot>
              </table>

              <?php } ?>

          </div>
         </div>
      </div>

</div><!--2 tabs-->

<<<<<<< Updated upstream
<!--tabs4-->

<div id="tab-4" class="tab-pane">
@include('doctor.prescription')
</div><!--4 tabs-->
=======


>>>>>>> Stashed changes

  <!--tabs5 Admit-->
<div id="tab-5" class="tab-pane">



                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('patientnotes'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                          <input type="text" class="form-control" name="next_appointment" value="{{$facilty}}">

                                        <!-- <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select> -->
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



@endsection
