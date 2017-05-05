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
         $pname = $pdetails->firstname;
         $lname = $pdetails->secondName;
         $facilty = $pdetails->FacilityName;
        $faciltyid = $pdetails->FacilityCode;
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

 $appStatue=$stat;
if ($appStatue == 2) {
  $appStatue ='ACTIVE';
} elseif ($stat == 3) {
  $appStatue='Discharged Outpatient';
} elseif ($stat == 4) {
  $appStatue='Admitted';
} elseif ($stat == 5) {
  $appStatue='Refered';
}
elseif ($stat == 6) {
  $appStatue='Discharged Intpatient';
}



}
?>

    <div class="ibox-title">
        <h5>{{$pname }}{{$lname}}</h5>
        <div class="ibox-tools">
            <button type="btn" class="btn btn-primary">{{$appStatue}}</button>

            <a class="collapse-link">{{$facilty}}  </a>
        </div>
      </div>


<!--tabs-->
        <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                  <li><a  href="{{route('showPatient',$app_id)}}">Home</a></li>
                    <li class="active"><a data-toggle="tab" href="#tab-1">Today's Triage</button></a></li>
                    <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
                    <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
                    <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
                    <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
                     <?php if ($stat==2) { ?>
                    <li class=""><a href="{{route('admit',$app_id)}}">Admit</a></li>
                    <?php } ?>
                     <?php if ($stat==4) { ?>
                    <li class=""><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
                     <?php } ?>
                      <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
                <?php if ($stat==2) { ?>
                    <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
                <?php } ?>
              </ul>
              <!-- </div> -->
                <div class="tab-content">
                  <!--tabs1-->
                  <div id="tab-1" class="tab-pane active">
                    <?php if ($pdetails->persontreated=='Self') {
                    ?>
                          @include('doctor.triage')
                    <?php }
                    if ($dependantdays <='28') {
                      ?>
               @include('doctor.triage28')

                     <?php } elseif ($dependantdays <='413') {
                       ?>
                @include('doctor.triage59')

                <?php } else  {
                  ?>
                @include('doctor.triage')

                      <?php } ?>


                   </div><!--tabs1-->




  <!--tabs5 Admit-->
<div id="tab-5" class="tab-pane">



                            <div class="panel-body">
                                    {{ Form::open(array('route' => array('admitting'),'method'=>'POST')) }}

                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                          <!-- <input type="text" class="form-control" name="next_appointment" value="{{$facilty}}"> -->

                                        <select id="facility" name="facility" class="form-control facility1" style="width: 100%"></select>
                                    </div>
                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Doctor Visit</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_appointment" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',4, array('class' => 'form-control')) }}
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
                                    {{ Form::open(array('route' => array('discharging'),'method'=>'POST')) }}


                                      <div class="form-group col-md-8 col-md-offset-1" id="data_1">
                                          <label class="font-normal">Next Appointment Date</label>
                                          <div class="input-group date">
                                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              <input type="text" class="form-control" name="next_visit" value="">
                                          </div>
                                      </div>
                                  {{ Form::hidden('appointment_status',3, array('class' => 'form-control')) }}
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
                                    {{ Form::open(array('route' => array('transfer'),'method'=>'POST')) }}
                                    <div class="form-group col-md-8 col-md-offset-1">
                                        <label for="presc" class="col-md-6">Facility:</label>
                                        <select id="facility" name="facility_to" class="form-control facility1" style="width: 100%"></select>
                                    </div>

                                   {{ Form::hidden('facility_from',$faciltyid, array('class' => 'form-control')) }}
                                   {{ Form::hidden('appointment_status',5, array('class' => 'form-control')) }}
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
