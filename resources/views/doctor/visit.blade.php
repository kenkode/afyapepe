
@extends('layouts.doctor')

@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
  @role('Doctor')
@include('doctor/doctor')
  @endrole
    <div class="row">
      <div class="page-title ">
        @foreach($patientvisit as $pdetails)

        <h3>{{$pdetails->firstname}} {{$pdetails->secondName}}</h3>
        <a href="#"><i class="fa fa-plus"></i> Add Widget</a>
        <a href="#"><i class="fa fa-share"></i> Share</a>
        <a href="#"><i class="fa fa-envelope"></i> Email</a>
    </div><!--end page title-->
      <div class="col-sm-6">
    <div class="panel-box">
        <h4>Basic INFO</h4>
        <h4>Gender:
          <?php $gender=$pdetails->gender;?>
            @if($gender==1){{"Male"}}@else{{"Female"}}@endif</h4>
          <h4>Date of Birth:  {{$pdetails->dob}}</h4>
          <h4>National ID:  {{$pdetails->national_id}}</h4>
          <h4>Constituency:  {{$pdetails->constituency}}</h4>

       </div>
    </div>
    <div class="col-sm-6">
  <div class="panel-box">
      <h4>NEXT OF KIN INFO</h4>
        <h4>Relation:{{$pdetails->relation}}</h4>
        <h4>Name:  {{$pdetails->kin_name}}</h4>
        <h4>Phone :  {{$pdetails->phone_of_kin}}</h4>
        <h4>Constituency:  {{$pdetails->constituency}}</h4>

     </div>
  </div>
  <div class="col-sm-6">
<div class="panel-box">
    <h4>TRIAGE INFO</h4>
      <h4>Temperature:  {{$pdetails->temperature}}</h4>
      <h4>Facility:{{$pdetails->facility_id}}</h4>
      <h4>Height:  {{$pdetails->current_height}}  Weight :  {{$pdetails->current_weight}}</h4>
      <h4>Systolic BP:  {{$pdetails->systolic_bp}}  Diastolic BP: {{$pdetails->diastolic_bp}}</h4>

   </div>
</div>
<div class="col-sm-6">
<div class="panel-box">
  <h4>OBSERVATION INFO</h4>
  <h4>Chief Complain:  {{$pdetails->chief_compliant}}</h4>
  <h4>Observation:  {{$pdetails->observation}}</h4>
  <h4>Doctor Note:  {{$pdetails->Doctor_note}}</h4>
    <h4>Constituency:  {{$pdetails->constituency}}</h4>

 </div>
</div>
  <div class="col-sm-6">
 <div class="panel-box">
   <h4>TEST INFO</h4>
<div class="table-responsive">
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Test  Name</th>
                        <th>Status</th>
                        <th>Result</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                     </tr>
                     <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                     </tr>
                   </tr>
             </tbody>
          </table>
       </div>
      </div>
</div>
<div class="col-sm-6">
<div class="panel-box">
  <h4>PRESCRIPTION INFO</h4>
  <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th>Drug  Name</th>
                          <th>Dosage</th>
                          <th>Doseform</th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr>
                          <td>1</td>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                       </tr>
                       <tr>
                          <td>2</td>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                       </tr>
                     </tr>
               </tbody>
            </table>
         </div>

 </div>
</div>
</div><!--row-->
@endforeach
        </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
