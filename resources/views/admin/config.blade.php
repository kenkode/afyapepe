
@extends('layouts.admin')

@section('content')
<div class="content-page  equal-height">
          <div class="content">
              <div class="container">
  <div class="row">
   <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              <h3>Basic Settings</h3>
                          </header>
                          <ul class="list-group">
                              <li class="list-group-item"><a href="{{ url('kins') }}">KINS</a></li>
                              <li class="list-group-item"><a href="{{ url('facility') }}">FACILITIES</a></li>
                              <li class="list-group-item"><a href="{{ url('county') }}">COUNTY</a></li>
                              <li class="list-group-item"><a href="{{ url('constituency') }}">CONSTITUENCIES</a></li>
                              


                          </ul>
                      </section>
                  </div>
                  <div class="col-lg-6">
                      <section class="panel">
                          <header class="panel-heading">
                              <h3>Medical Settings</h3>
                          </header>
                          <div class="list-group">
                              <a class="list-group-item " href="#">
                                  Allergies
                              </a>
                              <a class="list-group-item " href="javascript:;">Illnesses</a>
                              <a class="list-group-item" href="javascript:;">Diseases</a>
                              <a class="list-group-item" href="javascript:;">Chronic illnesses</a>
                              <a class="list-group-item" href="javascript:;">Vaccines</a>
                              <a class="list-group-item" href="javascript:;">diagnosis</a>
                          </div>
                      </section>
                  </div>




</div>
                   </div><!--container-->
                </div><!--content -->
            </div><!--content page-->
@endsection
