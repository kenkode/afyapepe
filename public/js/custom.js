// show radio divs
$(document).ready(function () {
  $('#div1').hide();
  $('#div2').hide();
                   $('#id_radio1').click(function () {
                       $('#div1').show('fast');
               });
               $('#id_radio2').click(function () {
                     $('#div1').hide();

                });
              });


$(document).ready(function(){
 $('input[type="checkbox"]').click(function(){
       var inputValue = $(this).attr("value");

       $("." + inputValue).toggle();

   });

});
$(document).ready(function(){
 $('input[name="checkbox"]').click(function(){
       var inputValue = $(this).attr("value");

       $("." + inputValue).toggle();

   });

});


$(".test-multiple").select2();
