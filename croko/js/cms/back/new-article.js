$(document).ready(function() {

	$("#article-name").focus()  ; 		 // set focus on 1st element 

	

	$("#url-address").focus(function(){

		if($(this).val() == '' && $("#article-name").val() != '' ) {

			var page_name = $("#article-name").val() ; 

			page_name = page_name.replace(/^\s\s*/, '').replace(/\s\s*$/, ''); // remove spaces from beginning and end 
			page_name = page_name.split(' ').join('-') ;  // replace spaces

			$(this).val( page_name ) ; 

		}

	}); 	



}) ; 
