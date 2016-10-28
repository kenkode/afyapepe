

      <div id="tab-3" class="tab-pane">
          <div class="panel-body">
              <strong>Tests</strong>

              <?php
            $tst= (new \App\Http\Controllers\TestController);
            $tests = $tst->TestList();
            foreach($tests as $test){
           	$tname = $test->name;
          }
            ?>
          <select name="parentProj">
              @foreach($tests as $test)
               <option value="{{ $test->id }}"><?php echo $tname; ?></option>
              @endforeach
          </select>
          {!! Form::open(array('route' => 'doctor.store','method'=>'POST')) !!}
     <tr>
       <div class="col-xs-12 col-sm-12 col-md-12">
       <div class="form-group">
      <td> <strong>Doctor's Notes:</strong></td>
         <td>{!! Form::textarea('facility', null, array('placeholder' => 'facility','class' => 'form-control')) !!}  </td>
       </div>
       </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <td/><button type="submit" class="btn btn-primary">Submit</button>  </td>
        </div>
      </tr>
        {!! Form::close() !!}
            <p>  that I neglect my talents. I should be incapable of d
              rawing a single stroke at the present moment; and yet.</p>
          </div>
      </div>
