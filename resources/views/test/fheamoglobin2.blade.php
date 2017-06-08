 <div class="wrapper wrapper-content animated fadeInRight">
				<div class="row">
               <h3 class="text-center">HAEMATOLOGY REPORT</h3>
						 <div class="col-sm-2 b-r">

						{{ Form::open(array('route' => array('testResult'),'method'=>'POST')) }}
                  <div class="form-group"><label>RBC</label>
                  <input type="text" name="rbc" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>HB</label>
                  <input type="text" name="hb" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>PCV</label>
                  <input type="text" name="pcv" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>MCV</label>
                  <input type="text" name="mcv" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>MCH</label>
                  <input type="text" name="mch" placeholder="Enter Value" class="form-control"></div>
            </div>
            <div class="col-sm-2 b-r">
                  <div class="form-group"><label>MCHC</label>
                  <input type="text" name="mch" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>Platelets</label>
                  <input type="text" name="platelets" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>ESR</label>
                  <input type="text" name="esr" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>WBC Count</label>
                  <input type="text" name="wbc" placeholder="Enter Value" class="form-control"></div>
                  <div class="form-group"><label>Neutrophils</label>
                  <input type="text" name="neutrophils" placeholder="Enter Value" class="form-control"></div>
            </div>
            <div class="col-sm-2 b-r">
                <div class="form-group"><label>Lymphocytes</label>
                <input type="text" name="lymphocytes" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Monocytes</label>
                <input type="text" name="monocytes" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Esinophils</label>
                <input type="text" name="esinophils" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Basophils</label>
                <input type="text" name="basophils" placeholder="Enter Value" class="form-control"></div>
     </div>
     <div class="col-sm-6">
       <div class="ibox float-e-margins">
               <h5>Full Haemoglobin Ranges</h5>
              <div class="ibox-content">
                          <table class="table table-bordered">
                               <thead>
                               <tr>
                                   <th>#</th>
                                   <th>TEST</th>
                                   <th>UNITS</th>
                                   @if($gender == 'Male')
                                   <th><button type="button" class="btn btn-primary">NORMAL MALE</button></th>
                                   <th>NORMAL FEMALE</th>
                                   @else
                                   <th>NORMAL MALE</th>
                                   <th><button type="button" class="btn btn-primary">NORMAL FEMALE</button></th>
                                   @endif
                               </tr>
                               </thead>
                               <tbody>
                                 <?php $i=1; $fh=DB::table('test_ranges')->where('type', '=','full-haemoglobin')->get(); ?>
                                 @foreach($fh as $fhtest)
                               <tr>
                                   <td>{{$i}}</td>
                                   <td>{{$fhtest->test}}</td>
                                   <td>{{$fhtest->units}}</td>
                                   <td>{{$fhtest->normal_male}}</td>
                                   <td>{{$fhtest->normal_female}}</td>
                                <?php $i ++ ?>
                               </tr>
                               @endforeach

                               </tbody>
                           </table>
                       </div>
                   </div>
 </div>


<div class="col-lg-12">
  <div class="ibox float-e-margins">
  <h5>FILM REPORT</h5>
    <div class="ibox-content form-inline">
        <div class="form-group col-sm-2">
        <label  class="">RBC:</label>
        <select class="form-control" name="rbc2" >
        <option value='Normocytic'>Normocytic</option>
        <option value='Normochromic'>Normochromic</option>
        <option value='Neutropenia'>Neutropenia</option>
        <option value='Adequate'>Adequate</option>
        </select>
        </div>
        <div class="form-group col-sm-2">
        <label  class="">WBC:</label>
        <select class="form-control" name="wbc2" >
        <option value='Normocytic'>Normocytic</option>
        <option value='Normochromic'>Normochromic</option>
        <option value='Neutropenia'>Neutropenia</option>
        <option value='Adequate'>Adequate</option>
        </select>
        </div>
        <div class="form-group col-sm-2">
        <label  class="">Platelets:</label>
        <select class="form-control" name="platelets2" >
        <option value='Normocytic'>Normocytic</option>
        <option value='Normochromic'>Normochromic</option>
        <option value='Neutropenia'>Neutropenia</option>
        <option value='Adequate'>Adequate</option>
        </select>
        </div>
        <div class="form-group col-lg-3">
        <label  class="">Comments:</label>
        <select class="form-control" name="comments" >
        <option value='Borderline neutropenia'>Borderline neutropenia</option>
        <option value='Normal peripherial blood picture'>Normal peripherial blood picture</option>
        </select>
        </div>

        <div class="form-group col-lg-3">
          <label>Other Reports</label>
        <textarea name="comments2" rows="2" placeholder="Any other notes" class="form-control"></textarea>
      </div>
        </div>
        <div class="text-center col-sm-4">
        <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>
     </div>
   </div>
</div>
{{ Form::close() }}
    </div>
 </div>
