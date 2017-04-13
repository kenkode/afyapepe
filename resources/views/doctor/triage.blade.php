<div class="wrapper wrapper-content">
  <div class="row">

          <?php if ($pdetails->persontreated=='Self') {
          ?>
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
              <?php } else { ?>
              <div class="ibox float-e-margins">
                <div class="table-responsive ibox-content">
              <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                 <thead>
              <tr>

                 <th>Weight </th>
                 <th>Height</th>
                 <th>Temperature</th>
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

               <td>{{ $pdetails->Infweight}}</td>
                <td>{{ $pdetails->Infheight}}</td>
                <td>{{$pdetails->Inftemp}}</td>
                <td> {{$pdetails->Infcompliant}}</td>
                 <td> {{ $pdetails->Infobservation}}</td>
                 <td> {{ $pdetails->Infsymptoms}}</td>
                 <td>{{ $pdetails->InfNnotes}}</td>
               </tr>
              <?php $i++; ?>
               @endforeach

              <tr> <td>
                Length of illness
              </td></tr>
              <thead>
             <tr>
              <th>Resp Rate <small>bpm</small></th>
              <th>Pulse <small>/min</small></th>
              <th>BP <small>/mmHg</small></th>
              <th>BMI</th>
              <th>Fever- No of days</th>
              <th>Difficult breathing</th>
              <th>Difficult feeding</th>

             </tr>
             </thead>

             <tbody>
             <?php $i =1; ?>

             @foreach($patientdetails as $pdetails)
             <tr>
              <td>{{$pdetails->Infresp_rate}}</td>
              <td>{{$pdetails->Infpulse}}</td>
              <td>{{$pdetails->Infbp}}</td>
              <td><?php $height=$pdetails->Infheight; $weight=$pdetails->Infweight;
                            $bmi =$weight/($height*$height);
                         echo number_format($bmi, 2);
                      ?></td>
              <td>{{$pdetails->fever_days}}</td>
              <td>{{$pdetails->difficult_breathing}}</td>
              <td>{{$pdetails->difficult_feeding}}</td>

             </tr>
             <?php $i++; ?>
               @endforeach
            <thead>
              <tr>
               <th>Diarrhoea <small>No of days</small></th>
               <th>Diarrhoea bloody</th>
               <th>Vomit Hours</th>
               <th>Vomits everything</th>
               <th>Convulsion <small>Hrs</small></th>
               <th>Partial/focal fits</th>
               <th>Apnoea</th>


              </tr>
              </thead>

              <tbody>
              <?php $i =1; ?>

              @foreach($patientdetails as $pdetails)
              <tr>
               <td>{{$pdetails->diarrhoea_day}}</td>
               <td>{{$pdetails->diarrhoea_bloody}}</td>
               <td>{{$pdetails->vomiting_hours}}</td>
               <td>{{$pdetails->vomiting_everything}}</td>
               <td>{{$pdetails->convulsion_hours}}</td>
               <td>{{$pdetails->fits}}</td>
               <td>{{$pdetails->aponea}}</td>

              </tr>
              <?php $i++; ?>
                @endforeach

                <tr> <td>
                  A&B
                </td></tr>
                <thead>
                <tr>
                <th>Stridor</th>
                <th>Oxygen saturation <small>%</small></th>
                <th>Central Cyanosis</th>
                <th>Indrawing</th>
                <th>Grunting</th>
                <th>Air entry bilateral</th>
                <th>Crackles</th>
                <th>Cry</th>

                </tr>
                </thead>
              <tbody>
                <?php $i =1; ?>

                @foreach($patientdetails as $pdetails)
                <tr>
                <td>{{$pdetails->stridor}}</td>
                <td>{{$pdetails->oxygen_saturation}}</td>
                <td>{{$pdetails->central_cyanosis}}</td>
                <td>{{$pdetails->indrawing}}</td>
                <td>{{$pdetails->grunting}}</td>
                <td>{{$pdetails->air_entry_bilateral}}</td>
                <td>{{$pdetails->crackles}}</td>
                <td>{{$pdetails->cry}}</td>

                </tr>
                <?php $i++; ?>
                 @endforeach
                 <tr> <td>
                   C
                 </td></tr>
                 <thead>
                 <tr>
                 <th>Femoral Pulse</th>
                 <th>Cap Refill</th>
                 <th>Murmur</th>
                 <th>Skin</th>
                 <th>Jaundice</th>
                 <th>Gest/Size</th>
                 <th>Pallor/Anaemia</th>
                 <th>Skin Cold</th>
                  </tr>
                 </thead>
               <tbody>
                 <?php $i =1; ?>

                 @foreach($patientdetails as $pdetails)
                 <tr>
                 <td>{{$pdetails->femoral_pulse}}</td>
                 <td>{{$pdetails->cap_refill}}</td>
                 <td>{{$pdetails->murmur}}</td>
                 <td>{{$pdetails->skin}}</td>
                <td>{{$pdetails->jaundice}}</td>
                 <td>{{$pdetails->gest_size}}</td>
                 <td>{{$pdetails->pallor}}</td>
                 <td>{{$pdetails->skin_cold}}</td>


                 </tr>
                 <?php $i++; ?>
                  @endforeach
                   </tbody>
              </table>
              </div>
            </div>
        </div>



<div class="row">
<div class="ibox float-e-margins">
              <div class="col-md-6">
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
                       <div class="form-group"><label class="col-lg-2 control-label">Abnormality</label>
                          <div class="col-lg-8"><input type="text" value="{{$abn->name}}" class="form-control" readonly="readonly" > </div>
                        </div>
                        <div class="form-group"><label class="col-lg-2 control-label">Details</label>
                           <div class="col-lg-8"><input type="text" value="{{$abn->notes}}" class="form-control" readonly="readonly" > </div>
                         </div>
                       @endforeach
                         </form>

                           </div>
                         </div>
                            <div class="col-md-6">
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
                        <div class="form-group"><label class="col-lg-2 control-label">Disabilities</label>
                           <div class="col-lg-10"><input type="text" value="{{$dis->name}}" class="form-control" readonly="readonly" > </div>
                         </div>
                         <div class="form-group"><label class="col-lg-2 control-label">Details</label>
                            <div class="col-lg-10"><input type="text" value="{{$dis->notes}}" class="form-control" readonly="readonly" > </div>
                          </div>
                        @endforeach

                           </form>
                           </div>
                         </div>
                      </div>
               </div>


                    <div class="row">
                      <div class="ibox float-e-margins">

                          <div class="ibox-title">
                                <h5>Mother Details</h5>
                          </div>
                          <div class="table-responsive ibox-content">

                          <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                             <thead>
                          <tr>

                             <th>Weight </th>
                             <th>Height</th>
                             <th>Temperature</th>
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

                           <td>{{ $pdetails->Infweight}}</td>
                            <td>{{ $pdetails->Infheight}}</td>
                            <td>{{$pdetails->Inftemp}}</td>
                            <td> {{$pdetails->Infcompliant}}</td>
                             <td> {{ $pdetails->Infobservation}}</td>
                             <td> {{ $pdetails->Infsymptoms}}</td>
                             <td>{{ $pdetails->InfNnotes}}</td>
                           </tr>
                          <?php $i++; ?>
                           @endforeach
                         </tbody>
                        </table>
                      </div>
                    </div>
              </div>

<?php } ?>

</div>
