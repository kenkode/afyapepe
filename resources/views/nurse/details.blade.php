@extends('layouts.app')
@section('title', 'Nurse Dashboard')


@section('content')
<div class="row">
<div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Patient Details</h5>

      </div>
      <div class="ibox-content">

     

 {!! Form::open(array('route' => 'createdetail','method'=>'POST')) !!}
    <div class="form-group">
    <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
    <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight"  required>
    </div>
    
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="text" class="form-control" placeholder="Height in Metres" name="current_height"
     required>
    </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Temperature</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Temperature" name="temperature"  required>
   </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Systolic BP</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Systolic BP" name="systolic"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Diastolic BP</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diastolic BP" name="diastolic"  required>
    </div>

    </div>
    </div>
  </div>
</div>






<div class="col-lg-6">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>Patient Observations</h5>
      </div>
      <div class="ibox-content">

    <div class="form-group">

 Drug Allergy <input type="checkbox"  name="drug" />
 <div id="drug">
    <label>Drug Name</label><br>
 <select multiple="multiple" class="form-control" name="drugs[]">
    <?php $druglists = DB::table('allergies_type')->where('allergies_id',1)->get();?>
                  @foreach($druglists as $druglist)
                   <option value="{{$druglist->id}}">{{$druglist->name}}</option>
                 @endforeach
                </select>
    </div>

 Food Allergy <input type="checkbox"   name="food" />
 <div id="food">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="foods[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',2)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Latex Allergy <input type="checkbox" value="latex"  name="latex" />
 <div id="latex">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="latexs[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',3)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Mold Allergy <input type="checkbox" value="mold"  name="molds" />
 <div id="mold">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="molds[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',4)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Pet Allergy <input type="checkbox" value="pet"  name="pets" />
 <div id="pet">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="pets[]"  >
    <?php $foods =  DB::table('allergies_type')->where('allergies_id',5)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Pollen Allergy <input type="checkbox" value="pollen"  name="pollens" />
 <div id="pollen">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="pollens[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',6)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Insect Allergy <input type="checkbox" value="insect"  name="insects" />
 <div id="insect">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="insects[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',7)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
 
    
    
   
    <div class="form-group">
                     <label >Chief Complaint/Reason for visit:</label>
                     <select multiple="multiple" id="chief" name="chiefcompliant[]" class="form-control chief" style="width:50%"></select>
                 </div>
     <div class="form-group">
                     <label >Observation:</label>
                     <select multiple="multiple" id="observation" name="observation[]" class="form-control observation" style="width:50%"></select>
                 </div>
    <div class="form-group">
                     <label >Symptom:</label>
                     <select multiple="multiple" id="symptom" name="symptoms[]" class="form-control symptom" style="width:50%"></select>
                 </div>
    
    

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Notes</label>
    <textarea class="form-control" placeholer="" name="nurse" required>
    </textarea>

    </div>
    <?php $db=DB::table('afya_users')->where('id',$id)->first(); $gender=$db->gender; ?>
    @if($gender==1)

    @else
    <div class="form-group">
    <label for="exampleInputPassword1">Pregnant?</label>
    <input type="radio" value="No"  name="pregnant"> No <input type="radio" value="Yes"  name="pregnant"> Yes
    </div>

    <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">LMP</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="lmp" value="">
                 </div>
                 </div>
   @endif


    <div class="form-group">
    <label for="exampleInputEmail1">Consulting Physician</label>
    <select class="form-control" name="doctor" >
    <?php 
     $facilitycode=DB::table('facility_nurse')->where('user_id', Auth::id())->first();

$doctors = DB::table('users')->
                    join('facility_doctor','facility_doctor.user_id','=','users.id')
                    ->select('facility_doctor.*','users.name as name')->Where('facility_doctor.facilitycode',$facilitycode->facilitycode)->where('users.role','=','Doctor')->get();?>
                  @foreach($doctors as $doctor)
                   <option value="{{$doctor->doctor_id}}">{{$doctor->name}}</option>
                 @endforeach
                </select>
                

    <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>
</div>
    </div>
    </div>
    </div>
    </div>

  @include('includes.default.footer')



@endsection
