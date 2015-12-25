/**
 * 
 */
$(document).ready(function(){
	$('#myDropdown').ddslick({
	    data: ddData,
	    width: 300,
	    imagePosition: "left",
	    selectText: "Select language",
	    onSelected: function (data) {
	        console.log(data);
	    }
	});

	
});

var ddData = [
    {
        text: "English",
        value: 1,
        selected: false,
        imageSrc: "./images/gb.gif"
    },
    {
        text: "Greek",
        value: 2,
        selected: false,
        imageSrc: "./images/gr.gif"
    }
];