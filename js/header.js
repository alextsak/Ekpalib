/**
 * Header functions, messages in particular
 */
$(document).ready(function(){
	
	$('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
		effect: 'fade',
        testMode: true,
        onChange: function(evt){
            
        }
	});
	

});

function error_messages(message){
	//console.log(message);
	var data = {"message" : message};
	jQuery.ajax({
		url : "/Ekpalib/includes/error.php",
		method: "post",
		data : data,
		success : function(data){
			jQuery('body').append(data);
			jQuery('#error-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}


function success_messages(message){
	//console.log(message);
	var data = {"message" : message};
	jQuery.ajax({
		url : "/Ekpalib/includes/success.php",
		method: "post",
		data : data,
		success : function(data){
			jQuery('body').append(data);
			jQuery('#success-modal').modal('toggle');
			},
		error : function(){
		alert("Something went wrong");
			}

		});
}


function cleanCart(){
	/*
	 * Removes every item from the cart
	 * */
	var data = {"action" : "removeAll"};
	jQuery.ajax({
		url : window.location.href,
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


