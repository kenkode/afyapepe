<?php
$doc = (new \App\Http\Controllers\DoctorController);
$Docdatas = $doc->DocDetails();
foreach($Docdatas as $Docdata){


$Did = $Docdata->id;
$Name = $Docdata->name;
$Address = $Docdata->address;
$RegNo = $Docdata->regno;
$RegDate = $Docdata->regdate;
$Speciality = $Docdata->speciality;
$Sub_Speciality = $Docdata->subspeciality;


}


      foreach ($patientD as $pdetails) {
        // $patientid = $pdetails->pat_id;
        //  $facilty = $pdetails->FacilityName;
         $stat= $pdetails->status;
         $afyauserId= $pdetails->afya_user_id;
          $dependantId= $pdetails->persontreated;
          $app_id_prev= $pdetails->last_app_id;
          $app_id =  $pdetails->id;
          $doc_id= $pdetails->doc_id;
          $fac_id= $pdetails->facility_id;
          $fac_setup= $pdetails->set_up;
          $dependantAge = $pdetails->depdob;
          $AfyaUserAge = $pdetails->dob;
          $condition = $pdetails->condition;
if($app_id_prev){ $app_id2 = $app_id_prev;}else{$app_id2 = $app_id;}
 $now = time(); // or your date as well
 $your_date = strtotime($dependantAge);
 $datediff = $now - $your_date;
 $dependantdays= floor($datediff / (60 * 60 * 24));


 if ($dependantId =='Self') {
            $dob=$AfyaUserAge;
            $gender=$pdetails->gender;
          $firstName = $pdetails->firstname;
          $secondName = $pdetails->secondName;
          $name =$firstName." ".$secondName;
   }

 else {    $dob=$dependantAge;
           $gender=$pdetails->depgender;
           $firstName = $pdetails->dep1name;
           $secondName = $pdetails->dep2name;
           $name =$firstName." ".$secondName;
      }


  $interval = date_diff(date_create(), date_create($dob));
  $age= $interval->format(" %Y Year, %M Months, %d Days Old");


 $appStatue=$stat;
if ($appStatue == 2) {
  $appStatue ='ACTIVE';
} elseif ($stat == 3) {
  $appStatue='Discharged Outpatient';
} elseif ($stat == 4) {
  $appStatue='Admitted';
} elseif ($stat == 5) {
  $appStatue='Refered';
}
elseif ($stat == 6) {
  $appStatue='Discharged Intpatient';
}
elseif ($stat == 7) {
  $appStatue='Waiting Test Result';
}
}
?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
            <h2>{{$name}}</h2>
            <ol class="breadcrumb">
            <li><a>@if($gender==1){{"Male"}}@else{{"Female"}}@endif</a></li>
            <li><a>{{$age}}</a> </li>
            <li>
            <strong> <button type="btn" class="btn btn-primary">{{$appStatue}}</button></strong>
            </li>
            </ol>
            </div>
        <div class="col-lg-6">
          <h2>{{$pdetails->FacilityName}} </h2>
          <ol class="breadcrumb">
          <li class="active"><strong>{{$Name}} </strong></li>
          </ol>
        </div>
        </div>

        <!--tabs Menus-->
        <div class="row border-bottom">
        <nav class="navbar" role="navigation">
          <div class="navbar-collapse " id="navbar">
                <ul class="nav navbar-nav">
                  <li><a role="button" href="{{route('showPatient',$app_id)}}">Today's Triage</a></li>
                  <li><a role="button" href="{{route('patienthistory',$app_id)}}">History</a></li>
                  <li class="active"><a role="button" href="{{route('testes',$app_id)}}">Tests</a></li>
                  <li><a role="button" href="{{route('diagnoses',$app_id)}}">Diagnosis</a></li>
                  <li><a role="button" href="{{route('medicines',$app_id)}}">Prescriptions</a></li>
                  @if ($condition =='Admitted')
                    <li><a role="button" href="{{route('discharge',$app_id)}}">Discharge</a></li>
                   @else
                    <li><a role="button" href="{{route('admit',$app_id)}}">Admit</a></li>@endif
                    <li><a role="button" href="{{route('transfering',$app_id)}}">Referral</a></li>
                   <li><a role="button" href="{{route('endvisit',$app_id)}}">End Visit</a></li>
                 </ul>
             </div>
        </nav>
     </div>

          <div class="row wrapper border-bottom  page-heading">
             <div class="float-e-margins">
               <div class="col-lg-12">
                     <div class="tabs-container">
