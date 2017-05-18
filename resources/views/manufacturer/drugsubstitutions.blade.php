@extends('layouts.manufacturer')
@section('title', 'Manufacturer')
@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
<div class="row">
<h1> Drug Substitutions</h1>
              <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> AWAY FROM MERCK</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">TO MERCK</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">MERCK TO MERCK</a></li>

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

                                                         <th>Prescribed Drug</th>
                                                          <th>Pharmacy  name</th>
                                                          <th>Prescribing Doctor</th>
                                                          <th>Substituted Drug</th>
                                                          <th> Dosage</th>
                                                          <th>Dosage form</th>
                                                          <th>Facility Name</th>
                                                          <th>Reason</th>
                                                          <th>Quantity</th>
                                                          <th>Price</th>
                                                         <th> Value</th>

                                                         </tr>

                                                  </thead>

<tbody>
  <?php $i =1; ?>
@foreach($drugsubst as $mandrug)
<?php
$total= ($mandrug->quantity * $mandrug->price);
?>
    <tr>
        <td>{{$i}}</td>

<td>{{ $mandrug->drugname}}</td>
<td> {{ $mandrug->pharmacy}}</td>
<td> {{ $mandrug->name}}</td>
<td> Bolt</td>
<td> {{ $mandrug->dose_given}}</td>
<td> {{ $mandrug->doseform}}</td>
<td> {{ $mandrug->FacilityName}}</td>
<td> {{ $mandrug->dose_reason}}</td>
<td> {{ $mandrug->quantity}}</td>
<td> {{ $mandrug->price}}</td>
<td> {{ $total}}</td>
          </td>
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

                                   <th>Prescribed Drug</th>
                                    <th>Pharmacy  name</th>
                                    <th>Prescribing Doctor</th>
                                    <th>Substituted Drug</th>
                                    <th> Dosage</th>
                                    <th>Dosage form</th>
                                    <th>Facility Name</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                   <th> Value</th>

                                   </tr>

                            </thead>

<tbody>
<?php $i =1;
use Carbon\Carbon;
$todaysales = Carbon::now();
$one_week_ago = Carbon::now()->subWeeks(1);
$drugsubstweek = DB::table('prescriptions')
->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
->select('prescription_filled_status.dose_given as dose','prescription_filled_status.substitution_reason as reason',
 'prescription_filled_status.quantity as quantity','prescription_filled_status.price as price',
 'facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
 'substitute_presc_details.doseform',
 'substitute_presc_details.id as subid')
