/**
 * 
 */
$(document).ready(function(){
	$("#lib-search").on("click",function(event){
    	searchLibraries($("#lib-addr").val() ,$( "#lib-dep option:selected" ).text() );
	});
	/*$('#lib-dep').on('change', function() {
		  if($( "#lib-dep option:selected" ).text() == "Κανένα")
			  $("input").prop('disabled', false);
		  else
			  $("input").prop('disabled', true);
	});
	*/
	$(".header").click(function () {

	    $header = $(this);
	    //getting the next element
	    $content = $header.next();
	    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
	    $content.slideToggle(500, function () {
	        //execute this after slideToggle is done
	        //change text of header based on visibility of content div
	        
	    });

	});
	
});




function searchLibraries(address,department){
	
	if(department == "Κανένα"){
		department = '';
	}
	if(department == "Όλα") {
		console.log(department);
		address="";
	}
	var data = {"address" :address,"department":department};
	$.ajax({
		url : "/Ekpalib/inc/lib_requests.php",
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
			alert("Something went wrong");
			}

		});
}