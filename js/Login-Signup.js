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
	
	/*$("#register-submit").on("click",function(event){
    	event.preventDefault();
    	var input = {};
    	
    	var password = $("#sign-up-password").val();
    	var verifiedPassword = $("#sign-up-confirm-password").val();
    	
    	if(verifiedPassword != password){
    		alert("Password is not verified!");
    	}
    });	*/
	
}
