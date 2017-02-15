@extends('layouts.doctor')
@section('content')
<div class="content-page  equal-height">
 <div class="content">
  <div class="container">
    <div class="row">
      @if (count($errors) > 0)
     <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
     <ul>
      @foreach ($errors->all() as $error)
     <li>{{ $error }}</li>
      @endforeach
     </ul>
     </div>
     @endif
      <?php
    $doc = (new \App\Http\Controllers\DoctorController);
    $Docdatas = $doc->DocDetails();
    foreach($Docdatas as $Docdata){


      $Did = $Docdata->doc_id;
    	$Name = $Docdata->name;
    	$Address = $Docdata->address;
    	$RegNo = $Docdata->regno;
    	$RegDate = $Docdata->regdate;
    	$Speciality = $Docdata->speciality;
    	$Sub_Speciality = $Docdata->subspeciality;
      $Facility = $Docdata->facility;

    }


    if ( empty ($Name ) ) {
    // return view('doctor.create');

    return redirect('doctor.create');



    }
    ?>

    <div class="pull-right">
     <div class="page-title clearfix">
                              <h3><?php echo $Facility;?></h3>

                          </div><!--end page title-->

       <div class="widget-box clearfix">
    <h4><?php echo $Name;?></h4>
    <h4>Address:
    <?php echo $Address; ?></h4>
    <h4>Registration Number:
    <?php echo $RegNo; ?></h4>

    <h4>Registration Date:
    <?php echo $RegDate; ?></h4>

    <h4>Speciality:
    <?php echo $Speciality; ?></h4>

    <h4>Sub Speciality:
    <?php echo $Sub_Speciality; ?></h4>
    </div>
    </div>

    	<br>	<br>	<br>
</div>
    <!--Home tabs-->
<div class="row">


<div class="col-sm-12">
  <div class="panel-box">

    <div class="tabs-container">
  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Test Results</a></li>
      <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">PRESCRIPTION</a></li>
  </ul>
  <div class="tab-content">


<!--Test result tabs PatientController@testdone-->

<div id="tab-1" class="tab-pane active">
<div class="panel-body">
      <div class="table-responsive">
   <table class="table table-small-font table-bordered table-striped">
 <thead>
     <tr>
       <th></th>
         <th>Test Recommended</th>
         <th>Done</th>
         <th>Result</th>
         <th>Faciity</th>
         <th>Note</th>
         <th>Date Test Done</th>

   </tr>
 </thead>

 <tbody>
   <?php $i =1; ?>

@foreach($tstdone as $tstdn)


     <tr>
         <td>{{ +$i }}</td>

         <td>{{$tstdn->test_name}}</td>
         <td>{{$tstdn->done}}</td>
         <td>{{$tstdn->results}}</td>
         <td>{{$tstdn->FacilityName}}</td>
          <td>{{$tstdn->note}}</td>
          <td>{{$tstdn->created_at}}</td>
</tr>
     <?php $i++; ?>

  @endforeach

  </tbody>
</table>
</div>
</div>
</div>



<!--Prescription tabs-->
      <div id="tab-2" class="tab-pane">
          <div class="panel-body">

              {!! Form::open(array('route' => 'doctor.store','method'=>'POST')) !!}

              <table class="table table-striped">
                 <thead>
                    <tr>
                       <h4>Prescription</h4>

                    </tr>
                 </thead>
                 <tbody>


<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
    <tr>
      <td>
    Appoinment id:
  </td>
  <td>
 {{ Form::text('appointment_id', $tstdn->appointment_id ) }}
 </td><td>
Doc id:
<td>
{{ Form::text('doc_id',$Did) }}
</td></tr>
<td>
patient id:
</td>
<td>
{{ Form::text('patient_id',$tstdn->patient_id, array('class' => 'form-control')) }}
</td>
</tr>
<tr>
  <td>
filled status:
</td>
<td>
{!! Form::text('filled_status', 1, array('placeholder' => 'FullName','class' => 'form-control')) !!}
</td>
<td>
</td>
</tr>
</div></div>

     <td>
    </td>
              <tr><td> Drug</td>
<?php
$drgs= (new \App\Http\Controllers\TestController);
$drugs = $drgs->TestList();
foreach($drugs as $druglist){

}
?>
<div class="col-xs-12 col-sm-12 col-md-12">
 <div class="form-group">
  <td><select name="test">
  @foreach($drugs as $druglist)
               <option value="{{$druglist->id }}">{{ $druglist->drugname }}</option>
              @endforeach
              </select>
              </td>
              <td>  </td>
              <td>  </td>
              </tr>

              <tr><td> Dosage</td>
              <td>  <select name="test">
              @foreach($drugs as $druglist)
               <option value="{{ $druglist->drugname }}">{{ $druglist->drugname }}</option>
              @endforeach
              </select>
              </td>
              <td>  </td>
              </tr>
              <tr><td> Doseform</td>
              <td>  <select name="test">
              @foreach($drugs as $druglist)
               <option value="{{ $druglist->drugname }}">{{ $druglist->drugname }}</option>
              @endforeach
              </select>
              </td>
              <td>  </td>
              </tr>
</div></div>
  <tr>
              <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
              <td> <strong>Doctor's Notes:</strong></td>
              <td>{!! Form::textarea('facility', null, array('placeholder' => 'facility','class' => 'form-control')) !!}  </td>
              </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <td/><button type="submit" class="btn btn-primary">Submit</button>  </td>
              </div>
              </tr>
</tbody>
              {!! Form::close() !!}

          </div>
          </div>
      </div>
  </div>


  </div>
    </div>



  </div><!--row-->
</div><!--container-->
</div><!--content -->
</div><!--content page-->
@endsection
