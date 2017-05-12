@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
<div class="row">
              <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> AWAY FROM MERCK</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">TO MERCK</a></li>
                            
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                <div class="ibox float-e-margins">
                              <div class="ibox-title">

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

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                                                                           
        
                                                      
                                                      <tr>
                                                          <th>No</th>
                                                     <th>Prescribed Drug</th>
                                                     <th> Dosage</th>
                                                          <th>Dosage form</th>
                                                          <th>Pharmacy  name</th>
                                                          <th> Prescribing Doctor</th>
                                                          <th>Substituted Drug</th>
                                                          <th>Facility Name</th>
                                                          <th>Reason</th>
                                                         <th> Value</th>

                                                         </tr>
                                                 
                                                  </thead>

                                                  <tbody>
                                                    

                                                   </tbody>
                                                 
                                                 </table>
                                                 </div>
                                                 </div>
                                                 </div>
                                    
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                   
                                    <div class="ibox float-e-margins">
                              <div class="ibox-title">

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

                                  <div class="table-responsive">
                              <table class="table table-striped table-bordered table-hover dataTables-example" >
                              <thead>
                                                                           
        
                                                    
                                                      <tr>
                                                          <th>No</th>
                                                     <th>Prescribed Drug</th>
                                                     <th> Dosage</th>
                                                          <th>Dosage form</th>
                                                          <th>Pharmacy  name</th>
                                                          <th> Prescribing Doctor</th>
                                                          <th>Substituted Drug</th>
                                                          <th>Facility Name</th>
                                                          <th>Reason</th>
                                                         <th> Value</th>

                                                         </tr>
                                                   
                                                  </thead>

                                                  <tbody>
                                                    

                                                   </tbody>
                                                 
                                                 </table>
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
             @include('includes.default.footer')
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
