@extends('layouts.patient')
@section('title', 'Patient Details')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">

  <div class="wrapper wrapper-content animated fadeInRight">
  <div class="panel-body">

          <h5><strong>Patient Name</strong>&nbsp;&nbsp;&nbsp;{{$patient->firstname}} {{$patient->secondName}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <strong>Age</strong>&nbsp;&nbsp;{{$patient->age}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <strong>Gender</strong>&nbsp;&nbsp;@if($patient->gender==1){{"Male"}}@else{{"Female"}}@endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
        </h5></div>
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Allergy List</h5>
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
       <div class="wrapper wrapper-content animated fadeInRight">
                 <div class="row">
                     <div class="col-lg-11">
                     <div class="ibox float-e-margins">
                         <div class="ibox-title">
                             <h5>Vaccinations List</h5>
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
            <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>Patient Tests</h5>
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
                 <div class="wrapper wrapper-content animated fadeInRight">
                           <div class="row">
                               <div class="col-lg-11">
                               <div class="ibox float-e-margins">
                                   <div class="ibox-title">
                                       <h5>Hospital Admission</h5>
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
       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
