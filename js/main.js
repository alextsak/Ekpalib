/**
 * 
 */
$(document).ready(function(){
	$("#lib-search").on("click",function(event){
    	console.log($("#lib-addr").val());
    	console.log($( "#lib-dep option:selected" ).text());
    	searchLibraries($("#lib-addr").val() ,$( "#lib-dep option:selected" ).text() );
	});
	$('#lib-dep').on('change', function() {
		  if($( "#lib-dep option:selected" ).text() == "Όλα"){
			  window.reload(true);
		  }
		});
});

function searchLibraries(address,department){
	
	if(department == "Κανένα"){
		department = '';
	}
	var data = {"address" :address,"department":department};
	$.ajax({
		url : "/Ekpalib/inc/lib_requests.php",
		method: "post",
		data : data,
		dataType: 'json',
		success : function(data){
			//var myObj = JSON.stringify(data);
			//var myObj = $.parseJSON(data);
			var myObj = data;
			console.log(myObj);
			
			console.log("data length: " + data.length);
			$("#lib-grid").find("tbody").empty();
			
			var datalength = data.length;
			for (var i = 0; i < datalength; i++) {
				var html =  "<tr> ";
			    for (var key in data[i]) {
			    	
			    	if(key == "id"){
			    		html = html +
			    		"<td style=\"width:120px;\">"+
						"<button class=\"btn btn-primary btn-sm\" type=\"button\" onclick=\"detailsLibrary(" + data[i][key] + ")>" +
								"<span class=\"glyphicon glyphicon-info-sign\"></span>"+
						"</button></td>"
			    	} else {
			    		html = html +
						"<td>" + 
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