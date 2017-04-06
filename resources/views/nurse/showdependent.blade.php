@extends('layouts.nurse')
@section('title', 'Patient Details')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
    <div class="col-lg-6 ">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Dependant Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
            <?php $dependant=DB::table('dependant')->where('id',$id)->first(); ?>
    <form class="form-horizontal" role="form" method="POST" action="/updateuser" novalidate>
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
              <div class="form-group">
             <label for="exampleInputEmail1">Name</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="kin_name"  value="{{$dependant->firstName}}  {{$dependant->secondName}}" readonly=""  >
             </div>


              
             <div class="form-group">
            <label for="exampleInputPassword1">Blood Group</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Blood Group" name="phone" value="{{$dependant->blood_type or ''}}" readonly  >
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Gender</label>
             <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$dependant->gender or ''}}" readonly  >
            </div>

            
  </div>
  </div>
  </div>

  <div class="col-lg-6 ">
  <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Parent Information</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
   <div class="form-group">
            <?php $father=DB::table('dependant_parent')->where('dependant_id',$id)->where('relationship','=','Father')->first();?>
            <label for="exampleInputPassword1">Father Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$father->name or ''}}" readonly  >
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Father Phone</label>
             <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$father->phone or ''}}" readonly  >
            </div>
             <?php $mother=DB::table('dependant_parent')->where('dependant_id',$id)->where('relationship','=','Mother')->first();?>
             <div class="form-group">
            <label for="exampleInputPassword1">Mother Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$mother->name or ''}}" readonly  >
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Mother Phone</label>
             <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$mother->phone or ''}}" readonly  >
            </div>
  <a href="{{ url('update.dependant', $dependant->id) }}" class="btn btn-primary btn-sm">Update Details</a>
            
  </div>
  </div>
  </div>
  </form>




 <div class="col-lg-12">
            <div class="tabs-container">
              <!-- <div class="col-lg-12 tbg"> -->
                <ul class="nav nav-tabs">

                     <li class="active"><a data-toggle="tab" href="#tab-7">Baby Details</a></li>
                      <li class=""><a data-toggle="tab" href="#tab-8">Mother Details</a></li>
                     <li class=""><a data-toggle="tab" href="#tab-5">Vitals</a></li>
                     <li class=""><a data-toggle="tab" href="#tab-9">General Examination</a></li>
                      <li class=""><a data-toggle="tab" href="#tab-10">Abnormalities</a></li>
                      <li class=""><a data-toggle="tab" href="#tab-1">Immunination Chart</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Measures of Growth & Weight</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Nutrition Check</a></li>
                     <li class=""><a data-toggle="tab" href="#tab-6">Allergies</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Adverse Events</a></li>
                    
                   
                </ul>
    <div class="tab-content">
    <div id="tab-7" class="tab-pane active">
                        <div class="panel-body">
  
          <div class="row">
      <div class="col-lg-6">
  <div class="ibox float-e-margins">
   <h4><label><u>Baby Details</u></label></h4>
           
  <div class="ibox-content">
  
     <form class="form-horizontal" role="form" method="POST" action="/updateinfant" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$dependant->id}}" name="id"  required>
   
   <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">Admission Date</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="dob" value="">
                 </div>
                 </div>
    <div class="form-group">
                 <label for="exampleInputPassword1">IP No</label>
            <input type="text" class="form-control" name="ipno">
    </div>
    <div class="form-group">
                 <label for="exampleInputPassword1">Gestation</label>
           <select name="" class="form-control">
  <option value="Latent TB">24 weeks</option>
  <option value="TB Disease">25 weeks</option>  
</select>
    </div>

    <div class="form-group">
                 <label for="exampleInputPassword1">Temperature</label>
            <input type="number" class="form-control" name="temperature">
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">APGar</label>
   1m <input type="checkbox" value="1m"  name="apgar"/>
   5m <input type="checkbox" value="5m"  name="apgar"/>
   10m <input type="checkbox" value="10m"  name="apgar"/>
   </div>

   <div class="form-group">
                 <label for="exampleInputPassword1">Birth Weight</label>
            <input type="number" class="form-control" name="birthweight">
    </div>
    <div class="form-group">
                 <label for="exampleInputPassword1">Weight Now</label>
            <input type="number" class="form-control" name="weightnow">
    </div>
    </div>
    
    </div>
    </div>

