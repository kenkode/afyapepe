@extends('layouts.nurse')
@section('title', 'Registrar Dashboard')
@section('content')
             <?php   $facilitycode=DB::table('facility_nurse')->where('user_id', Auth::id())
             ->where('facilitycode',1111)->first();
            
            ?>
<div class="wrapper wrapper-content animated fadeInRight">
  <br><br><br><br><br><br>
  
   @if(!empty($facilitycode))
  <div class="row">
            <div class="col-sm-5 col-sm-offset-1">

               <a href="{{URL('registrar.shows',$id)}}" class="btn btn-primary btn-block">{{'Self'}}</a>

            </div>
            <div class="col-sm-5">

                  <a href="{{URL('registrar.showdependants',$id)}}" class="btn btn-success btn-block">{{'Dependant'}}</a>

            </div>
          </div>
        @else
        <div class="row">
        

            <div class="col-sm-5 col-sm-offset-1">

               <a href="{{URL('nurse.show',$id)}}" class="btn btn-primary btn-block">{{'New Appointment'}}</a>

            </div>
            <div class="col-sm-5">

                  <a href="{{URL('nurse.continueapp',$id)}}" class="btn btn-success btn-block">{{'Existing Appointment'}}</a>

            </div>
          </div>
          @endif
        </div>
      
     @include('includes.default.footer')
    

     @endsection
