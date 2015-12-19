$(document).ready(function(){
	init();
	addListeners();
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
}

function addListeners(){
	
	$("#guest-submit").on("click",function(event){
    	event.preventDefault();
    	
    	var input = {};
    	input.username = "guest";
    	input.password = "guest";
    	
    	//logIn(input);
    });
		
	$("#login-submit").on("click",function(event){
    	event.preventDefault();
    	
    	var input = {};
    	input.username = $("#log-in-username").val();
    	input.password = $("#log-in-password").val();
    	
    	//logIn(input);
    });
	
	$("#register-submit").on("click",function(event){
    	event.preventDefault();
    	var input = {};
    	
    	var password = $("#sign-up-password").val();
    	var verifiedPassword = $("#sign-up-confirm-password").val();
    	
    	input = JSON.stringify({
    		"username": $("#sign-up-username").val(), 
    		"password": $("#sign-up-password").val(), 
    		"firstname": $("#sign-up-firstname").val(),
    		"email": $("#sign-up-email").val(),
    		"lastname": $("#sign-up-lastname").val(),
    		"trn": $("#sign-up-trn").val(),
    		"phonenumber": $("#sign-up-phonenumber").val(),
    		"street": $("#sign-up-street").val(),
    		"city": $("#sign-up-city").val(),
    		"zipcode": $("#sign-up-zipcode").val(),
    		"region": $("#sign-up-region").val()
    		});
    
    	if(verifiedPassword != password){
    		alert("Password is not verified!");
    		input = {};
    	}//else
    		//registerUser(input);
    });	
}

/*****************Server communication*****************/
function registerUser(input){
	$.ajax({
		type : "POST",
		url  : "signup",
		data : {json:input},
		statusCode: {
		    303: function(jqXHR,textStatus,errorThrown ) {
		    	console.log("303 response received . . .");	
				window.location.replace(jqXHR.getResponseHeader("Content-Location"));
		    },
		    404: function(jqXHR,textStatus,errorThrown ) {
		    	console.log("404 response received . . .");
		    	//pop-up window for bad-request 404 or 403
		    	alert("Username already in use!");
		    }
		  },
		dataType:'text'
	});
}

function logIn(input){
	$.ajax({
		type : "GET",
		url  : "login",
		data : input,
		statusCode: {
		    303: function(jqXHR,textStatus,errorThrown ) {
		    	console.log("303 response received . . .");
				window.location.replace(jqXHR.getResponseHeader("Content-Location"));
		    },
		    404: function(jqXHR,textStatus,errorThrown ) {
		    	console.log("404 response received . . .");
		    	alert("Username or Password are incorrent!");
		    	//pop-up window for bad-request 404 or 403
		    }
		  },
		dataType:'text'
	});
}