<div class="col-lg-6">
       <div class="form-group">
   <label for="exampleInputEmail1">BBA</label>
   No <input type="checkbox" value="No"  name="bba" />
   Yes <input type="checkbox" value="yes"  name="bba"  />
    

<div class="yes"  style="display: none">
    <label>Born Where</label>
  Home  <input type="checkbox" value="Home"  name="bba_where"/>
  Clinic  <input type="checkbox" value="Clinic"  name="bba_where" />
  Other Hospitals <input type="checkbox" value="Other"  name="bba_where" />
    
</div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Delivery</label>
   SDV <input type="checkbox" value="SDV"  name="delivery"/>
   Vacuum <input type="checkbox" value="vaccum"  name="delivery"/>
   Breech <input type="checkbox" value="breech"  name="delivery"/>
   Cs <input type="checkbox" value="cs"  name="delivery"/>
   
   </div>

   <div class="form-group">
   <label>Resuscitation</label>
   None <input type="checkbox" value="None"  name="resuscitation"/>
   Oxygen <input type="checkbox" value="Oxygen"  name="resuscitation"/>
   Bag/Mask <input type="checkbox" value="Bag/Mask"  name="resuscitation"/>
   </div>

   <div class="form-group">
   <label>ROM</label>
  12 h<input type="checkbox" value="-<12h" name="rom"/>
  12-18>18<input type="checkbox" value="12-18>18h" name="rom"/>
     
   </div>
   <div class="form-group">
   <label>Given Vitamen: K</label>
   Yes <input type="checkbox" name="vitamen" value="Yes">
   No <input type="checkbox" name="vitamen" value="No">
     
   </div>

   <div class="form-group">
     <label>Given Eye Prophylaxis</label>
      Yes <input type="checkbox" name="prophylaxis" value="Yes">
   No <input type="checkbox" name="prophylaxis" value="No">
   </div>

   <div class="form-group">
<label>Babies Presenting Problems</label>
<textarea name="babyproblem" class="form-control"></textarea>
  
</div>
<div class="form-group">
<label>Revelant Drugs( Pre Admission)</label>
<textarea name="revelantdrugs" class="form-control"></textarea>
  
</div>
   </div>

   <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
  
   </div>
   </div>
      </div> 
      </form>

      <div id="tab-8" class="tab-pane">
                        <div class="panel-body">
<h4><label><u>Mother Details</u></label></h4>
  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">

          <div class="row"> 
          <div class="col-lg-6">
  <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">Date of Birth</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="dob" value="">
                 </div>
                 </div>
  
  <div class="form-group">
  <label>Gravidity</label><br>
  <input type="text" name="gravidity" placeholder="mother gravidity" class="form-control" />
    
  </div>
  <div class="form-group">
  <label>Parity</label><br>
  <input type="text" name="parity" class="form-control" placeholder="mother parity" />
    
  </div>
  <div class="form-group">
              <label for="exampleInputEmail1">Blood Group</label>
              <select class="form-control" name="blood_type">
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
 <label>Sublocation</label>
 <input type="text" name="sublocation" class="form-control">
   
 </div>
     <div class="form-group">
   <label for="exampleInputEmail1">Hiv status</label>
   Negative <input type="checkbox" value="Negative"  name="hiv" />
   Positive <input type="checkbox" value="Positive"  name="hiv"  />

<div class="Positive"  style="display: none">
    <label>ARV's</label>
  No  <input type="checkbox" value="No"  name="arvs"/>
  Yes  <input type="checkbox" value="Yes"  name="arvs" />
     
</div>
</div>
<div class="form-group">
<label>VDRL</label>
 Negative <input type="checkbox" value="Negative"  name="vdrl" />
   Positive <input type="checkbox" value="Positive"  name="vdrl"  />
 
</div>

<div class="form-group">
<label>Fever</label>
 No <input type="checkbox" value="No"  name="fever" />
   Yes <input type="checkbox" value="Yes"  name="fever"  />
 
