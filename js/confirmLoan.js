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

function loan_request(idArray, user){
	
	var data = {"id" : idArray, "user" : user};
	jQuery.ajax({
		url : "/Ekpalib/inc/loan_request.php",
		method: "post",
		data : data,
		success : function(data){
			jQuery('body').append(data);
			jQuery('#success-loan-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}