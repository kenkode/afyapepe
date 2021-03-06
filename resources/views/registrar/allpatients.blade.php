@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')
              <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                              
                           

                                  <div class="ibox-tools">

                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                          <i class="fa fa-wrench"></i>
                                      </a>
                                      <ul class="dropdown-menu dropdown-user">

                                          <li><a href="#">Config option 1</a>
                                          </li>
                                          <li><a href="#">Config option 2</a>
                                          </li>
                                      </ul>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">
                              <a data-toggle="modal" class="btn btn-primary" href="#modal-form3">Add</a>

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>Name</th>
                                                          <th>Age</th>
                                                          <th>Gender</th>
                                                          <th>Join Date</th>

                                                          

                                               



                                                    </tr>
                                                  </thead>

                                                  <tbody>
                                                    <?php $i=1;
                                                    $users=DB::table('afya_users')->get(); ?>
                                                    @foreach ($users as $user)
                                                    <tr>
                                                    <td><a href="{{URL('registrar.select',$user->id)}}">{{$i}}</a></td>
                                                      <td><a href="{{URL('registrar.select',$user->id)}}">{{$user->firstname}} {{$user->secondName}}</a></td>
                                                        <td><?php $dob=$user->dob;
                                  $interval = date_diff(date_create(), date_create($dob));
                             $age= $interval->format(" %Y Year, %M Months, %d Days Old");?> {{$age}}

                             </td>
                                                        <td><?php $gender=$user->gender;?>
                                                      @if($gender==1){{"Male"}}@else{{"Female"}}@endif</td>
                                                        <td>{{$user->created_at}}</td>
                                                    </tr>
                                                    
                                                    <?php $i++; ?>
                                                   @endforeach
                                               
                                                   </tbody>

                                                 </table>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>
                                         </div>
                                     </div>



                    
 
                            <div id="modal-form3" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                            <div class="row">
                            <div class="col-sm-8">
                               {!! Form::open(array('url' => 'registeruser','method'=>'POST')) !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                               <div class="form-group">
              <label for="exampleInputEmail1">First Name</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="first"/>
              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Second Name</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="second"/>
              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Phone</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="phone"/>
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Gender</label>
              <input type="radio" value="1"  name="gender"  />
                <label>Male</label>
                      <input type="radio" value="2"  name="gender" />
                    <label>Female</label>

              </div>
              <div class="form-group">
              <label for="exampleInputEmail1">Age</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"/>
              </div>
                                      <button class="btn btn-sm btn-primary" type="submit"><strong>Add</strong></button>
                                  
                              {{ Form::close() }}
                                </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
@include('includes.default.footer')



@endsection
