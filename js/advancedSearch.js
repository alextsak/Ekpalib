$(document).ready(function(){
	$("#books").change(function() {
	    if(this.checked) {
	        // create an ajax
	    	
	    	$.ajax({
	    		url: '',
	    		type: 'POST',
	    		data: {choice : 'books'},
	    		success: function(data){
	    			$('#options').html(data);
	    		},
	    		error: function(){alert("Something went wrong with material_categories");}
	    		
	    	});
	    }
	});
	
});