@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
<div class="row">
<h1> Sales</h1>   
<br>             <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">By Drug</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">By Prescribing Doctor</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-3">By Region</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                             <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1a">Today</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2a">This Week</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-3a">This Month</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-4a">This Year</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-5a">Max</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-6a">Custom</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                                <div id="tab-1a" class="tab-pane active">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total </th>
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
                         <div id="tab-2a" class="tab-pane ">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                                <div id="tab-3a" class="tab-pane ">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-4a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-5a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-6a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                            <div id="tab-2" class="tab-pane">
                             <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-21a">Today</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-22a">This Week</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-23a">This Month</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-24a">This Year</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-25a">Max</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-26a">Custom</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                                <div id="tab-21a" class="tab-pane active">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total </th>
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
                         <div id="tab-22a" class="tab-pane ">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                                <div id="tab-23a" class="tab-pane ">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-24a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-25a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-26a" class="tab-pane">
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
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                            <div id="tab-3" class="tab-pane">
                             <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-31a">Today</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-32a">This Week</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-33a">This Month</a></li>
                          <li class=""><a data-toggle="tab" href="#tab-34a">This Year</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-35a">Max</a></li>
                             <li class=""><a data-toggle="tab" href="#tab-36a">Custom</a></li>
                        </ul>
                        <br>
                        <div class="tab-content">
                                <div id="tab-31a" class="tab-pane active">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total </th>
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
                         <div id="tab-32a" class="tab-pane ">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                                <div id="tab-33a" class="tab-pane ">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-34a" class="tab-pane">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-35a" class="tab-pane">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
                         <div id="tab-36a" class="tab-pane">
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
                                                          <th>County</th>
                                                     <th>Drug Name</th>
                                                          
                                                          <th>Prescribing Doctor</th>
                                                           <th>Facility</th>
                                                          <th>Pharmacy  name</th>
                                                         <th> Quantity</th>
                                                         <th>Dosage</th>
                                                          <th>Dosage form</th>
                                                         <th>Unit Cost</th>
                                                         <th>Total  </th>
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
               
            </div>
            </div>
           <br><br>
             @include('includes.default.footer')
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
