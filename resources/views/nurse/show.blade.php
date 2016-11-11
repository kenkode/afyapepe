@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


   <div class="row">

     <h3> Full Name: <b>{{$patient->firstname}}  {{$patient->secondName}}</b></h3>
    <h3> Age: <b>{{$patient->age}} </b></h3>
   <h3>Gender: <b><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</b></h3>
              <hr>

</div>
          </div>
    <div class="row">
    <div class="col-sm-4 col-md-offset-1">
    <h5>Next of Kin Details</h5>
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
<a href="{{ route('createkin', $patient->id) }}" class="btn btn-primary btn-lg">Update Details</a>
          </div>

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
          <a href="{{ route('createkin', $patient->id) }}" class="btn btn-primary btn-lg">Update Details</a>
                  </div>
          @endif

     <div class="col-sm-7">
          <h5>Vaccination Details</h5>

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


    <a href="{{ route('vaccinescreate', $patient->id) }}" class="btn btn-primary btn-lg">Update Details</a>
          </div>
    <!--content-->



      </div><!--content page-->
      <br><br>
      <div class="row">
      <div class="col-sm-12">
      <h5>Patient Details</h5>
      <div class="table-responsive">
      <table class="table table-small-font table-bordered table-striped">
      <thead>
       <tr>
           <th>No</th>
           <th>Weight</th>
           <th>Height</th>
           <th>Temperature</th>
           <th>Systolic_bp</th>
           <th>Diastolic_bp</th>
           <th>Chief Compliant</th>
           <th>Observation</th>
           <th>Date</th>
            <th>View</th>

      </tr>
      </thead>

      <tbody>
      <?php $i =1; ?>
      @foreach($details as $detail)
       <tr>
           <td>{{$i}}</td>
           <td>{{$detail->current_weight}}</td>
           <td>{{$detail->current_height}}</td>
           <td>{{$detail->temperature}}</td>
          <td>{{$detail->systolic_bp}}</td>
         <td>{{$detail->diastolic_bp}}</td>
         <td>{{$detail->chief_compliant}}</td>
         <td>{{$detail->observation}}</td>
           <td>{{$detail->updated_at}}</td>
          <td>More</td>

       </tr>
       <?php $i++; ?>

      @endforeach


      </tbody>
      </table>


</div>



         </div>


      <a href="{{ route('details', $patient->id) }}" class="btn btn-primary btn-lg">Add Details</a>
</div>
</div>
</div>
@endsection
