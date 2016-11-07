
@extends('layouts.nurse')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">


      <div class="row">
    <div class="col-sm-6 col-md-offset-2">
     <h2>Next of Kin</h2>
   {!! Form::open(array('route' => 'nextkin','method'=>'POST')) !!}
    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
   
    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name"  required>
    </div>
    
    <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
    <select class="form-control" name="relationship">
    <?php  $kin = DB::table('kin')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->id}}">{{$kn->relation}}</option>
                 @endforeach
                </select>
    </div>
     <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"  required>
    </div>
   <button type="submit" class="btn btn-primary">Save</button>
      {!! Form::close() !!}
    
</div>


         </div>

      
</div>
</div>
</div>
@endsection
