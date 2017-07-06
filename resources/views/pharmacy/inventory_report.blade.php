@extends('layouts.pharmacy')
@section('content')


<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
<div class="col-lg-12">
 <div class="ibox float-e-margins">
 <div class="ibox-title">
     <h5>Inventory Report</h5>

     <div class="ibox-tools">

   </div>

 </div>

 <div class="ibox-content">

 <div class="table-responsive">
   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>

     <tr>
         <th>No</th>
         <th>Drug</th>
         <th>Inventory Stock</th>
         <th>Stock Update</th>
         <th>Sales</th>
         <th>Variance</th>

     </tr>
     </thead>
     <tbody>
       <?php
       $i = 1;
       foreach($reports as $report)
       {
         $inventory_qty = $report->inv_qty;
         $update_qty = $report->inv_qty2;
         $sale_qty = $report->qty3;
         $variance = $sale_qty - $update_qty;
         $drug = $report->drugname;
        ?>
        <tr>
        <td>{{$i}}</td>
        <td>{{$drug}}</td>
        <td>{{$inventory_qty}}</td>
        <td>{{$update_qty}}</td>
        <td>{{$sale_qty}}</td>
        <td>{{$variance}}</td>
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
      <th>Inventory Stock</th>
      <th>Stock Update</th>
      <th>Sales</th>
      <th>Variance</th>
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
