
@extends('layouts.nurse')
@section('title', 'New patients')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info"></span>
      <div class="content">
          <div class="container">



            <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-10 col-lg-offset-1">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                               <h5>Today Patient  Details</h5>

                                  <div class="ibox-tools">

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
                                                          <th>Gender</th>
                                                          <th>Age</th>
                                                          <th>Appointment Status</th>
                                                          <th>Date</th>
                                                    </tr>
                                                  </thead>


                                                  <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($patients as $patient)
                                                      <tr>
                                                @if($patient->persontreated==="Self")                                                
                                                 <td><a href="{{route('nurse.show',$patient->parid)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('nurse.show',$patient->parid)}}">{{$patient->first}} {{$patient->second}}</a></td>
                                                          <td><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                                                          </td>
                                
                                  <td><?php $dob=$patient->dob;
                                  $interval = date_diff(date_create(), date_create($dob));
                             $age= $interval->format(" %Y Year, %M Months, %d Days Old");?> {{$age}}

                             </td>
                               <td><?php $status=$patient->parid;
                               $app=DB::table('appointments')->orderby('created_at', 'desc')->where('afya_user_id',$status) ->where('created_at','<=',$today)->first();

                                   ?>@if($app->status==3)<a href="{{route('nurse.show',$patient->parid)}}">{{"New"}}</a>@else<a href="{{url('nurse.existapp',$patient->parid)}}">{{"Existing"}}</a>@endif</td>
                                                @else
                                                          <td><a href="{{url('nurse.dependents',$patient->depid)}}">{{$i}}</a></td>
                                                          <td><a href="{{url('nurse.dependents',$patient->depid)}}">{{$patient->dfirst}} {{$patient->dsecond}}</a></td>
                                                          <td>{{$patient->dgender}}
                                                          </td>
                                                         <td><?php
                                                         $ddob=$patient->ddob;
                                                          $intervals = date_diff(date_create(), date_create($patient->ddob));
                             $dage= $intervals->format(" %Y Year, %M Months, %d Days Old");?>

                              {{$dage}}</td></td>
                               <td><?php $st=$patient->depid;
                               $app=DB::table('appointments')->orderby('created_at', 'desc')->where('persontreated',$st) ->where('created_at','<=',$today)->first();

                                   ?>@if($app->status==3)<a href="{{route('nurse.dependents',$patient->depid)}}">{{"New"}}</a>@else<a href="{{url('nurse.deexistapp',$patient->depid)}}">{{"Existing"}}</a>@endif</td>

                                                  @endif
                                                          
                                                

                                                          <td>{{$patient->created_at}}</td>



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
@include('includes.default.footer')
          </div><!--content-->
      </div><!--content page-->

@endsection
