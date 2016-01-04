/**
 * 
 */

$(document).ready(function(){
	$('#loan-Button').attr("disabled", true);
	
	$('#terms').click(function() {
		   if($('#terms').is(':checked'))
			   $('#loan-Button').attr("disabled", false);
		   else
			   $('#loan-Button').attr("disabled", true);
	});

});