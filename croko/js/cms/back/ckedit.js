$(document).ready(function() {


	$(".save-content").click(function() {

		var row_id = $(".content-id").text() ; 
		var data_field = 'content' ; 
		var data_type = $(".content-type").text() ; 
		var value = CKEDITOR.instances.editor.getData();

		console.log(value) ; 

		ajax_update_field( data_type , row_id , 'content' , value) ; 			
		humane.log("שמרתי את השינויים.")


	}); 	



}) ; 
