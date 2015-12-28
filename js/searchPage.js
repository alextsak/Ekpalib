/**
 * 
 */

var data = [];
$(document).ready(function(){
	
	$('#confirmLoan-Button').attr("disabled", true);
	
	$('#results-grid tbody').on('click', 'td button', function () {
		var row = $(this).closest('tr');
		var button = row.find("button");
		
		if (button.css('color') == 'rgb(255, 0, 0)') {
			button.css('color','green');
			//window.location = window.location.href + "&action=add" + "&materialID=" + this.id;
		}
					    
		else 
		    button.css('color','red');
		
		
		
		//window.location = window.location.href
		
		/*var array = [];
		for( var i=0;i<6;i++)
			array.push(row.find("td").eq(i).html());
		
		data.push(array);
		console.log(data);
		*/
		//$('#confirmLoan-Button').attr("disabled", false);
    } );
	
	
	/*$("#confirmLoan-Button").click(function(e) {
		e.preventDefault();
		var jsonArray = {};
		jsonArray.cart_func = JSON.stringify(data);
		console.log(jsonArray);
		
		
		var uri = document.URL;
		uri = uri.substring(0,window.location.href.lastIndexOf("="));
		uri = uri + "=confirmLoan";
		console.log(uri);
		$.ajax({
			type : "POST",
			url  : uri,
			data : jsonArray,
			success:function(response){},
			dataType:'json'
		});
	})*/
	
});