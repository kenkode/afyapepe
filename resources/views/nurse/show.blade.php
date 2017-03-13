@extends('layouts.nurse')
@section('title', 'Patient Details')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
   <div class="row">
    <h3 class="marg"> Patient Details <b class="marg"> Name: {{$patient->firstname}}  {{$patient->secondName}}</b>
     <b class="marg">Age: {{$patient->age}} </b> <b class="marg">Gender: <?php $gender=$patient->gender;?>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</b></h3>
      <hr>
  </div>

  <div class="row">
    <div class="col-lg-5">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Next of Kin Details</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <form class="form-horizontal">


                    <?php $id=$kin->kin_name;?>
                  @if ($id!=="")
                  <div class="form-group">
                 <label for="exampleInputEmail1">Name</label>
                 <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  value="
                 {{ $yes=$kin->kin_name}}

                  "  readonly="">
                 </div>

                 <div class="form-group">
                  <label for="exampleInputPassword1">Relationship</label>
                  <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="relation"  value="{{$relation=$kin->relation}}
                     "  readonly="">
                 </div>
                  <div class="form-group">
                 <label for="exampleInputPassword1">Phone</label>
                 <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$phone=$kin->phone_of_kin}}"  readonly="">
                 </div>
                <a href="{{ route('createkin', $patient->id) }}" class="btn btn-primary btn-sm">Update Details</a>
                </form>
                @else
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  readonly="">
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Relationship</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="relation"
                  readonly="">
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"
                readonly="">
                </div>

                        </div>
                        <a href="{{ route('createkin', $patient->id) }}" class="btn btn-primary btn-sm">Update Details</a>
                @endif
            </div>
        </div>
</div>

            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Vaccination Details</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
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




                    </div>
                </div>
            </div>
        </div>

      <div class="row">
         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5>Patient History</h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

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

          <td>More</td>

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
<a href="{{ route('details', $patient->id) }}" class="btn btn-primary btn-sm">Add Details</a>
</div>
@endsection
