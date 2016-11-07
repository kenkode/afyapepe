@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


  
    <div class="row">

    <div class="col-sm-6">
    <h2>Patient Details</h2>

 {!! Form::open(array('route' => 'createdetail','method'=>'POST')) !!}
    <div class="form-group">
    <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
                <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="name" class="form-control" placeholder="Height" name="current_height"
     required>
    </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Temperature</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Temperature" name="temperature"  required>
   </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Systolic BP</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Systolic BP" name="systolic"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Diastolic BP</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diastolic BP" name="diastolic"  required>
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
    <textarea class="form-control" placeholer="" name="chiefcompliant" required>
    </textarea>

    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Observation</label>
    <textarea class="form-control" placeholer="" name="observation" required>
    </textarea>

    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Details</label>
    <textarea class="form-control" placeholer="" name="nurse" required>
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
