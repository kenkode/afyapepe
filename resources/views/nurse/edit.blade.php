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
     {!! Form::close() !!}
         </div>
    <div class="col-sm-6">
    <h2>Patient Details</h2>
    {!!Form::model($patient,['route'=>['patient.update',$patient->id],'method'=>'PUT']) !!}
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
                   <option value="{{$doctor->name}}">{{$doctor->name}}</option>
                 @endforeach
                </select>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>

          </div><!--content-->
      </div><!--content page-->
</div>
</div>
@endsection
