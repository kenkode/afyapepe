@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


              <div class="row">

<h2><span class="break"> Full Name: </span><b>{{$patient->firstname}}  {{$patient->lastname}}</b></h2>
              <hr>
    <div class="col-sm-6">
    <h2>Next of Kin</h2>
    {!!Form::model($patient,['route'=>['nurse.update',$patient->id],'method'=>'PUT']) !!}
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name" value="{{$patient->next_kin}}" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">ID Number</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin ID Number" name="idno" value="{{$patient->nextkinID}}" required>
    </div>
    <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
    <select class="form-control" name="relationship">
    <?php  $kins = DB::table('kins')->get();?>
                  @foreach($kins as $kin)
                   <option value="{{$kin->name}}">{{$kin->name}}</option>
                 @endforeach
                </select>
    </div>
     <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$patient->phone_kin}}" required>
    </div>
   <button type="submit" class="btn btn-primary">Save</button>
             </div>
    <div class="col-sm-6">
    <h2>Vaccines Details</h2>
    <div class="row multi-field-wrapper ">
    <div class="multi-fields">


                <div class="form-group col-sm-6  multi-field">
                <div class="form-group">

                 <label class="control-label" for="validateSelect">Diseases</label>
                  <select  name="diseases" class="form-control" data-parsley-required="true">
                   <?php  $diseases = DB::table('diseases')->get();?>
                  @foreach($diseases as $disease)
                   <option value="{{$disease->id}}">{{$disease->name}}</option>
                 @endforeach
                </select>
                </div>

                <div class="form-group">
                  <label class="control-label" for="name">Vaccine Name</label>
                  <input type="text" name="vaccinename" class="form-control" data-parsley-required="true">
                </div>
              <div class="form-group">
            <label class="control-label" for="name">Vaccinated ?</label>
        No<INPUT TYPE=RADIO NAME="yes" VALUE="NO" onclick="hide();"/>
        Yes<INPUT TYPE=RADIO NAME="yes" VALUE="YES" onclick="show();"/>
     </div>
     <div class="form-group">
   <label class="control-label" for="name">Vaccinated Date</label>
        <input type="Date" id="area"  name="dates" />

    </div>


      <!-- <button type="button" class="remove-field">Remove</button> -->
        <a href="javascript:void(0);" class="remove-field" title="Remove field"><i class="glyphicon glyphicon-minus-sign fa-4x" aria-hidden="true"></i></a>


        <!-- <button type="button" class="add-field">Add field</button> -->
      <a href="javascript:void(0);" class="add-field" title="Addfield"><i class="glyphicon glyphicon-plus-sign fa-4x" aria-hidden="true"></i></a>

               </div>  <!-- /.form-group -->
              </div>
              </div>
    </div>
    </div>
    <div class="row">

    <div class="col-sm-6">
    <h2>Patient Details</h2>


    <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight" value="{{$patient->current_weight}}" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="name" class="form-control" placeholder="Height" name="current_height"
    value="{{$patient->current_height}}" required>
    </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Temperature</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Temperature" name="temperature" value="{{$patient->temperature}}" required>
   </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Systolic BP</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Systolic BP" name="systolic" value="{{$patient->systolic_bp}}" required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Diastolic BP</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diastolic BP" name="diastolic" value="{{$patient->diastolic_bp}}" required>
    </div>
    </div>
    <div class="col-sm-6">
    <h2>Patient Observations</h2>
    <div class="form-group">
    <label for="exampleInputEmail1">Allergies</label>
    <select class="form-control" name="allergies">
    <?php  $allergies = DB::table('allergies')->get();?>
                  @foreach($allergies as $allergy)
                   <option value="{{$allergy->id}}">{{$allergy->name}}</option>
                 @endforeach
                </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Chief-Compliant</label>
    <textarea class="form-control" placeholer="" name="chiefcompliant" required>{{$patient->chief_compliant}}
    </textarea>

    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Observation</label>
    <textarea class="form-control" placeholer="" name="observation" required>{{$patient->observation}}
    </textarea>

    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Details</label>
    <textarea class="form-control" placeholer="" name="nurse" required>{{$patient->nurse_note}}
    </textarea>

    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Consulting Physician</label>
    <select class="form-control" name="doctor" >
    <?php $doctors = DB::table('users')->Where('role', '=','Doctor')->get();?>
                  @foreach($doctors as $doctor)
                   <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                 @endforeach
                </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>

    </div>

          </div><!--content-->
      </div><!--content page-->
</div>
</div>
@endsection
