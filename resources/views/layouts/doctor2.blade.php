<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Afyapepe- @yield('title') </title>


    <link rel="stylesheet" href="{{asset('css/plugins/toastr/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{asset('js/plugins/gritter/jquery.gritter.css') }}" />
    <link rel="stylesheet" href="{{asset('css/vendor.css') }}" />
    <link rel="stylesheet" href="{{asset('css/app.css') }}" />

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{asset('css/plugins/dataTables/datatables.min.css') }}" />
    <link rel="stylesheet" href="{{asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{asset('css/style.css') }}" />

    <link rel="stylesheet" href="{{asset('css/plugins/iCheck/custom.css') }}" />
     <link rel="stylesheet" href="{{asset('css/plugins/steps/jquery.steps.css') }}" />



</head>

<body>
    <div id="wrapper">
      @include('includes.doc_inc.leftmenu')

        <div id="page-wrapper" class="gray-bg dashbard-1">

    @include('includes.doc_inc.headbar')
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
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>
  <!-- Flot -->
    <script src="{{ asset('js/plugins/flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}" type="text/javascript"></script>


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


    <!-- Toastr -->
    <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>

    <!-- Steps -->

  <script src="{{ asset('js/plugins/steps/jquery.steps.min.js') }}" type="text/javascript"></script>
        <!-- Jquery Validate -->

  <script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}" type="text/javascript"></script>

        <script>
            $(document).ready(function(){
                $("#wizard").steps();
                $("#form").steps({
                    bodyTag: "fieldset",
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        // Always allow going backward even if the current step contains invalid fields!
                        if (currentIndex > newIndex)
                        {
                            return true;
                        }

                        // Forbid suppressing "Warning" step if the user is to young
                        if (newIndex === 3 && Number($("#age").val()) < 18)
                        {
                            return false;
                        }

                        var form = $(this);

                        // Clean up if user went backward before
                        if (currentIndex < newIndex)
                        {
                            // To remove error styles
                            $(".body:eq(" + newIndex + ") label.error", form).remove();
                            $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                        }

                        // Disable validation on fields that are disabled or hidden.
                        form.validate().settings.ignore = ":disabled,:hidden";

                        // Start validation; Prevent going forward if false
                        return form.valid();
                    },
                    onStepChanged: function (event, currentIndex, priorIndex)
                    {
                        // Suppress (skip) "Warning" step if the user is old enough.
                        if (currentIndex === 2 && Number($("#age").val()) >= 18)
                        {
                            $(this).steps("next");
                        }

                        // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                        if (currentIndex === 2 && priorIndex === 3)
                        {
                            $(this).steps("previous");
                        }
                    },
                    onFinishing: function (event, currentIndex)
                    {
                        var form = $(this);

                        // Disable validation on fields that are disabled.
                        // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                        form.validate().settings.ignore = ":disabled";

                        // Start validation; Prevent form submission if false
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex)
                    {
                        var form = $(this);

                        // Submit form input
                        form.submit();
                    }
                }).validate({
                            errorPlacement: function (error, element)
                            {
                                element.before(error);
                            },
                            rules: {
                                confirm: {
                                    equalTo: "#password"
                                }
                            }
                        });
           });
        </script>







    <!-- Page-Level Scripts -->
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

        });

    </script>
</body>
</html>
