@extends('layouts.pharmacy')
@section('title', 'Pharmacy')
@section('content')
<div class="content-page  equal-height">

    <div class="content">
        <div class="container">



          <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-11">
            <div class="ibox float-e-margins">
                <div class="ibox-title">

                    <div class="ibox-tools">

                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">

                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                      <tr>
                          <th>No</th>
                          <th>Patient Name</th>
                          <th>Age</th>
                          <th>Gender</th>
                          <th>Allergies</th>
                          <th>Prescribing Doctor</th>
                          <th>Date of Prescription</th>
                    </tr>
                  </thead>

                          <tbody>
                            <?php $i =1;

                            foreach($results as $result)
                            {
                              $name = $result->firstname.'  '.$result->secondName;
                              $age = $result->age;
                              $gender = $result->gender;

                              if($gender === 1)
                              {
                                $gender = 'Male';
                              }
                              elseif($gender === 2)
                              {
                                $gender = 'Female';
                              }

                              $allergies = $result->allergies;
                              $daktari = $result->name;

                              $presc_date = $result->presc_date;
                              $my_date = strtotime($presc_date);
                              $presc_date = date("Y-m-d",$my_date);

                          ?>
                              <tr>
                                  <td><a href="{{route('pharmacy.show',$result->id)}}">{{$i}}</a></td>
                                  <td><a href="{{route('pharmacy.show',$result->id)}}">{{$name}}</a></td>
                                  <td>{{$age}}</td>
                                  <td><a href="{{route('pharmacy.show',$result->id)}}">{{$gender}}</a></td>
                                  <td>{{$allergies}} </td>
                                  <td>{{$daktari}} </td>
                                  <td>{{$presc_date}}</td>


                              </tr>
                              <?php $i++;
                              }
                               ?>



                           </tbody>

                         </table>
                      </div>

                           </div>
                       </div>
                   </div>
                   </div>

               </div>



                       </div>

@endsection
