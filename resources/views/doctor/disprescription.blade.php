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
      foreach ($patientD as $pdetails) {
         $stat= $pdetails->status;
          $afyauserId= $pdetails->afya_user_id;
          $dependantId= $pdetails->persontreated;
          $app_id= $pdetails->id;
          $doc_id= $pdetails->doc_id;
          $fac_id= $pdetails->facility_id;
          $dependantAge= $pdetails->depdob;
        $condition = $pdetails->condition;

 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;
 $dependantdays= floor($datediff / (60 * 60 * 24));

}
?>

          <?php  $routem= (new \App\Http\Controllers\TestController);
                $routems = $routem->RouteM();
            ?>
          <?php $Strength= (new \App\Http\Controllers\TestController);
                $Strengths = $Strength->Strength();
            ?>
          <?php $frequency= (new \App\Http\Controllers\TestController);
                $frequent = $frequency->Frequency();
            ?>



                <div class="ibox-title">
                  <?php if ($dependantId =='Self') { ?>
                 <h5>{{$pdetails->firstname}} {{$pdetails->secondName}}</h5>
                    <div class="ibox-tools">
                      <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
                    </div>

               <?php     }else{  ?>
                  <h5>{{$pdetails->dep1name}} {{$pdetails->dep2name}}</h5>
                 <div class="ibox-tools">
                   <a class="collapse-link">{{$pdetails->FacilityName}}  </a>
                 </div>
                 <?php   } ?>
               </div>
<div class="ibox float-e-margins">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
      <li><a  href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
      <li><a href="{{route('patienthistory',$app_id)}}">History</a></li>
      <li><a href="{{route('testes',$app_id)}}">Tests</a></li>
      <li><a href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
      <li><a href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
      @if ($condition =='Admitted')
      <li><a href="{{route('discharge',$app_id)}}">Discharge</a></li>
      @else  <li><a href="{{route('admit',$app_id)}}">Admit</a></li>@endif
      <li cl ass=""><a href="{{route('transfering',$app_id)}}">Transfer</a></li>
      <li class="btn btn-primary"><a href="{{route('endvisit',$app_id)}}">End Visit</a></li>
      </ul>
      <ul class="nav nav-tabs">
      <li class=""><a href="{{route('discharge',$app_id)}}"> Discharge Condition</a></li>
      <li class=""><a href="{{route('disdiagnosis',$app_id)}}"> Discharge Diagnosis</a></li>
      <li class="active"><a href="{{route('disprescription',$app_id)}}">Discharge Prescription</a></li>
      </ul>
                  <div class="col-sm-5 b-r">
                  <div class="table-responsive ibox-content">
                  <table class="table table-striped table-bordered table-hover " >
                  <thead>
                  <tr>
                  <th>Diagnosis</th>
                  <th>Level</th>
                  <th>Severity</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($Pdiagnosis as $tstdn)
                  <tr>
                  <td>{{$tstdn->name}}</td>
                  <td>{{$tstdn->level}}</td>
                  <td>{{$tstdn->severity}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  </table>
                  </div>
                  </div>

          <div class="col-sm-7">
          <div class="ibox-content">
          <br />
          {{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}
          <div class="form-group">

          <div class="form-group">
          <label for="dosage" class="col-md-4">Prescription For:</label></td>
          <select class="form-control m-b col-md-8" name="disease_id" id="example-getting-started" style="width: 50%">
          <?php $druglists=DB::table('druglists')->distinct()->get(['DosageForm']); ?>
          @foreach($Pdiagnosis as $tstdn)
          <option value='{{$tstdn->id}}'>{{$tstdn->name}}</option>
          @endforeach
          </select>
          </div>


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
          </div>

          <div class="form-group">
          <label for="dosage" class="col-md-4 control-label">Strength Unit</label></td>
          <input type="radio" name="strength_unit" value="ml"> Ml
          &nbsp;&nbsp;<input type="radio" name="strength_unit" value="mg"> Mg
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
          {{ Form::hidden('state','Discharge', array('class' => 'form-control')) }}
          {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
          {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
           <div class="form-group  text-center">
          <button type="submit" class="btn btn-primary">Submit</button>  </td>
          </div>
          {{ Form::close() }}
          </div>
          </div>
<?php $i =1;
if ($dependantId =='Self') {
  $tstdone = DB::table('appointments')
  ->leftJoin('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
  ->leftJoin('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
  ->leftJoin('diagnoses', 'prescription_details.diagnosis', '=', 'diagnoses.id')
  ->leftJoin('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
  ->leftJoin('frequency', 'prescription_details.frequency', '=', 'frequency.id')
  ->leftJoin('route', 'prescription_details.routes', '=', 'route.id')
  ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
  ->select('diagnoses.name','druglists.drugname','frequency.name as frequency','prescriptions.created_at','prescription_details.created_at as dater',
  'route.name as route','prescription_filled_status.start_date','prescription_filled_status.end_date')
  ->where('appointments.afya_user_id', '=',$afyauserId)
  ->orderBy('dater', 'desc')
  ->get();

}else {

  $tstdone = DB::table('appointments')
  ->leftJoin('prescriptions', 'appointments.id', '=', 'prescriptions.appointment_id')
  ->leftJoin('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
  ->leftJoin('diagnoses', 'prescription_details.diagnosis', '=', 'diagnoses.id')
  ->leftJoin('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
  ->leftJoin('frequency', 'prescription_details.frequency', '=', 'frequency.id')
  ->leftJoin('route', 'prescription_details.routes', '=', 'route.id')
  ->leftJoin('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
  ->select('diagnoses.name','druglists.drugname','frequency.name as frequency','prescriptions.created_at','prescription_details.created_at as dater',
  'route.name as route','prescription_filled_status.start_date','prescription_filled_status.end_date')
  ->where('appointments.persontreated', '=',$dependantId)
  ->orderBy('dater', 'desc')
  ->get();
}
?>

                                              <div class="col-lg-12">
                                                <div class="ibox float-e-margins">
                                                  <div class="ibox-content col-md-12">
                                                  <div class="ibox-title">
                                                      <h5>Prescription History</h5>
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
                                                      <th>Start Date</th>
                                                      <th>Stop Date</th>
                                                      <th>Frequeny</th>
                                                      <th>Route</th>
                                               </tr>
                                             </thead>

                                             <tbody>
                                               <?php $i =1; ?>

                                                    @foreach($tstdone as $tstdn)
                                                    <tr>
                                                    <td>{{ +$i }}</td>
                                                     <td>{{$tstdn->name}}</td>
                                                     <td>{{$tstdn->drugname}}</td>
                                                      <td>{{$tstdn->start_date}}</td>
                                                      <td>{{$tstdn->end_date}}</td>
                                                      <td>{{$tstdn->frequency}}</td>
                                                      <td>{{$tstdn->route}}</td>

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
                        </div>
                    @endsection
