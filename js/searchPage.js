/**
 * 
 */

var data = [];
$(document).ready(function(){
	
	$('#confirmLoan-Button').attr("disabled", true);
	
	$('#results-grid tbody').on('click', 'td button', function () {
		var row = $(this).closest('tr');
		var button = row.find("button");
		
		if (window.getComputedStyle(button).color == 'rgb(255, 0, 0)') {
			console.log("hiii");
			button.css('color','green');
		   }
		    else {
		    	button.css('color','rgb(255,0,0)');
		    }
		/*if(button.css('color') == "rgb(255,0,0)") {
			console.log("hiii");
			button.css('color','green');
			var test = window.location.href + "?id=" + this.id;
			console.log(test);
		} else {
			button.css('color','red');
		}*/
		
		
		
		//window.location = window.location.href
		
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