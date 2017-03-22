@extends('layouts.pharmacy')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">

                    <div class="row">

                         {!! Form::open(array('route' => 'pharmacy.store')) !!}

                        <div class="col-sm-6 ">
                          <h2>Doctor</h2>
                        <input type="hidden" name="id" value="{{$patient->  patient_id}}">

                         <div class="panel-box">
                           <div class="form-group">
                           <h5><label for="exampleInputPassword1">Doctor's Note</label></h5>
                           <br>
                           <textarea rows="4" cols="58"  name="docprescription"readonly>{{$patient->Doctor_note}}</textarea>
                          </div>
                        <div class="form-group">
                        <h5><label for="exampleInputPassword1">Doctor's Prescription</label></h5>
                        <br>
                        <textarea rows="4" cols="58"  name="docprescription"readonly>{{$patient->prescription}}</textarea>
                       </div>
                     </div>
                   </div>
                   <div class="col-sm-6 ">
                    <h2>Pharmacy</h2>
                    <div class="panel-box">
                       <div class="form-group">
                        <label for="exampleInputPassword1">Drugs</label>
                        <select class="form-control" name="druglist">
                        <?php  $druglists = DB::table('druglists')->get();?>
                                      @foreach($druglists as $druglist)
                                       <option value="{{$druglist->id}}">{{$druglist->drugname}}</option>
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
                      <label for="exampleInputEmail1">Quantity</label>
                     <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Quantity" name="quantity"  required>
                      </div>
                       <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                     <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Price" name="price"  required>
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

                         </div>


         </div>

          </div><!--content-->
      </div><!--content page-->


@endsection
