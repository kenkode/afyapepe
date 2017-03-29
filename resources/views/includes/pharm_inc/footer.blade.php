<div class="footer">

    <div class="pull-right">
        Afyapepe <strong>Health</strong> Platform.
    </div>
    <div>
        <strong>Copyright</strong> afyapepe.co.ke &copy; 2016-2017
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
