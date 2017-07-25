@extends('layouts.app')
@section('title', 'Nurse Dashboard')


@section('content')
<div class="row">

 
  
<div class="col-lg-2">
</div>


<div class="col-lg-8 ">




    <div class="ibox float-e-margins">
    <br>
      <div class="ibox-title">
          <h5>Patient chronic diseases</h5>
      </div>
      <div class="ibox-content">
      {!! Form::open(array('url' => 'update_chronic','method'=>'POST')) !!}
  
    <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>

    <div class="form-group">
                     <label >Chronic Diseases:</label>
                     <select multiple="multiple" id="chronic" name="chronic[]" class="form-control chronic" style="width:50%" required></select>
                 </div>

 
                
<br><br>
    <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
   
</div>
    </div>
    </div>
    </div>
  

  @include('includes.default.footer')



@endsection
