@extends('layouts.patient')
@section('title', 'Patient Tests')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
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

  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Health Expenditures </h5>
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
                            <th>Facility</th>
                            
                            <th>Amount(Kshs)</th>
                          

                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                    <?php $i=1;
                    $expenditures=DB::table('fees')->where('patient_id',$patient->id)
                    ->where('type','=','Yes')->orderby('created_at','desc')->get(); ?>
                    @foreach($expenditures as $exp)
                      <tr>
                      <td>{{$i}}</td>
                       <td>{{ date('d -m- Y', strtotime($exp->created_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($exp->created_at)) }}</td>
                      <td>St Jude's Huruma Community Health Services</td>
                      <td>{{$exp->amount}}</td>
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

       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
