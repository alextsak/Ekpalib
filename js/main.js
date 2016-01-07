/**
 * 
 */
$(document).ready(function(){
	$("#lib-search").on("click",function(event){
    	console.log($("#lib-addr").val());
    	console.log($( "#lib-dep option:selected" ).text());
    	searchLibraries($("#lib-addr").val() ,$( "#lib-dep option:selected" ).text() );
	});

});

function searchLibraries(address,department){
	
	var data = {"address" :address,"department":department};
	$.ajax({
		url : "/Ekpalib/inc/lib_requests.php",
		method: "post",
		data : data,
		success : function(data){
			$("#lib-grid").find("tbody").empty();
			$("#lib-grid tbody").append(data);
		},
		error : function(){
			alert("Something went wrong");
			}

		});
}