 <div class="wrapper wrapper-content animated fadeInRight">
						 <div class="row">
						 <div class="col-sm-6"><h3 class="m-t-none m-b">Test Result</h3>
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
                <div class="form-group"><label>Lymphocytes</label>
                <input type="text" name="lymphocytes" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Monocytes</label>
                <input type="text" name="monocytes" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Esinophils</label>
                <input type="text" name="esinophils" placeholder="Enter Value" class="form-control"></div>
                <div class="form-group"><label>Basophils</label>
                <input type="text" name="basophils" placeholder="Enter Value" class="form-control"></div>

                <div class="form-group">
                    <label  class="">RBC:</label>
                         <select class="form-control" name="rbc2" >

                                  <option value='Normocytic'>Normocytic</option>
                                  <option value='Normochromic'>Normochromic</option>
                                  <option value='Neutropenia'>Neutropenia</option>
                                  <option value='Adequate'>Adequate</option>

                           </select>
                     </div>
                     <div class="form-group">
                         <label  class="">WBC:</label>
                              <select class="form-control" name="wbc2" >

                                       <option value='Normocytic'>Normocytic</option>
                                       <option value='Normochromic'>Normochromic</option>
                                       <option value='Neutropenia'>Neutropenia</option>
                                       <option value='Adequate'>Adequate</option>

                                </select>
                          </div>
                          <div class="form-group">
                              <label  class="">Platelets:</label>
                                   <select class="form-control" name="platelets2" >

                                            <option value='Normocytic'>Normocytic</option>
                                            <option value='Normochromic'>Normochromic</option>
                                            <option value='Neutropenia'>Neutropenia</option>
                                            <option value='Adequate'>Adequate</option>

                                     </select>
                               </div>






						 <div class="form-group"><label>Comments</label>
						 <input type="textarea" name="comments" placeholder="Any other notes" class="form-control"></div>
						 <div>
						 <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>SUBMIT</strong></button>

						 </div>
						 {{ Form::close() }}
						 </div>
						 </div>
                  </div>