<div class="row">
    <div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
   <div class="col-lg-6">
  <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-1"><i class="fa fa-database"></i> TEST HISTORY</a>
     </div>
    <div class="col-lg-6">
    <a class="btn btn-primary btn-lg btn-block" data-toggle="tab" href="#tab-2"><i class="fa fa-flask"></i> ADD TEST</a>
    </div>
   </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                      <!--Test result tabs PatientController@testdone-->
                  <?php $i =1;

if ($dependantId =='Self') {
  $tstdone = DB::table('patient_test')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.id')
  ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
  ->select('patient_test_details.id as ptdid','patient_test_details.*','facilities.*','tests.name','diagnoses.name as diagnoses')
 ->where('patient_test_details.afya_user_id', '=',$afyauserId)
  ->orderBy('created_at', 'desc')
  ->get();
}else{
  $tstdone = DB::table('patient_test')
  ->leftJoin('patient_test_details', 'patient_test.id', '=', 'patient_test_details.patient_test_id')
  ->leftJoin('facilities', 'patient_test_details.facility_done', '=', 'facilities.id')
  ->leftJoin('tests', 'patient_test_details.tests_reccommended', '=', 'tests.id')
  ->leftJoin('diagnoses', 'patient_test_details.conditional_diag_id', '=', 'diagnoses.id')
  ->select('patient_test_details.id as ptdid','patient_test_details.*','facilities.*','tests.name','diagnoses.name as diagnoses')
  ->Where('patient_test_details.dependant_id', '=',$dependantId)
  ->orderBy('created_at', 'desc')
  ->get();

}
?>

                      <div class="table-responsive ibox-content">
                       <table class="table table-striped table-bordered table-hover dataTables-conditional" >
                         <thead>
                      <tr>
                       <th></th>
                          <th>Date </th>
                         <th>Test Name</th>
                         <th>Conditional Diagnosis</th>
                         <th>Result</th>
                         <th>Note</th>
                         <th>Action</th>

                    </tr>
                      </thead>

                      <tbody>

                      @foreach($tstdone as $tstdn)
                  <?php    $ptdid =$tstdn->ptdid;
                    $prescs=$tstdn->done;
                    if (is_null($prescs)) {
                      $prescs= 'N/A';
                    }
                    elseif ($prescs==0) {
                      $prescs= 'Pending';
                    } elseif($prescs==1) {
                      $prescs= 'Complete';
                    }
                      ?>
                        <tr>
                        <td>{{ +$i }}</td>
                       <td>{{$tstdn->created_at}}</td>
                       <td>@if($tstdn->name){{$tstdn->name}}
                         @else{{$tstdn->testmore}}
                         @endif
                       </td>
                       <td>{{$tstdn->diagnoses}}</td>
                       <!-- <td>  {{$prescs}}</td> -->
                         <td>{{$tstdn->results}}</td>
                         <td>{{$tstdn->note}}</td>
           @if($tstdn->confirm =='N')
                         @if($tstdn->done =='1')
                        <td>
                           {{ Form::open(array('route' => array('diaconf'),'method'=>'POST')) }}
                             {{ Form::hidden('appointment_id',$app_id, array('class' => 'form-control')) }}
                             {{ Form::hidden('pat_details_id',$ptdid, array('class' => 'form-control')) }}
                             <button class="btn btn-sm btn-primary  m-t-n-xs" type="submit"><strong>Confirm Diagnosis</strong></button>
                            {{ Form::close() }}
                        </td>
                         @else
                         <td>
                           {{ Form::open(['method' => 'DELETE','route' => ['test.deletes', $tstdn->ptdid],'style'=>'display:inline']) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </td>
                          @endif
                    @else
                    <td> Confirmed</td>
                    @endif
                  </tr>
                      <?php $i++; ?>
                  @endforeach
                      </tbody>
                    </table>
                         </div>

                    </div>
                </div>
                <div id="tab-2" class="tab-pane">
                    <div class="panel-body">


                      <div id="othertest" class="ibox float-e-margins">

                      <label class="col-md-2">Test Categories:</label>
                      <input type="checkbox" name="colorCheckbox" value="MRI">Imaging
                      <input type="checkbox" name="colorCheckbox" value="Lab"> Laboratory
                      <input type="checkbox" name="colorCheckbox" value="Neurology"> Neurology
                      <input type="checkbox" name="colorCheckbox" value="Gestrointestinal"> Gestrointestinal

                      <div class="MRI box">
                        @include('doctor.imagingtest')
                      </div>
                      <!-- Laboratory Tests starts}} -->

