</div>
</div>
</div>
<div class="clearfix"></div>
	
	<footer>

		

	</footer>
	
	<!-- start: JavaScript-->
		<script type="text/javascript" src="<?php echo url("/"); ?>/assets/js/jquery.js"></script>
		<!--<script src="utils/js/jquery.min.js"></script>-->
		<!--<script type="text/javascript" src="utils/js/jquery-1.4.2.min.js"></script>-->
		<!--<script type="text/javascript" src="utils/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="utils/js/jquery-1.9.1.min.js"></script>-->
			
	
		<script type="text/javascript" src="<?php echo url("/"); ?>/assets/js/bootstrap.min.js"></script>
		<script src="utils/js/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo url("/"); ?>/assets/js/jquery-ui.min.js"></script>

	
		<script type="text/javascript" src="<?php echo url("/"); ?>/assets/js/jquery-migrate-1.0.0.min.js"></script>	
		<script src='<?php echo url("/"); ?>/assets/js/jquery.dataTables.min.js'></script>
		
		<script src='<?php echo url("/"); ?>/assets/Chart.js-master/src/moment.min.js'></script>
		<!--<script src='utils/Chart.js-master/src/chart.js'></script>-->
		<script src="<?php echo url("/"); ?>/assets/Chart.js-master/src/Chart.bundle.min.js"></script>
		<script src='user/graphs.js'></script>
        
		<!--<script src="utils/js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="utils/js/jquery.ui.touch-punch.js"></script>
		<script src="utils/js/modernizr.js"></script>
		<script src="utils/js/jquery.cookie.js"></script>-->
		
		<!--<script src='utils/js/fullcalendar.min.js'></script>
		
		<!--<script src="utils/js/excanvas.js"></script>
		<script src="utils/js/jquery.flot.js"></script>
		<script src="utils/js/jquery.flot.pie.js"></script>
		<script src="utils/js/jquery.flot.stack.js"></script>
		<script src="utils/js/jquery.flot.resize.min.js"></script>-->
		<!--<script src="utils/js/jquery.chosen.min.js"></script>
		<script src="utils/js/jquery.uniform.min.js"></script>	
		<script src="utils/js/jquery.cleditor.min.js"></script>
		<script src="utils/js/jquery.noty.js"></script>
		<script src="utils/js/jquery.elfinder.min.js"></script>
		<script src="utils/js/jquery.raty.min.js"></script>
		<!--<script src="utils/js/jquery.iphone.toggle.js"></script>
	
		<script src="utils/js/jquery.uploadify-3.1.min.js"></script><!--
	
		<script src="utils/js/jquery.gritter.min.js"></script>
	
		<script src="utils/js/jquery.imagesloaded.js"></script>
	
		<script src="utils/js/jquery.masonry.min.js"></script>
	
		<script src="utils/js/jquery.knob.modified.js"></script>
	
		<script src="utils/js/jquery.sparkline.min.js"></script>-->
		
		<!--<script src="utils/js/counter.js"></script>-->
	
		<!--<script src="utils/js/retina.js"></script>-->

		<!--<script src="utils/js/custom.js"></script>-->
		
		<script class="include" type="text/javascript" src="<?php echo url("/"); ?>/assets/live_ajax/assets/js/jquery.dcjqaccordion.2.7.js"></script>
		<script type="text/javascript" src="<?php echo url("/"); ?>/assets/live_ajax/scripts/triggers.js"></script>
<script type="text/javascript">
$(function () {
    $('table').on('click', 'tr btn', function (e) {
         e.preventDefault();
         $(this).parents('tr').remove();
   });
    
	
	$("#resultTable").on('click','td button',function() {	
	var row;
	row = $(this).closest('tr').find('td:nth-child(1)').text();

	var url="doctor/insert_drug.php?id="+row;
	
	$.getJSON(url,function(data){
	
	$.each(data.drug, function(i,drug){ 
	
    var newRow = "<tr>"
	+"<td><input type='text' name='d_id[]' value="+drug.id+" style='width:30px' readonly></td>"
	+"<td><input type='text' name='d_name[]' value="+drug.drugname+" style='width:150px' readonly></td>"
	+"<td><input type='text' name='d_form[]' value="+drug.dosageform+" style='width:150px' readonly></td>"
	+"<td><input type='text' nme='d_ing[]' value="+drug.ingredients+" style='width:150px' readonly></td>"
	+"<td><input type='text' name='d_man[]' value="+drug.manufacturer+" style='width:150px' readonly></td>"
	+"<td><select type='text' name='d_dose[]' style='width:100px'><option value='quater'>1/4 dose</option><option value='half'>Half dose</option><option value='three-quaters'>3/4 dose</option><option value='full'>Full dose</option></select></td>"
	+"<td><btn ><buton class='btn btn-default' >Delete</buton></btn></td>"
	+"</tr>" ;	
	$("#mans tbody").append(newRow);	
	});
});	
});
});
	
</script>
<script type="text/javascript">
 $(function () {
    	$('table').on('click', 'tr btn1', function (e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    });
    
	
	$("#testTable").on('click','td button',function() {	
	var row;
	row = $("select[name=new_select]").val();

	var url="doctor/insert_test.php?id="+row;
		
	var note = $("input[name=test_note]").val();
		
	$.getJSON(url,function(data){
	$.each(data.test, function(i,test){ 
	
    var newRow = "<tr>"
	+"<td><input type='text' name='d_id[]' value="+test.id+" style='width:30px' readonly></td>"
	+"<td><input type='text' name='d_name[]' value="+test.Name+" style='width:150px' readonly></td>"
	+"<td><input type='text' name='d_test_name[]' value="+test.test_name+" style='width:150px' readonly></td>"
	+"<td><input type='text' name='d_notes[]' value="+note+" style='width:150px' readonly></td>"
	+"<td><btn1><buton class='btn btn-default' >Delete</buton></btn1></td>"
	+"</tr>" ;	
	$("#test tbody").append(newRow);	
		
});	
});
});
});		
</script>
	
</body>
</html>
