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
	var data = {"search_libs" : "search_libs", "address" :address,"department":department};
	$.ajax({
		url : "/Ekpalib/inc/lib_requests.php",
		method: "post",
		data : data,
		success : function(data){
			var myObj = $.parseJSON(data);
			
			$("#lib-grid").find("tbody").empty();
			console.log(myObj);
			//for(var i=0;i<myObj.length;i++){
				var html =  "<tr> " +
								"<td>" + 
									myObj.Name
								+ "</td> " 
								+ " <td> " +
									myObj.Address
								+ "</td> " +
								+ " <td> " +
									myObj.Telephone
								+ "</td> " +
							"</tr>";
				$("#lib-grid tbody").append(html);
			//}
			
			
		},
		error : function(){
			alert("Something went wrong");
			}

		});
}