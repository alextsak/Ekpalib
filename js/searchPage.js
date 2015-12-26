/**
 * 
 */
$(document).ready(function(){
	$('#results-grid tbody').on('click', 'td button', function () {
		var row = $(this).closest('tr');
		var button = row.find("td:last");
		button.css('color','green');
    } );
	

});