</div>
<div class="form-group">
<label>Antibiotics</label>
Yes <input type="checkbox" name="antibiotics" value="Yes" />
No <input type="checkbox" name="antibiotics" value="No" />
  
</div>

<div class="form-group">
<label>Diabetes</label>
Yes <input type="checkbox" name="diabetes" value="Yes" />
No <input type="checkbox" name="diabetes" value="No" />
  
</div>
<div class="form-group">
<label>TB Positive</label>
<select name="" class="form-control">
  <option value="Latent TB">Latent TB</option>
  <option value="TB Disease">TB Disease</option>  
</select>
Yes <input type="checkbox" name="tb" value="Yes" />
No <input type="checkbox" name="tb" value="No" />
  
</div>
<div class="form-group">
<label>TB Treatment</label>
Yes <input type="checkbox" name="tb_treatment" value="Yes" />
No <input type="checkbox" name="tb_treatment" value="No" />
  
</div>
</div>
<div class="col-lg-6">
<div class="form-group">
<label>Labour</label><br>
1 stage <input type="text" name="labour1" class="form-control" placeholder="Enter Hours"/>
2 stage <input type="text" name="labour2" class="form-control" placeholder="Enter Minutes"/>
</div>

<div class="form-group">
<label>Hypertention</label>
Yes <input type="checkbox" name="hypertention" value="Yes" />
No <input type="checkbox" name="hypertention" value="No" />
  </div>

<div class="form-group">
<label>APH</label>
Yes <input type="checkbox" name="aph" value="Yes" />
No <input type="checkbox" name="aph" value="No" />
  </div>


<div class="form-group">
<label>Mother Presenting Problems?</label>
<textarea name="motherproblem" class="form-control"></textarea>
  
</div>
<div class="form-group">
<label>Revelant Drugs( Pre Admission)</label>
<textarea name="revelantdrugs" class="form-control"></textarea>
  
</div>

<button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}

      </div> 
      </div>
      </div> 
      </div> 
      </div>
      </div>
      
                      <div id="tab-1" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">

           <div class="col-lg-10 col-lg-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Immunination Chart</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                   


                                                                 <table class="table table-small-font table-bordered table-striped">
                                                              <thead>
                                                                  <tr>
                                                                      <th>No</th>
                                                                      <th>Disease</th>
                                                                      <th>Antigen</th>
                                                                      <th>Duration</th>

                                                                     
                                                                      <th>Date Guideline</th>

                                                                      <th>Status</th>
                                                                      <th>Vaccination Date</th>
                                                                      <th>Vaccine Name</th>

                                                                </tr>
                                                              </thead>
                                                              
                                                        <?php  $vaccines=DB::table('vaccine')->leftjoin('dependant_vaccination','dependant_vaccination.vaccine_id','=','vaccine.id')->select('vaccine.*','dependant_vaccination.*','dependant_vaccination.id as userid')
                                                         ->where('vaccine.age','=>',$length)->get(); ?>
                                                          <?php $i=1; ?>
                                                        @foreach($vaccines as $vaccine)
                                                          
                                                              <tbody>
                                                      
                                                           <tr>
                                                         <td><a href="{{url('immunination',$vaccine->userid)}}">
                                                         {{$i}}</a></td>
                                                         <td><a href="{{url('immunination',$vaccine->userid)}}">{{$vaccine->disease}}</a></td>
                                                         <td><a href="{{url('immunination',$vaccine->userid)}}">{{$vaccine->antigen}}</a></td>
                                                        
                                                         <td>{{$vaccine->duration or ''}}</td>
                                                         <td>{{$vaccine->date_guideline or ''}}</td>
                                                          <td>{{$vaccine->status or ''}}</td>
                                                          <td>{{$vaccine->status_date or ''}}</td>
                                                           <td>{{$vaccine-> vaccin_name or ''}}</td>       
                                                        
                                                             </tr>
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach

                                                      
                                                             </table>

                                                               



                    </div>
         
                </div>
            </div>
      </div> 
      </div> 
      </div> 
      </div>   

