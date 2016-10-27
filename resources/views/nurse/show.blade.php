@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


   <div class="row">

     <h3> Full Name: <b>{{$patient->firstname}}  {{$patient->lastname}}</b></h3>
    <h3> Age: <b>{{$patient->age}} </b></h3>
   <h3>Gender: <b><?php $gender=$patient->gender;?>
                                                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</b></h3>
              <hr>
    <div class="col-sm-3">
    <h5>Patient Details</h5>
 
    <div class="form-group">


      <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight" value="{{$patient->current_weight}}" readonly="">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="name" class="form-control" placeholder="Height" name="current_height"
    value="{{$patient->current_height}}" readonly="">
    </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Temperature</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Temperature" name="temperature" value="{{$patient->temperature}}" readonly="">
   </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Systolic BP</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Systolic BP" name="systolic" value="{{$patient->systolic_bp}}" readonly="">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Diastolic BP</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diastolic BP" name="diastolic" value="{{$patient->diastolic_bp}}" readonly="">
    </div>


     

       </div>

          </div>
    <div class="col-sm-3">
    <h5>Next of Kin Details</h5>
     <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name" value="{{$patient->next_kin}}" readonly="">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">ID Number</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin ID Number" name="idno" value="{{$patient->nextkinID}}" readonly="">
    </div>
    <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
     <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name" value="{{$patient->relation_kin}}" readonly="">
    </div>
    
     <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$patient->phone_kin}}" readonly="">
    </div>
  
             </div>
     <div class="col-sm-6">
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
                                                 @foreach($vaccines as $vaccine)
                                                      <tr>
                                                          <td>{{$i}}</td>
                                                          <td>{{$vaccine->name}}</td>
                                                          <td>{{$vaccine->vaccine_name}}</td>

                                                          <td><?php $yes=$vaccine->Yes;
                                                            if($yes=="YES"){ echo '<p><i class="glyphicon glyphicon-ok-circle" aria-hidden="true"></i></p>';}else{ echo '<p><i class="glyphicon glyphicon-remove-circle" aria-hidden="true"></i></p>';} ?>
                                                            </td>
                                                          <td>{{$vaccine->yesdate}}</td>
                                                           
                                                      </tr>
                                                      <?php $i++; ?>

                                                   @endforeach
                                                    

                                                   </tbody>
                                                 </table>

          </div>
    <!--content-->
        
          
         
      </div><!--content page-->
      <a href="{{ route('nurse.edit', $patient->id) }}" class="btn btn-primary btn-lg">Update Details</a> 
</div>
</div>
@endsection
