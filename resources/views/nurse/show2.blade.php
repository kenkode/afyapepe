<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Afyapepe- Show Dependent </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
       <link href="{!! asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') !!}" rel="stylesheet">
    <link href="{!! asset('css/plugins/iCheck/custom.css') !!}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('select/select2.min.css') }}" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>

    <div id="wrapper">
@include('includes.nurse_inc.leftmenu')

        <div id="page-wrapper" class="gray-bg dashbard-1">

    @include('includes.nurse_inc.headbar')
           <?php 
    $mothers=DB::table('triage_infants')->where('dependant_id',$id)->get();
    $details=DB::table('infant_details')->where('dependant_id',$id)->get();?>
    

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
            <?php $father=DB::table('dependant_parent')->where('dependant_id',$id)->where('relationship','=','Father')->first();?>
  
            @if(is_null($father))
            <a data-toggle="modal" class="btn btn-primary" href="#modal-formf">Add Father</a>
                            
                            <div id="modal-formf" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
          <form class="form-horizontal" role="form" method="POST" action="/addfather" novalidate>
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
              <div class="form-group">
             <label for="exampleInputEmail1">Father Name</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Father Name" name="father_name"    >
             </div>


              <div class="form-group">
             <label for="exampleInputPassword1">Father Phone</label>
             <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Father Phone" name="father_phone"  >
             </div>


             <input type="submit" name="submit" value="Add" > 
    </form>
         
                            </div>
                            </div>
                            </div>
                            </div>
                            @else
                             <div class="form-group">
            
            <label for="exampleInputPassword1">Father Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1"  name="phone" value="{{$father->name or ''}}" readonly  >
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Father Phone</label>
             <input type="text" class="form-control" id="exampleInputPassword1"  name="phone" value="{{$father->phone or ''}}" readonly  >
            </div>
            @endif
             <?php $mother=DB::table('dependant_parent')->where('dependant_id',$id)->where('relationship','=','Mother')->first();?>
             
   @if(is_null($mother))
            
             <a data-toggle="modal" class="btn btn-primary" href="#modal-formp">Add Mother</a>
                            
                            <div id="modal-formp" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-body">
             <form class="form-horizontal" role="form" method="POST" action="/addmother" novalidate>
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
                            <div class="form-group">
            <label for="exampleInputPassword1">Mother Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Mother Name" name="mother_name">
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Mother Phone</label>
             <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Mother Phone" name="mother_phone" >
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Birth Number</label>
             <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Birth Number" name="Birth_number" >
            </div>
            <div class="form-group">
            <label for="exampleInputEmail1">Younger sibling(born to mother)?</label>
            No <input type="checkbox" value="No"  name="birth" />
            Yes <input type="checkbox" value="Yes"  name="birth"  />
            <div class="Yes" style="display: none">
             <div class="form-group" id="data_1">
                 <label>Date of Birth</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="dob" value="">
                 </div>
                 </div> 
                            </div>

                <input type="submit" name="submit" value="Add">
    </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
            @else
            <div class="form-group">
            <label for="exampleInputPassword1">Mother Name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="phone" value="{{$mother->name or ''}}" readonly  >
            </div>
             <div class="form-group">
            <label for="exampleInputPassword1">Mother Phone</label>
             <input type="text" class="form-control" id="exampleInputPassword1"  name="phone" value="{{$mother->phone or ''}}" readonly  >
            </div>
            @endif
            
  </div>
  </div>
  </div>


            

    
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Dependant information</h5>
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
                            

                            <form id="form" action="{{ url('babytriage') }}" method="post" class="wizard-big">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$dependant->id}}">
                                <h1>Baby Details</h1>
                                <fieldset>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                               <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">Admission Date</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="admission_date">
                 </div>
                 </div>
                
    <div class="form-group">
                 <label for="exampleInputPassword1">IP No</label>
            <input type="text" class="form-control" name="ipno">
    </div>
    <div class="form-group">
                 <label for="exampleInputPassword1">Gestation</label>
  <select name="gestation" class="form-control">
  <option value="24">24 weeks</option>
  <option value="25">25 weeks</option>  
  <option value="26">26 weeks</option>
   <option value="27">27 weeks</option> 
    <option value="28">28 weeks</option> 
     <option value="29">29 weeks</option> 
      <option value="30">30 weeks</option> 
       <option value="31">31 weeks</option> 
        <option value="32">32 weeks</option> 
         <option value="33">33 weeks</option> 
          <option value="34">34 weeks</option> 
           <option value="35">35 weeks</option> 
            <option value="36">36 weeks</option> 
             <option value="37">37 weeks</option> 
              <option value="38">38 weeks</option> 
               <option value="39">39 weeks</option> 
                <option value="40">40 weeks</option>
                <option value="41">41 weeks</option>
                <option value="42">42 weeks</option>
                <option value="43">43 weeks</option>
                <option value="44">44 weeks</option>
                <option value="45">45 weeks</option>
                <option value="46">46 weeks</option>   
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
     @if(!empty($details))
 @else

   <div class="form-group">
                 <label for="exampleInputPassword1">Birth Weight</label>
            <input type="number" class="form-control" name="birthweight">
    </div>
    @endif
    <div class="form-group">
                 <label for="exampleInputPassword1">Weight Now</label>
            <input type="number" class="form-control" name="weightnow">
    </div>
    </div>
    <div class="col-sm-6">
   
    @if(!empty($details))
 @else
  <div class="form-group">
