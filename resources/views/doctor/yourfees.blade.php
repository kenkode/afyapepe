@extends('layouts.doctor')
@section('title', 'Your Fees')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">
            <?php
            $doc = (new \App\Http\Controllers\DoctorController);
            $Docdatas = $doc->DocDetails();
            foreach($Docdatas as $Docdata){
            $Did = $Docdata->doc_id;
            $Name = $Docdata->name;
          }

            if ( empty ($Name ) ) {
            // return view('doctor.create');

            return redirect('doctor.create');
            }
            ?>

  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Your Fees</h5>
                        <div class="ibox-tools">
                          @role('Doctor')
                           <a class="collapse-link">
                            {{$Name}}
                          </a>  @endrole
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
                            <th>Name of Patient</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Fee Type(procedures/consultation)</th>
                            <th>Amount</th>
                            <th>Mode of Payment</th>
                            <th>Date</th>
                            <!-- <th>Constituency of Residence</th> -->

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
       @include('includes.default.footer')

         </div><!--container-->
      </div><!--content-->
      </div><!--content page-->

@endsection
