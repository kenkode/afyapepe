@extends('layouts.pharmacy')
@section('content')


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
         /* Get total amount of that specific drug that has been given  */
         $id = $patient->presc_id;
         $query1 = DB::table('prescription_filled_status')
                 ->select(DB::raw('SUM(dose_given) AS total_given'))
                 ->where('presc_details_id','=',$id)
                 ->first();
         $count1 = $query1->total_given;

         /* Get the prescribed strength of the drug($id) */
         $query2 = DB::table('prescription_details')
                 ->where('id', '=', $id)
                 ->first();
         $count2 = $query2->strength;

         $new_strength = $count2 - $count1;

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
     <td>{{$new_strength}}</td>
     <td>{{$patient->strength_unit}}</td>
     <td>{{$patient->name}}</td>
     <td>{{$patient->freq_name}} </td>
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
