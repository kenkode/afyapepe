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
              <div class="col-lg-12 tbg">
                <ul class="nav nav-tabs">
                    <li class="active btn"><a data-toggle="tab" href="#tab-1">Home</button></a></li>
                    <li class="btn"><a data-toggle="tab" href="#tab-2">History</a></li>
                    <li class="btn"><a data-toggle="tab" href="#tab-3">Tests</a></li>
                    <li class="btn"><a data-toggle="tab" href="#tab-4">Prescriptions</a></li>
                    <li class="btn"><a data-toggle="tab" href="#tab-5">End Visit</a></li>
                </ul>
              </div>
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
                                      <div class="col-md-4">
                                       <h5><strong>Allergies:</strong><?php echo $allergies;?></h5>
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


<div class="col-md-8">
<div class="form-group ">
    <label for="d_list2">Conditional Diagnosis:</label>
    <select id="d_list2" name="conditional" class="form-control"></select>
</div>
<div class="form-group">
    <label for="tag_list">Select Test:</label>
    <select id="tag_list" name="test" class="form-control" ></select>
</div>
</div>


{{ Form::hidden('patient_id',$pdetails->pat_id, array('class' => 'form-control')) }}
{{ Form::hidden('test_status',1, array('class' => 'form-control')) }}
{{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
{{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}


<div class="form-group">
  <label for="tag_list"><br />Doctor Note:</label>
{{ Form::textarea('doc_note', null, array('placeholder' => 'note..','class' => 'form-control')) }}
</div>

<div class="form-group  text-center">
<button type="submit" class="btn btn-primary">Submit</button>  </td>
</div>
{{ Form::close() }}
</div>
</div>

<button>Test Results</button>
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





















              </div><!--tabcontent-->
          </div><!--tabs-container-->
        </div><!--col12-->
        <!--tabs-->
        <div class="col-md-4">
        <div class="form-group ">
            <label for="d_list2">Conditional Diagnosis:</label>
            <select id="d_list2" name="conditional" class="form-control " ></select>
        </div>
        <div class="form-group">
            <label for="tag_list">Select Test:</label>
            <select id="tag_list" name="test" class="form-control" ></select>
        </div>
      </div>
            </div>
        </div><!--row-->
  </div><!--wrapper-->


</body>
</html>
@endsection
