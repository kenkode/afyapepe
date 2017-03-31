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
                    <li class=""><a data-toggle="tab" href="#tab-5">Mother Details</a></li>
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
<div id="tab-5" class="tab-pane active">
                        <div class="panel-body">

  <div class="wrapper wrapper-content">
          <div class="row animated fadeInRight">
 <div class="row">
  <div class="col-lg-6"> 
  <div class="ibox-title">
                            <h5>Mother Details</h5>
                            </div>       

          <div class="ibox-content">
               <form class="form-horizontal" role="form" method="POST" action="#" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
               <div class="form-group">
              <label for="exampleInputEmail1">Age:</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"  value="
               "  >
              </div> 
              <div class="form-group">
             <label for="exampleInputEmail1">Gravidity:</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="gravidity"  value="
              "  >
             </div>
             <div class="form-group">
             <label for="exampleInputEmail1">Parity:</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="parity"  value="
              "  >
             </div>
             <div class="form-group">
             <label for="exampleInputEmail1">Blood Group:</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="parity"  value="
              "  >
             </div>
              <div class="form-group">
             <label for="exampleInputEmail1">Sublocation:</label>
             <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="parity"  value="
              "  >
             </div>

             
      <div class="form-group">
  <label class="control-label" for="name">Hiv</label>
  <input type="radio" value="no" id="type" name="type" checked='checked' autocomplete="off" />
    <label>Negative</label>
          <input type="radio" value="yes" id="type" name="type" class="youtube" />
        <label>Positive</label>
        <div id="embedcode">
     ARV <select name="mode"><option value="">Select</option><option value="yes">Yes</option><option value="No">No</option></select>
      
      </div>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">VDRL? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>Negative</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Positive</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Fever? </label>
  <input type="radio" value="no"  name="fever" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="fever" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Antibiotics</label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Diabetes? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">TB Positive ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">TB Treatment? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Labour-1st Stage</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"  value="
               "  >
               </div>
               <div class="form-group">
              <label for="exampleInputPassword1">Labour-2st Stage</label>
              <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="age"  value="
               "  >
               </div>

    <div class="form-group">
  <label class="control-label" for="name">Hypertention? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">APH? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>




                <div class="form-group">
              <label for="exampleInputPassword1">Babies Presenting Problems</label>
              <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="Babies_Presenting_Problems"  value="
               "  ></textarea> 
                

              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Mothers Presenting Problems</label>
              <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="Mothers_Presenting_Problems"  value="
               "  ></textarea> 
                

              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Relevant Drugs:Pre Admission</label>
              <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="Relevant_Drugs"  value="
               "  ></textarea> 
                

              </div>
                

             
              
             
              
              
           
               </div>
             </div>
        <div class="col-lg-6">
        <div class="ibox-title">
                            <h5>General Examination</h5>
        </div>
        <div class="ibox-content">
               <form class="form-horizontal" role="form" method="POST" action="#" novalidate>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
               <div class="form-group">
  <label class="control-label" for="name">Oral thush:? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Lympn N> 1cm :? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Fever</label>
  <input type="radio" value="no" id="types" name="type" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes" id="types" name="type" class="youtube" />
        <label>Yes</label>
        <div id="embedcode">
   No of days <input type="number" value="number" id="types" name="feveno"/>
      
      </div>

        </div>
    <div class="form-group">
  <label class="control-label" for="name">Difficulty Breathing ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Diarrhoea ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
         <div class="form-group">
  <label class="control-label" for="name">Contact with TB ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Chronic Cough(last 12 Months) ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Diarrhoea-Bloody ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Vomiting  ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Vomiting Everything ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Difficult Feeding ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
    <div class="form-group">
  <label class="control-label" for="name">Convulsions ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Partial/Focal Fits ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
     <div class="form-group">
  <label class="control-label" for="name">Apnoea ? </label>
  <input type="radio" value="no"  name="vdrl" checked='checked' autocomplete="off" />
    <label>No</label>
          <input type="radio" value="yes"  name="vdrl" class="youtube" />
        <label>Yes</label>
    </div>
        </div>
      </div> 
      

         <button type="submit" class="btn btn-primary btn-sm">Save</button>
                 {!! Form::close() !!}
       
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
 @include('includes.default.footer')

        
      </div><!--content-->
      </div><!--content page-->

@endsection
