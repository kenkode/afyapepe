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
             <label for="exampleInputPassword1">Age</label>
             <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone" value="{{$dependant->age}}" readonly  >
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
                                                                      <th>Vaccine Name</th>

                                                                </tr>
                                                              </thead>
                                                              <?php $i=1;
                                                      $vaccines=DB::table('vaccine')->leftjoin('dependant_vaccination','dependant_vaccination.vaccine_id','=','vaccine.id')->select('vaccine.*','dependant_vaccination.*')->where('dependant_vaccination.dependent_id',$id)->get(); ?>
                                                      @if(count($vaccines) > 0)
     
                                                        @foreach($vaccines as $vaccine)

                                                              <tbody>
                                                      
                                                           
                                                         <td><a href="{{url('immuninationshow',$id)}}">{{$i}}</a></td>
                                                         <td><a href="{{url('immuninationshow',$id)}}">{{$vaccine->disease}}</a></td>
                                                         <td><a href="{{url('immuninationshow',$id)}}">{{$vaccine->antigen}}</a></td>
                                                        <td>{{$vaccine->duration or ''}}</td>
                                                         <td>{{ date('d -m- Y', strtotime($vaccine-> date_guideline))}}</td>
                                                          <td>{{$vaccine->status or ''}}</td>
                                                           <td>{{$vaccine-> vaccin_name or ''}}</td>       
                                                        
                                                             
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach
                                                        @else
                                                        <?php  $vaccines=DB::table('vaccine')->leftjoin('dependant_vaccination','dependant_vaccination.vaccine_id','=','vaccine.id')->select('vaccine.*','dependant_vaccination.*')->get(); ?>
                                                        @foreach($vaccines as $vaccine)

                                                              <tbody>
                                                      
                                                           
                                                         <td><a href="{{url('immunination',$id)}}">{{$i}}</a></td>
                                                         <td><a href="{{url('immunination',$id)}}">{{$vaccine->disease}}</a></td>
                                                         <td><a href="{{url('immunination',$id)}}">{{$vaccine->antigen}}</a></td>
                                                        <td>{{$vaccine->duration or ''}}</td>
                                                         <td></td>
                                                          <td>{{$vaccine->status or ''}}</td>
                                                           <td>{{$vaccine-> vaccin_name or ''}}</td>       
                                                        
                                                             
                                                               </tbody>
                                                           <?php $i++ ?>
                                                          @endforeach

                                                        @endif
                                                             </table>

                                                               



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
 @include('includes.default.footer')

        
      </div><!--content-->
      </div><!--content page-->

@endsection
