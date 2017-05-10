
<div class="wrapper wrapper-content">


           <div class="col-lg-12">
                       <div class="ibox float-e-margins">
                           <div class="ibox-title">
                               <h5>Today's Vitals </h5>
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
                               <div class="row">
                                   <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Sign in</h3>

                                       <form role="form" class="form-horizontal">
                                 @foreach($patientdetails as $pdetails)
                                           <div class="form-group"><label class="col-lg-3 control-label">Weight</label>
                                                <div class="col-lg-6">
                                              <input type="text" value="{{$pdetails->current_weight}}" class="form-control" readonly ></div>
                                           </div>
                                           <div class="form-group"><label class="col-lg-3 control-label">Height</label>
                                                <div class="col-lg-6">
                                              <input type="text" value="{{$pdetails->current_height}}" class="form-control" readonly ></div>
                                           </div>
                                           <div class="form-group"><label class="col-lg-3 control-label">Temperature</label>
                                                <div class="col-lg-6">
                                              <input type="text" value="{{$pdetails->temperature}}" class="form-control" readonly ></div>
                                           </div>
                                           <div class="form-group"><label class="col-lg-3 control-label">Systolic BP</label>
                                                <div class="col-lg-6">
                                              <input type="text" value="{{$pdetails->systolic_bp}}" class="form-control" readonly ></div>
                                           </div>
                                           <div class="form-group"><label class="col-lg-3 control-label">Diastolic BP</label>
                                                <div class="col-lg-6">
                                              <input type="text" value="{{$pdetails->diastolic_bp}}" class="form-control" readonly ></div>
                                           </div>
                                           <?php $height=$pdetails->current_height; $weight=$pdetails->current_weight;

                                                       $bmi =$weight/($height*$height);

                                                 ?>
                                                 <div class="form-group"><label class="col-lg-3 control-label">BMI</label>
                                                      <div class="col-lg-6">
                                                    <input type="text" value="<?php echo number_format($bmi, 2); ?>" class="form-control" readonly ></div>
                                                 </div>
                                       </form>
                                   </div>

                                   <div class="col-sm-6"><h4></h4>
                                     <form class="form-horizontal">
                                      <br /><br />
                                       <div class="form-group"><label class="col-lg-3 control-label">Chief Compliant</label>
                                            <div class="col-lg-6">
                                          <input type="text" value="{{$pdetails->chief_compliant}}" class="form-control" readonly ></div>
                                       </div>

                                       <div class="form-group"><label class="col-lg-3 control-label">Observation</label>
                                            <div class="col-lg-6">
                                          <input type="text" value="{{$pdetails->observation}}" class="form-control" readonly ></div>
                                       </div>

                                       <div class="form-group"><label class="col-lg-3 control-label">Symptoms</label>
                                            <div class="col-lg-6">
                                          <input type="text" value="{{$pdetails->symptoms}}" class="form-control" readonly ></div>
                                       </div>
                                       <div class="form-group"><label class="col-lg-3 control-label">Nurse notes</label>
                                            <div class="col-lg-6">
                                                <textarea class="form-control" rows="5" value="{{$pdetails->nurse_notes}}" readonly=""></textarea>
                                           </div>
                                       </div>

                        </form>
                        @endforeach
                                   </div>

                               </div>
                           </div>
                       </div>
                   </div>


</div>
