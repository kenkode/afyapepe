@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
  <div class="content-page  equal-height">

      <div class="content">
          <div class="container">



            <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
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
                                                         <th>Total</th>
                                                         </tr>
                                                 
                                                  </thead>

                                                  <tbody>
                                                    <?php $i =1; ?>
                                                 @foreach($drugs as $mandrug)
                                                 <?php $total= ($mandrug->quantity * $mandrug->price);

                                                 ?>
                                                      <tr>
                                                          <td>{{$i}}</td>
                                                          <td> <?php if($mandrug->substitute_presc_id){
                                                              $drugs = DB::table('substitute_presc_details')
                                                              ->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
                                                              ->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
                                                              ->where('druglists.Manufacturer','like', '%' . 'MERCK' . '%')
                                                              ->first();
                                                              echo $drugs->subdrugname;
                                                          }
                                                            else{ echo $mandrug->drugname;   } ?>

                                                            </td>
                                                          <td>{{$mandrug->name}}</td>
                                                          <td>{{$mandrug->FacilityName}}</td>
                                                          <td>{{$mandrug->pharmacy}}</td>
                                                          <td>{{$mandrug->quantity}}</td>
                                                          <td>{{$mandrug->dose_given}}</td>
                                                          <td><?php if($mandrug->substitute_presc_id){  echo $drugs->subdoseform;}
                                                          else { echo $mandrug->doseform; }?> </td>
                                                          <td>{{$mandrug->price}}</td>
                                                          <td>{{$total}}</td>
                                                        </tr>
                                                          <?php $i++;  ?>
                                                        @endforeach

                                                     </tbody>

                                                 </table>
                                                     </div>

                                                 </div>
                                             </div>
                                         </div>
                                         </div>
                                     </div>



                         </div>
@include('includes.default.footer')
          </div><!--content-->
      </div><!--content page-->

@endsection
