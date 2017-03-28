@extends('layouts.patient')
@section('title', 'Patient Details')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">

  <div class="wrapper wrapper-content animated fadeInRight">
  <div class="panel-body">
  <div class="col-lg-4">
                     <div class="widget navy-bg ">

                                <h2>
                                    {{$patient->firstname}} {{$patient->secondName}}
                                </h2>
                        <ul class="list-unstyled m-t-md">
                            <li>
                                <span class="fa fa-users m-r-xs"></span>
                                <label>Age:</label>
                                {{$patient->age}}
                            </li>
                            
                            <li>
                                <span class="fa  fa-genderless m-r-xs"></span>
                                <label>Gender:</label>
                                @if($patient->gender==1){{"Male"}}@else{{"Female"}}@endif
                            </li>
                        </ul>

                    </div>

          </div>

     <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Allergy List</button></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Vaccinations List</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Patient History</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Patient Tests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Patient Prescriptions</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Hospital Admission</a></li>
                    
                </ul>
                <br>
         <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
                        
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Your Allergy List</h5>
                        <div class="ibox-tools">
                          @role('Patient')
                           <a class="collapse-link">

                          </a>  @endrole
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
                            <th>No</th>
                            <th>Name</th>
                            <th>Description </th>

                            

                      </tr>
                    </thead>

                    <tbody>


                     </tbody>
                   </table>
                       </div>

                   </div>
               </div>
           </div>
           </div>
      
       </div>
      <div id="tab-2" class="tab-pane">
       <div class="wrapper wrapper-content animated fadeInRight">
                 <div class="row">
                     <div class="col-lg-11">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <h5>Your Vaccinations List</h5>
                             <div class="ibox-tools">
                               @role('Patient')
                                <a class="collapse-link">

                               </a>  @endrole
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
                                 <th>No</th>
                                 <th>Antigen</th>
                                <th>Vaccinations Name</th>
                                <th>Location(Facility)</th>
                                 <th>Date </th>

                                 <!-- <th>Constituency of Residence</th> -->

                           </tr>
                         </thead>

                         <tbody>
                         <?php $i=1;
                         $vaccines=DB::table('vaccination')->
                         join('vaccine','vaccine.id','=','vaccination.diseaseId')->
                         select('vaccine.*','vaccination.*')
                         ->where('vaccination.userId',$patient->id)
                         ->where('vaccination.yes','=','yes')->
                         Orderby('yesdate','desc')->get();
                         ?>
                         @foreach($vaccines as $vaccine)
                         <tr>
                         <td>{{$i}}</td>
                         <td>{{$vaccine->antigen}}</td>
                         <td>{{$vaccine->vaccine_name}}</td>
                         <td>St Jude's Huruma Community Health Services</td>
                          <td>{{ date('d -m- Y', strtotime($vaccine->yesdate)) }}</td>
                         
                         </tr>

                         <?php $i++ ?>
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
      <div id="tab-3" class="tab-pane">
      <div class="wrapper wrapper-content animated fadeInRight">
                 <div class="row">
                     <div class="col-lg-11">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <h5>Your Patient History</h5>
                             <div class="ibox-tools">
                               @role('Patient')
                                <a class="collapse-link">

                               </a>  @endrole
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
                                 <th>No</th>
            <th>Date</th>
            <th>Time</th>
           <th>Weight</th>
           <th>Height</th>
           <th>BMI</th>
           <th>Temperature</th>
           <th>Systolic_bp</th>
           <th>Diastolic_bp</th>
           <th>Chief Compliant</th>

                                 <!-- <th>Constituency of Residence</th> -->

                           </tr>
                         </thead>

                         <tbody>
                         <?php $i=1;
                         $triages=DB::table('triage_details')->join('appointments','appointments.id','=','triage_details.appointment_id')
                         ->select('triage_details.*')->where('appointments.afya_user_id',$patient->id)->Orderby('triage_details.updated_at','desc')->get();
                        ?>
                        @foreach($triages as $triage)
                        <tr>
                         <td>{{$i}}</td>
            <td>{{ date('d -m- Y', strtotime($triage->updated_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($triage->updated_at)) }}</td>
           <td>{{$triage->current_weight}}</td>
           <td>{{$triage->current_height}}</td>
            <td><?php $height=$triage->current_height; $weight=$triage->current_weight;
               $bmi =$weight/($height*$height);
               echo number_format($bmi, 2);
            ?></td>
           <td>{{$triage->temperature}}</td>
          <td>{{$triage->systolic_bp}}</td>
         <td>{{$triage->diastolic_bp}}</td>
         <td>{{$triage->chief_compliant}}</td>
         </tr>
                          <?php $i++ ?>
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
            <div id="tab-4" class="tab-pane">
            <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>Your Patient Tests</h5>
                                  <div class="ibox-tools">
                                    @role('Patient')
                                     <a class="collapse-link">

                                    </a>  @endrole
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
                                      <th>No</th>
                                      <th>Date</th>

                                      <th>Test Type</th>
                                      <th>Test</th>
                                      <th>Doctor Name</th>
                                      <th>Status</th>
                                      <th>Cost</th>

                                      <!-- <th>Constituency of Residence</th> -->

                                </tr>
                              </thead>

                              <tbody>
                              <?php $i=1; 
                              $tests=DB::table('patient_test')
                                 ->join('appointments','appointments.id','=','patient_test.appointment_id')
                                 ->join('patient_test_details','patient_test_details.patient_test_id','=','patient_test.id')->select('patient_test.*','patient_test_details.*')->
                              where('appointments.afya_user_id',$patient->id)->get(); ?>
                              @foreach($tests as $test)
                              <tr>
                              <td>{{$i}}</td>
                              </tr>

                               <?php $i++ ?>
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
                 <div id="tab-5" class="tab-pane">
                 <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>Your Patient Prescriptions</h5>
                                  <div class="ibox-tools">
                                    @role('Patient')
                                     <a class="collapse-link">

                                    </a>  @endrole
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
                                      <th>No</th>
                                      <th>Date</th>
                                      <th>Test Type</th>
                                      <th>Test</th>
                                      <th>Doctor Name</th>
                                      <th>Status</th>
                                      <th>Cost</th>

                                      <!-- <th>Constituency of Residence</th> -->

                                </tr>
                              </thead>

                              <tbody>


                               </tbody>
                             </table>
                                 </div>

                             </div>
                         </div>
                     </div>
                     </div>
                 </div>
                 </div>
                 <div id="tab-6" class="tab-pane">
                 <div class="wrapper wrapper-content animated fadeInRight">
                           <div class="row">
                               <div class="col-lg-11">
                               <div class="ibox float-e-margins">
                                   <div class="ibox-title">
                                       <h5>Your Hospital Admission</h5>
                                       <div class="ibox-tools">
                                         @role('Patient')
                                          <a class="collapse-link">

                                         </a>  @endrole
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
                                           <th>No</th>
                                           <th>Date</th>
                                           <th>Date of Admission</th>
                                           <th>Date of Discharge</th>
                                           <th>Chief Complaint</th>
                                           <th>Diagnosis</th>
                                           <th>Procedure Performed</th>
                                           <th>Discharge Summary</th>

                                           <!-- <th>Constituency of Residence</th> -->

                                     </tr>
                                   </thead>

                                   <tbody>


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
                      <br><br>
       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
