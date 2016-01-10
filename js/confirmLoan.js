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
	
	
	var json_id_array = jQuery.parseJSON(idArray);
	
	
	if(json_id_array == null || user == null){
		alert("NUUUUULLLL");
	}else {
		console.log("confirm loan send: " + json_id_array + " and " + user);
	}
	
	var data = {"idArray" : json_id_array, "user" : user};
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