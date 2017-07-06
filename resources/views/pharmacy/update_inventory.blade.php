@extends('layouts.pharmacy')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
  <div class="col-lg-8">
    <div class="ibox-content">

    {!! Form::open(array('route' => 'inventory_update','method'=>'POST','class'=>'form-horizontal','role'=>'form')) !!}

    <?php
    foreach($inventory as $inv)
    {
      $inventory = DB::table('inventory_updates')->select('quantity')
      ->where([
        ['status', '=', 1],
        ['inventory_id', '=', $inv->inventory_id],
      ])
      ->first();

      if(!empty($inventory->quantity))
      {
        $quantity = $inventory->quantity;
      }
      else
      {
        $quantity = '';
      }
     ?>
     <input type="hidden" name="inventory_id" value="{{$inv->inventory_id}}" />

    <div class="form-group">
        <label >Drug:</label>
        <select id="presc1" name="prescription" class="form-control presc1" disabled="">
          <option selected="" value="{{$inv->drug_id}}">{{$inv->drugname}}</option>
        </select>
    </div>

    <input type="hidden" name="patient_prescription" class="form-control" value="{{$inv->drug_id}}">

    <div class="form-group"><label>Strength</label> <input type="text" name="strength" class="form-control" value="{{$inv->strength.$inv->strength_unit}}" disabled=""></div>

     <div class="form-group"><label>Quantity</label> <input type="number" name="quantity" value="{{$quantity}}" class="form-control" ></div>

     <?php
      }
      ?>
    <p> </p>
    <p> </p>
    <p> </p>
    <div class="form-group">
      <div >
      <button class="btn btn-w-m btn-primary" type="submit">Submit</button>
      </div>
    </div>

      {{ Form::close() }}
</div>
<a href="{{route('inventory')}}"><button type="button" class="btn btn-w-m btn-primary">Back</button></a>

</div>

    </div><!--content-->
</div><!--content page-->


@endsection
