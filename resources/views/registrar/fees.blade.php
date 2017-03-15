@extends('layouts.registrar')
@section('title', 'Registrar Dashboard')
@section('content')
  <div class="content-page  equal-height">
      <div class="content">
          <div class="container">

  <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Consultation Fee </h5>
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
                            <th>Date</th>
                            <th>Time</th>
                            <th>Name</th>
                            <th>Descr</th>
                            <th>Amount</th>


                      </tr>
                    </thead>

                    <tbody>
                      <?php $i=1;?>
            @foreach($fees as $fee)
            <tr>
            <td>{{$i}}</td>
            <td><?php $dt=$fee->created_at; echo date("d-m-Y ", strtotime( $dt));?> </td>
           <td><?php $dy=$fee->created_at; echo date("g-i-a ", strtotime( $dy));?></td>
            <td>{{$fee->firstname}} {{$fee->secondName}}</td>
            <td>{{$fee->descr}}</td>
            <td>{{$fee->amount}}</td>
          </tr>
          <?php $i++ ?>
            @endforeach

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
