
<div class="wrapper wrapper-content">


  <div class="row">
         <div class="ibox float-e-margins">
            <div class="table-responsive ibox-content">
          <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                 <thead>
              <tr>
               <th></th>
                 <th>Weight </th>
                 <th>Height</th>
                 <th>Temperature</th>
                 <th>Systolic BP</th>
                 <th>Diastolic BP</th>
                 <th>BMI</th>
                 <th>Chief Compliant</th>
                 <th>Observations</th>
                 <th>Symptoms</th>
                 <th>Nurse Notes</th>
            </tr>
              </thead>

              <tbody>
              <?php $i =1; ?>

              @foreach($patientdetails as $pdetails)
                <tr>
                <td>{{ +$i }}</td>
               <td>{{$pdetails->current_weight}} </td>
                <td>{{ $pdetails->current_height}}</td>
                <td>{{  $pdetails->temperature}}</td>
                <td>{{ $pdetails->systolic_bp}}</td>
                 <td>{{ $pdetails->diastolic_bp}}</td>
                 <td>
                   <?php $height=$pdetails->current_height; $weight=$pdetails->current_weight;

                               $bmi =$weight/($height*$height);
                            echo number_format($bmi, 2);
                         ?></td>
                 <td>{{ $pdetails->chief_compliant}}</td>
                 <td> {{ $pdetails->observation}}</td>
                 <td> {{ $pdetails->symptoms}}</td>
                 <td>{{ $pdetails->nurse_notes}}</td>
               </tr>
              <?php $i++; ?>

              @endforeach

              </tbody>
              </table>
               </div>
             </div>

           </div>






 </div>
