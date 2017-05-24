@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
              <br>
<div class="row">
<?php
$id=Auth::id();
$manufacturer=DB::table('manufacturers')->where('user_id', Auth::id())->first();
$Mname = $manufacturer->name;
$Mid = $manufacturer->id;
?>



<a data-toggle="modal" id="button1" class="btn btn-primary" href="#modal-company">Competition Companies</a>
<a data-toggle="modal" id="button2" class="btn btn-primary" href="#modal-drugs">Competition Drugs</a>
  <!-- Company Drug Competitions -->
  <div class="row" id="company">
  <div class="col-md-6">
  <div class="ibox float-e-margins">
  <div class="ibox-title">
  <h5>Company Competition <small></small></h5>
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
  <div class="col-lg-6">

          <form class="form-horizontal" role="form" method="POST" action="/addcompany" enctype="multipart/form-data" novalidate>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
             <label>Your Company:</label>
                  <select class="drugs-single" name="manuco" multiple="multiple" style="width: 100%">
                    <?php $manuco=DB::table('druglists')->select('id','Manufacturer')->groupBy('Manufacturer')->get(); ?>

                      <option value=''>Please Choose one</option>
                      @foreach($manuco as $comp)
                           <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                    @endforeach
                    </select>
              </div>
  <div class="hr-line-dashed"></div>
          <div class="form-group">
             <label>Company NO 1:</label>
                  <select class="drugs-single" name="company1" multiple="multiple" style="width: 100%">
                    <?php $manuco=DB::table('druglists')->select('id','Manufacturer')->groupBy('Manufacturer')->get(); ?>

                      <option value=''>Please Choose one</option>
                      @foreach($manuco as $comp)
                           <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                    @endforeach
                    </select>
              </div>
              <div class="form-group">
                 <label>Company NO 2:</label>
                      <select class="drugs-single" name="company2" multiple="multiple"  style="width: 100%">
                        <option value=''>Please Choose one</option>
                        @foreach($manuco as $comp)
                             <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                      @endforeach
                        </select>
                  </div>
                  <div class="form-group">
                     <label>Company NO 3:</label>
                          <select class="drugs-single" name="company3" multiple="multiple" style="width: 100%">
                            <option value=''>Please Choose one</option>
                            @foreach($manuco as $comp)
                                 <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                          @endforeach
                            </select>
                      </div>
                      <div class="form-group">
                         <label>Company NO 4:</label>
                              <select class="drugs-single" name="company4" multiple="multiple"  style="width: 100%">
                                <option value=''>Please Choose one</option>
                                @foreach($manuco as $comp)
                                     <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                              @endforeach
                                </select>
                          </div>
                          <div class="form-group">
                             <label>Company NO 5:</label>
                                  <select class="drugs-single" name="company5" multiple="multiple" style="width: 100%">
                                    <option value=''>Please Choose one</option>
                                    @foreach($manuco as $comp)
                                         <option value='{{$comp->id}}'>{{$comp->Manufacturer}}</option>
                                  @endforeach
                                    </select>
                              </div>
                              <div class="text-center">
                              {{ Form::hidden('manu_id',$Mid, array('class' => 'form-control')) }}

                              <button class="btn btn-lg btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>
                              </form>
                              </div>


    </div>
