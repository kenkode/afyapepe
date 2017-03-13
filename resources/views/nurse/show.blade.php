@extends('layouts.nurse')
@section('title', 'Patient Details')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
    <h3 class="marg"> Patient Details <b class="marg"> Name: {{$patient->firstname}}  {{$patient->secondName}}</b>
     <b class="marg">Age: {{$patient->age}} </b> <b class="marg">Gender: <?php $gender=$patient->gender;?>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</b></h3>
      <hr>
  </div>

                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Next of Kin Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Vaccination Details</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">Patient History </a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <strong>Next of Kin Details</strong>

                                    <div class="ibox-content">
                                          @if(is_null($kin))
                                          <form class="form-horizontal" role="form" method="POST" action="/nextkin" novalidate>
                                         <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                         <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$patient->id}}" name="id"  required>
                                          <div class="form-group">
                                         <label for="exampleInputEmail1">Name</label>
                                         <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  value="
                                          "  >
                                         </div>

                                         <div class="form-group">
                                          <label for="exampleInputPassword1">Relationship</label>
                                         <select class="form-control" name="relationship">
                                         <?php  $kin = DB::table('kin')->get();?>
                                                       @foreach($kin as $kn)
                                                        <option value="{{$kn->id}}">{{$kn->relation}}</option>
                                                      @endforeach
                                                     </select>
                                         </div>
                                          <div class="form-group">
                                         <label for="exampleInputPassword1">Phone</label>
                                         <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value=""  >
                                         </div>
                                         <button type="submit" class="btn btn-primary btn-sm">Create Details</button>
                                            {!! Form::close() !!}
                                        @else
                                          <form class="form-horizontal">
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name" value="{{$kin->kin_name}}" readonly="">
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputPassword1">Relationship</label>
                                        <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="relation"
                                        value="{{$kin->relation}}"  readonly="">
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputPassword1">Phone</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"
                                        value="{{$kin->phone_of_kin}}"readonly="">
                                        </div>
                          <a href="{{ route('createkin', $patient->id) }}" class="btn btn-primary btn-sm">Update Details</a>
                                                </div>

                                {!! Form::close() !!}
                                        @endif
                                    </div>
                                </div>

                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Vaccination Details</strong>
                                    <div class="ibox-content">


                                                                                 <table class="table table-small-font table-bordered table-striped">
                                                                              <thead>
                                                                                  <tr>
                                                                                      <th>No</th>
                                                                                      <th>Disease Name</th>
                                                                                      <th>Vaccine Name</th>
                                                                                      <th>Yes</th>

                                                                                      <th>Date</th>

                                                                                </tr>
                                                                              </thead>

                                                                              <tbody>
                                                                           <?php $i =1; ?>
                                                                             @foreach($vaccines as $vac)
                                                                                  <tr>
                                                                                      <td>{{$i}}</td>
                                                                                      <td>{{$vac->name}}</td>
                                                                                      <td>{{$vac->vaccine_name}}</td>

                                                                                      <td><?php $yes=$vac->Yes;
                                                                                        if($yes=="yes"){ echo '<p><i class="glyphicon glyphicon-ok-circle" aria-hidden="true"></i></p>';}else{ echo '<p><i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i></p>';} ?>
                                                                                        </td>
                                                                                      <td><?php if($yes!=="yes"){echo"0000:00:00";}
                                                                                      else{ echo $vac=$vac->yesdate;} ?></td>

                                                                                  </tr>
                                                                                  <?php $i++; ?>

                                                                               @endforeach


                                                                               </tbody>
                                                                             </table>
                                                                              <a href="{{ route('vaccinescreate', $patient->id) }}" class="btn btn-primary btn-sm">Update Details</a>




                                    </div>


                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <strong>Patient History</strong>
                                    <div class="table-responsive">
                                  <table class="table table-striped table-bordered table-hover dataTables-example" >
                                  <thead>
                                   <tr>
                                       <th>No</th>
                                        <th>Date</th>
                                       <th>Weight</th>
                                       <th>Height</th>
                                       <th>BMI</th>
                                       <th>Temperature</th>
                                       <th>Systolic_bp</th>
                                       <th>Diastolic_bp</th>
                                       <th>Chief Compliant</th>


                                        <th>View</th>

                                  </tr>
                                  </thead>

                                  <tbody>
                                  <?php $i =1; ?>
                                  @foreach($details as $detail)
                                   <tr>
                                       <td>{{$i}}</td>
                                        <td>{{$detail->updated_at}}</td>
                                       <td>{{$detail->current_weight}}</td>
                                       <td>{{$detail->current_height}}</td>
                                        <td><?php $height=$detail->current_height; $weight=$detail->current_weight;
                                           $bmi =$weight/($height*$height);
                                           echo number_format($bmi, 2);
                                        ?></td>
                                       <td>{{$detail->temperature}}</td>
                                      <td>{{$detail->systolic_bp}}</td>
                                     <td>{{$detail->diastolic_bp}}</td>
                                     <td>{{$detail->chief_compliant}}</td>

                                      <td><a href="{{url('nurse.patientshow',$detail->id)}}">More</a></td>

                                   </tr>
                                   <?php $i++; ?>

                                  @endforeach


                                    </tbody>
                                  </table>

                               </div>


                            <a href="{{ route('details', $patient->id) }}" class="btn btn-primary btn-sm">Add Details</a>






                    </div>
                </div>



   </div>

</div>



</div>
</div>

</div>

@endsection
