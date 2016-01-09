$(document).ready(function(){
	
	$('#radioButton-From input').on('change', function() {
		   var id = $('input[name=radio]:checked', '#radioButton-From').val();
		   $.ajax({
	    		url: '/Ekpalib/inc/material_categories.php',
	    		type: 'POST',
	    		data: {material : id},
	    		dataType: 'json',
	    		success: function(data){
	    			$('#options').empty();
	    			console.log(data);
	    			var datalength = data.length;
	    			for (var i = 0; i < datalength; i++) {
	    				var option = '<option>'+data[i].Category+'</option>';
	    				$('#options').append(option);
	    			}
	    		},
	    		error: function(data){ console.log(data) ;alert("Something went wrong with material_categories");}
	    		
	    	});
		});
	
	if($('#all').prop('checked')){
		$.ajax({
    		url: '/Ekpalib/inc/material_categories.php',
    		type: 'POST',
    		data: {material : 'all'},
    		dataType: 'json',
    		success: function(data){
    			var datalength = data.length;
    			$('#options').empty();
    			for (var i = 0; i < datalength; i++) {
    				var option = '<option>'+data[i].Category+'</option>';
    				$('#options').append(option);
    			}
    		},
    		error: function(){alert("Something went wrong with material_categories");}
    		
    	});
	}
	
	/*$("#books").change(function() {
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
	});*/
	
});