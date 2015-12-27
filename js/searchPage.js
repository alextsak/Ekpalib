/**
 * 
 */

var data = [];
$(document).ready(function(){
	
	$('#confirmLoan-Button').attr("disabled", true);
	
	$('#results-grid tbody').on('click', 'td button', function () {
		var row = $(this).closest('tr');
		var button = row.find("button");
		button.css('color','green');
		console.log(window.location.href);
		//window.location = 
		
		/*var array = [];
		for( var i=0;i<6;i++)
			array.push(row.find("td").eq(i).html());
		
		data.push(array);
		console.log(data);
		*/
		$('#confirmLoan-Button').attr("disabled", false);
    } );
	
	
	$("#confirmLoan-Button").click(function(e) {
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
	})
	
});