<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Afyapepe- @yield('title') </title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{asset('select/select2.min.css') }}" />

    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" /> -->
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{asset('css/plugins/dataTables/datatables.min.css') }}" />

    <link rel="stylesheet" href="{{asset('css/animate.css') }}" />
    <link rel="stylesheet" href="{{asset('css/style.css') }}" />
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
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

<!-- Custom and plugin javascript -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('select/select2.min.js') }}" type="text/javascript"></script>
   <!-- Custom and plugin javascript -->
  <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>

   <script>
       $('#tag_list').select2({
           placeholder: "Choose tags...",
           minimumInputLength: 2,
           ajax: {
               url: '/tags/find',
               dataType: 'json',
               data: function (params) {
                   return {
                       q: $.trim(params.term)
                   };
               },
               processResults: function (data) {
                   return {
                       results: data
                   };
               },
               cache: true
           }
       });

       $('#d_list2').select2({
           placeholder: "Choose tags...",
           minimumInputLength: 2,
           ajax: {
               url: '/disis/find',
               dataType: 'json',
               data: function (params) {
                   return {
                       q: $.trim(params.term)
                   };
               },
               processResults: function (data) {
                   return {
                       results: data
                   };
               },
               cache: true
           }
       });
   </script>
   <script>
       $(document).ready(function(){
           $('.dataTables-conditional').DataTable({
               pageLength: 5,
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
