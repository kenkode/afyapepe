@extends('layouts.app')

@section('content')
<div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Child Details</h5>

      </div>
      <div class="ibox-content">
      <form action="{{ url('createinfantdetails') }}"   method="post">
 <input type="hidden" name="_token" value="{{ Session::token() }}"/>
 
    <div class="form-group">
    <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
    <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="name" class="form-control" placeholder="Height in Metres" name="current_height"
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
    </div>
  </div>
</div>






<div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Child Observations</h5>
      </div>
      <div class="ibox-content">

    <div class="form-group">
    <label for="exampleInputEmail1">Allergies</label><br>

    <?php  $allergies = DB::table('allergies')->get();?>
                  @foreach($allergies as $allergy)
                  <input type="checkbox"  name="allergy[]" value="{{$allergy->name}}"> {{$allergy->name}}
                 @endforeach

    </div>
 
    
    
     <div class="form-group">
    <label for="exampleInputPassword1">Chief Compliant</label>
    <select multiple="multiple" class="form-control" name="chiefcompliant[]"  >
    <?php $chiefs = DB::table('chief_compliant_table')->get();?>
                  @foreach($chiefs as $chief)
                   <option value="{{$chief->name}}">{{$chief->name}}</option>
                 @endforeach
                </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Observation</label>
    <select  class="form-control" name="observation" id="observation" >
    
                  @foreach($observations as $observation)
                   <option value="{{$observation->name}}">{{$observation->name}}</option>
                 @endforeach
                </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">symptoms</label>
    <select  class="form-control" name="symptoms" id="symptoms">
     @foreach($symptoms as  $symptom)
                   <option value="{{$symptom->name}}">{{$symptom->name}}</option>
                 @endforeach
    
                </select>
    </div>
    

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Notes</label>
    <textarea class="form-control" placeholer="" name="nurse" required>
    </textarea>

    </div>
    

    <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>
</div>
    </div>
  @include('includes.default.footer')



@endsection
