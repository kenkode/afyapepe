@extends('layouts.show')
@section('title', 'vist')
@section('content')
<?php
      foreach ($patientvisit as $pdetails) {
        // $patientid = $pdetails->pat_id;

      }
        ?>
<div class="row  border-bottom white-bg dashboard-header">
  <a href="{{route('showPatient',$pdetails->appointment_id)}}">BACK<i class="fa fa-arrow-circle-o-left"></i></a>
  <div>

  <h3>{{$pdetails->firstname}} {{$pdetails->secondName}}</h3>
  <small>Patient Name</small>
</div>

<div class="col-md-4">
  <ul class="list-group clear-list m-t">
    <h3>Today's Vitals </h3>
    <li class="list-group-item">
        <span class="pull-right">
          {{$pdetails->temperature}}
        </span>
        Temperature
    </li>
    <li class="list-group-item">
        <span class="pull-right">
          {{$pdetails->current_weight}}
        </span>
       Weight
    </li>
    <li class="list-group-item">
        <span class="pull-right">
           {{$pdetails->current_height}}
        </span>
     Height
    </li>
    <li class="list-group-item">
        <span class="pull-right">
         {{$pdetails->diastolic_bp}}
        </span>
        Diastolic BP
    </li>
    <li class="list-group-item">
        <span class="pull-right">
        {{$pdetails->systolic_bp}}
        </span>
       Systolic BP
    </li>

</ul>

</div>
    <div class="col-md-4">
          <ul class="list-group clear-list m-t">
                <h3>Chief Complain</h3>
                 <li class="list-group-item">
              {{$pdetails->chief_compliant}}
              </span>
              </li>
              </ul>
              </div>

                <div class="col-md-4">
                        <ul class="list-group clear-list m-t">
                          <h3>Observations </h3>
                          <li class="list-group-item">
                            {{$pdetails->observation}}
                          </li>

                        </ul>
                    </div>



        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">

                              <div class="col-lg-12">
                              <div class="ibox float-e-margins">
                                  <div class="ibox-title">
                                      <h5>All Test Done</h5>
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
                      </div>
                  </div>



                    <div class="col-lg-12">
                    <div class="ibox float-e-margins">
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
                            <th>Drug Replaced By</th>
                            <th>Dosage Form</th>
                           <th>Strength</th>
                           <th>Strength Unit</th>
                           <th>Date given</th>
                           <th>Date Bought</th>
                           <th>Status</th>

                     </tr>
                   </thead>

                   <tbody>
                     <?php $i =1; ?>

                  @foreach($prescription as $presc)
                          <tr>
                             <td>{{ +$i }}</td>
                           <td>{{$presc->name}}</td>
                           <td>{{$presc->drugname}}</td>
                           <td>{{$presc->drugname}}</td>
                           <td>{{$presc->doseform}}</td>
                           <td>{{$presc->strength}}</td>
                           <td>{{$presc->strength_unit}}</td>
                           <td>{{$presc->created_at}}</td>
                           <td>{{$presc->created_at}}</td>
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


        </div><!--container-->
      </div><!--content-->


@endsection