<label class="exampleInputPassword1" for="name">BBA</label><br>
No<input type="checkbox" value="No"  name="bba"/>Yes<input type="checkbox" value="Yes"  name="bba"/>

  <div id="embedcode">
    <label>Born Where</label>
  Home  <input type="checkbox" value="Home"  name="bba_where"/>
  Clinic  <input type="checkbox" value="Clinic"  name="bba_where" />
  Other Hospitals <input type="checkbox" value="Other"  name="bba_where" />
    </div>
  </div>

    <!--<div class="form-group">
   <label for="exampleInputEmail1">BBA</label>
   No <input type="checkbox" value="No" id="type" name="bba" />
   Yes <input type="checkbox" value="Yes" id="type"  name="bba"  />
 <div id="embedcode">
    <label>Born Where</label>
  Home  <input type="checkbox" value="Home"  name="bba_where"/>
  Clinic  <input type="checkbox" value="Clinic"  name="bba_where" />
  Other Hospitals <input type="checkbox" value="Other"  name="bba_where" /> 
</div>
</div>-->
<div class="form-group">
    <label for="exampleInputEmail1">Delivery</label>
   SDV <input type="checkbox" value="SDV"  name="delivery"/>
   Vacuum <input type="checkbox" value="vaccum"  name="delivery"/>
   Breech <input type="checkbox" value="breech"  name="delivery"/>
   Cs <input type="checkbox" value="cs"  name="delivery"/>
   
   </div>
@endif

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
   <br>
<div class="form-group">
<label>Babies Presenting Problems</label>
<textarea name="babyproblem" class="form-control"></textarea>
  </div>

<!--<div class="form-group">
    <label for="exampleInputPassword1">Revelant Drugs( Pre Admission)</label>
    <select multiple="multiple" class="select2" name="brevelantdrugs[]"  >
    <?php $chiefs = DB::table('druglists')->get();?>
                  @foreach($chiefs as $chief)
                   <option value="{{$chief->drugname}}">{{$chief->drugname}}</option>
                 @endforeach
                </select>
    </div>-->
    <div class="form-group">
                     <label >Revelant Drugs:</label>
                     <select multiple="multiple" id="presc1" name="brevelantdrugs[]" class="form-control presc1" style="width:50%" required></select>
                 </div>

                                           
                                       
                                    </div>

                                </fieldset>
                                <h1>Mother Details</h1>
                                <fieldset>
                                   
                                    <div class="row">
                                        <div class="col-sm-6">
                                            @if(!empty($mothers))
 @else
  <div class="form-group" id="data_1">
                 <label for="exampleInputPassword1">Date of Birth</label>
                 <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <input type="text" class="form-control" name="dob" value="">
                 </div>
                 </div>
  
  @endif
  <div class="form-group">
  <label>Gravidity</label><br>
  <input type="number" name="gravidity" id="gravidity" maxlength="6" autocomplete="off" placeholder="mother gravidity" class="form-control" />
    
  </div>
  <div class="form-group">
  <label>Parity</label><br>
  <input type="number" name="parity" class="form-control" placeholder="mother parity" />
    
  </div>
 
  <div class="form-group">
   <label for="exampleInputEmail1">Hiv status</label>
   Negative <input type="checkbox" value="Negative"  name="hiv" />
   Positive <input type="checkbox" value="Positive"  name="hiv"  />
