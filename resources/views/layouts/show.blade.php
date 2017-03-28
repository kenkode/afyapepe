<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <title>Afyapepe- @yield('title') </title>

    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{asset('select/select2.min.css') }}" />


    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.js"></script> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css') }}" /> -->
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.css') }}" />
    <link rel="stylesheet" href="{{asset('css/plugins/dataTables/datatables.min.css') }}" />
  <link rel="stylesheet" href="{{asset('css/plugins/datapicker/datepicker3.css') }}" />
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
    <meta name="_token" content="{!! csrf_token() !!}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{asset('js/docajax.js')}}"></script>
    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>

<!-- Custom and plugin javascript -->
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}" type="text/javascript"></script>
   <script src="{{ asset('select/select2.min.js') }}" type="text/javascript"></script>
   <!-- Data picker -->
   <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>

   <!-- Custom and plugin javascript -->
  <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>

  <script>


  $('#data_1 .input-group.date').datepicker({
              todayBtn: "linked",
              keyboardNavigation: false,
              forceParse: false,
              calendarWeeks: true,
              autoclose: true
          });

          $(document).ready(function(){
              $("button").click(function(){
                  $("#testR").toggle();
              });
          });
  </script>
  <script type="text/javascript">
  $.ajaxSetup({
     headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });
  </script>
   <script>
       $('.tag_list1').select2({
           placeholder: "Select test...",
           minimumInputLength: 2,
           ajax: {
               url: '/tags/tst',
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

       $('.d_list2 ').select2({
           placeholder: "Choose disease...",

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
          $('.presc1').select2({
              placeholder: "Select prescriptions...",
              minimumInputLength: 2,
              ajax: {
                  url: '/tags/drugs',
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
            $('.facility1').select2({
                placeholder: "Select facility to .....",
                minimumInputLength: 2,
                ajax: {
                    url: '/tags/fac',
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


       $(document).ready(function(){
           $('.dataTables-main').DataTable({
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
   <script>

$("document").ready(function(){
 $("#ptest").submit(function(e){
 e.preventDefault();
 var conditional = $("input[name=conditional]").val();
 var test = $("select[name=test]").val();
 var patient_id = $("input[name=patient_id]").val();
 var appointment_id = $("input[name=appointment_id]").val();
 var doc_id = $("input[name=doc_id]").val();

 var dataString = 'customer='+customer+'&details='+details;
 $.ajax({
 type: "POST",
 url : "patienttest",
 data : dataString,
 dataType : "json",
 success : function(data){

}

},"json");

});
 });//end of document ready function
 </script>
</body>
</html>
