@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
     <div class="row">

<div class="col-sm-6 col-sm-offset-2">
  <div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Consultation description</h5>

    </div>
    <div class="ibox-content">
    <form class="form-horizontal" role="form" method="POST" action="/Dependentconsultationfee" novalidate>

<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
  <input type="hidden" class="form-control" id="exampleInputEmail1S" aria-describedby="emailHelp" value="{{$user->afya_user_id}}" name="afya_user"  required>
    <div class="form-group">
<label class="control-label" for="name">Consultation Fee ?</label>
<input type="radio" value="No" id="type" name="type" checked='checked' autocomplete="off" />
  <label>No</label>
        <input type="radio" value="Yes" id="type" name="type" class="youtube" />
      <label>Yes</label>
      <div id="embedcode">
    Payment Mode: <select name="mode"><option value="">Select</option><option value="Cash">Cash</option><option value="Mpesa">Mpesa</option><option value="Insurance">Insurance</option></select>
     Amount: <input type="number"  placeholder="Amount" name="amount" >
    </div>
  </div>

  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
    {!! Form::close() !!}
    </div>
  </div>
</div>
</div>
</div>
<br>


@include('includes.default.footer')
          </div><!--content-->
      </div><!--content page-->

@endsection
