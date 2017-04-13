{{ Form::open(array('route' => array('prescription.store'),'method'=>'POST')) }}

          <?php  $routem= (new \App\Http\Controllers\TestController);
                $routems = $routem->RouteM();
            ?>
          <?php $Strength= (new \App\Http\Controllers\TestController);
                $Strengths = $Strength->Strength();
            ?>
          <?php $frequency= (new \App\Http\Controllers\TestController);
                $frequent = $frequency->Frequency();
            ?>


              <div class="ibox float-e-margins">
                <div class="ibox-content col-md-12">
            <div class="ibox-content col-md-8 col-md-offset-2">

                  <div class="form-group ">
                      <label for="d_list3" class="col-md-4">Confirmed Diagnosis:</label>
                      <select  name="diagnosis" class="form-control d_list2" style="width: 50%"></select>
                  </div>
                  <div class="form-group">
                      <label for="presc" class="col-md-4">Prescription:</label>
                      <select id="presc" name="prescription" class="form-control presc1" style="width: 50%"></select>
                  </div>
                  <div class="form-group">
                      <label for="dosage" class="col-md-4">Dosage Form</label></td>
                       <select class="form-control m-b col-md-4" name="dosageform" id="example-getting-started" style="width: 50%">
                        <?php $druglists=DB::table('druglists')->distinct()->get(['DosageForm']); ?>
                        @foreach($druglists as $druglist)
                               <option value='{{$druglist->DosageForm}}'>{{$druglist->DosageForm}}</option>
                        @endforeach
                      </select>
                    </div>

                     <div class="form-group">
                      <label for="dosage" class="col-md-4 control-label">Strength</label></td>
                       <select class="form-control" id="testsj" name="strength" style="width: 25%">
                           @foreach($Strengths as $Strengthz)
                             <option value="{{$Strengthz->strength}}">{{ $Strengthz->strength  }}  </option>
                          @endforeach
                      </select>

                <input type="radio" name="strength_unit" value="ml"> Ml &nbsp;&nbsp;<input type="radio" name="strength_unit" value="mg"> Mg

                   </div>

                     <div class="form-group">
                      <label for="dosage" class="col-md-4 control-label">Route</label></td>
                       <select class="form-control" name="routes" style="width: 50%">
                           @foreach($routems as $routemz)
                             <option value="{{$routemz->id }}">{{ $routemz->abbreviation }}----{{ $routemz->name  }} </option>
                          @endforeach
                       </select>
                    </div>

                      <div class="form-group">
                      <label for="dosage" class="col-md-4 control-label">Frequency</label></td>
                       <select class="form-control"  name="frequency" style="width: 50%">
                           @foreach($frequent as $freq)
                             <option value="{{$freq->id }}">{{ $freq->abbreviation }}----{{ $freq->name  }} </option>
                          @endforeach
                       </select>
                    </div>

                    {{ Form::hidden('appointment_id',$pdetails->app_id, array('class' => 'form-control')) }}
                    {{ Form::hidden('doc_id',$Docdata->doc_id, array('class' => 'form-control')) }}



                            <div class="form-group  text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>  </td>
                             </div>

                        {{ Form::close() }}
                            </div>
                            <div class="col-lg-12">
                              <div class="ibox float-e-margins">
                                <div class="ibox-content col-md-12">
                                <div class="ibox-title">
                                    <h5>Prescription List</h5>
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
                                   <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                                <thead>
                               <tr>
                                 <th></th>


                                    <th>Diagnosis</th>
                                    <th>Drug Name</th>
                                    <th>Dosage Form</th>
                                   <th>Strength</th>
                                   <th>Strength Unit</th>
                                   <th>Date given</th>
                             </tr>
                           </thead>

                           <tbody>
                             <?php $i =1; ?>

                          @foreach($prescription as $presc)
                                  <tr>
                                     <td>{{ +$i }}</td>
                                   <td>{{$presc->name}}</td>
                                   <td>{{$presc->drugname}}</td>
                                   <td>{{$presc->doseform}}</td>
                                   <td>{{$presc->strength}}</td>
                                   <td>{{$presc->strength_unit}}</td>
                                   <td>{{$presc->created_at}}</td>

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
                       </div>