<div id="tab-5" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
    <?php $infants=DB::table('infants_details')->where('dependent_id',$dependant->id)->get(); 
    $abs=DB::table('infact_abnormalities')->where('dependent_id',$dependant->id)->get(); 
    ?>
     
     @if (count($infants) > 0)
      <div class="col-lg-10 col-lg-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                   
<h4><label><u>Baby Details</u></label></h4>

                                                                 <table class="table table-small-font table-bordered table-striped">
                                                              <thead>
                                                                  <tr>
                                                                      <th>No</th>
                                                                      <th>Date</th>
                                                                      <th>Time</th>
                                                                      <th>Breast Feed</th>
                                                                      <th>Stiff Neck</th>
                                                                      <th>Bulging Fontanelle</th>

                                                                     
                                                                      <th>Reduce Movement/Tone</th>

                                                                      <th>Umbilicus</th>
                                                                      <th>Skin</th>
                                                                      <th>Jaundice</th>
                                                                      <th>Gest/Size</th>
                                                                      

                                                                </tr>
                                                              </thead>
                                                              
                                                                                                              <?php $i=1; ?>
                                                        @foreach($infants as $infant)
                                                          
                                                              <tbody>
                                                      
                                                           <tr>
                                                         <td>{{$i}}</td> 
                                                         <td>{{ date('d -m- Y', strtotime($infant->created_at))}}</td>     
                                                        <td>{{ date('H:i:s', strtotime($infant->created_at))}}</td>     
                                                        <td>{{$infant->breast_feed}}</td>     
                                                        <td>{{$infant->stiff_neck}}</td>     
                                                        <td>{{$infant->bulging_fontance}}</td>     
                                                        <td>{{$infant->reduced_movement}}</td>     
                                                        <td>{{$infant->umbilicus}}</td>     
                                                        <td>{{$infant->skin}}</td>     
                                                        <td>{{$infant->jaundice}}</td>     
                                                        <td>{{$infant->gest_size}}</td>     
                                                           
                                                        
                                                             </tr>
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach

                                                      
                                                             </table>

<br>



 
                                                               



                    </div>
         
                </div>
            </div>
     @else
      <div class="row">
      <div class="col-lg-6">
<h4><label><u>Vitals</u></label></h4>
 <div class="form-group">
   <label for="exampleInputEmail1">Fever</label>
   No<input type="checkbox" value="No_fevers"  name="fevers" />
   Yes <input type="checkbox" value="Yes_fevers"  name="fevers"  />

<div class="Yes_fevers"  style="display: none">
    <label>Number of days</label>
  <input type="number" value="No"  name="days"/>
  
     
</div>
</div>
<div class="form-group">
<label>Difficulty Breathing</label>
 No  <input type="checkbox" value="No"  name="difficulty_breathing" />
 Yes <input type="checkbox" value="Yes"  name="difficulty_breathing"  />
  
</div>

 <div class="form-group">
   <label for="exampleInputEmail1">Diarrhoea</label>
   No<input type="checkbox" value="No_diarrhoea"  name="diarrhoea" />
   Yes <input type="checkbox" value="Yes_diarrhoea"  name="diarrhoea"  />

<div class="Yes_diarrhoea"  style="display: none">
    <label>Number of days</label>
  <input type="number" value="No"  name="diarrhoea_days"/>
  
     
</div>
</div>
<div class="form-group">
<label>Diarrhoea-Bloody</label>
 No  <input type="checkbox" value="No"  name="diarrhoea_bloody" />
 Yes <input type="checkbox" value="Yes"  name="diarrhoea_bloody"  />
  
</div>

<div class="form-group">
<label>Vomiting Yes/No?</label>
 No  <input type="checkbox" value="No_vomiting"  name="vomiting" />
 Yes <input type="checkbox" value="Yes_vomiting"  name="vomiting"  />
 <div class="Yes_vomiting"  style="display: none">
    <label>number per 24 hours</label>
  <input type="number"  name="vomiting_hours"/>
  </div>
</div>

