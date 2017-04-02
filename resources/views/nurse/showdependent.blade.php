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
                    <li class="active"><a data-toggle="tab" href="#tab-1">Immunination Chart</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Baby/Mother Details</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Measures of Growth & Weight</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Nutrition Check</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Adverse Events</a></li>
                    
                   
                </ul>
    <div class="tab-content">
                      <div id="tab-1" class="tab-pane active">
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

    <div class="form-group">
    <label for="exampleInputEmail1">Can suck/Breastfeed?</label>
   <label>No</label> <input type="radio" value="No"  name="breastfeed"/>
   <label>Yes</label><input type="radio" value="yes"  name="breastfeed"/>
   </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Stiff Neck?</label>
   <label>No</label> <input type="radio" value="No"  name="neck"/>
   <label>Yes</label><input type="radio" value="Yes"  name="neck"/>
   </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Bulging fontanelle?</label>
   <label>No</label> <input type="radio" value="No"  name="bulging"/>
   <label>Yes</label><input type="radio" value="Yes"  name="bulging"/>
   </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Reduced Movement/Tone ?</label>
   <label>No</label> <input type="radio" value="No"  name="tone"/>
   <label>Yes</label><input type="radio" value="Yes"  name="tone"/>
   </div> 
    <div class="form-group">
    <label for="exampleInputPassword1">Umbilicus</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Clean,Local Pus, Plus + Red Skin" name="umbilicus"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Skin</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Brusing,Rash,Postules" name="skin"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Jaundice</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="None,+,+++" name="jaundice"  required>
    </div>
    <div class="form-group">
    <label for="exampleInputPassword1">Gest/Size</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Clean,Local Pus, Plus + Red Skin" name="size"  required>
    </div>
    
  

</div>
            
  </div>
  </div>
  <div class="col-lg-6">
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
