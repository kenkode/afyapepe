
@extends('layouts.app')
@section('content')

      <div class="row">
        <div class="col-lg-6 col-md-offset-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Next of Kin</h5>
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

     <form class="form-horizontal" role="form" method="POST" action="/nextkin" novalidate>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$id}}" name="id"  required>

    <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Next Kin Name" name="name"  required>
    </div>

    <div class="form-group">
     <label for="exampleInputPassword1">Relationship</label>
    <select class="form-control" name="relationship">
    <?php  $kin = DB::table('kin')->get();?>
                  @foreach($kin as $kn)
                   <option value="{{$kn->id}}">{{$kn->relation}}</option>
                 @endforeach
                </select>
    </div>
     <div class="form-group">
    <label for="exampleInputPassword1">Phone</label>
    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Next of Kin Phone" name="phone"  required>
    </div>
   <button type="submit" class="btn btn-primary">Save</button>
      {!! Form::close() !!}

</div>


         </div>


</div>
</div>

@endsection