<div class="form-group">
<label>Vomits Everything?</label>
 No  <input type="checkbox" value="No"  name="vomits_eveything" />
 Yes <input type="checkbox" value="Yes"  name="vomits_eveything"  />
  
</div>

<div class="form-group">
<label>Difficult Feeding?</label>
 No  <input type="checkbox" value="No"  name="feeding_difficult" />
 Yes <input type="checkbox" value="Yes"  name="feeding_difficult"  />
  
</div>

<div class="form-group">
<label>Convulsion</label>
No  <input type="checkbox" value="No_convulsion"  name="convulsion" />
 Yes <input type="checkbox" value="Yes_convulsion"  name="convulsion"  />
 <div class="Yes_convulsion"  style="display: none">
    <label>number per 24 hours</label><br>
  <input type="number"  name="convulsion_hours"/>
  </div>
  
</div>
<div class="form-group">
<label>Partial/Focal Fits?</label>
 No  <input type="checkbox" value="No"  name="fits" />
 Yes <input type="checkbox" value="Yes"  name="fits"  />
  
</div>

<div class="form-group">
<label>Apnoea?</label>
 No  <input type="checkbox" value="No"  name="apnoea" />
 Yes <input type="checkbox" value="Yes"  name="apnoea"  />
  
</div>
<h4> <label><U>Circulation</U></label></h4>
    <div class="form-group">
    <label>Femoral Pulse</label>
    Normal <input type="checkbox" value="Normal"  name="femoral_pulse"/>
    Weak <input type="checkbox" value="Weak"  name="femoral_pulse"/>
    </div>
  <div class="form-group">
    <label>Cap Refill</label>
    Possible <input type="checkbox" name="refill" value="possible" />
    Not Possible <input type="checkbox" name="refill" value="notpossible">
    <div class="possible"  style="display: none">
    <label>In Seconds</label>
  <input type="number" name="Seconds">
    
</div>
  </div>

  <div class="form-group">
    <label>Murmur</label>
    Yes <input type="checkbox" name="Murmur" value="Murmur_Yes" />
    No <input type="checkbox" name="Murmur" value="Murmur_No">
    <div class="possible"  style="display: none">
    <label>Yes?</label>
  <input type="text" name="murmur_yes">
    
</div>
</div>
<div>
<label>Pallor/Anaemia</label>
0 <input type="checkbox" name="pallor" value="0" />
+ <input type="checkbox" name="pallor" value="+" />
+++ <input type="checkbox" name="pallor" value="+++" />
  
</div>


<div class="form-group">
<label>Skin cold</label>
Hand <input type="checkbox" name="skincold" value="Hand" />
Elbow <input type="checkbox" name="skincold" value="Elbow" />
Shoulder <input type="checkbox" name="skincold" value="Shoulder" />
  </div>
    
  </div>

