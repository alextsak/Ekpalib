$(document).ready(function(){
	
	if($('#all').prop('checked')){
		
		$.ajax({
    		url: '/Ekpalib/inc/material_categories.php',
    		type: 'POST',
    		data: {material : 'all'},
    		success: function(data){
    			$('#options').html(data);
    		},
    		error: function(){alert("Something went wrong with material_categories");}
    		
    	});
	}
	
	$("#books").change(function() {
	    if(this.checked) {
	       //disable all checkbox
	    	$("#all").prop('checked', false);
	    	 // create an ajax
	    	$.ajax({
	    		url: '/Ekpalib/inc/material_categories.php',
	    		type: 'POST',
	    		data: {material : 'books'},
	    		success: function(data){
	    			$('#options').html(data);
	    		},
	    		error: function(){alert("Something went wrong with material_categories");}
	    		
	    	});
	    }
	});
	
});