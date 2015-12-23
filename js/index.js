/**
 * 
 */
$(document).ready(function(){
	$('#libraries-grid').dataTable({
		columns: [
	       { title: "Name" },
	       { title: "Address" },
	       { title: "Hours" },
   ]});

	$('#studyRooms-grid').dataTable({
		columns: [
           { title: "Name" },
           { title: "Address" },
           { title: "Hours" },
   ]});
	
});