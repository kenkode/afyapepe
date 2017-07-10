@extends('layouts.patient')
@section('title', 'Patient Tests')
@section('content')

  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
          <div class="row">
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
                             <li>
                                <span class="fa  fa-medkit m-r-xs"></span>
                                <label>Blood Type:</label>
                                {{$patient->blood_type}}
                            </li>

                           <li>
                                <span class="fa  fa-map m-r-xs"></span>
                                <label>Constituency:</label>
                                <?php $const=$patient->constituency; $cons=DB::table('constituency')->where('id',$const)->first();?>{{$cons->Constituency}}
                            </li>
                             <li>
                                <span class="fa  fa-map m-r-xs"></span>
                                <label>County:</label>
                                <?php $county=DB::Table('county')->where('id',$cons->cont_id)->first();?> {{$county->county}}
                            </li>
                             <li>
                                <span class="fa  fa-phone m-r-xs"></span>
                                <label>Phone:</label>
                                {{$patient->msisdn}}
                            </li>
                        </ul>

                    </div>

          </div>
           <div class="col-lg-8">
           </div>
          </div>
    <div class="row">       
  <div class="col-lg-12">

 
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">This Week</button></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">This Month</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">This Year</a></li>
                    
                    
                </ul>
                <br>
          <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
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
                            <th>Patient Name</th>
                            <th>Amount(Kshs)</th>
                          

                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>
 
                    <tbody>

                    <?php $i=1;
                     
                  
                    $expenditures=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')
                    ->whereBetween('created_at', [
    Carbon\Carbon::now()->startOfWeek(),
    Carbon\Carbon::now()->endOfWeek(),
])
                    ->orderby('created_at','desc')->get(); ?>
                    @foreach($expenditures as $exp)
                      <tr>
                      <td>{{$i}}</td>
                       <td>{{ date('d -m- Y', strtotime($exp->created_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($exp->created_at)) }}</td>
                      <td><?php $facility=$exp->facility; $name=DB::table('facilities')->where('FacilityCode',$facility)->first();?>{{$name->FacilityName}}</td>
                        <td><?php $person=$exp->person_treated; if($person=='Dependent'){
                          $user=DB::table('dependant')->where('id',$exp->dependent_id)->first();
                          echo $user->firstName." ".$user->secondName; }
                          else{ echo "Primary";
                            }?></td>
                      <td>{{$exp->amount}}</td>
                      </tr>
                      <?php $i++ ?>
                      @endforeach
                       </tbody>
<?php $wekexp=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')->whereBetween('created_at', [
    Carbon\Carbon::now()->startOfWeek(),
    Carbon\Carbon::now()->endOfWeek(),
])->sum('amount'); ?>
 <td></td><td></td><td></td><td>Total</td><td></td><td>{{$wekexp}}</td>
                    
                   </table>
                       </div>

                   </div>
               </div>
           </div>
           </div>
           </div>
           <div id="tab-2" class="tab-pane">
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
                            <th>Patient Name</th>
                            
                            <th>Amount(Kshs)</th>
                          

                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                    <?php $i=1;

                    $expenditures=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')->whereBetween('created_at', [
    Carbon\Carbon::now()->startOfMonth(),
    Carbon\Carbon::now()->endOfMonth(),
])->orderby('created_at','desc')->get(); ?>
                    @foreach($expenditures as $mexp)
                      <tr>
                      <td>{{$i}}</td>
                       <td>{{ date('d -m- Y', strtotime($mexp->created_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($mexp->created_at)) }}</td>
                      <td><?php $facility=$mexp->facility; $name=DB::table('facilities')->where('FacilityCode',$facility)->first();?>{{$name->FacilityName}}</td>
                      <td><?php $mperson=$mexp->person_treated; if($mperson=='Dependent'){
                          $userm=DB::table('dependant')->where('id',$mexp->dependent_id)->first();
                         echo $userm->firstName." ".$userm->secondName;} else{ echo "Primary";}?></td>
                      <td>{{$mexp->amount}}</td>
                      </tr>
                      <?php $i++ ?>
                      @endforeach
                      </tbody>
          <?php $monthexp=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')->whereBetween('created_at', [
    Carbon\Carbon::now()->startOfMonth(),
    Carbon\Carbon::now()->endOfMonth(),
])->sum('amount'); ?>
                <td></td><td></td><td></td><td>Total</td><td></td><td>{{$monthexp}}</td>
                     
                   </table>
                       </div>

                   </div>
               </div>
           </div>
           </div>
           </div>
           <div id="tab-3" class="tab-pane">
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
                            <th>Patient Name</th>
                            <th>Amount(Kshs)</th>
                          

                            <!-- <th>Constituency of Residence</th> -->

                      </tr>
                    </thead>

                    <tbody>
                    <?php $i=1;
                    $expenditures=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')
                    ->whereYear('created_at','=',date("Y"))
                    ->where('fee_required','=','Yes')->orderby('created_at','desc')->get(); ?>
                    @foreach($expenditures as $yexp)
                      <tr>
                      <td>{{$i}}</td>
                       <td>{{ date('d -m- Y', strtotime($yexp->created_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($yexp->created_at)) }}</td>
                     <td><?php $facility=$yexp->facility; $name=DB::table('facilities')->where('FacilityCode',$facility)->first();?>{{$name->FacilityName}}</td>
                       <td><?php $yperson=$yexp->person_treated; if($yperson=='Dependent'){
                          $usery=DB::table('dependant')->where('id',$yexp->dependent_id)->first();
                          echo $usery->firstName." ".$usery->secondName;} else{
                            echo "Primary";
                            }?></td>
                      <td>{{$yexp->amount}}</td>
                      </tr>
                      <?php $i++ ?>
                      @endforeach
                       </tbody>
                   
  <?php $yearexp=DB::table('consultation_fees')->where('afyauser_id',$patient->id)
                    ->where('fee_required','=','Yes')->whereYear('created_at','=',date("Y"))
 ->sum('amount'); ?>
 <td></td><td></td><td></td><td>Total</td><td></td><td>{{$yearexp}}</td>
                    </table>
                       </div>

                   </div>
               </div>
           </div>
           </div>
           </div>



           </div>
       
       

     

         

@endsection