->where([ ['druglists.Manufacturer','like','MERCK%'],
    ['prescription_filled_status.created_at','>=',$one_week_ago],
      ['prescription_filled_status.created_at','<=',$todaysales],
     ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->get(); ?>
@foreach($drugsubstweek as $mandrug)
<?php
$total= ($mandrug->quantity * $mandrug->price);
$drugs = DB::table('substitute_presc_details')
->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
->where([
['substitute_presc_details.id','=',$mandrug->subid],
])
->first();
?>
<tr>
<td>{{$i}}</td>

<td>{{ $mandrug->drugname}}</td>
<td> {{ $mandrug->pharmacy}}</td>
<td> {{ $mandrug->name}}</td>
<td> <?php if($drugs) { echo $drugs->subdrugname; }else{} ?></td>
<td> {{ $mandrug->dose}}</td>
<td> {{ $mandrug->doseform}}</td>
<td> {{ $mandrug->FacilityName}}</td>
<td> {{ $mandrug->reason}}</td>
<td> {{ $mandrug->quantity}}</td>
<td> {{ $mandrug->price}}</td>
<td> {{ $total}}</td>
</td>
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
  <!-- tab-2a -->
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

                                   <th>Prescribed Drug</th>
                                    <th>Pharmacy  name</th>
                                    <th>Prescribing Doctor</th>
                                    <th>Substituted Drug</th>
                                    <th> Dosage</th>
                                    <th>Dosage form</th>
                                    <th>Facility Name</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                   <th> Value</th>

                                   </tr>

                            </thead>

<tbody>
<?php $i =1;
$one_month_ago = Carbon::now()->subMonths(1);
$drugsubstMon = DB::table('prescriptions')
->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
->select('prescription_filled_status.dose_given as dose','prescription_filled_status.substitution_reason as reason',
 'prescription_filled_status.quantity as quantity','prescription_filled_status.price as price',
 'facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
 'substitute_presc_details.doseform',
 'substitute_presc_details.id as subid')
->where([ ['druglists.Manufacturer','like','MERCK%'],
    ['prescription_filled_status.created_at','>=',$one_month_ago],
      ['prescription_filled_status.created_at','<=',$todaysales],
     ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->get(); ?>

@foreach($drugsubstMon as $mandrug)
<?php
$total= ($mandrug->quantity * $mandrug->price);
$drugs = DB::table('substitute_presc_details')
->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
->where([
['substitute_presc_details.id','=',$mandrug->subid],
])
->first();
?>
<tr>
<td>{{$i}}</td>

<td>{{ $mandrug->drugname}}</td>
<td> {{ $mandrug->pharmacy}}</td>
<td> {{ $mandrug->name}}</td>
<td> <?php if($drugs) { echo $drugs->subdrugname; }else{} ?></td>
<td> {{ $mandrug->dose}}</td>
<td> {{ $mandrug->doseform}}</td>
<td> {{ $mandrug->FacilityName}}</td>
<td> {{ $mandrug->reason}}</td>
<td> {{ $mandrug->quantity}}</td>
<td> {{ $mandrug->price}}</td>
<td> {{ $total}}</td>
</td>
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
        <!-- tab-3a -->         <div id="tab-4a" class="tab-pane ">
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
                                    <th>Pharmacy  name</th>
                                    <th>Prescribing Doctor</th>
                                    <th>Substituted Drug</th>
                                    <th> Dosage</th>
                                    <th>Dosage form</th>
                                    <th>Facility Name</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                   <th> Value</th>

                                   </tr>

                            </thead>

<tbody>
<?php $i =1;
$one_year_ago = Carbon::now()->subYears(1);
$drugsubstYear = DB::table('prescriptions')
->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
->select('prescription_filled_status.dose_given as dose','prescription_filled_status.substitution_reason as reason',
 'prescription_filled_status.quantity as quantity','prescription_filled_status.price as price',
 'facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
 'substitute_presc_details.doseform',
 'substitute_presc_details.id as subid')
->where([ ['druglists.Manufacturer','like','MERCK%'],
    ['prescription_filled_status.created_at','>=',$one_year_ago],
      ['prescription_filled_status.created_at','<=',$todaysales],
     ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->get();

?>
@foreach($drugsubstYear as $mandrug)
<?php
$total= ($mandrug->quantity * $mandrug->price);
$drugs = DB::table('substitute_presc_details')
->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
->where([
['substitute_presc_details.id','=',$mandrug->subid],
])
->first();
?>
<tr>
<td>{{$i}}</td>

<td>{{ $mandrug->drugname}}</td>
<td> {{ $mandrug->pharmacy}}</td>
<td> {{ $mandrug->name}}</td>
<td> <?php if($drugs) { echo $drugs->subdrugname; }else{} ?></td>
<td> {{ $mandrug->dose}}</td>
<td> {{ $mandrug->doseform}}</td>
<td> {{ $mandrug->FacilityName}}</td>
<td> {{ $mandrug->reason}}</td>
<td> {{ $mandrug->quantity}}</td>
<td> {{ $mandrug->price}}</td>
<td> {{ $total}}</td>
</td>
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

                                   <th>Prescribed Drug</th>
                                    <th>Pharmacy  name</th>
                                    <th>Prescribing Doctor</th>
                                    <th>Substituted Drug</th>
                                    <th> Dosage</th>
                                    <th>Dosage form</th>
                                    <th>Facility Name</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                   <th> Value</th>

                                   </tr>

                            </thead>

<tbody>
<?php $i =1;
$drugsubstall = DB::table('prescriptions')
->Join('prescription_details', 'prescriptions.id', '=', 'prescription_details.presc_id')
->Join('prescription_filled_status', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
->Join('pharmacy', 'prescription_filled_status.outlet_id', '=', 'pharmacy.id')
->Join('facilities', 'prescriptions.facility_id', '=', 'facilities.FacilityCode')
->Join('doctors', 'prescriptions.doc_id', '=', 'doctors.doc_id')
->Join('substitute_presc_details', 'prescription_filled_status.substitute_presc_id', '=', 'substitute_presc_details.id')
->Join('druglists', 'prescription_details.drug_id', '=', 'druglists.id')
->select('prescription_filled_status.dose_given as dose','prescription_filled_status.substitution_reason as reason',
 'prescription_filled_status.quantity as quantity','prescription_filled_status.price as price',
 'facilities.FacilityName','doctors.name','druglists.drugname','pharmacy.name as pharmacy',
 'substitute_presc_details.doseform',
 'substitute_presc_details.id as subid')
->where([ ['druglists.Manufacturer','like','MERCK%'],
                      ])
->whereNotNull('prescription_filled_status.substitute_presc_id')
->get();
 ?>
@foreach($drugsubstall as $mandrug)
<?php
$total= ($mandrug->quantity * $mandrug->price);
$drugs = DB::table('substitute_presc_details')
->Join('druglists', 'substitute_presc_details.drug_id', '=', 'druglists.id')
->select('druglists.drugname as subdrugname','substitute_presc_details.doseform as subdoseform')
->where([
['substitute_presc_details.id','=',$mandrug->subid],
])
->first();
?>
<tr>
<td>{{$i}}</td>

<td>{{ $mandrug->drugname}}</td>
<td> {{ $mandrug->pharmacy}}</td>
<td> {{ $mandrug->name}}</td>
<td> <?php if($drugs) { echo $drugs->subdrugname; }else{} ?></td>
<td> {{ $mandrug->dose}}</td>
<td> {{ $mandrug->doseform}}</td>
<td> {{ $mandrug->FacilityName}}</td>
<td> {{ $mandrug->reason}}</td>
<td> {{ $mandrug->quantity}}</td>
<td> {{ $mandrug->price}}</td>
<td> {{ $total}}</td>
</td>
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

                                   <th>Prescribed Drug</th>
                                    <th>Pharmacy  name</th>
                                    <th>Prescribing Doctor</th>
                                    <th>Substituted Drug</th>
                                    <th> Dosage</th>
                                    <th>Dosage form</th>
                                    <th>Facility Name</th>
                                    <th>Reason</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
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
   </div><!-- tab-6a -->

 </div><!--  tab-content -->
  </div>
<!--  ................To MERCK............................. -->

<!-- .................INTER MERCK...................................... -->


<!--  ................INTER MERCK........................................ -->
</div><!--  tab-content -->
</div>
</div>
  </div>

             @include('includes.default.footer')
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
