@extends('layouts.pharmacy')
@section('content')

<!-- <script type="text/javascript">
       $(document).ready(function() {
           $('.noCheck').click(function() {
               $('td:nth-child(9),th:nth-child(9)').hide();
               $('td:nth-child(10),th:nth-child(10)').hide();
               $('td:nth-child(11),th:nth-child(11)').hide();
               $('td:nth-child(12),th:nth-child(12)').hide();
               $('td:nth-child(13),th:nth-child(13)').hide();
               // if your table has header(th), use this
               //$('td:nth-child(2),th:nth-child(2)').hide();
           });

     $('.yesCheck').click(function() {
                $('td:nth-child(9),th:nth-child(9)').show();
                $('td:nth-child(10),th:nth-child(10)').show();
                $('td:nth-child(11),th:nth-child(11)').show();
                $('td:nth-child(12),th:nth-child(12)').show();
                $('td:nth-child(13),th:nth-child(13)').show();
               // if your table has header(th), use this
               //$('td:nth-child(2),th:nth-child(2)').hide();
           });

       });
   </script> -->

<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
<div class="col-lg-12">
 <div class="ibox float-e-margins">
 <div class="ibox-title">
     <h5>Prescription Details</h5>

 </div>

 <div class="ibox-content">

 <div class="table-responsive">
   <table class="table table-striped table-bordered table-hover dataTables-example" >
   <thead>
     <?php
     //$drugs = DB::table('druglists')->distinct(['drugname'])->get();
      ?>
     <!-- <div class="form-group">
         <label >Prescription:</label>
         <?php
        //  foreach($drugs as $drug)
        //  {
        //   $dds = $drug->drugname;
        //   foreach( explode(' ,', $dds) as $dd)
        //   {
        //   $d= $dd;
        //    }
        //}
          ?>
        <textarea><?php //echo $d; ?></textarea> -->

  <!-- <select class="presc1 form-control" style="width:500px;" name="itemName"></select>
  <input class="form-control" id="q" placeholder="Search users" name="q" type="text" > -->


     <tr>
         <th>No</th>
         <th>Name</th>
         <th>Drug</th>
         <th>Dosage Form</th>
         <th>Strength</th>
         <th>Strength Unit</th>
         <th>Route</th>
         <th>Frequency</th>
         <th></th>
     </tr>
     </thead>
     <tbody>

       <?php $i =1;
       foreach ($patients as $patient)
       {
         $person_treated = $patient->persontreated;
         ?>
     <tr class="gradeX">

     <td>{{$i}}</td>
     <?php
     if($person_treated == 'Self')
     {
      ?>
     <td>{{$patient->firstname.' '.$patient->secondName}}</td>
     <?php
     }
     else
     {?>
       <td>{{$patient->fname.' '.$patient->sname}}</td>
     <?php }
      ?>
     <td>{{$patient->drugname}}</td>
     <td>{{$patient->doseform}}</td>
     <td>{{$patient->strength}}</td>
     <td>{{$patient->strength_unit}}</td>
     <td>{{$patient->name}}</td>
     <td>{{$patient->frequency}} </td>
     <td>
    <div class="text-center">
    <!-- <a class="btn btn-success btn-rounded" data-toggle="modal" data-id="{{$patient->presc_id}}" data-target="#modal-form">Fill Prescription</a> -->
    <a class="btn btn-primary btn-rounded" href="{{ route('fillpresc',$patient->presc_id) }}" >Fill Prescription</a>

    <!-- <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Fill Prescription</a> -->
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
      <th>Name</th>
      <th>Drug</th>
      <th>Dosage Form</th>
      <th>Strength</th>
      <th>Strength Unit</th>
      <th>Route</th>
      <th>Frequency</th>
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
