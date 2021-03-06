@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">



            <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">

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
                              @if($facilitycode->facilitycode == 1111)

                              <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>Name</th>
                                                          <th>Age</th>
                                                          <th>Gender</th>

                                                          <th>Date</th>
                                                          <th>Time</th>

                                                <th>Date of Birth</th>
                                                  <th>Place of Birth</th>
                                                  <th>Constituency of Residence</th>
                                                  <th>County of Residence</th>



                                                    </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php $i=1; ?>
                                                    @foreach($users as $user)
                                                  <tr>
                                                    <td><a href="{{URL('registrar.selects',$user->id)}}">{{$i}}</a></td>
                                                    <td><a href="{{URL('registrar.selects',$user->id)}}">{{$user->firstname}} {{$user->secondName}}</a></td>
                                                    <td><a href="{{URL('registrar.selects',$user->id)}}">{{$user->age}}</a></td>
                                                    <td><?php $gender=$user->gender;?>
                                                      @if($gender==1){{"Male"}}@else{{"Female"}}@endif</td>

                                                     <td><?php $dt=$user->created_at; echo date("d-m-Y ", strtotime( $dt));?> </td>
                                                    <td><?php $dy=$user->created_at; echo date("g-i-a ", strtotime( $dy));?></td>
                                                    <td>{{$user->dob or ''}}</td>
                                                    <td>{{$user->pob or ''}}</td>
                                                    <td>{{$user->Constituency or ''}}</td>
                                                    <td><?php
                                                    if ($user->cont_id != "") {$county=DB::Table('county')->where('id',$user->cont_id)->first();
                                                    echo $county->county;}
                                                    else{ echo "";} ?>
                                                  </td>

                                                  </tr>
                                                    <?php $i++; ?>

                                                 @endforeach
                                                   </tbody>

                                                 </table>
                                                     </div>

                              @else

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>Name</th>
                                                          <th>Age</th>
                                                          <th>Gender</th>

                                                          <th>Date</th>
                                                          <th>Time</th>

                                                <th>Date of Birth</th>
                                                  <th>Place of Birth</th>
                                                  <th>Constituency of Residence</th>
                                                  <th>County of Residence</th>



                                                    </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php $i=1; ?>
                                                    @foreach($users as $user)
                                                  <tr>
                                                    <td><a href="{{URL('registrar.select',$user->id)}}">{{$i}}</a></td>
                                                    <td><a href="{{URL('registrar.select',$user->id)}}">{{$user->firstname}} {{$user->secondName}}</a></td>
                                                    <td><a href="{{URL('registrar.select',$user->id)}}">{{$user->age}}</a></td>
                                                    <td><?php $gender=$user->gender;?>
                                                      @if($gender==1){{"Male"}}@else{{"Female"}}@endif</td>

                                                     <td><?php $dt=$user->created_at; echo date("d-m-Y ", strtotime( $dt));?> </td>
                                                    <td><?php $dy=$user->created_at; echo date("g-i-a ", strtotime( $dy));?></td>
                                                    <td>{{$user->dob or ''}}</td>
                                                    <td>{{$user->pob or ''}}</td>
                                                    <td>{{$user->Constituency or ''}}</td>
                                                    <td><?php
                                                    if ($user->cont_id != "") {$county=DB::Table('county')->where('id',$user->cont_id)->first();
                                                    echo $county->county;}
                                                    else{ echo "";} ?>
                                                  </td>

                                                  </tr>
                                                    <?php $i++; ?>

                                                 @endforeach
                                                   </tbody>

                                                 </table>
                                                     </div>
                                              @endif

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
