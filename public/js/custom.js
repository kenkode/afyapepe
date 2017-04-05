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

// show checkbox divs
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

// select test
$(".test-multiple").select2();
<<<<<<< Updated upstream
=======
// show Modal test
>>>>>>> Stashed changes
