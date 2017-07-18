
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
                                                @if($patient->persontreated=="Self")                
                                                <?php $parent=DB::table('afya_users')->where('id',$patient->afya_user_id)->first(); ?>                 
                                                 <td><a href="{{route('nurse.show',$parent->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{route('nurse.show',$parent->id)}}">{{$parent->firstname}} {{$parent->secondName}}</a></td>
                                                          <td><?php $gender=$parent->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a>
                                                          </td>
                                
                                  <td><?php $dob=$parent->dob;
                                  $interval = date_diff(date_create(), date_create($dob));
                             $age= $interval->format(" %Y Year, %M Months, %d Days Old");?> {{$age}}

                             </td>
                               <td><?php $status=$patient->p_status;
                               

                                   ?>@if($status==11)<a href="{{url('nurse.existapp',$parent->id)}}">{{"Existing"}}</a>@else<a href="{{route('nurse.show',$parent->id)}}">{{"New"}}</a>@endif</td>
                                                @else
                                    <?php $depid=$patient->persontreated; $dep=DB::table('dependant')->where('id',$depid)->first(); ?>
                                                          <td><a href="{{url('nurse.dependents',$dep->id)}}">{{$i}}</a></td>
                                                          <td><a href="{{url('nurse.dependents',$dep->id)}}">{{$dep->firstName}} {{$dep->secondName}}</a></td>
                                                          <td>{{$dep->gender}}
                                                          </td>
                                                         <td><?php
                                                         $ddob=$dep->dob;
                                                          $intervals = date_diff(date_create(), date_create($dep->dob));
                             $dage= $intervals->format(" %Y Year, %M Months, %d Days Old");?>

                              {{$dage}}</td></td>
                               <td><?php $st=$patient->p_status;
                               

                                   ?>@if($st==11)<a href="{{url('nurse.deexistapp',$dep->id)}}">{{"Existing"}}</a>@else <a href="{{url('nurse.dependents',$dep->id)}}">{{"New"}}</a>@endif</td>

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
