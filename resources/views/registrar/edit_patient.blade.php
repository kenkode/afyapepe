@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')




  <div class="col-sm-8  col-sm-offset-2" style="text-align:left;">   
  <br>                  
  <div class="ibox-title">
      <h5>Patient Details</h5>
      <?php $user=DB::table('afya_users')->where('id',$id)->first(); ?>

  </div>
         <div class="ibox-content">
               <form class="form-horizontal" role="form" method="POST" action="/register_update_patient" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" class="form-control" id="exampleInputEmail1"  value="{{$id}}" name="id"  required>
              <input type="hidden" name="user" value="{{$user->id}}">
               <div class="form-group">
              <label for="exampleInputPassword1">Phone Number</label>
              <input type="name" class="form-control" id="exampleInputEmail1" value="{{$user->msisdn}}" placeholder="" name="phone" >
              </div>

              <div class="form-group">
             <label for="exampleInputPassword1">Email</label>
             <input type="name" class="form-control" id="exampleInputEmail1" value="{{$user->email}}" placeholder="" name="email">
             </div>         
                         
                  <?php $const=DB::table('constituency')->where('id',$user->constituency)->first(); ?> 
                  <div class="form-group">
                     <label >Constituency: {{$const->Constituency}}</label>
                     <select id="constituency" value="{{$const->Constituency}}" name="constituency" class="form-control constituency" style="width:50%"></select>
                 </div>
             
              
               
              <button type="submit" class="btn btn-primary btn-sm">Update Details</button>
                 {!! Form::close() !!}
               </div>
             
              
             
</form>
</div>

            @include('includes.admin_inc.footer')
             </div>
           
            
            @endsection