<div class="col-lg-6">
   <h4> <label><u>Airways & Breathing</u></label></h4>

    <div class="form-group">
    <label for="exampleInputPassword1">Stridor</label>
    No <input type="checkbox" value="No"  name="stridor"/>
    Yes  <input type="checkbox" value="Yes"  name="stridor"/>
    </div>

    <div class="form-group">
    <label>Oxygen Saturation (enter(represent this in %)</label>
    <input type="text" name="oxygen_saturation" class="form-control">
    </div>
    <div class="form-group">
    <label>Central Cyanosis</label>
    No <input type="checkbox" value="No"  name="cyanosis"/>
    Yes  <input type="checkbox" value="Yes"  name="cyanosis"/>
    </div>
    <div class="form-group">
    <label>InDrawing</label>
    None <input type="checkbox" name="indrawing" value="None">
    Severe <input type="checkbox" name="indrawing" value="Severe">
    Sternum <input type="checkbox" name="indrawing" value="Sternum">
      
    </div>  
    <div class="form-group">
    <label for="exampleInputPassword1">Grunting</label>
    No <input type="checkbox" value="No"  name="grunting"/>
    Yes  <input type="checkbox" value="Yes"  name="grunting"/>
    </div>  
    <div class="form-group">
    <label for="exampleInputPassword1">Air Entry Bilateral</label>
    No <input type="checkbox" value="No"  name="air_entry"/>
    Yes  <input type="checkbox" value="Yes"  name="air_entry"/>
    </div>
    <div class="form-group">
    <label>Crackles</label>
    No <input type="checkbox" value="No"  name="crackles"/>
    Yes  <input type="checkbox" value="Yes"  name="crackles"/>
    </div>
    <div class="form-group">
    <label>Cry</label>
    Normal <input type="checkbox" value="No"  name="cry"/>
    Hoarse  <input type="checkbox" value="Yes"  name="cry"/>
    Weak  <input type="checkbox" value="Yes"  name="cry"/>
    </div>

     <h4> <label><u>Other Vitals</u></label></h4>
    <div class="form-group">
    <label for="exampleInputEmail1">Weight</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Weight" name="weight"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Height</label>
    <input type="name" class="form-control" placeholder="Height in Metres" name="current_height"
     required>
    </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Temperature</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Temperature" name="temperature"  required>
   </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Systolic BP</label>
    <input type="name" class="form-control" id="exampleInputPassword1" placeholder="Systolic BP" name="systolic"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Diastolic BP</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Diastolic BP" name="diastolic"  required>
    </div>
 
  

     <div class="form-group">
    <label for="exampleInputPassword1">Chief Complaint/Reason for visit</label>
    <select multiple="multiple" class="form-control" name="chiefcompliant[]"  >
    <?php $chiefs = DB::table('chief_compliant_table')->get();?>
                  @foreach($chiefs as $chief)
                   <option value="{{$chief->name}}">{{$chief->name}}</option>
                 @endforeach
                </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Observation</label>
    <select  class="form-control" name="observation" id="observation" >
    
                  @foreach($observations as $observation)
                   <option value="{{$observation->name}}">{{$observation->name}}</option>
                 @endforeach
                </select>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">symptoms</label>
    <select  class="form-control" name="symptoms" id="symptoms">
     @foreach($symptoms as  $symptom)
                   <option value="{{$symptom->name}}">{{$symptom->name}}</option>
                 @endforeach
    
                </select>
    </div>
    

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Notes</label>
    <textarea class="form-control" placeholer="" name="nurse" required>
    </textarea>

    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Consulting Physician</label>
    <select class="form-control" name="doctor" >
    <?php $doctors = DB::table('users')->Where('role', '=','Doctor')->get();?>
                  @foreach($doctors as $doctor)
                   <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                 @endforeach
                </select>
    </div>
    

   <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}

 
  

</div>
            
 
  
  


  @endif
  </div>
  </div>
      
      </div> 
      </div> 
      </div> 
      
 <div id="tab-6" class="tab-pane ">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
      
 <div class="col-lg-10">
    <div class="ibox float-e-margins">
     
      <div class="ibox-content">

