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
  <!-- <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script> -->
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

  <script src="{{ asset('select/select2.min.js') }}" type="text/javascript"></script>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


  <!-- Typehead -->
  <script src="{{ asset('js/plugins/typehead/bootstrap3-typeahead.min.js') }}"></script>
<?php
$drugs = DB::table('druglists')->distinct(['drugname'])->get();
 ?>
  <script>
     $(document).ready(function(){

       $('.typeahead_1').typeahead({
               source: <?php echo json_encode($drugs); ?>
           });

         $.get('js/api/typehead_collection.json', function(data){
             $(".typeahead_2").typeahead({ source:data.countries });
         },'json');

         $('.typeahead_3').typeahead({
                source: [
                    {"name": "Afghanistan"},
                    {"name": "Land Islands", "code": "AX", "ccn0": "050"},
                    {"name": "Albania", "code": "AL","ccn0": "060"},
                    {"name": "Algeria", "code": "DZ","ccn0": "070"}
                ]
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

  <script>
        $('.presc1').select2({
            placeholder: "Select prescriptions...",
            minimumInputLength: 2,
            ajax: {
                url: '/tag/drug',
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

    <script type="text/javascript">
    $(document).ready(function(){

      $('.itemName').select2({
        placeholder: 'Select an item',
        ajax: {
          url: '/select2',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.drugname
                    }
                })
            };
          },
          cache: true
        }
      });

      });

</script>

<script>
   $(document).ready(function() {
 $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {

     var data_id = '';
if (typeof $(this).data('id') !== 'undefined') {
        data_id = $(this).data('id');
     }
     $('#edit-content').val(data_id);
   })
 });
 </script>

 <script type="text/javascript" src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
 <script>
 $(function()
 {
 	 $( "#q" ).autocomplete({
 	  source: "{{ url('search/autocomplete') }}",
 	  minLength: 3,
 	  select: function(event, ui) {
 	  	$('#q').val(ui.item.value);
 	  }
 	});
 });
 </script>

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

 <script type="text/javascript">
     var path = "{{ route('autocomplete') }}";
     $('input.typeahead').typeahead({
         source:  function (query, process) {
         return $.get(path, { query: query }, function (data) {
                 return process(data);
             });
         }
     });
 </script>
