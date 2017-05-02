// show radio divs
$(document).ready(function () {
  // $('#div1').hide();
  $('#div2').hide();
  $('#othertest').hide();
                   $('#button1').click(function () {
                       $('#div1').toggle('fast');
               });


               $('#button2').click(function () {
                   $('#othertest').toggle('fast');
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

// wizzard for infants
$(document).ready(function(){
    $("#wizard").steps();

});

// Test toogle
$(document).ready(function(){
  $("#divtest").hide();
    $("#addtestes").click(function(){
        $("#divtest").toggle();
    });
});

// diagnoses toogle
$(document).ready(function(){
  $("#confdiag").hide();
    $("#diag").click(function(){
        $("#confdiag").toggle();
    });
});

// diagnoses toogle
$(document).ready(function(){
  $("#supportive").hide();
    $("#diagSC").click(function(){
        $("#supportive").toggle();
    });
});
