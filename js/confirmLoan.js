

$(document).ready(function(){
	$('#loan-Button').attr("disabled", true);
	
	$('#terms').click(function() {
		   if($('#terms').is(':checked'))
			   $('#loan-Button').attr("disabled", false);
		   else
			   $('#loan-Button').attr("disabled", true);
	});
	
	

});


function removeMaterial(id){
	var data = {"id_to_remove" : id};
	jQuery.ajax({
		url: window.location.href,
		method: "post",
		data : data,
		success : function(data){
			location.reload(true);
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}

function loan_request(idArray, user){
	
	
	var json_id_array = jQuery.parseJSON(idArray);
	var days_array = [];
	$('#confirmLoan-grid > tbody  > tr').each(function() {
		var spinner = $(this).closest('tr').find('input');
		var current_val = parseInt(($(this).closest('tr').find('input').val()));
		days_array.push(current_val);
		console.log(current_val);
	});

	if(json_id_array == null || user == null){
		alert("a problem occured during loan request");
	}
	
	var data = {"idArray" : json_id_array, "user" : user, "request_days" : days_array};
	jQuery.ajax({
		url : "/Ekpalib/includes/loan_request.php",
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