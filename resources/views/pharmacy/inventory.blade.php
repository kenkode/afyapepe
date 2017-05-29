@extends('layouts.pharmacy')
@section('content')


<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
<div class="col-lg-12">
 <div class="ibox float-e-margins">
 <div class="ibox-title">
     <h5>Drugs Stock</h5>

     <div class="ibox-tools">

     <a class="btn btn-primary " type="button" href="{{ URL::to('new_stock') }}"><i class="fa fa-paste"></i> Add Stock</a>
   </div>

 </div>

 <div class="ibox-content">

 <div class="table-responsive">
   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>

     <tr>
         <th>No</th>
         <th>Drug</th>
         <th>Manufacturer</th>
         <th>Number in stock</th>
     </tr>
     </thead>
     <tbody>
       <?php
       $i = 1;
       foreach($inventory as $inv)
       {
         $bought = $inv->quantity;
         $drug_id = $inv->drug_id;
         $counter = DB::table('prescription_filled_status')
                ->join('prescription_details', 'prescription_details.id', '=', 'prescription_filled_status.presc_details_id')
                ->select(DB::raw('SUM(prescription_filled_status.quantity) AS count1'))
                ->where('prescription_details.drug_id', '=', $drug_id)
                ->first();
        $sold= $counter->count1;

          $stock_level = $bought - $sold;
        ?>
        <tr>
        <td>{{$i}}</td>
        <td>{{$inv->drugname}}</td>
        <td>{{$inv->Manufacturer}}</td>
        <td>{{$stock_level}}</td>
        </tr>
        <?php
        $i++;
      }
         ?>
   </tbody>
  <tfoot>
    <tr>
      <th>No</th>
      <th>Drug</th>
      <th>Manufacturer</th>
      <th>Number in stock</th>
    </tr>
    </tfoot>
    </table>
        </div>

    </div>


   </div>
   </div>

    </div><!--content-->
</div><!--content page-->


@endsection
