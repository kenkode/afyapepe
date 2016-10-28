@extends('layouts.pharmacy')
@section('content')
  <div class="content-page  equal-height">
      <span class="label label-info">Today's Patients</span>
      <div class="content">
          <div class="container">



                    <div class="row">
                                      <div class="col-sm-12 ">


                                          <div class="panel-box">

                                                        <div class="table-responsive">
                                                     <table class="table table-small-font table-bordered table-striped">
                                                  <thead>
                                                      <tr>
                                                          <th>No</th>
                                                          <th>FirstName</th>
                                                          <th>Surname</th>
                                                          
                                                          <th>Age</th>
                                                          <th>Gender</th>
                                                          <th>Description</th>
                                                          <th>Dosage</th>
                                                          <th>Quantity</th>
                                                          <th>Price</th>
                                                          <th>Amount</th>
                                                    </tr>
                                                  </thead>
                                       <tbody>
                                              

                                                   </tbody>
                                                 </table>
                                               </div>


         </div>

          </div><!--content-->
      </div><!--content page-->

@endsection
