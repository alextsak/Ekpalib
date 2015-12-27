/**
 * 
 */
$(document).ready(function(){
	$('#results-grid tbody').on('click', 'td button', function () {
		var row = $(this).closest('tr');
		var button = row.find("button");
		button.css('color','green');
		
		for( var i=0;i<6;i++){
			var data = row.find("td").eq(i).html();
			console.log(data);
		}
		
		//active button on click
    } );
});