
<div class="wrapper wrapper-content">
<?php if ($pdetails->persontreated=='Self') {
?>

  <div class="row">
         <div class="ibox float-e-margins">
            <div class="table-responsive ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                 <thead>
              <tr>
               <th></th>
                 <th>Weight </th>
                 <th>Height</th>
                 <th>Temperature</th>
                 <th>Systolic BP</th>
                 <th>Diastolic BP</th>
                 <th>BMI</th>
                 <th>Chief Compliant</th>
                 <th>Observations</th>
                 <th>Symptoms</th>
                 <th>Nurse Notes</th>
            </tr>
              </thead>

              <tbody>
              <?php $i =1; ?>

              @foreach($patientdetails as $pdetails)
                <tr>
                <td>{{ +$i }}</td>
               <td>{{$pdetails->current_weight}} </td>
                <td>{{ $pdetails->current_height}}</td>
                <td>{{  $pdetails->temperature}}</td>
                <td>{{ $pdetails->systolic_bp}}</td>
                 <td>{{ $pdetails->diastolic_bp}}</td>
                 <td>
                   <?php $height=$pdetails->current_height; $weight=$pdetails->current_weight;

                               $bmi =$weight/($height*$height);
                            echo number_format($bmi, 2);
                         ?></td>
                 <td>{{ $pdetails->chief_compliant}}</td>
                 <td> {{ $pdetails->observation}}</td>
                 <td> {{ $pdetails->symptoms}}</td>
                 <td>{{ $pdetails->nurse_notes}}</td>
               </tr>
              <?php $i++; ?>

              @endforeach

              </tbody>
              </table>
               </div>
             </div>

           </div>




              <?php }
              if ($dependantdays <='28') {
                ?>
                <div class="row">

              <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>Basic Wizzard</h5>
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

                      <div id="wizard">
                          <h1>Vital Signs</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Vitals</h3>
                        <form class="form-horizontal">

                   @foreach($patientdetails as $pdetails)

                   <div class="form-group"><label class="col-lg-4 control-label">weight</label>
                      <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infweight}}" class="form-control" readonly="readonly" > </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Height</label>
                       <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infheight}}" class="form-control" readonly="readonly" > </div>
                     </div>
                     <div class="form-group"><label class="col-lg-4 control-label">Temperature</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->Inftemp}}" class="form-control" readonly="readonly" > </div>
                      </div>

                <div class="form-group"><label class="col-lg-4 control-label">Resp Rate<small>bpm</small></label>
                  <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infresp_rate}}" class="form-control" readonly="readonly" > </div>
                </div>
                <div class="form-group"><label class="col-lg-4 control-label">Pulse<small>/min</small></label>
                   <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infpulse}}" class="form-control" readonly="readonly" > </div>
                </div>

             </form>
          </div>
                      <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <div class="form-group"><label class="col-lg-4 control-label">BP<small>/mmHg</small></label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infbp}}" class="form-control" readonly="readonly" > </div>
                           </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Resp Rate<small>bpm</small></label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infresp_rate}}" class="form-control" readonly="readonly" > </div>
                      </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Chief Compliant</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infcompliant}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">Observation</label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infobservation}}" class="form-control" readonly="readonly" > </div>
                            </div>
                            <div class="form-group"><label class="col-lg-4 control-label">Symptoms</label>
                               <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infsymptoms}}" class="form-control" readonly="readonly" > </div>
                             </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Nurse Notes</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->InfNnotes}}" class="form-control" readonly="readonly" > </div>
                           </div>

                        </form>
                        @endforeach
                      </div>
                  </div>
              </div>
                              </div>
                          </div>


                          <h1>Length of Illness</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Vitals</h3>
                        <form class="form-horizontal">

                   @foreach($patientdetails as $pdetails)

                   <div class="form-group"><label class="col-lg-4 control-label">Fever No of Days</label>
                      <div class="col-lg-8"><input type="text" value="{{ $pdetails->fever_days}}" class="form-control" readonly="readonly" > </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Difficult Breathing</label>
                       <div class="col-lg-8"><input type="text" value="{{ $pdetails->difficult_breathing}}" class="form-control" readonly="readonly" > </div>
                     </div>
                     <div class="form-group"><label class="col-lg-4 control-label">Difficult Feeding</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->difficult_feeding}}" class="form-control" readonly="readonly" > </div>
                      </div>

                <div class="form-group"><label class="col-lg-4 control-label">Diarrhoea<small>days</small></label>
                  <div class="col-lg-8"><input type="text" value="{{ $pdetails->diarrhoea_day}}" class="form-control" readonly="readonly" > </div>
                </div>


             </form>
          </div>
                      <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <div class="form-group"><label class="col-lg-4 control-label">Diarrhoea bloody</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->diarrhoea_bloody}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Vomit Hours</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->vomiting_hours}}" class="form-control" readonly="readonly" > </div>
                           </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Vomits everything</label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->vomiting_everything}}" class="form-control" readonly="readonly" > </div>
                      </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Convulsion <small>Hrs</small></label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->Infcompliant}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">Partial/focal fits</label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->convulsion_hours}}" class="form-control" readonly="readonly" > </div>
                            </div>
                            <div class="form-group"><label class="col-lg-4 control-label">Apnoea</label>
                               <div class="col-lg-8"><input type="text" value="{{ $pdetails->aponea}}" class="form-control" readonly="readonly" > </div>
                             </div>


                        </form>
                        @endforeach
                      </div>
                  </div>
              </div>
                              </div>
                          </div>
                          <h1>A & B</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                        <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">A & B</h3>
                        <form class="form-horizontal">

                        @foreach($patientdetails as $pdetails)

                        <div class="form-group"><label class="col-lg-4 control-label">Stridor</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->stridor}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Oxygen saturation <small>%</small></label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->oxygen_saturation}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Central Cyanosis</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->central_cyanosis}}" class="form-control" readonly="readonly" > </div>
                        </div>

                        <div class="form-group"><label class="col-lg-4 control-label">Indrawing</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->indrawing}}" class="form-control" readonly="readonly" > </div>
                        </div>


                        </form>
                        </div>
                        <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <br /><br />
                          <div class="form-group"><label class="col-lg-4 control-label">Grunting</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->grunting}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Air entry bilateral</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->air_entry_bilateral}}" class="form-control" readonly="readonly" > </div>
                           </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Crackles</label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->crackles}}" class="form-control" readonly="readonly" > </div>
                        </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Cry</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->cry}}" class="form-control" readonly="readonly" > </div>
                           </div>



                        </form>
                        @endforeach
                        </div>
                        </div>
                        </div>
                              </div>
                          </div>

                          <h1>C</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                  <div class="row">
                      <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">C</h3>
                        <form class="form-horizontal">

                   @foreach($patientdetails as $pdetails)

                   <div class="form-group"><label class="col-lg-4 control-label">Femoral Pulse</label>
                      <div class="col-lg-8"><input type="text" value="{{ $pdetails->femoral_pulse}}" class="form-control" readonly="readonly" > </div>
                    </div>
                    <div class="form-group"><label class="col-lg-4 control-label">Cap Refill</label>
                       <div class="col-lg-8"><input type="text" value="{{ $pdetails->cap_refill}}" class="form-control" readonly="readonly" > </div>
                     </div>
                     <div class="form-group"><label class="col-lg-4 control-label">Murmur</label>
                        <div class="col-lg-8"><input type="text" value="{{ $pdetails->murmur}}" class="form-control" readonly="readonly" > </div>
                      </div>

                <div class="form-group"><label class="col-lg-4 control-label">Skin</label>
                  <div class="col-lg-8"><input type="text" value="{{ $pdetails->skin}}" class="form-control" readonly="readonly" > </div>
                </div>


             </form>
          </div>
                      <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <br />  <br />
                          <div class="form-group"><label class="col-lg-4 control-label">Jaundice</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->jaundice}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Gest/Size</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->gest_size}}" class="form-control" readonly="readonly" > </div>
                           </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Pallor/Anaemia</label>
                              <div class="col-lg-8"><input type="text" value="{{ $pdetails->pallor}}" class="form-control" readonly="readonly" > </div>
                      </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Skin Cold</label>
                             <div class="col-lg-8"><input type="text" value="{{ $pdetails->skin_cold}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">Umblicus</label>
                              <div class="col-lg-8"><input type="text" value="{{$pdetails->umbilicus}}" class="form-control" readonly="readonly" > </div>
                            </div>


                        </form>
                        @endforeach
                      </div>
                  </div>
              </div>
                              </div>
                          </div>
                          <h1>Mother Details</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                        <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Mother Details</h3>
                        <form class="form-horizontal">

                <?php $MotherD=DB::table('mother_details')
                  ->leftJoin('afya_users', 'mother_details.afya_user_id',  '=', 'afya_users.id')
                  ->leftJoin('constituency', 'afya_users.constituency',  '=', 'constituency.const_id')
                  ->where('mother_details.dependant_id', '=', $dependantId)
                     ->select('mother_details.*','afya_users.*','constituency.constituency as const')
                     ->get();

                     ?>
                     @foreach($MotherD as $mother)
                     <div class="form-group"><label class="col-lg-4 control-label">Name</label>
                        <div class="col-lg-8"><input type="text" value="{{$mother->firstname}} {{$mother->secondName}}" class="form-control" readonly="readonly" > </div>
                      </div>
                      <div class="form-group"><label class="col-lg-4 control-label">Blood type</label>
                         <div class="col-lg-8"><input type="text" value="{{$mother->blood_type}}" class="form-control" readonly="readonly" > </div>
                       </div>
                       <div class="form-group"><label class="col-lg-4 control-label">Age</label>
                        <?php
                        $dob=$mother->dob;
                         $interval = date_diff(date_create(), date_create($dob));
                         $age= $interval->format(" %Y Year, %M Months, %d Days Old");?>


                          <div class="col-lg-8"><input type="text" value="{{$age}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Constituency</label>
                           <div class="col-lg-8"><input type="text" value="{{$mother->const}}" class="form-control" readonly="readonly" > </div>
                         </div>
                         <div class="form-group"><label class="col-lg-4 control-label">Gravity</label>
                            <div class="col-lg-8"><input type="text" value="{{$mother->gravity}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Parity</label>
                             <div class="col-lg-8"><input type="text" value="{{$mother->parity}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">Labour 1</label>
                              <div class="col-lg-8"><input type="text" value="{{$mother->labour1}}" class="form-control" readonly="readonly" > </div>
                            </div>

                         </form>
                        </div>
                        <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <br />  <br />
                          <div class="form-group"><label class="col-lg-4 control-label">Labour 2</label>
                             <div class="col-lg-8"><input type="text" value="{{$mother->labour2}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">APH</label>
                              <div class="col-lg-8"><input type="text" value="{{$mother->aph}}" class="form-control" readonly="readonly" > </div>
                            </div>
                            <div class="form-group"><label class="col-lg-4 control-label">Relevant Drugs</label>
                               <div class="col-lg-8"><input type="text" value="{{$mother->revelantdrugs}}" class="form-control" readonly="readonly" > </div>
                             </div>
                            <div class="form-group"><label class="col-lg-4 control-label">Other Issue</label>
                               <div class="col-lg-8"><input type="text" value="{{$mother->motherproblem}}" class="form-control" readonly="readonly" > </div>
                             </div>
                         @endforeach
                          <?php $MotherD=DB::table('mother_details')
                            ->leftJoin('patient_diagnosis', 'mother_details.afya_user_id',  '=', 'patient_diagnosis.afya_user_id')
                            ->leftJoin('diseases', 'patient_diagnosis.disease_id',  '=', 'diseases.id')
                            ->where([ ['mother_details.dependant_id', '=', $dependantId],
                            ['patient_diagnosis.chronic', '=', 'Y'],
                                    ])
                            ->select('patient_diagnosis.*','diseases.name as disease')
                            ->get();
                               ?>
                               @foreach($MotherD as $mother)
                          <div class="form-group"><label class="col-lg-4 control-label">Disease</label>
                             <div class="col-lg-8"><input type="text" value="{{ $mother->disease}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Date Diagnosed</label>
                             <div class="col-lg-8"><input type="text" value="{{$mother->date_diagnosed}}" class="form-control" readonly="readonly" > </div>
                          </div>



                        </form>
                        @endforeach
                        </div>
                        </div>
                        </div>
                              </div>
                          </div>

                          <h1>Baby's Details</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="ibox-content">
                        <div class="row">
                        <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Baby's Details</h3>
                        <form class="form-horizontal">
                          <?php $BabyD=DB::table('infant_details')
                            ->where('dependant_id', '=', $dependantId)
                            ->select('infant_details.*')
                            ->get();
                               ?>


                        <div class="form-group"><label class="col-lg-4 control-label">Age</label>
                        <div class="col-lg-8"><input type="text" value="{{ $dependantage}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        @foreach($BabyD as $baby)
                        <div class="form-group"><label class="col-lg-4 control-label">Birth wt</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->birthweight}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Gestation</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->gestation}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Apgar</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->apgar}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">BBA</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->bba}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Where Born</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->bba_where}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-4 control-label">Delivery</label>
                        <div class="col-lg-8"><input type="text" value="{{ $baby->delivery}}" class="form-control" readonly="readonly" > </div>
                        </div>
                      </form>
                        </div>
                        <div class="col-sm-6">
                        <form role="form" class="form-horizontal">
                          <br />  <br />
                          <div class="form-group"><label class="col-lg-4 control-label">Resuscitation</label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->resuscitation }}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Rom</label>
                          <div class="col-lg-8"><input type="text" value="{{$baby->rom }}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Delivery</label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->delivery}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Vitamin Given</label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->vitamen}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Prophylaxis</label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->prophylaxis}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Relevant Drugs </label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->revelantdrugs}}" class="form-control" readonly="readonly" > </div>
                          </div>
                          <div class="form-group"><label class="col-lg-4 control-label">Other Issues</label>
                          <div class="col-lg-8"><input type="text" value="{{ $baby->babyproblem}}" class="form-control" readonly="readonly" > </div>
                          </div>



                        </form>
                        @endforeach
                        </div>
                        </div>
                        </div>
                              </div>
                          </div>





                          <h1>Disability & Abnormalities</h1>
                          <div class="step-content">
                              <div class="text-center m-t-md">
                                <div class="col-lg-6">
                                  <div class="ibox-title">
                                        <h5>Disabilities</h5>
                                  </div>
                                 <div class="ibox-content">

                                 <form class="form-horizontal">
                            <?php $disabilities=DB::table('patient_disabilities')->where('dependant_id', '=', $dependantId)
                            ->select('name','notes')
                            ->get();
                            ?>
                            @foreach($disabilities as $dis)
                            <div class="form-group"><label class="col-lg-4 control-label">Disabilities</label>
                               <div class="col-lg-8"><input type="text" value="{{$dis->name}}" class="form-control" readonly="readonly" > </div>
                             </div>
                             <div class="form-group"><label class="col-lg-4 control-label">Details</label>
                                <div class="col-lg-8"><input type="text" value="{{$dis->notes}}" class="form-control" readonly="readonly" > </div>
                              </div>
                            @endforeach

                               </form>
                               </div>
                               </div>
                              <div class="col-lg-6">
                                <div class="ibox-title">
                                      <h5>Abnormalities</h5>
                                </div>
                               <div class="ibox-content">

                               <form class="form-horizontal">
                          <?php $abnormalities=DB::table('patient_abnormalities')->where('dependant_id', '=', $dependantId)
                          ->select('name','notes')
                          ->get();
                          ?>
                          @foreach($abnormalities as $abn)
                          <div class="form-group"><label class="col-lg-4 control-label">Abnormality</label>
                             <div class="col-lg-8"><input type="text" value="{{$abn->name}}" class="form-control" readonly="readonly" > </div>
                           </div>
                           <div class="form-group"><label class="col-lg-4 control-label">Details</label>
                              <div class="col-lg-8"><input type="text" value="{{$abn->notes}}" class="form-control" readonly="readonly" > </div>
                            </div>

                          @endforeach
                            </form>
                            </div>
                              </div>
                          </div>




                      </div>

                  </div>
              </div>
          </div>
          </div>
</div>

<?php } ?>

 </div>
