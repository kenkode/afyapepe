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
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$dependant->blood_type or ''}}" readonly  >
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

                  
                     <li class="active"><a data-toggle="tab" href="#tab-6">Vitals</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Baby/Mother Details</a></li>
                      <li class=""><a data-toggle="tab" href="#tab-1">Immunination Chart</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Measures of Growth & Weight</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Nutrition Check</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Adverse Events</a></li>
                    
                   
                </ul>
    <div class="tab-content">
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
    <?php $infants=DB::table('infants_triage')->where('dependent_id',$dependant->id)->get(); 
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
                   
<h5>Baby Details</h5>

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

<h5> Baby Abnormalities</h5>

             <table class="table table-small-font table-bordered table-striped">
                                                              <thead>
                                                                  <tr>
                                                                      <th>No</th>
                                                                      <th>Date</th>
                                                                      <th>Time</th>
                                                                      <th>Abnormalities</th>
                                                                      <th>Abnormalities Description</th>
                                                                     
                                                                      

                                                                </tr>
                                                              </thead>
                                                              
                                                                                                              <?php $i=1; ?>
                                                        @foreach($abs as $ab)
                                                          
                                                              <tbody>
                                                      
                                                           <tr>
                                                         <td>{{$i}}</td> 
                                                         <td>{{ date('d -m- Y', strtotime($ab->created_at))}}</td>     
                                                        <td>{{ date('H:i:s', strtotime($ab->created_at))}}</td>     
                                                        <td>{{$ab->name}}</td>     
                                                        <td>{{$ab->abnormalities_describe}}</td>     
                                                             
                                                           
                                                        
                                                             </tr>
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach

                                                      
                                                             </table>


 <a href="{{ URL('babydetails', $dependant->id) }}" class="btn btn-primary btn-sm">Add Details</a>
                                                               



                    </div>
         
                </div>
            </div>
     @else
      <div class="row">
      <div class="col-lg-6">
  <div class="ibox float-e-margins">
           
  <div class="ibox-content">
  
     <form class="form-horizontal" role="form" method="POST" action="/updateinfant" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$dependant->id}}" name="id"  required>
    <h2> Baby Details</h2>
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
            <input type="text" class="form-control" name="gestation">
    </div>

    <div class="form-group">
                 <label for="exampleInputPassword1">Temperature</label>
            <input type="number" class="form-control" name="ipno">
    </div>

    <div class="form-group">
    <label for="exampleInputEmail1">APGar?</label><br>
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

       <div class="form-group">
   <label for="exampleInputEmail1">BBA?</label><br>
   No <input type="checkbox" value="No"  name="bba" />
   Yes <input type="checkbox" value="yes"  name="bba"  />
    
</label>

<div class="yes"  style="display: none">
    <label>Born Where?</label><br>
  Home  <input type="checkbox" value="Home"  name="bba_where"/>
  Clinic  <input type="checkbox" value="Clinic"  name="bba_where" />
  Other Hospitals <input type="checkbox" value="Other"  name="bba_where" />
    