</div>
  </div>

  </div>
  </div>
  </div>
  </div>

  <!-- Company Competitions -->
                            <div class="row" id="drugs">
              <div class="col-lg-12">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>Drugs Competition <small></small></h5>
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
                              <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">{{$manufacturer->name}} Drugs</h3>

                                    <form class="form-horizontal" role="form" method="POST" action="/adddrugs" enctype="multipart/form-data" novalidate>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                       <label>Drug NO 1:</label>
                                            <select class="drugs-single" name="base_drug_1" multiple="multiple" style="width: 100%">
                                              <?php $biotests=DB::table('druglists')->where('Manufacturer', 'like',$Mname.'%')->distinct()->get(['id','drugname']); ?>
                                                <option value=''>Please Choose one</option>
                                                @foreach($biotests as $biotest)
                                                     <option value='{{$biotest->id}}'>{{$biotest->drugname}}</option>
                                              @endforeach
                                              </select>
                                        </div>
                                        <div class="form-group">
                                           <label>Drug NO 2:</label>
                                                <select class="drugs-single" name="base_drug_2" multiple="multiple"  style="width: 100%">
                                                  <?php $biotests=DB::table('druglists')->where('Manufacturer', 'like',$Mname.'%')->distinct()->get(['id','drugname']); ?>
                                                    <option value=''>Please Choose one</option>
                                                    @foreach($biotests as $biotest)
                                                         <option value='{{$biotest->id}}'>{{$biotest->drugname}}</option>
                                                  @endforeach
                                                  </select>
                                            </div>
                                            <div class="form-group">
                                               <label>Drug NO 3:</label>
                                                    <select class="drugs-single" name="base_drug_3" multiple="multiple" style="width: 100%">
                                                      <?php $biotests=DB::table('druglists')->where('Manufacturer', 'like',$Mname.'%')->distinct()->get(['id','drugname']); ?>
                                                        <option value=''>Please Choose one</option>
                                                        @foreach($biotests as $biotest)
                                                             <option value='{{$biotest->id}}'>{{$biotest->drugname}}</option>
                                                      @endforeach
                                                      </select>
                                                </div>
                                                <div class="form-group">
                                                   <label>Drug NO 4:</label>
                                                        <select class="drugs-single" name="base_drug_4" multiple="multiple"  style="width: 100%">
                                                          <?php $biotests=DB::table('druglists')->where('Manufacturer', 'like',$Mname.'%')->distinct()->get(['id','drugname']); ?>
                                                             <option value=''>Please Choose one</option>
                                                             @foreach($biotests as $biotest)
                                                                 <option value='{{$biotest->id}}'>{{$biotest->drugname}}</option>
                                                          @endforeach
                                                          </select>
                                                    </div>
                                                    <div class="form-group">
                                                       <label>Drug NO 5:</label>
                                                            <select class="drugs-single" name="base_drug_5" multiple="multiple" style="width: 100%">
                                                              <?php $biotests=DB::table('druglists')->where('Manufacturer', 'like',$Mname.'%')->distinct()->get(['id','drugname']); ?>
                                                              <option value=''>Please Choose one</option>
                                                              @foreach($biotests as $biotest)
                                                              <option value='{{$biotest->id}}'>{{$biotest->drugname}}</option>
                                                              @endforeach
                                                              </select>
                                                        </div>



                              </div>
                              <div class="col-sm-6"><h4>Competition Drug</h4>
                                <div class="form-group">
                                <label for="presc" class="col-md-6">Competition Drug No 1:</label>
                                <select id="presc" name="compe_drug_1" multiple="multiple" class="form-control drugs1" style="width: 100%">
                              </select>
                            </div>
                            <div class="form-group">
                            <label for="presc" class="col-md-6">Competition Drug No 2:</label>
                            <select id="presc" name="compe_drug_2" multiple="multiple" class="form-control drugs1" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                           <label for="presc" class="col-md-6">Competition Drug No 3:</label>
                           <select id="presc" name="compe_drug_3" multiple="multiple" class="form-control drugs1" style="width: 100%"></select>
                          </div>
                          <div class="form-group">
                         <label for="presc" class="col-md-6">Competition Drug No 4:</label>
                         <select id="presc" name="compe_drug_4" multiple="multiple" class="form-control drugs1" style="width: 100%"></select>
                         </div>
                        <div class="form-group">
                      <label for="presc" class="col-md-6">Competition Drug No 5:</label>
                      <select id="presc" name="compe_drug_5" multiple="multiple" class="form-control drugs1" style="width: 100%"></select>
                       </div>
                        </div>
                           </div>
                          <div class="row text-center">
                            {{ Form::hidden('manu_id',$Mid, array('class' => 'form-control')) }}
                          <button class="btn btn-lg btn-primary  m-t-n-xs" type="submit"><strong>Submit</strong></button>
                           </form>
                           </div>
                      </div>
                  </div>
              </div>
              </div>
              <div class="row" id="company">
              <div class="col-md-12">
              <div class="ibox float-e-margins">
              <div class="ibox-title">
              <h5> Competition <small></small></h5>
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
            <div class="col-sm-4 b-r"><h3 class="m-t-none m-b">Competition Companies</h3>
              <?php $Companies=DB::table('compe_manufacturer')
              ->Join('druglists', 'compe_manufacturer.competition', '=', 'druglists.id')
              ->select('compe_manufacturer.id','druglists.Manufacturer')
               ->where('compe_manufacturer.company', '=',$Mid)
               ->get(); ?>

              @foreach($Companies as $cos)
              <div class="form-group">
            <input type="text" value="{{$cos->Manufacturer}}" class="form-control">
            </div>
              @endforeach
             </div>




        <div class="col-sm-8"><h4>Competition Drug</h4>
          <form role="form" class="form-inline">

            <?php $Companiesd=DB::table('compe_drugs')
            ->select('compe_drugs.*')
             ->where('manufacturer_id', '=',$Mid)
             ->get(); ?>

            @foreach($Companiesd as $cosd)

<div class="form-group">
  <?php $companydrugs=DB::table('druglists')->where('id', '=',$cosd->company)->distinct()->first(['drugname']); ?>
<input type="text" value="{{$companydrugs->drugname}}" class="form-control">
</div>

<button class="btn btn-white" type="submit">Vs</button>

<div class="form-group">
  <?php $companydrug=DB::table('druglists')->where('id', '=',$cosd->competition)->distinct()->first(['drugname']); ?>
<input type="text" value="{{$companydrug->drugname}}" class="form-control">
</div>
<br />
                @endforeach

                </form>
          </div>
            </div>
              </div>

              </div>
              </div>
              </div>







</div>
<br>



             @include('includes.default.footer')
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
