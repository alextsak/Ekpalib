/**
 * 
 */
$(document).ready(function(){
	
	$('#polyglotLanguageSwitcher').polyglotLanguageSwitcher({
		effect: 'fade',
        testMode: true,
        onChange: function(evt){
            //alert("The selected language is: "+evt.selectedItem);
        }
	});
	

});

function error_messages(message){
	console.log(message);
	var data = {"message" : message};
	jQuery.ajax({
		url : "/Ekpalib/inc/error.php",
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
	console.log(message);
	var data = {"message" : message};
	jQuery.ajax({
		url : "/Ekpalib/inc/success.php",
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


