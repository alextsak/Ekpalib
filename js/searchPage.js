/**
 * 
 */

$(document).ready(function(){
	init();
});


function init(){
	 
	$('#searchResults-grid').dataTable({
		columns: [
            { title: "Title" },
            { title: "Type" },
            { title: "Author(s)" },
            { title: "ISBN" },
            { title: "Library" },
            { title: "Availability" },
            {
                 title: "Add to cart",
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "sDefaultContent": '<button id="cartButton" class="glyphicon glyphicon-shopping-cart"></button>'
            },
            {
            	title:"Options",
            	"sDefaultContent": '<a href="#"><h6 >Details</h6></a>'
            						+'&nbsp|&nbsp'
            						+'<a href="#"><h6>Preview</h6></a>'
            }
        ],
        "data": [
                 [
                   "Tiger Nixon",
                   "System Architect",
                   "Edinburgh",
                   "5421",
                   "2011/04/25",
                   "2"
                 ]
                ]
    } );
}