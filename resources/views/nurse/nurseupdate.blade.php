
@extends('layouts.app')
@section('content')

      <div class="row">
        <div class="col-lg-6 col-md-offset-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Update Patients Details</h5>
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

     <form class="form-horizontal" role="form" method="POST" action="/nurseupdates" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>

    
    <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone"  required>
    </div>

    <div class="form-group">
     <label for="exampleInputPassword1">Constituency</label>
    <select class="form-control" name="constituency">
    <?php  $kin = DB::table('constituency')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->const_id}}">{{$kn->Constituency}}</option>
                 @endforeach
                </select>
    </div>

   <button type="submit" class="btn btn-primary btn-sm">Update Details</button>
      {!! Form::close() !!}

</div>


         </div>


</div>
</div>

@endsection
