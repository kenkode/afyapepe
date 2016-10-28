@extends('layouts.pharmacy')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-sm-6 ">
                                       <?php $gender=$patient->gender;?>

                                          <div class="panel-box">

                                            <h5>Patient Details</h5>
                                             {!! Form::open(array('route' => 'pharmacy.store')) !!}
                                             <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name" value="{{$patient->firstname}} {{$patient->lastname}}" readonly="">
                                            </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Age</label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin ID Number" name="idno" value="{{$patient->age}}" readonly="">
                                            </div>
                                            <div class="form-group">
                                             <label for="exampleInputPassword1">Gender</label>
                                             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name" value="@if($gender==1){{"Male"}}@else{{"Female"}}@endif" readonly="">
                                            </div>

                                             <div class="form-group">
                                            <label for="exampleInputPassword1">Allergies</label>
                                            <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Allegies" name="phone" value="{{$patient->allergies}}" readonly="">
                                            </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 ">
                                             <div class="panel-box">
                                            <div class="form-group">
                                            <h5><label for="exampleInputPassword1">Doctor's Prescription</label></h5>
                                            <br>
                                            <textarea rows="4" cols="58" readonly>{{$patient->prescription}}</textarea>
                                           </div>
                                           <div class="form-group">
                                            <label for="exampleInputPassword1">Drugs</label>
                                           <select class="form-control" name="drugs">
                                           <?php  $druglists = DB::table('druglists')->get();?>
                                                         @foreach($druglists as $druglist)
                                                          <option value="{{$druglist->id}}">{{$druglist->drugname}}</option>
                                                        @endforeach
                                                       </select>
                                           </div>
                                           <div class="form-group">
                                            <label for="exampleInputPassword1">DosageForm</label>
                                           <select class="form-control" name="dosageform">
                                           <?php  $druglists = DB::table('druglists')->get();?>
                                                         @foreach($druglists as $druglist)
                                                          <option value="{{$druglist->DosageForm}}">{{$druglist->DosageForm}}</option>
                                                        @endforeach
                                                       </select>
                                           </div>
                                           <div class="form-group">
                                            <label for="exampleInputPassword1">DosageAmount</label>
                                          <select class="form-control" name="dosageamount">
                                          <option value="Full">Full</option>
                                          <option value="3/4">3/4</option>
                                          <option value="1/2">1/2</option>
                                          <option value="1/4">1/4</option>
                                          <option value="1/8">1/8</option>

                                          </select>
                                           </div>
                                           <div class="form-group">
                                           <label for="exampleInputPassword1">Reasons for the dosage amount</label>
                                           <textarea rows="4" cols="58"   name="reasons"></textarea>
                                          </div>
                                           {{Form::submit('Assign Drug',array('class' =>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px;'))}}
                                        {!! Form::close() !!}
                                                     </div>
                                                     </div>
                                                     </div>




                                               </div>


         </div>

          </div><!--content-->
      </div><!--content page-->


@endsection
