<!-- Imaging Tests starts}} -->
<div class="col-lg-12">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-90">X-RAY</a></li>
            <li class=""><a data-toggle="tab" href="#tab-91">CT SCAN</a></li>
            <li class=""><a data-toggle="tab" href="#tab-92">MRI</a></li>
            <li class=""><a data-toggle="tab" href="#tab-93">ULTRASOUND</a></li>
        </ul>
<div class="tab-content">
    <div id="tab-90" class="tab-pane active">
        <div class="panel-body">
          {{ Form::open(array('route' => array('testsave'),'method'=>'POST')) }}
            <div class="col-sm-6 b-r">
              XRAY  pokit
            </div>

            <div class="col-sm-6 ">
              XRAYBeeeeee
            </div>
    </div>
</div>

  <div id="tab-91" class="tab-pane">
        <div class="panel-body">
          <div class="col-sm-6 b-r">
              CT-SCAN Aaaaaaabb
          </div>
       <div class="col-sm-6 ">
        CT-SCAN bbbbbbb
       </div>
    </div>
</div>

    <div id="tab-92" class="tab-pane">
        <div class="panel-body">
            <div class="col-sm-6 b-r">
              MRI  aaaaaaaaaaaaaaaaaaa
            </div>
        <div class="col-sm-6 ">
            MRI BBBBBBBBBBBBBBBBB
        </div>
      </div>
  </div>

  <div id="tab-93" class="tab-pane">
      <div class="panel-body">
          <div class="col-sm-6 b-r">
            uLTRASOUND  aaaaaaaaaaaaaaaaaaa
          </div>
      <div class="col-sm-6 ">
          uLTRASOUND  BBBBBBBBBBBBBBBBB
      </div>
    </div>
</div>


    {{ Form::hidden('afya_user_id',$afyauserId, array('class' => 'form-control')) }}
    {{ Form::hidden('dependant_id',$dependantId, array('class' => 'form-control')) }}

    {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
    {{ Form::hidden('doc_id',$doc_id, array('class' => 'form-control')) }}
    {{ Form::hidden('facility_from',$fac_id, array('class' => 'form-control')) }}

    <button class=" mtop btn btn-sm btn-primary pull-left m-t-n-xs" type="submit"><strong>Submit</strong></button>

    {{ Form::close() }}
          </div>


      </div>
   </div>
<!-- Imaging Tests Ends}} -->
