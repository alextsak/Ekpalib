/*
 * 
 * This script include's functions for the login_signup.php page
 * */

$(document).ready(function(){
	init();
});


function init(){
	
	$('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	
	
	$("a.my-tool-tip").tooltip();
	$("#sign-up-confirm-password").keyup(checkPasswordMatch);
	
	$('#register-submit').click(function(e) {
		
		if($('#sign-up-username').val().length === 0 || $('#sign-up-password').val().length === 0 || $('#sign-up-email').val().length === 0 || $('#sign-up-academic-id').val().length === 0 || $('#sign-up-academic-pass').val().length === 0)
		{
			//if there is a missing field prevent the form from submitting
			e.preventDefault(); //prevent the default action
			$('#empty-fields').empty();
			$('#empty-fields').html('Παρακαλώ συμπληρώστε όλα τα απαιτούμενα πεδία');
			
		}
		else {
			// let the form submit 
		}

	});
	
}


function checkPasswordMatch() {
	/*
	 * Validates passwords on the fly
	 * */
	
    var password = $("#sign-up-password").val();
    var confirmPassword = $("#sign-up-confirm-password").val();
    
    if (password != confirmPassword){
    	$("#divCheckPasswordMatch").html("Passwords do not match!");
    }
    else {
    	$("#divCheckPasswordMatch").html("Passwords match");	
    }
        
}
