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
         @role(['Pharmacyadmin','Pharmacymanager'])
         <th>Number in stock</th>
         @endrole
         <th></th>
     </tr>
     </thead>
     <tbody>
       <?php
       $i = 1;
       foreach($inventory as $inv)
       {
         $bought = $inv->quantity;
         $drug_id = $inv->drug_id;
         $inventory_id = $inv->inventory_id;
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
        @role(['Pharmacyadmin','Pharmacymanager'])
        <td>{{$stock_level}}</td>
        @endrole
        <td>
          @role(['Pharmacyadmin','Pharmacymanager'])
          <a href="{{ route('edit_inventory',$inventory_id) }}">Edit</a> &nbsp;&nbsp;
          @endrole
          <a href="{{ route('update_inv',$inventory_id) }}">Update</a> &nbsp;&nbsp;
          @role(['Pharmacyadmin','Pharmacymanager'])
          <a data-toggle="modal" class="btn btn-primary" href="#modal-form" data-manufacturer="{{$inv->Manufacturer}}"
            data-drug="{{$inv->drugname}}" data-stock="{{$stock_level}}" data-id="{{$inv->inventory_id}}">Delete</a>
            @endrole
          <div id="modal-form" class="modal fade" aria-hidden="true">
          <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body">
            <div class="row">
          <div class="col-sm-8"><h3 class="m-t-none m-b">Inventory</h3>
          {!! Form::open(array('route' => 'delete_inventory','method'=>'POST','class'=>'form-horizontal')) !!}
            <input type="hidden" class="form-control" name="inv_id" id="deletion4">

              <div class="form-group"><label>Manufacturer</label> <input type="text" class="form-control" id="deletion1" disabled></div>
              <div class="form-group"><label>Drug</label> <input type="text" class="form-control" id="deletion2" disabled></div>
              <div class="form-group"><label>Number in Stock</label> <input type="text" class="form-control" id="deletion3" disabled></div>
              <div>
                  <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Delete</strong></button>
              </div>
          </form>
          </div>

                  </div>
              </div>
              </div>
              </div>
      </div>

        </td>
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
      @role(['Pharmacyadmin','Pharmacymanager'])
      <th>Number in stock</th>
      @endrole
      <th></th>
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