<div class="form-group">

 Drug Allergy <input type="checkbox" value="drug"  name="drug" />
 <div class="drug"  style="display: none">
    <label>Drug Name</label><br>
 <select multiple="multiple" class="form-control" name="drugs[]">
    <?php $druglists = DB::table('druglists')->get();?>
                  @foreach($druglists as $druglist)
                   <option value="{{$druglist->id}}">{{$druglist->drugname}}</option>
                 @endforeach
                </select>
    </div>

 Food Allergy <input type="checkbox" value="food"  name="food" />
 <div class="food"  style="display: none">
    <label>Food Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="foods[]"  >
    <?php $foods = DB::table('food_allergy')->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
 Latex Allergy <input type="checkbox" value="latex"  name="latex" />
 <div class="latex"  style="display: none">
    <label>Latex Allergy Name</label><br>
   <select multiple="multiple" class="form-control" name="latexs[]"  >
    <?php $latexs = DB::table('Latex_allergy')->get();?>
                  @foreach($latexs as $latex)
                   <option value="{{$latex->id}}">{{$latex->name}}</option>
                 @endforeach
                </select>
  </div>
 Mold Allergy  <input type="checkbox" value="mold"  name="mold" />
 <div class="mold"  style="display: none">
    <label>Mold Allergy</label><br>
 <select multiple="multiple" class="form-control" name="molds[]"  >
    <?php $molds = DB::table('mold_allergy')->get();?>
                  @foreach($molds as $mold)
                   <option value="{{$mold->id}}">{{$mold->name}}</option>
                 @endforeach
                </select>
  </div>
 Pet Allergy   <input type="checkbox" value="pet"  name="pet" />
 <div class="pet"  style="display: none">
    <label>Pet Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="pets[]"  >
    <?php $pets = DB::table('pet_allergy')->get();?>
                  @foreach($pets as $pet)
                   <option value="{{$pet->id}}">{{$pet->name}}</option>
                 @endforeach
                </select>
  </div>
 Pollen Allergy  <input type="checkbox" value="pollen"  name="pollen" />
 <div class="pollen"  style="display: none">
    <label>Pollen Allergy Name</label><br>
  <select multiple="multiple" class="form-control" name="pollens[]"  >
    <?php $pollens = DB::table('pollen_allergy')->get();?>
                  @foreach($pollens as $pollen)
                   <option value="{{$pollen->id}}">{{$pollen->name}}</option>
                 @endforeach
                </select>
  </div>
 Insect Allergy  <input type="checkbox" value="insect"  name="insect"  />
 
  <div class="insect"  style="display: none">
    <label>Insect Allergy Name</label><br>
    <select multiple="multiple" class="form-control" name="insects[]"  >
    <?php $insects = DB::table('insect_allergy')->get();?>
                  @foreach($insects as $insect)
                   <option value="{{$insect->id}}">{{$insect->name}}</option>
                 @endforeach
                </select>
  </div>
<br><br>
  <button type="submit" class="btn btn-primary">Save</button>


</div>
</div> 
      </div> 
      </div> 
      </div> 
</div>
</div>
</div>
<div id="tab-2" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
 <div class="col-lg-10 col-lg-offset-1">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h4>Measures of  Growth & Weight</h4>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>


        <div class="ibox-content">
        <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-example" >
      <thead>
       <tr>
           <th>No</th>
            <th>Date</th>
           <th>Weight</th>
           <th>Height</th>
           <th>Head Measurement</th>
           

      </tr>
      </thead>

      <tbody>
     


        </tbody>
      </table>
      
<a href="{{ url('growth', $dependant->id) }}" class="btn btn-primary btn-sm">Update Details</a>
   </div>

      </div> 
      </div> 
      </div> 
      </div> 
      </div>
      </div>
      </div>
      <div id="tab-3" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
 <div class="col-lg-10 col-lg-offset-1">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h4>MUAC/Nutrition Test</h4>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>

                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>


        <div class="ibox-content">
        <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover dataTables-example" >
      <thead>
       <tr>
           <th>No</th>
            <th>Date</th>
           <th>Time</th>
           <th>MUAC</th>
           <th>Score</th> 
           
           

      </tr>
      </thead>

<?php $i=1;  $nutritions=DB::table('dependant_nutrition_test')->where('dependent_id',$id)->get();?>
@foreach($nutritions as $nutrition)
      <tbody>
      <tr>
<td>{{$i}}</td> 
<td>{{ date('d -m- Y', strtotime($nutrition->created_at))}}</td>     
<td>{{ date('H:i:s', strtotime($nutrition->created_at))}}</td>     
 <td>{{$nutrition->score}}</td>
 <td><?php $score=$nutrition->score;
 if ($score<=110) {
   echo '<div style="color:red">Severe Acute Malnutrition (SAM)</div>';
 }
elseif($score>111 & $score<=125){
  echo '<div style="color:orange">Moderate Acute Malnutrition (MAM)</div>';
}
elseif($score>126 & $score<=135){
  echo '<div style="color:yellow"><b>Growth Promotion and Monitoring (GPM)</b></div>';
}
else{
  echo ' <div style="color:green">Well Nourished.</div>';
}
  ?></td>


</tr>
        </tbody>
        <?php $i++; ?>