<div id="hiv">
    <label>ARV's</label>
  No  <input type="checkbox"  value="No"  name="arvs"/>
  Yes  <input type="checkbox"   value="Yes"  name="arvs" />
     
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

Yes <input type="checkbox" name="tb" value="Yes" />
No <input type="checkbox" name="tb" value="No" />
<div id="tb">
    <label>TB Type </label>
  Latent TB  <input type="checkbox" value="Latent TB"  name="tb_type"/>
  TB Disease  <input type="checkbox"value="TB Disease"  name="tb_type" />
  <br>
  <label>TB Treatment</label>
Yes <input type="checkbox" name="tb_treatment" value="Yes" />
No <input type="checkbox" name="tb_treatment" value="No" />
     
</div>
  
</div>

                                        </div>
                                        <div class="col-lg-6">
                                            @if(!empty($mothers))
                                            @else
<div class="form-group">
<label>Labour</label><br>
1 stage <input type="text" name="labour1" class="form-control" placeholder="Enter Hours"/>
2 stage <input type="text" name="labour2" class="form-control" placeholder="Enter Minutes"/>
</div>
@endif
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
                     <label >Revelant Drugs:</label>
                     <select multiple="multiple" id="presc1" name="mrevelantdrugs[]" class="form-control presc1" style="width:50%" required></select>
                 </div>


                                        </div>
                                    </div>
                                </fieldset>
                            <h1>Allergies</h1>
                                <fieldset>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                           <div class="form-group">

 Drug Allergy <input type="checkbox" value="drug"  name="drug" />
 <div id="drug">
    <label>Drug Name</label><br>
 <select multiple="multiple" class="form-control" name="drugs[]">
    <?php $druglists = DB::table('allergies_type')->where('allergies_id',1)->get();?>
                  @foreach($druglists as $druglist)
                   <option value="{{$druglist->id}}">{{$druglist->name}}</option>
                 @endforeach
                </select>
    </div>

 Food Allergy <input type="checkbox" value="food"  name="food" />
 <div id="food">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="foods[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',2)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Latex Allergy <input type="checkbox" value="latex"  name="latex" />
 <div id="latex">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="latexs[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',3)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Mold Allergy <input type="checkbox" value="mold"  name="molds" />
 <div id="mold">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="molds[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',4)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Pet Allergy <input type="checkbox" value="pet"  name="pets" />
 <div id="pet">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="pets[]"  >
    <?php $foods =  DB::table('allergies_type')->where('allergies_id',5)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Pollen Allergy <input type="checkbox" value="pollen"  name="pollens" />
 <div id="pollen">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="pollens[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',6)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
  Insect Allergy <input type="checkbox" value="insect"  name="insects" />
 <div id="insect">
    <label>Allergy Name</label><br>
 <select multiple="multiple" class="form-control" name="insects[]"  >
    <?php $foods = DB::table('allergies_type')->where('allergies_id',7)->get();?>
                  @foreach($foods as $food)
                   <option value="{{$food->id}}">{{$food->name}}</option>
                 @endforeach
                </select>
  </div>
                                        </div>
                                        
                                    </div>
                                </fieldset>
                                <h1>Disablility and Abnormalities</h1>
                                <fieldset>
                                     <div class="row">
                                        <div class="col-sm-6">
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
                                        </div>
                                        <div class="col-lg-6">
                                            Skull <input type="checkbox" value="skull"  name="skull" />
 <div id="skull">
 <label>Describe</label>
    <textarea name="skull_descr" class="form-control"></textarea>
  </div>

  Limbs <input type="checkbox" value="limbs"  name="limbs" />
 <div id="limbs">
 <label>Describe</label>
    <textarea name="limbs_descr" class="form-control"></textarea>
  </div>
  Spine <input type="checkbox" value="spine"  name="spine" />
 <div id="spine">
 <label>Describe</label>
    <textarea name="spine_descr" class="form-control"></textarea>
  </div>
  Palate <input type="checkbox" value="palate"  name="palate" />
 <div id="palate">
 <label>Describe</label>
    <textarea name="palate_descr" class="form-control"></textarea>
  </div>
  Face <input type="checkbox" value="face"  name="face" />
 <div id="face">
 <label>Describe</label>
    <textarea name="face_descr" class="form-control"></textarea>
  </div>
  Anus <input type="checkbox" value="anus"  name="anus" />
 <div id="anus">
 <label>Describe</label>
    <textarea name="anus_descr" class="form-control"></textarea>
  </div>
  Dysmorphic <input type="checkbox" value="dysmorphic"  name="dysmorphic" />
 <div id="dysmorphic">
 <label>Describe</label>
    <textarea name="dysmorphic_descr" class="form-control"></textarea>
  </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <h1>Growth</h1>
                                <fieldset>
                                     <div class="row">
                                        <div class="col-sm-6">
                                             <div class="form-group">
    <label for="exampleInputEmail1">MUAC Reading</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder=" in mm" name="muac"  required>
    </div>
                                        </div>
                                       
                                    </div>
                                </fieldset>
                                <h1>Immunination Chart</h1>
                                <fieldset>
                                      <div class="row">
                                        <div class="col-sm-12">
                                              <table class="table table-small-font table-bordered table-striped">
                                                              <thead>
                                                                  <tr>
                                                                     
                                                                      <th>Disease</th>
                                                                      <th>Antigen</th>
                                                                      <th>Duration</th>

                                                                     
                                                                      <th>Date Guideline</th>

                                                                      <th>Status</th>
                                                                      <th>Vaccination Date</th>
                                                                      <th></th>
                                                                     

                                                                </tr>
                                                              </thead>
                                                              
                                                        <?php  $vaccines=DB::table('vaccine')->join('dependant_vaccination','dependant_vaccination.vaccine_id','=','vaccine.id')->distinct()->select('vaccine.*','dependant_vaccination.*','dependant_vaccination.id as userid')
                                                         ->where('vaccine.age','=>',$length)
                                                         ->where('dependant_vaccination.dependent_id','=',$id)->get(); ?>
                                                          <?php $i=1; ?>
                                                        @foreach($vaccines as $vaccine)
                                                          
                                                              <tbody>
                                                      
                                                           <tr>
                                                         
                                                         <td>{{$vaccine->disease}}</td>
                                                         <td>{{$vaccine->antigen}}</a></td>
                                                        
                                                         <td><?php $age=$vaccine->age; 
                                                         if($age==0){echo("Birth");}
                                                         else if($age==42){echo("6 Weeks");}
                                                         else if($age==70){echo("10 Weeks");}
                                                         else if($age==98){echo("14 Weeks");}
                                                         else if($age==183){echo("6 months");}
                                                         else if($age==274){echo("9 months");}
                                                         else if($age==335){echo("11 months");}
                                                         else if($age==456){echo("15 months");}
                                                         else if($age==730){echo("2 Years");}?></td>
                                                         <td>{{date('d -m- Y', strtotime($vaccine->date_guideline))}}</td>
                                                          <td>{{$vaccine->status or ''}}</td>

                                                          <td>{{$vaccine->status_date or ''}}</td>
                                                          <td><?php if(is_null($vaccine->status)){
                                                            echo "<select name='test[]'>
                                                            <option></option>
                                                            <option value='<?php echo $vaccine->userid;?>'>Done</option>";
                                                            } ?></td>
                                                           
                                                             </tr>
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach

                                                      
                                                             </table>
                                        </div>
                                        
                                    </div>
                                </fieldset>
                                <h1>Baby Vitals</h1>
                                <fieldset>
                                   
                                    <div class="row">
                                        <div class="col-sm-6">
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
    <label for="exampleInputEmail1">Head Head Measurement</label>
    <input type="name" class="form-control" placeholder="" name="cir">
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
                     <label >Chief Complaint/Reason for visit:</label>
                     <select multiple="multiple" id="chief" name="chiefcompliants[]" class="form-control chief" style="width:50%" required></select>
                 </div>
    <!--<div class="form-group">
    <label for="exampleInputPassword1">Observation</label>
    <select  multiple="multiple"  class="form-control" name="observations[]" id="observation" >
    
                  @foreach($observations as $observation)
                   <option value="{{$observation->name}}">{{$observation->name}}</option>
                 @endforeach
                </select>
    </div>-->
      <div class="form-group">
                     <label >Observation:</label>
                     <select multiple="multiple" id="observation" name="observations[]" class="form-control observation" style="width:50%" required></select>
                 </div>
      <div class="form-group">
                     <label >Symptom:</label>
                     <select multiple="multiple" id="symptom" name="symptoms[]" class="form-control symptom" style="width:50%" required></select>
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

