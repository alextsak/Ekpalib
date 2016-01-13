$(document).ready(function(){
	
	$('#radioButton-From input').on('change', function() {
			$("#isbn").prop('disabled', false);
			$("#publisher").prop('disabled', false);
			var id = $('input[name=radio]:checked', '#radioButton-From').val();
			if( id == "magazines" || id == "articles"){
				$("#isbn").prop('disabled', true);
				$("#isbn-form").append("<input class='form-control' name='isbn' id='isbn' type='hidden' value=''/>");
				
				
				$("#publisher").prop('disabled', true);
				$("#publisher-form").append("<input class='form-control' name='publisher' id='publisher' type='hidden' value='' />");
			}
			
			$.ajax({
	    		url: '/Ekpalib/inc/material_categories.php',
	    		type: 'POST',
	    		data: {material : id},
	    		dataType: 'json',
	    		success: function(data){
	    			$('#category-options').empty();
	    			var datalength = data.length;
	    			for (var i = 0; i < datalength; i++) {
	    				var option = '<option>'+data[i].Category+'</option>';
	    				$('#category-options').append(option);
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
    			$('#category-options').empty();
    			for (var i = 0; i < datalength; i++) {
    				var option = '<option>'+data[i].Category+'</option>';
    				$('#category-options').append(option);
    			}
    		},
    		error: function(){alert("Something went wrong with material_categories");}
    		
    	});
	}
});