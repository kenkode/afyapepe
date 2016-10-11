@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


              <div class="row">
            <div class="col-sm-12 ">
<h2><span class="break"> Full Name: </span><b>{{$patient->firstname}}  {{$patient->lastname}}</b></h2>
              <br>
              <table class="table table-striped table-bordered bootstrap-datatable ">
              				<tbody>
              						<tr><td><b>Age:</b>   {{$patient->age}}</td><td><b>Gender:</b> <?php $gender=$patient->gender;?>
                            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></td><td><b>National ID:</b> {{$patient->national_id}}</td><td><b>Constituency:</b>  {{$patient->name}}</td></tr>
                          <tr><td colspan="4"><h3>Next of Kin</h3></td></tr>
              						<tr><td><b>National ID:</b>  {{$patient->nextkinID}}</td><td><b>Name: </b> {{$patient->next_kin}}</td><td><b>Relationship:</b> {{$patient->relation_kin}}</td><td><b>Phone:</b> {{$patient->phone_kin}}</td></tr>
              						<tr><td colspan="4"><h3>Vitals</h3></td></tr>
              						<tr><td>Weight:</td><td>{{$patient->current_weight}}</td><td>Temperature: </td><td>{{$patient->temperature}}</td></tr>
              						<tr><td>Systolic BP: </td><td>{{$patient->systolic_bp}}</td><td>Diastolic BP: </td><td>{{$patient->diastolic_bp}}</td></tr>
              						<tr><td>Height: </td><td>{{$patient->current_height}}</td><td colspan="2"></td></tr>
              						<tr><td colspan="4"><h3>Todays Observations</h3></td></tr>
              						<tr><td>Nurses Notes: </td><td colspan="3"><textarea cols="90">{{$patient->nurse_note}}</textarea></td></tr>

                          <tr><td colspan="8"><a href="{{route('nurse.edit',$patient->id)}}"><button type="button" class="btn btn-info btn-block">Update Info</BUTTON></a></td></tr>

              				</tbody>
              				</table>


         </div>

          </div><!--content-->
      </div><!--content page-->
</div>
</div>
@endsection
