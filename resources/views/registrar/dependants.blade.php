@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')

<div class="row">

  <?php  $dependants=DB::table('dependant')->where('afya_user_id',$id)->get();?>
  @if(!empty($dependants))


    <div class="col-lg-8 col-md-offset-2">
    <div class="ibox-title">
        <h5>Dependant Details</h5>

    </div>
      <div class="table-responsive">
  <table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>
                          <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Age</th>
                              <th>Relationship</th>
                            <th>Date of Birth</th>
                      <th>Place of Birth</th>
                                              </tr>
                      </thead>

                      <tbody>
                        <?php $i=1; ?>
                        @foreach($dependants as $dependant)
                      <tr>
                        <td><a href="{{URL('registrar.dependantTriage',$dependant->id)}}">{{$i}}</a></td>
                        <td><a href="{{URL('registrar.dependantTriage',$dependant->id)}}">{{$dependant->firstName}} {{$dependant->secondName}}</a></td>
                        <td>{{$dependant->gender}}</td>
                        <td>{{$dependant->age}}</td>
                        <td>{{$dependant->relationship or ''}}</td>
                        <td>{{$dependant->dob or ''}}</td>
                        <td>{{$dependant->pob or ''}}</td>


                      </tr>
                        <?php $i++; ?>

                     @endforeach
                       </tbody>

                     </table>
                     <a href="{{URL('registrar.addDependents',$id)}}" class="btn btn-primary btn-block">Add</a>
                         </div>
                       </div>
  @else
  <div class="col-lg-6 col-md-offset-2">
           <div class="ibox-content">
             <div class="ibox-title">
                 <h5>Dependant Details</h5>

             </div>
                 <form class="form-horizontal" role="form" method="POST" action="/createdependent" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
                 <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="first"  value="
                 "  >
                </div>
                <div class="form-group">
               <label for="exampleInputEmail1">Second Name</label>
               <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="second"  value="
                "  >
               </div>
               <div class="form-group">
                <label for="exampleInputPassword1">Gender</label>
                <input type="radio" value="Male"  name="gender"  />
                  <label>Male</label>
                        <input type="radio" value="Female"  name="gender" />
                      <label>Female</label>

                </div>
                <div class="form-group">
              <label for="exampleInputPassword1">Age</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"  value="
               "  >
               </div>
                <div class="form-group">
              <label for="exampleInputPassword1">School</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="school"  value="
               "  >
                

              </div>
                

             
              <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
    <select class="form-control" name="relationship">
    <?php  $kin = DB::table('kin')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->relation}}">{{$kn->relation}}</option>
                 @endforeach
                </select>
    </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Blood Group</label>
                <select class="form-control" name="blood">
                <option value="O +">O +</option>
                <option value="O -">O -</option>
                <option value="A +">A +</option>
                <option value="A -">A -</option>
                <option value="B +">B +</option>
                <option value="B -">B -</option>
                <option value="AB +">AB +</option>
                <option value="AB -">AB -</option>
                </select>
                </div>
                 <div class="form-group">
                  <label for="exampleInputPassword1">Place of Birth</label>
                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="pob" value=""  >
                  </div>
                  <div class="form-group" id="data_1">
                   <label for="exampleInputPassword1">Date of Birth</label>
                   <div class="input-group date">
                       <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                       <input type="text" class="form-control" name="dob" value="">
                   </div>
                   </div>
                <button type="submit" class="btn btn-primary btn-sm">Create Details</button>
                   {!! Form::close() !!}
                 </div>

</div>
@endif
               </div>




@include('includes.default.footer')
</div>


</div>

@endsection