/**
 *  This scipt include's functions for the main content in general
 */
$(document).ready(function(){
	$("#lib-search").on("click",function(event){
		if ( $("#addr-content").css("display") == "none")
			searchLibraries("",$( "#lib-dep option:selected" ).text() );
		else
			searchLibraries($("#lib-addr").val(),"");
	});
	
	if ( $("#addr-content").css("display") == "block")
		$("#addr-content").hide();
	
	$("#addr-header").click(function () {

	    $header = $(this);
	    $content = $header.next();
	    $content.slideToggle(500, function () {
	    	
	    	if ( $("#dep-content").css("display") != "block")
	    		$("#dep-content").show();
	    	else 
	    		$("#dep-content").hide();
	    });

	});
	
	$("#dep-header").click(function () {
	    $header = $(this);
	    $content = $header.next();
	    $content.slideToggle(500, function () {
	    	if ( $("#addr-content").css("display") != "block")
	    		$("#addr-content").show();
	    	else
	    		$("#addr-content").hide();
	    });

	});
	
});




function searchLibraries(address,department){

	var data = {"address" :address,"department":department};
	console.log(data);
	$.ajax({
		url : "/Ekpalib/includes/lib_requests.php",
		method: "post",
		data : data,
		dataType: 'json',
		success : function(data){
		
			var myObj = data;
			$("#lib-grid").find("tbody").empty();
			
			var datalength = data.length;
			for (var i = 0; i < datalength; i++) {
				var html =  "<tr> ";
			    for (var key in data[i]) {
			    	
			    	if(key == "id"){
			    		html = html +
			    		"<td style=\"width:120px;text-align:center;\">"+
						"<button class='btn btn-primary btn-sm' type='button' style=\"background-color: rgb(153, 43, 0); border-color: rgb(153, 43, 0);\" onclick=detailsLibrary(" + data[i][key] + ")>" +
								"<span class='glyphicon glyphicon-info-sign'></span>"+
						"</button></td>"
			    	} else {
			    		html = html +
						"<td style=\"text-align:center;\">" + 
							data[i][key] 
						+ "</td> " 
			    	}
	
				"</tr>";    
			    }
			    $("#lib-grid tbody").append(html);
			}
		},
		error : function(){
			$("#lib-grid").find("tbody").empty();
			var html =  "Δεν βρέθηκαν εγγραφές";
			$("#lib-grid tbody").append(html);
			}

		});
}