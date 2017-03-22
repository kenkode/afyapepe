
@extends('layouts.show')
@section('title', 'vist')
@section('content')
<div class="row  border-bottom white-bg dashboard-header">

                <div class="col-md-3">
                  @foreach($patientvisit as $pdetails)

                  <h2>{{$pdetails->firstname}} {{$pdetails->secondName}}</h2>

                    <small>You have 42 messages and 6 notifications.</small>
                    <ul class="list-group clear-list m-t">
                        <li class="list-group-item fist-item">
                            <span class="pull-right">
                              <?php $gender=$pdetails->gender;?>
                                @if($gender==1){{"Male"}}@else{{"Female"}}@endif
                            </span>
                            Gender

                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                              {{$pdetails->dob}}
                            </span>
                            Date of Birth
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                {{$pdetails->nationalId}}
                            </span>
                          National ID
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                              {{$pdetails->constituency}}
                            </span>
                          Constituency
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                12:00 am
                            </span>
                        Write a letter to Sandra
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                        <h2>Next of kin info</h2>
                        <small>.</small>
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="pull-right">
                                     {{$pdetails->kin_name}}
                                </span>
                                Name
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    {{$pdetails->relation}}
                                </span>
                                Relation
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                  {{$pdetails->phone_of_kin}}
                                </span>
                                Phone
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                  {{$pdetails->constituency}}
                                </span>
                                Constituency
                            </li>
                            <li class="list-group-item">
                                <span class="pull-right">
                                    12:00 am
                                </span>
                              Write a letter to Sandra
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                          <h2>Observations </h2>
                            <small>.</small>
                          <ul class="list-group clear-list m-t">
                              <li class="list-group-item fist-item">
                                  <span class="pull-right">
                                  {{$pdetails->chief_compliant}}
                                  </span>
                                  Chief Complain
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right">
                                {{$pdetails->observation}}
                                  </span>
                                Observation
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right">
                                  {{$pdetails->Doctor_note}}
                                  </span>
                             Doctor Note
                              </li>
                              <li class="list-group-item">
                                  <span class="pull-right">
                                    {{$pdetails->constituency}}
                                  </span>
                                  Constituency
                              </li>

                          </ul>
                      </div>
                      <div class="col-md-3">
                      <h2>TRIAGE INFO</h2>
                      <small>.</small>
                      <ul class="list-group clear-list m-t">
                          <li class="list-group-item fist-item">
                              <span class="pull-right">
                                  {{$pdetails->facility_id}}

                              </span>
                             Facility
                          </li>
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
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                       <tr>
                         <th></th>

                           <th>Drug Name</th>
                           <th>Facility Name</th>
                           <th>Available</th>
                           <th>Dosage Form</th>
                           <th>Dose given</th>
                           <th>Date given</th>
                     </tr>
                   </thead>

                   <tbody>
                     <?php $i =1; ?>

                  @foreach($prescription as $presc)
                          <tr>
                             <td>{{ +$i }}</td>
                          <td>{{$presc->drugname}}</td>
                           <td>{{$presc->FacilityName}}</td>
                           <td>{{$presc->availability}}</td>
                           <td>{{$presc->doseform}}</td>
                           <td>{{$presc->dosage}}</td>
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

@endforeach
        </div><!--container-->
      </div><!--content-->


@endsection
