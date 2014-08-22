
function ajax_update_field(table,row,field,value) { 

	var url = "/admin/ajax/update_field";

	$.ajax({
		 
		url: url,

		data: { 										
			"table" : table , "row" : row , "field" : field  , "value" : value
		} ,				
				
		type: "post",
	  
		success: function(data){
			console.log('saved row ' + row ) ; 	
			console.log('response : ' + data ) ; 							  	
		} , 

		error: function(err) {
			console.log('error, cant update ...') ; 			
		}
	});


}