<div class="Lab box">
  <div class="col-lg-12">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-8"> Conditional Diagnosis</a></li>
            <li class=""><a data-toggle="tab" href="#tab-80">Common Tests</a></li>
            <li class=""><a data-toggle="tab" href="#tab-81">Biochemistry</a></li>
            <li class=""><a data-toggle="tab" href="#tab-82">Other Tests</a></li>
        </ul>
<div class="tab-content">
    <div id="tab-8" class="tab-pane active">
        <div class="panel-body">
          {{ Form::open(array('route' => array('testsave'),'method'=>'POST')) }}
  <div class="col-sm-6 b-r">
            <?php  if ($dependantdays <='28') {
            ?>
            <div class="form-group">
            <label for="tag_list" class="">Conditional Diagnosis:</label>
            <select class="test-multiple" name="mainconditional"  style="width: 100%">
            <?php $diagnoses=DB::table('diagnoses')->where(function($query)
            { $query->where('target', '=','28 ')
            ->orWhere('target', '=','28-29');  })
            ->get(); ?>
            <option value=''>Choose one</option>
            @foreach($diagnoses as $diag)
            <option value='{{$diag->id}}'>{{$diag->name}}</option>
            @endforeach </select>
            </div>
            <?php } if ($dependantdays >='28') { ?>
            <div class="form-group">
            <label for="tag_list" class="">Conditional Diagnosis:</label>
            <select class="test-multiple" name="mainconditional"  style="width: 100%">
            <?php $diagnoses=DB::table('diagnoses')->where(function($query)
            {
            $query->where('target', '=','29 ')
            ->orWhere('target', '=','28-29');
            })
            ->get();
            ?>
            @foreach($diagnoses as $diag)
            <option value='{{$diag->id}}'>{{$diag->name}}</option>
            @endforeach
            </select>
            </div>
            <?php }  ?>

            <div class="form-group ">
            <label for="d_list2">Doctor Note(For test):</label>
            <textarea rows="4" name="docnote" cols="50" class="form-control"></textarea>
            </div>
            </div>
            <div class="col-sm-6 ">
            <div class="form-group ">
            <label for="d_list2">Any other Tests:</label>
            <textarea rows="4" name="testmore" cols="50" placeholder="Any other test Not in the List" class="form-control"></textarea>
            </div>
            </div>
            </div>
        </div>

    <div id="tab-80" class="tab-pane">
        <div class="panel-body">
            <div class="col-sm-6 b-r">
              <div class="form-group">
              <label for="tag_list" class="">Common Tests:</label>
              <select class="test-multiple" name="common[]" multiple="multiple" style="width: 100%">
              <?php $common=DB::table('tests')->where('common', '=','Y') ->get(); ?>
              @foreach($common as $cmn)
              <option value='{{$cmn->id}}'>{{$cmn->name}}</option>
              @endforeach
              </select>
              </div>
            </div>
       <div class="col-sm-6 ">
         <div class="form-group">
         <label for="tag_list" class="">Other Lab Tests:</label>
         <select class="test-multiple" name="olab[]" multiple="multiple" style="width: 100%">
         <?php $otherlabt=DB::table('tests')->where('sub_categories_id', '=',24) ->get(); ?>
         @foreach($otherlabt as $olab)
         <option value='{{$olab->id}}'>{{$olab->name}}</option>
         @endforeach
         </select>
         </div>
         <div class="form-group">
         <label for="tag_list" class="">Miscellaneous Tests:</label>
         <select class="test-multiple" name="laneous[]" multiple="multiple" style="width: 100%">
         <?php $laneous=DB::table('tests')->where('sub_categories_id', '=',22) ->get(); ?>
         @foreach($laneous as $linus)
         <option value='{{$linus->id}}'>{{$linus->name}}</option>
         @endforeach
         </select>
         </div>
    </div>
        </div>
    </div>
    <div id="tab-81" class="tab-pane">
      <div class="col-lg-6 b-r">
        <div class="panel-body">
            <div class="form-group">
            <label for="tag_list" class="">Renal Function Tests:</label>
            <select class="test-multiple" name="renal[]" multiple="multiple" style="width: 100%">
            <?php $RFT=DB::table('tests')->where('sub_categories_id', '=',1) ->get(); ?>
            @foreach($RFT as $rfts)
            <option value='{{$rfts->id}}'>{{$rfts->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Liver AND Pancrease Tests:</label>
            <select class="test-multiple" name="liverp[]" multiple="multiple" style="width: 100%">
            <?php $liverp=DB::table('tests')->where('sub_categories_id', '=',2) ->get(); ?>
            @foreach($liverp as $lps)
            <option value='{{$lps->id}}'>{{$lps->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Lipid Profile Tests:</label>
            <select class="test-multiple" name="lipid[]" multiple="multiple" style="width: 100%">
            <?php $lipids=DB::table('tests')->where('sub_categories_id', '=',3) ->get(); ?>
            @foreach($lipids as $lpds)
            <option value='{{$lpds->id}}'>{{$lpds->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Diabetic Tests:</label>
            <select class="test-multiple" name="diabetic[]" multiple="multiple" style="width: 100%">
            <?php $diabetic=DB::table('tests')->where('sub_categories_id', '=',4) ->get(); ?>
            @foreach($diabetic as $diab)
            <option value='{{$diab->id}}'>{{$diab->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Cardiac And Muscle Tests:</label>
            <select class="test-multiple" name="cardiac[]" multiple="multiple" style="width: 100%">
            <?php $cardiac=DB::table('tests')->where('sub_categories_id', '=',5) ->get(); ?>
            @foreach($cardiac as $card)
            <option value='{{$card->id}}'>{{$card->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Bone Profile Tests:</label>
            <select class="test-multiple" name="bone[]" multiple="multiple" style="width: 100%">
            <?php $Bone=DB::table('tests')->where('sub_categories_id', '=',7) ->get(); ?>
            @foreach($Bone as $Bonep)
            <option value='{{$Bonep->id}}'>{{$Bonep->name}}</option>
            @endforeach
            </select>
            </div>
            <div class="form-group">
            <label for="tag_list" class="">Urine Biochemistry Tests:</label>
            <select class="test-multiple" name="urine[]" multiple="multiple" style="width: 100%">
            <?php $urine=DB::table('tests')->where('sub_categories_id', '=',8) ->get(); ?>
            @foreach($urine as $urin)
            <option value='{{$urin->id}}'>{{$urin->name}}</option>
            @endforeach
            </select>
            </div>
         </div>
        </div>
        <div class="col-lg-6 b-r">
          <div class="form-group">
          <label for="tag_list" class="">Stool Analysis Tests:</label>
          <select class="test-multiple" name="stool[]" multiple="multiple" style="width: 100%">
          <?php $stool=DB::table('tests')->where('sub_categories_id', '=',25) ->get(); ?>
          @foreach($stool as $stul)
          <option value='{{$stul->id}}'>{{$stul->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Drugs Of Abuse Tests:</label>
          <select class="test-multiple" name="drugs[]" multiple="multiple" style="width: 100%">
          <?php $drugs=DB::table('tests')->where('sub_categories_id', '=',12) ->get(); ?>
          @foreach($drugs as $abuse)
          <option value='{{$abuse->id}}'>{{$abuse->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Nutrition Tests:</label>
          <select class="test-multiple" name="nutrition[]" multiple="multiple" style="width: 100%">
          <?php $nutrition=DB::table('tests')->where('sub_categories_id', '=',11) ->get(); ?>
          @foreach($nutrition as $nutrt)
          <option value='{{$nutrt->id}}'>{{$nutrt->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Tumour Markers Tests:</label>
          <select class="test-multiple" name="tumour[]" multiple="multiple" style="width: 100%">
          <?php $tumour=DB::table('tests')->where('sub_categories_id', '=',10) ->get(); ?>
          @foreach($tumour as $tm)
          <option value='{{$tm->id}}'>{{$tm->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Endocrinology Tests:</label>
          <select class="test-multiple" name="endo[]" multiple="multiple" style="width: 100%">
          <?php $endo=DB::table('tests')->where('sub_categories_id', '=',9) ->get(); ?>
          @foreach($endo as $endoc)
          <option value='{{$endoc->id}}'>{{$endoc->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Other Chemistry:</label>
          <select class="test-multiple" name="others[]" multiple="multiple" style="width: 100%">
          <?php $others=DB::table('tests')->where('sub_categories_id', '=',6) ->get(); ?>
          @foreach($others as $other)
          <option value='{{$other->id}}'>{{$other->name}}</option>
          @endforeach
          </select>
          </div>

        </div>
    </div>
    <div id="tab-82" class="tab-pane">
        <div class="panel-body">
            <div class="col-sm-6 b-r">

    <div class="ibox float-e-margins">
          <h5>Haematology Test </h5>
     <div class="ibox-content">
        <div class="row">
          <div class="form-group">
          <label for="tag_list" class="">Haematology:</label>
          <select class="test-multiple" name="haema[]" multiple="multiple" style="width: 100%">
          <?php $haema=DB::table('tests')->where('sub_categories_id', '=',14) ->get(); ?>
          @foreach($haema as $haem)
          <option value='{{$haem->id}}'>{{$haem->name}}</option>
          @endforeach
          </select>
          </div>
          <div class="form-group">
          <label for="tag_list" class="">Serology:</label>
          <select class="test-multiple" name="serology[]" multiple="multiple" style="width: 100%">
          <?php $serology=DB::table('tests')->where('sub_categories_id', '=',18) ->get(); ?>
          @foreach($serology as $sero)
          <option value='{{$sero->id}}'>{{$sero->name}}</option>
          @endforeach
          </select>
          </div>

        </div>
    </div>
  </div>
  <div class="ibox float-e-margins">
        <h5>Microbiology</h5>
   <div class="ibox-content">
      <div class="row">
        <div class="form-group">
        <label for="tag_list" class="">Microbiology:</label>
        <select class="test-multiple" name="microbiology[]" multiple="multiple" style="width: 100%">
        <?php $microbiology=DB::table('tests')->where('sub_categories_id', '=',19) ->get(); ?>
        @foreach($microbiology as $micro)
        <option value='{{$micro->id}}'>{{$micro->name}}</option>
        @endforeach
        </select>
        </div>
        <div class="form-group">
        <label for="tag_list" class="">Tuberculosis:</label>
        <select class="test-multiple" name="tb[]" multiple="multiple" style="width: 100%">
        <?php $tbs=DB::table('tests')->where('sub_categories_id', '=',19) ->get(); ?>
        @foreach($tbs as $tb)
        <option value='{{$tb->id}}'>{{$tb->name}}</option>
        @endforeach
        </select>
        </div>

      </div>
  </div>
</div>



</div>
            <div class="col-sm-6 ">
              <div class="ibox float-e-margins">
                    <h5>Immunology </h5>
               <div class="ibox-content">
                  <div class="row">
                    <div class="form-group">
                    <label for="tag_list" class="">Immunology:</label>
                    <select class="test-multiple" name="immuno[]" multiple="multiple" style="width: 100%">
                    <?php $immunology=DB::table('tests')->where('sub_categories_id', '=',16) ->get(); ?>
                    @foreach($immunology as $immuno)
                    <option value='{{$immuno->id}}'>{{$immuno->name}}</option>
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="tag_list" class="">Allergy Test:</label>
                    <select class="test-multiple" name="allergy[]" multiple="multiple" style="width: 100%">
                    <?php $allergy=DB::table('tests')->where('sub_categories_id', '=',13) ->get(); ?>
                    @foreach($allergy as $alleg)
                    <option value='{{$alleg->id}}'>{{$alleg->name}}</option>
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="tag_list" class="">HIV:</label>
                    <select class="test-multiple" name="hiv[]" multiple="multiple" style="width: 100%">
                    <?php $hiv=DB::table('tests')->where('sub_categories_id', '=',17) ->get(); ?>
                    @foreach($hiv as $hv)
                    <option value='{{$hv->id}}'>{{$hv->name}}</option>
                    @endforeach
                    </select>
                    </div>
                  </div>
              </div>
            </div>
            <div class="ibox float-e-margins">
                  <h5>Coagulation</h5>
             <div class="ibox-content">
                <div class="row">
                  <div class="form-group">
                  <label for="tag_list" class="">Coagulation:</label>
                  <select class="test-multiple" name="coagu[]" multiple="multiple" style="width: 100%">
                  <?php $coagulation=DB::table('tests')->where('sub_categories_id', '=',19) ->get(); ?>
                  @foreach($tbs as $coagu)
                  <option value='{{$coagu->id}}'>{{$coagu->name}}</option>
                  @endforeach
                  </select>
                  </div>
                </div>
            </div>
          </div>

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
</div>
                      <!-- Laboratory Tests Ends}} -->
                      <div class="Neurology box">Neurology TESTS COMING SOON</div>
                      <div class="Gestrointestinal box">Gestrointestinal TESTS COMING SOON</div>


                      </div>


                    </div>
                </div>
            </div>


        </div>
    </div>
  </div>
</div>

      </div><!-- col md 12" -->
   </div><!-- emargis" -->
   </div>
