@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
  <div class="content-page  equal-height">
    <?php
    $id=Auth::id();
    $manufacturer=DB::table('manufacturers')->where('user_id', Auth::id())->first();
    $Mname = $manufacturer->name;
    $Mid = $manufacturer->id;
    ?>
      <div class="content">
          <div class="container">
             <div class="wrapper wrapper-content animated fadeInRight">
                      <div class="row">
                          <div class="col-lg-11">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                    PHARMACY STOCKS
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
                                                          <th>Pharmacy</th>
                                                          <th>County</th>
                                                          <th>Drug Name</th>
                                                          <th>Dosage form</th>
                                                          <th>Quantity</th>
                                                          <th>Rate of Sales(Per Week)</th>
                                                          <th>Run of Rate</th>

                                                         </tr>
                                                    </tr>
                                                  </thead>
                    <?php  $invents = DB::table('inventory')
                         ->join('pharmacy','inventory.outlet_id','=','pharmacy.id')
                         ->join('druglists','inventory.drug_id','=','druglists.id')
                         ->select('pharmacy.name','pharmacy.county','inventory.created_at','inventory.quantity','inventory.strength',
                         'inventory.strength_unit','druglists.drugname','druglists.DosageForm'
                        )
                         ->where([ ['druglists.Manufacturer','like','%'.$Mname.'%'],  ])
                         ->whereIn('inventory.created_at', function($query)
                             {
                                 $query->select(DB::raw('max(inventory.created_at)'))
                                       ->from('inventory')
                                       ->join('pharmacy','inventory.outlet_id','=','pharmacy.id')
                                       ->join('druglists','inventory.drug_id','=','druglists.id')
                                       ->groupBy('pharmacy.name','druglists.drugname');

                             })
                          ->get();
                             $i=1;
                          ?>
                        <tbody>
                          @foreach($invents as $stock)
                          <tr>
                          <td>{{$i}}</td>
                          <td>{{$stock->name}}</td>
                          <td>{{$stock->county}}</td>
                          <td>{{$stock->drugname}}</td>
                          <td>{{$stock->DosageForm}}</td>
                          <td>{{$stock->quantity}}</td>
                          <td>{{$stock->quantity}}</td>
                          <td>{{$stock->quantity}}</td>

                          </tr>
                      <?php $i++; ?>
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