</div>
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Delivery?</label><br>
   SDV <input type="checkbox" value="SDV"  name="delivery"/>
   Vacuum <input type="checkbox" value="vaccum"  name="delivery"/>
   Breech <input type="checkbox" value="breech"  name="delivery"/>
   Cs <input type="checkbox" value="cs"  name="delivery"/>
   
   </div>

   <div class="form-group">
   <label>Resuscitation?</label><br>
   None <input type="checkbox" value="None"  name="resuscitation"/>
   Oxygen <input type="checkbox" value="Oxygen"  name="resuscitation"/>
   Bag/Mask <input type="checkbox" value="Bag/Mask"  name="resuscitation"/>
   </div>

   <div class="form-group">
   <label>ROM?</label><br>
  -<12h <input type="checkbox" value="-<12h" name="rom"/>
  12-18>18<input type="checkbox" value="12-18>18h" name="rom"/>
     
   </div>
   <div class="form-group">
   <label>Given Vitamen: K?</label><br>
   Yes <input type="checkbox" name="vitamen" value="Yes">
   No <input type="checkbox" name="vitamen" value="No">
     
   </div>

   <div class="form-group">
     <label>Given Eye Prophylaxis?</label><br>
      Yes <input type="checkbox" name="prophylaxis" value="Yes">
   No <input type="checkbox" name="prophylaxis" value="No">
   </div>
    <h2> Mother Details</h2>
    <div class="form-group">
    <label for="exampleInputEmail1">Can suck/Breastfeed?</label><br>
   No <input type="checkbox" value="No"  name="breastfeed"/>
   Yes <input type="checkbox" value="yes"  name="breastfeed"/>
   </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Stiff Neck?</label><br>
   No <input type="checkbox" value="No"  name="neck"/>
   Yes <input type="checkbox" value="Yes"  name="neck"/>
   </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Bulging fontanelle?</label><br>
   No <input type="checkbox" value="No"  name="bulging"/>
   Yes <input type="checkbox" value="Yes"  name="bulging"/>
   </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Reduced Movement/Tone ?</label><br>
    No <input type="checkbox" value="Yes"  name="tone"/>
    Yes <input type="checkbox" value="Yes"  name="tone"/>
   </div> 
    <div class="form-group">
    <label for="exampleInputPassword1">Umbilicus?</label><br>
    
       Clean <input type="checkbox" value="Clean"  name="umbilicus"/>
       Local Pus <input type="checkbox" value="Local Pus"  name="umbilicus"/>
       Plus + Red Skin <input type="checkbox" value="Plus + Red Skin"  name="umbilicus"/>
      
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Skin?</label><br>
    
     Brusing  <input type="checkbox" value="Brusing"  name="skin"/>
      Rash  <input type="checkbox" value="Rash"  name="skin"/>
      Postules  <input type="checkbox" value="Postules"  name="skin"/>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Jaundice</label><br>
    
    None <input type="checkbox" value="None"  name="jaundice"/>
       +  <input type="checkbox" value="+"  name="jaundice"/>
     +++  <input type="checkbox" value="+++"  name="jaundice"/>

    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Gest/Size</label><br>
    
    Clean <input type="checkbox" value="Brusing"  name="size"/>
    Local Pus  <input type="checkbox" value="Brusing"  name="size"/>
    Plus + Red Skin <input type="checkbox" value="Brusing"  name="size"/>
    </div>

    <div class="form-group">
    <label for="exampleInputPassword1">Stridor?</label><br>
    No <input type="checkbox" value="No"  name="stridor"/>
    Yes  <input type="checkbox" value="Yes"  name="stridor"/>
    </div>

    <div class="form-group">
    <label>Oxygen Saturation (enter(represent this in %)?</label>
    <input type="text" name="oxygen_saturation" class="form-control">
    </div>
    <div class="form-group">
    <label>Central Cyanosis?</label><br>
    No <input type="checkbox" value="No"  name="cyanosis"/>
    Yes  <input type="checkbox" value="Yes"  name="cyanosis"/>
    </div>
    <div class="form-group">
    <label>InDrawing</label><br>
    None <input type="checkbox" name="indrawing" value="None">
    Severe <input type="checkbox" name="indrawing" value="Severe">
    Sternum <input type="checkbox" name="indrawing" value="Sternum">
      
    </div>  
    <div class="form-group">
    <label for="exampleInputPassword1">Grunting?</label><br>
    No <input type="checkbox" value="No"  name="grunting"/>
    Yes  <input type="checkbox" value="Yes"  name="grunting"/>
    </div>  
    <div class="form-group">
    <label for="exampleInputPassword1">Air Entry Bilateral?</label><br>
    No <input type="checkbox" value="No"  name="air_entry"/>
    Yes  <input type="checkbox" value="Yes"  name="air_entry"/>
    </div>
    <div class="form-group">
    <label>Crackles</label>
    No <input type="checkbox" value="No"  name="crackles"/>
    Yes  <input type="checkbox" value="Yes"  name="crackles"/>
    </div>
    <div class="form-group">
    <label>Cry?</label><br>
    Normal <input type="checkbox" value="No"  name="cry"/>
    Hoarse  <input type="checkbox" value="Yes"  name="cry"/>
    Weak  <input type="checkbox" value="Yes"  name="cry"/>
    </div>
    <div class="form-group">
    <label>Femoral Pulse</label><br>
    Normal <input type="checkbox" value="Normal"  name="femoral_pulse"/>
    Weak <input type="checkbox" value="Weak"  name="femoral_pulse"/>
    </div>
  <div class="form-group">
    <label>Cap Refill</label><br>
    Possible <input type="checkbox" name="refill" value="possible" />
    Not Possible <input type="checkbox" name="refill" value="notpossible">
    <div class="possible"  style="display: none">
    <label>In Seconds?</label><br>
  <input type="number" name="Seconds">
    
</div>
  </div>

  <div class="form-group">
    <label>Murmur</label><br>
    Yes <input type="checkbox" name="Murmur" value="Murmur_Yes" />
    No <input type="checkbox" name="Murmur" value="Murmur_No">
    <div class="possible"  style="display: none">
    <label>Yes?</label><br>
  <input type="text" name="murmur_yes">
    
</div>
  </div>
  <div class="form-group">
  <label>Pallar/Anaemia</label><br>
  0 <input type="checkbox" name="anaemia" value="0" />
  + <input type="checkbox" name="anaemia" value="+">
  +++ <input type="checkbox" name="anaemia" value="+++">
    
  </div>


<div class="form-group">
  <label>Skin Cold</label><br>
  Hand <input type="checkbox" name="skin_cold" value="Hand" />
  Elbow <input type="checkbox" name="skin_cold" value="Elbow">
  Shoulder <input type="checkbox" name="skin_cold" value="Shoulder">
    
  </div>
   
  

</div>
            
  </div>
  </div>
  <div class="col-lg-6">
  <div class="form-group">
  <label>Age</label>
  <input type="text" name="age" placeholder="mother age" class="form-control" />
    
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
   <label for="exampleInputEmail1">Hiv status?</label><br>
   Negative <input type="checkbox" value="Negative"  name=hiv />
   Positive <input type="checkbox" value="Positive"  name="hiv"  />

<div class="Positive"  style="display: none">
    <label>ARV's</label><br>
  No  <input type="checkbox" value="No"  name="arvs"/>
  Yes  <input type="checkbox" value="Yes"  name="arvs" />
     
</div>
</div>
<div class="form-group">
<label>VDRL</label><br>
 Negative <input type="checkbox" value="Negative"  name="vdrl" />
   Positive <input type="checkbox" value="Positive"  name="vdrl"  />
 
</div>

<div class="form-group">
<label>Fever</label><br>
 No <input type="checkbox" value="No"  name="fever" />
   Yes <input type="checkbox" value="Yes"  name="fever"  />
 
</div>
<div class="form-group">
<label>Antibiotics?</label><br>
Yes <input type="checkbox" name="antibiotics" value="Yes" />
No <input type="checkbox" name="antibiotics" value="No" />
  
</div>

<div class="form-group">
<label>Diabetes?</label><br>
Yes <input type="checkbox" name="diabetes" value="Yes" />
No <input type="checkbox" name="diabetes" value="No" />
  
</div>
<div class="form-group">
<label>TB Positive?</label><br>
Yes <input type="checkbox" name="tb" value="Yes" />
No <input type="checkbox" name="tb" value="No" />
  
</div>
<div class="form-group">
<label>TB Treatment?</label><br>
Yes <input type="checkbox" name="tb_treatment" value="Yes" />
No <input type="checkbox" name="tb_treatment" value="No" />
  
</div>
<div class="form-group">
<label>Labour</label><br>
1 stage <input type="text" name="labour1" class="form-control" placeholder="Enter Hours"/>
2 stage <input type="text" name="labour2" class="form-control" placeholder="Enter Minutes"/>
</div>

<div class="form-group">
<label>Hypertention?</label><br>
Yes <input type="checkbox" name="hypertention" value="Yes" />
No <input type="checkbox" name="hypertention" value="No" />
  </div>

<div class="form-group">
<label>APH?</label><br>
Yes <input type="checkbox" name="aph" value="Yes" />
No <input type="checkbox" name="aph" value="No" />
  </div>
<div class="form-group">
<label>Babies Presenting Problems?</label>
<textarea name="babyproblem" class="form-control"></textarea>
  
</div>

<div class="form-group">
<label>Mother Presenting Problems?</label>
<textarea name="motherproblem" class="form-control"></textarea>
  
</div>
<div class="form-group">
<label>Revelant Drugs( Pre Admission)</label>
<textarea name="revelantdrugs" class="form-control"></textarea>
  
</div>

<h2>General Examination</h2>
<div class="form-group">
<label>Oral thrush?</label><br>
Yes <input type="checkbox" name="oral" value="Yes" />
No <input type="checkbox" name="oral" value="No" />
  </div>
<div class="form-group">
<label>Lympn N>1cm?</label><br>
Yes <input type="checkbox" name="lympn" value="Yes" />
No <input type="checkbox" name="lympn" value="No" />
  </div>
    <div class="form-group">
   <label for="exampleInputEmail1">Fever?</label><br>
   No<input type="checkbox" value="No"  name="fevers" />
   Yes <input type="checkbox" value="Yes"  name="fevers"  />

<div class="Yes"  style="display: none">
    <label>Number of days</label><br>
  <input type="number" value="No"  name="days"/>
  
     
</div>
</div>
<div class="form-group">
<label>Difficulty Breathing?</label>
 No  <input type="checkbox" value="No"  name="fevers" />
 Yes <input type="checkbox" value="Yes"  name="fevers"  />
  
</div>

 <div class="form-group">
   <label for="exampleInputEmail1">Diarrhoea?</label><br>
   No<input type="checkbox" value="No"  name="diarrhoea" />
   Yes <input type="checkbox" value="Yes"  name="diarrhoea"  />

<div class="Yes"  style="display: none">
    <label>Number of days</label><br>
  <input type="number" value="No"  name="diarrhoea_days"/>
  
     
</div>
</div>
<div class="form-group">
<label>Contact with TB?</label>
 No  <input type="checkbox" value="No"  name="contact_tb" />
 Yes <input type="checkbox" value="Yes"  name="contact_tb"  />
  
</div>

<div class="form-group">
<label>Chronic Cough(last 12 Months)?</label>
 No  <input type="checkbox" value="No"  name="cough" />
 Yes <input type="checkbox" value="Yes"  name="cough"  />
  
</div>

<div class="form-group">
<label>Diarrhoea-Bloody?</label>
 No  <input type="checkbox" value="No"  name="diarrhoea_bloody" />
 Yes <input type="checkbox" value="Yes"  name="diarrhoea_bloody"  />
  
</div>

<div class="form-group">
<label>Vomiting Yes/No?</label>
 No  <input type="checkbox" value="No"  name="vomiting" />
 Yes <input type="checkbox" value="Yes"  name="vomiting"  />
 <div class="Yes"  style="display: none">
    <label>number per 24 hours</label><br>
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
No  <input type="checkbox" value="No"  name="convulsion" />
 Yes <input type="checkbox" value="Yes"  name="convulsion"  />
 <div class="Yes"  style="display: none">
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




  <h2> Abonormalities-Tick All Relevant and Describe</h2>
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
   <button type="submit" class="btn btn-primary btn-block">Update Details</button>
      {!! Form::close() !!}
  </div>
  </div>
  @endif
      </div> 
      </div> 
      </div> 
      </div> 
      
 <div id="tab-6" class="tab-pane active">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
      
 <div class="row">
         <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                              <h5>Vital History</h5>
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
           <th>Weight</th>
           <th>Height</th>
           <th>BMI</th>
           <th>Temperature</th>
           <th>Systolic_bp</th>
           <th>Diastolic_bp</th>
           <th>Chief Compliant</th>


            

      </tr>
      </thead>

      <tbody>
      <?php $i =1; ?>
      @foreach($details as $detail)
       <tr>
           <td>{{$i}}</td>
            <td>{{ date('d -m- Y', strtotime($detail->updated_at)) }}</td>
            <td>{{ date('H:i:s', strtotime($detail->updated_at)) }}</td>
           <td>{{$detail->current_weight}}</td>
           <td>{{$detail->current_height}}</td>
            <td><?php $height=$detail->current_height; $weight=$detail->current_weight;
               $bmi =$weight/($height*$height);
               echo number_format($bmi, 2);
            ?></td>
           <td>{{$detail->temperature}}</td>
          <td>{{$detail->systolic_bp}}</td>
         <td>{{$detail->diastolic_bp}}</td>
         <td>{{$detail->chief_compliant}}</td>

        

       </tr>
       <?php $i++; ?>

      @endforeach


        </tbody>
      </table>
       <a href="{{ URL('infactdetails', $dependant->id) }}" class="btn btn-primary btn-sm">Add Details</a>


   </div>

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
                              <h5>Measures of  Growth & Weight</h5>
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
<div id="tab-3" class="tab-pane">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
      </div> 
      </div> 
      </div> 
      </div> 
<div id="tab-4" class="tab-pane active">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
      </div> 
      </div> 
      </div> 
      </div> 

</div><!--3tabs-->
</div>
</div>
</div>


 
 @include('includes.default.footer')

        </div>
    
      </div><!--content page-->

@endsection