@endforeach
      </table>
      
                            <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Add</a>
                            
                            <div id="modal-form" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
                            <div class="row">
                            <div class="col-sm-6">
                               {!! Form::open(array('url' => 'nurse.nutrition','method'=>'POST')) !!}
                              <input type="hidden" name="patient_id" value="{{$dependant->id}}">
                               <div class="form-group">
    <label for="exampleInputEmail1">MUAC Reading</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" in mm" name="muac"  required>
    </div>
                               
                                      <button class="btn btn-sm btn-primary" type="submit"><strong>Submit</strong></button>
                                  </div>
                              {{ Form::close() }}
                                </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                       

      </div> 
      </div> 
      </div> 
      </div> 
      </div>
      </div>
      </div> 
      </div>
<div id="tab-10" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">

<h4><label> Abonormalities-Tick All Relevant and Describe</label></h4>
<?php $abs=DB::table('abnormalities')->get(); ?>
@foreach($abs as $ab )
<div class="form-group">
   <label for="chkPassport">
    <input type="checkbox" id="chkPassport" name="abs[]" value="{{$ab->name}}"/>
   {{$ab->name}}
</label>

<div class="{{$ab->name}}"  style="display: none">
    <label>Describe:</label><br>
    <textarea rows="3" cols="50" name="abs_detail"></textarea>
</div>
</div>
@endforeach
      </div> 
      </div> 
      </div> 
      </div> 

<div id="tab-9" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
          <div class="row">
          <div class="col-lg-6">
 <h4> <label><u>General Examination</u></label></h4>
          <div class="form-group">
    <label for="exampleInputPassword1">Skin</label>
    Bruising <input type="checkbox" value="Bruising"  name="skin"/>
    Rash <input type="checkbox" value="Rash"  name="skin"/>
    Pustules <input type="checkbox" value="Pustules"  name="skin"/>
    </div>
    <div class="form-group">
    <label>Jaundice</label>
    None <input type="checkbox" value="None"  name="jaundice"/>
    +  <input type="checkbox" value="+"  name="jaundice"/>
    +++ <input type="checkbox" value="+++"  name="jaundice"/>
    </div>
    <div class="form-group">
    <label>Gest/Size</label>
    Normal <input type="checkbox" value="Normal"  name="gest_size"/>
    Perm <input type="checkbox" value="Perm"  name="gest_size"/>
    SGA/wasted  <input type="checkbox" value="SGA/wasted"  name="gest_size"/>
    </div>

    <h4> <label><u>Umbilicus</u></label></h4>
    <div class="form-group">
    <label>Umbilicus</label>
    Clean <input type="checkbox" value="Clean"  name="umbilicus"/>
    Local Pus <input type="checkbox" value="LocalPus"  name="umbilicus"/>
    Pus + red skin  <input type="checkbox" value="Pus red skin "  name="umbilicus"/>
    </div>
    </div>
    <div class="col-lg-6">
    <h2> <label><u>Disability</u></label></h2>
    <div class="form-group">
<label>Can suck/breastfeed</label>
Yes <input type="checkbox" name="breastfeed" value="Yes" />
No <input type="checkbox" name="breastfeed" value="No" />
  
</div>

<div class="form-group">
<label>Stiff neck</label>
Yes <input type="checkbox" name="neck" value="Yes" />
No <input type="checkbox" name="neck" value="No" />
  
</div>
<div class="form-group">
<label>Bulging fontanelle</label>
Yes <input type="checkbox" name="fontanelle" value="Yes" />
No <input type="checkbox" name="fontanelle" value="No" />
  
</div>
<div class="form-group">
<label>Irritable</label>
Yes <input type="checkbox" name="irritable" value="Yes" />
No <input type="checkbox" name="irritable" value="No" />
  
</div>


<div class="form-group">
<label>Reduced movement/tone</label>
Yes <input type="checkbox" name="tone" value="Yes" />
No <input type="checkbox" name="tone" value="No" />
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
     {!! Form::close() !!}
    </div>
    
      </div> 
      </div> 
      </div> 
      </div>
<div id="tab-4" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
      </div> 
      </div> 
      </div> 
      </div> 

      </div> 

</div><!--3tabs-->
</div>
</div>
</div>

<br><br>

 
 @include('includes.default.footer')

        </div>
    
      </div><!--content page-->

@endsection
