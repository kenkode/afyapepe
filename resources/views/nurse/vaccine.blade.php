@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


              <div class="row">



    <div class="col-sm-6 col-md-offset-3">
    <h2>Vaccines Details</h2>
    <div class="row multi-field-wrapper ">
    <div class="multi-fields">
    {!! Form::open(array('route' => 'vaccine','method'=>'POST')) !!}

                <div class="form-group col-sm-6  multi-field">
                <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
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
            <input type="radio" value="no" id="type" name="type" checked='checked' autocomplete="off" />
<label>No</label>
<input type="radio" value="yes" id="type" name="type" class="youtube" />
<label>Yes</label>
<input type="date" value="0000-00-00" id="embedcode" placeholder="Vaccinated Date" name="date" type="text"/>
        
     </div>
 

      <!-- <button type="button" class="remove-field">Remove</button> -->
        <a href="javascript:void(0);" class="remove-field" title="Remove field"><i class="glyphicon glyphicon-minus-sign fa-4x" aria-hidden="true"></i></a>


        <!-- <button type="button" class="add-field">Add field</button> -->
      <a href="javascript:void(0);" class="add-field" title="Addfield"><i class="glyphicon glyphicon-plus-sign fa-4x" aria-hidden="true"></i></a>
      <br><br>
     <button type="submit" class="btn btn-primary">Save</button>
      {!! Form::close() !!}
               </div>  <!-- /.form-group -->

              </div>
              </div>
    </div>
    </div>
    

          </div><!--content-->
      </div><!--content page-->
</div>
</div>
@endsection
