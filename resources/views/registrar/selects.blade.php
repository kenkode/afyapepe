@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">
<div class="wrapper wrapper-content animated fadeInRight">
  <br><br><br><br><br><br>
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1">

               <a href="{{URL('registrar.shows',$id)}}" class="btn btn-primary btn-block">{{'Self'}}</a>

            </div>
            <div class="col-sm-5">

                  <a href="{{URL('registrar.showdependants',$id)}}" class="btn btn-success btn-block">{{'Dependant'}}</a>

            </div>
          </div>
        </div>
      </div>
     @include('includes.default.footer')
     </div><!--content-->
     </div><!--content page-->

     @endsection