<div id="diarrhoea">
    <label>Number of days</label>
  <input type="number" value="No"  name="diarrhoea_days"/>
  <br>
  <label>Diarrhoea-Bloody</label>
 No  <input type="checkbox" value="No"  name="diarrhoea_bloody" />
 Yes <input type="checkbox" value="Yes"  name="diarrhoea_bloody"  />
  
  
     
</div>
</div>

<div class="form-group">
<label>Vomiting ?</label>
 No  <input type="checkbox" value="No_vomiting"  name="vomiting" />
 Yes <input type="checkbox" value="Yes_vomiting"  name="vomiting"  />
 <div id="vomiting">
    <label>number per 24 hours</label>
  <input type="number"  name="vomiting_hours"/><br>
  <label>Vomits Everything?</label>
 No  <input type="checkbox" value="No"  name="vomits_eveything" />
 Yes <input type="checkbox" value="Yes"  name="vomits_eveything"  />

  </div>
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

    
  </div>

                                        <div class="col-lg-6">
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
    <div id="refill">
    <label>In Seconds</label>
  <input type="number" name="Seconds">
    
</div>
  </div>

  <div class="form-group">
    <label>Murmur</label>
    Yes <input type="checkbox" name="Murmur" value="Murmur_Yes" />
    No <input type="checkbox" name="Murmur" value="Murmur_No">
    <div id="Murmur">
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


    

    <div class="form-group">
    <label for="exampleInputPassword1">Nurse Notes</label>
    <textarea class="form-control" placeholer="" name="nurse" required>
    </textarea>

    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Consulting Physician</label>
    <select class="form-control" name="doctor" >
    <?php $doctors = DB::table('users')->
                    join('doctors','doctors.user_id','=','users.id')->select('doctors.*')->Where('role', '=','Doctor')->get();?>
                  @foreach($doctors as $doctor)
                   <option value="{{$doctor->doc_id}}">{{$doctor->name}}</option>
                 @endforeach
                </select>
    </div>
                                        </div>
                                    </div>
                                </fieldset>



                                
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
     <div class="footer">
    <div class="pull-right">
        Afyapepe <strong>Health</strong> Platform.
    </div>
    <div>
        <strong>Copyright</strong> afyapepe.co.ke &copy; 2016-2017
    </div>
