@extends('layouts.patient')
@section('title', 'Patient')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">

  <div class="row">
    <div class="col-lg-6">
      <div class="ibox float-e-margins">
            <form class="form-horizontal">

           <h4>Basic Info</h4>
              <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="kin_name"  readonly="">
              </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Date of Birth:</label>
              <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="relation"
                readonly="">
              </div>

              <div class="form-group">
              <label for="exampleInputPassword1">Place of Birth:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Constituency of Residence:</label>
              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
            />
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">County of Residence</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              />
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Gender:</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Height: (last reading)</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Weight: (last reading)</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Phone Number:</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Email:</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Personal Physician:</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
              readonly="">
              </div>

                      </div>
    </div>
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
              <form class="form-horizontal">


               <h4>Next of Kin Details</h4>
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="kin_name"  >
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Relationship</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="relation"
                >
                </div>

                <div class="form-group">
                <label for="exampleInputPassword1">Phone</label>
                <input type="number" class="form-control" id="exampleInputPassword1" placeholder="" name="phone"
                >
                </div>
               <input type="submit" class="btn btn-block btn-primary" value="Update Details">.
                        </div>

            </div>
        </div>
</div>
@endsection
