<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Afyapepe- @yield('title') </title>


    <link rel="stylesheet" href="{!! asset('css/plugins/toastr/toastr.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('js/plugins/gritter/jquery.gritter.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />

    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('font-awesome/css/font-awesome.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/plugins/dataTables/datatables.min.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}" />

<link rel="stylesheet" href="{!! asset('css/plugins/datapicker/datepicker3.css') !!}" />

    <link rel="stylesheet" href="{!! asset('css/style.css') !!}" />

</head>

<body>
    <div id="wrapper">
      @include('includes.manu_inc.leftmenu')

        <div id="page-wrapper" class="gray-bg dashbard-1">

    @include('includes.manu_inc.headbar')
    <!-- Main view  -->
    @yield('content')

        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}" type="text/javascript"></script>

    <!-- Custom and plugin javascript -->
    <!-- <script src="{{ asset('js/inspinia.js') }}" type="text/javascript"></script> -->
    <!-- <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script> -->
  <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/plugins/flot/jquery.flot.time.js') }}"></script>



    <script src="{{ asset('js/demo/flot-demo.js') }}"></script>


    <!-- Peity -->
    <script src="{{ asset('js/plugins/peity/jquery.peity.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/demo/peity-demo.js') }}" type="text/javascript"></script>


    <!-- jQuery UI -->
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <!-- GITTER -->
    <script src="{{ asset('js/plugins/gritter/jquery.gritter.min.js') }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
   <!-- Sparkline demo data  -->
    <script src="{{ asset('js/demo/sparkline-demo.js') }}" type="text/javascript"></script>


    <!-- ChartJS-->
    <script src="{{ asset('js/plugins/chartJs/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/demo/chartjs-demo.js') }}"></script>
    <!-- Data picker -->
   <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

    <!-- Toastr -->
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>

    <!-- Page-Level Scripts -->
    <script>
     $(document).ready(function(){
          $.datepicker.setDefaults({
               dateFormat: 'yy-mm-dd'
          });
          $(function(){
               $("#from_date").datepicker();
               $("#to_date").datepicker();
          });
          $('#filter').click(function(){
               var from_date = $('#from_date').val();
               var to_date = $('#to_date').val();
               if(from_date != '' && to_date != '')
               {
                    $.ajax({
                         url:"customsales.php",
                         method:"POST",
                         data:{from_date:from_date, to_date:to_date},
                         success:function(data)
                         {
                              $('#order_table').html(data);
                         }
                    });
               }
               else
               {
                    alert("Please Select Date");
               }
          });
     });
</script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

            <?php  
           use Carbon\Carbon;
           $Today= Carbon::now();
           $monday = Carbon::now()->startOfWeek();
           $Tuesday= new Carbon('this tuesday');
           $Wednesday=new Carbon('this wednesday');
           $Thursday=new Carbon('this thursday');
           $Friday=new Carbon('this friday');
           $Saturday=new Carbon('this saturday');
           $Sunday=new Carbon('this sunday');
$id=Auth::id();
$manufacturer=DB::table('manufacturers')->where('user_id', Auth::id())->first(); 
            if($manufacturer==''){
                $name = 'name';
            }
            else{
                $name=$manufacturer->name;
            }

            $from = date('Y-m-d' ." ". '08:00:00', time()); $to = date('Y-m-d' ." ". '09:59:59', time());
            $from1 = date('Y-m-d' ." ". '10:00:00', time()); $to1 = date('Y-m-d' ." ". '12:59:59', time());
            $from2 = date('Y-m-d' ." ". '13:00:00', time()); $to2 = date('Y-m-d' ." ". '15:59:59', time());
            $from3 = date('Y-m-d' ." ". '16:00:00', time()); $to3 = date('Y-m-d' ." ". '18:59:59', time());
            $from4 = date('Y-m-d' ." ". '19:00:00', time()); $to4 = date('Y-m-d' ." ". '21:59:59', time());
            $from5 = date('Y-m-d' ." ". '22:00:00', time()); $to5 = date('Y-m-d' ." ". '00:59:59', time());
            $from6 = date('Y-m-d' ." ". '01:00:00', time()); $to6 = date('Y-m-d' ." ". '03:59:59', time());
            $from7 = date('Y-m-d' ." ". '05:00:00', time()); $to7 = date('Y-m-d' ." ". '07:59:59', time());
           
//Today

$d1=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from, $to))->selectRaw('SUM(price * quantity) as total')->whereNull('prescription_filled_status.substitute_presc_id')->first();
        $d2=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from1, $to1))->count();
        $d3=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from2, $to2))->count();
         $d4=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from3, $to3))->count();
          $d5=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from4, $to4))->count();
           $d6=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from5, $to5))->count();
            $d7=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from6, $to6))->count();
             $d8=DB::table('prescription_filled_status')->join('prescription_details','prescription_details.id','=','prescription_filled_status.presc_details_id')->join('druglists','druglists.id','=','prescription_details.drug_id')
                ->where('druglists.Manufacturer','like', '%' .$name . '%')->whereBetween('prescription_filled_status.created_at', array($from7, $to7))->count();

               ?>

    var lineData = {
        labels: ["8-9 am", "10-12 pm", "1-3 pm", "4-6 pm", "7-9 pm", "10-12 am", "1-3 am"
        , "5-7 am"],
        datasets: [

            {
                label: "Today Sales",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d5; ?>, <?php echo $d6; ?>, <?php echo $d7; ?>,<?php echo $d8; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        
         var lineDatas = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
        ],
        datasets: [

            {
                label: "Sales This Week",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d5; ?>, <?php echo $d6; ?>, <?php echo $d7; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineCharts").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatas, options:lineOptions});

  var lineDatam = {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
        datasets: [

            {
                label: "Sales This Month",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChartm").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatam, options:lineOptions});

    var ctx = document.getElementById("lineCharts").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatas, options:lineOptions});

  var lineDatay = {
        labels: ["January", "February", "March", "April"
        , "May", "June", "July", "August", "September", "October", "November","December"],
        datasets: [

            {
                label: "Sales This Year",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineCharty").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatay, options:lineOptions});


     var lineDatap = {
        labels: ["8-9 am", "10-12 pm", "1-3 pm", "4-6 pm", "7-9 pm", "10-12 am", "1-3 am"
        , "5-7 am"],
        datasets: [

            {
                label: "Today Prescription",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d5; ?>, <?php echo $d6; ?>, <?php echo $d7; ?>,<?php echo $d8; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChartp").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatap, options:lineOptions});

        
         var lineDatasp = {
        labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"
        ],
        datasets: [

            {
                label: "Prescription This Week",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d5; ?>, <?php echo $d6; ?>, <?php echo $d7; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChartsp").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatasp, options:lineOptions});

  var lineDatamp = {
        labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
        datasets: [

            {
                label: "Prescription This Month",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChartmp").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatamp, options:lineOptions});

    

  var lineDatayp = {
        labels: ["January", "February", "March", "April"
        , "May", "June", "July", "August", "September", "October", "November","December"],
        datasets: [

            {
                label: "Prescription This Year",
                backgroundColor: 'rgba(26,179,148,0.5)',
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php echo $d1->total; ?>,<?php echo $d2; ?>,<?php echo $d3; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>,<?php echo $d4; ?>]
            }
        ]
    };

    var lineOptions = {
        responsive: true
    };


    var ctx = document.getElementById("lineChartyp").getContext("2d");
    new Chart(ctx, {type: 'line', data: lineDatayp, options:lineOptions});


        });

    </script>
</body>
</html>
