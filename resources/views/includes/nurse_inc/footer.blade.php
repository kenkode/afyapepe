<div class="footer">
            <span>Copyright &copy; 2016. Prioritymobile.co.ke.by MOKETCH</span>
        </div>
        <!-- Plugins  -->
  <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.slimscroll.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/metisMenu.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/moment.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.sparkline.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.time.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.tooltip.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.resize.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.pie.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.selection.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.stack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/jquery.flot.crosshair.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/raphael-2.1.0.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/morris.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/Chart.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/core.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/mediaquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/equalize.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>
  <script type="text/javascript" src="{{ asset('') }}"></script>

 <script type="text/javascript">
        $(document).ready(function(){
        $('.multi-field-wrapper').each(function() {
            var $wrapper = $('.multi-fields', this);
            
            $(".add-field", $(this)).click(function(e) {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            
                            
            });
            $('.multi-field .remove-field', $wrapper).click(function() {
                if ($('.multi-field', $wrapper).length > 1)
                    $(this).parent('.multi-field').remove();
            });
        });
        });
        </script>

    

<script type="text/javascript">
    $(document).ready(function(){
          $("#embedcode").hide();
          $("input[name='type']").change(function () {
               if($(this).val() == "yes")
                    $("#embedcode").show();
               else
                    $("#embedcode").hide();
          });
    });
</script>




       