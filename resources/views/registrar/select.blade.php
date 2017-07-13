@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')
             <?php   $facilitycode=DB::table('facility_registrar')->where('user_id', Auth::id())
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

               <a href="{{URL('registrar.show',$id)}}" class="btn btn-primary btn-block">{{'Self'}}</a>

            </div>
            <div class="col-sm-5">

                  <a href="{{URL('registrar.dependant',$id)}}" class="btn btn-success btn-block">{{'Dependant'}}</a>

            </div>
          </div>
          @endif
        </div>
      
     @include('includes.default.footer')
    

     @endsection
