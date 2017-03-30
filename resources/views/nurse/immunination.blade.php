@extends('layouts.app')
@section('content')
  <div class="row">
    <div class="col-lg-6 col-md-offset-2">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Immunization Details</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
<div class="ibox-content">


    <div class="multi-fields">
      <form class="form" role="form" method="POST" action="/immunization" novalidate>
     <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>
         <?php  $vaccines=DB::table('vaccine')->leftjoin('dependant_vaccination','dependant_vaccination.vaccine_id','=','vaccine.id')->select('vaccine.*','dependant_vaccination.*')
                                                         ->where('vaccine.age','=>',$length)->get(); ?>
                                                        @foreach($vaccines as $vaccine)

                                                        @endforeach
      
     <button type="submit" class="btn btn-primary">Process Immunization Chart</button>
      {!! Form::close() !!}
               </div>  <!-- /.form-group -->

              </div>
              </div>
    </div>
    </div>
 </div>
</div>
@endsection