</div>
</div>
</div>
       



    <!-- Mainly scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/ajaxscript.js')}}"></script>
   <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}" type="text/javascript"></script>
   <script src="{{ asset('js/plugins/steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

 

 <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{asset('js/ajaxscript.js')}}"></script>

    <!-- Custom and plugin javascript -->




    <!-- Custom and plugin javascript -->
<script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('select/select2.min.js') }}" type="text/javascript"></script>


    <!--  <script src="{{ asset('js/inspinia.js') }}" type="text/javascript"></script>-->

 
   
    

    <!-- Page-Level Scripts -->
    
   
    <script type="text/javascript">
           $(document).ready(function(){
           $('.multi-field-wrapper').each(function() {
               var $wrapper = $('.multi-fields', this);

               $(".add-field", $(this)).click(function(e) {
                   $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();


               });
               $('.multi-field .remove-field', $wrapper).click(function() {
                   if ($('.multi-field', $wrapper).length > 1)
                       $(this).parent('.multi-field').remove();
               });
           });
           });
           </script>

   
   
   <script>
        $(document).ready(function(){
            $("#wizard").steps();
              $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return true;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
               
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            });
            $.ajaxSetup({
 headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});
              $(".presc1").select2({
          placeholder: "Select revelant drugs...",
          minimumInputLength: 2,
          ajax: {
              url: '/tag/drugs',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
      });
      $(".observation").select2({
          placeholder: "Select observations...",
          minimumInputLength: 2,
          ajax: {
              url: '/tag/observation',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
      });
      $(".symptom").select2({
          placeholder: "Select symptom...",
          minimumInputLength: 2,
          ajax: {
              url: '/tag/symptom',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
      });
      $(".chief").select2({
          placeholder: "Select chief compliant...",
          minimumInputLength: 2,
          ajax: {
              url: '/tag/chief',
              dataType: 'json',
              data: function (params) {
                  return {
                      q: $.trim(params.term)
                  };
              },
              processResults: function (data) {
                  return {
                      results: data
                  };
              },
              cache: true
          }
      });
       });
    </script>
    <script type="text/javascript">
       $(document).ready(function(){
             $("#embedcode").hide();
             $("#hiv").hide();
             $("#tb").hide();
              $("#drug").hide();
               $("#food").hide();
                $("#latex").hide();
                 $("#mold").hide();
                  $("#pet").hide();
                   $("#pollen").hide();
                    $("#insect").hide();
                     $("#skull").hide();
                      $("#limbs").hide();
                       $("#spine").hide();
                        $("#palate").hide();
                         $("#face").hide();
                          $("#anus").hide();
                           $("#dysmorphic").hide();
                            $("#diarrhoea").hide();
                             $("#vomiting").hide();
                             $("#refill").hide();
                            $("#Murmur").hide();

             $("input[name='bba']").change(function () {
                  if($(this).val() == "Yes")
                       $("#embedcode").show();
                  else
                       $("#embedcode").hide();
             });
             $("input[name='hiv']").change(function () {
                  if($(this).val() == "Positive")
                       $("#hiv").show();
                  else
                       $("#hiv").hide();
             });
             $("input[name='tb']").change(function () {
                  if($(this).val() == "Yes")
                       $("#tb").show();
                  else
                       $("#tb").hide();
             });
              $("input[name='drug']").change(function () {
                  if($(this).val() == "drug")
                       $("#drug").show();
                  else
                       $("#drug").hide();
             });
            $("input[name='food']").change(function () {
                  if($(this).val() == "food")
                       $("#food").show();
                  else
                       $("#food").hide();
             });
            $("input[name='latex']").change(function () {
                  if($(this).val() == "latex")
                       $("#latex").show();
                  else
                       $("#latex").hide();
             });
            $("input[name='molds']").change(function () {
                  if($(this).val() == "mold")
                       $("#mold").show();
                  else
                       $("#mold").hide();
             });
            $("input[name='pets']").change(function () {
                  if($(this).val() == "pet")
                       $("#pet").show();
                  else
                       $("#pet").hide();
             });
            $("input[name='pollens']").change(function () {
                  if($(this).val() == "pollen")
                       $("#pollen").show();
                  else
                       $("#pollen").hide();
             });
            $("input[name='insects']").change(function () {
                  if($(this).val() == "insect")
                       $("#insect").show();
                  else
                       $("#insect").hide();
             });
            $("input[name='skull']").change(function () {
                  if($(this).val() == "skull")
                       $("#skull").show();
                  else
                       $("#skull").hide();
             });

             $("input[name='limbs']").change(function () {
                  if($(this).val() == "limbs")
                       $("#limbs").show();
                  else
                       $("#limbs").hide();
             });
              $("input[name='spine']").change(function () {
                  if($(this).val() == "spine")
                       $("#spine").show();
                  else
                       $("#spine").hide();
             });
               $("input[name='palate']").change(function () {
                  if($(this).val() == "palate")
                       $("#palate").show();
                  else
                       $("#palate").hide();
             });
                $("input[name='face']").change(function () {
                  if($(this).val() == "face")
                       $("#face").show();
                  else
                       $("#face").hide();
             });
                 $("input[name='anus']").change(function () {
                  if($(this).val() == "anus")
                       $("#anus").show();
                  else
                       $("#anus").hide();
             });
                  $("input[name='dysmorphic']").change(function () {
                  if($(this).val() == "dysmorphic")
                       $("#dysmorphic").show();
                  else
                       $("#dysmorphic").hide();
             });
                   $("input[name='diarrhoea']").change(function () {
                  if($(this).val() == "Yes_diarrhoea")
                       $("#diarrhoea").show();
                  else
                       $("#diarrhoea").hide();
             });
                    $("input[name='vomiting']").change(function () {
                  if($(this).val() == "Yes_vomiting")
                       $("#vomiting").show();
                  else
                       $("#vomiting").hide();
             });
                    $("input[name='refill']").change(function () {
                  if($(this).val() == "possible")
                       $("#refill").show();
                  else
                       $("#refill").hide();
             });
                    $("input[name='Murmur']").change(function () {
                  if($(this).val() == "Murmur_Yes")
                       $("#Murmur").show();
                  else
                       $("#Murmur").hide();
             });
                    $('input[type="checkbox"]').on('change', function() {
    $('input[name="' + this.name + '"]').not(this).prop('checked', false);
});
$('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $(document).ready(function(){
                $("button").click(function(){
                    $("#testR").toggle();
                });
            });
       });
  

           
   </script>


    
</script>



</body>
</html>
