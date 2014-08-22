/*$('#about').live('pagebeforecreate',function(event){
      //alert('This page was just enhanced by jQuery Mobile!');
      $.mobile.loadingMessage = "נא להמתין, טוען אפליקציה ...";
      $.mobile.showPageLoadingMsg();
});

$( '#about' ).live( 'pageinit',function(event){
  
});
*/ 

$(document).ready(function(){
	
	
	
	 



 	$('.article-link').live("click", function() {
 		
 		
 		var id = $(this).attr("id") ; 
 		var title =  $(this).text() ;
 		var content = $("#article-" + id).html() ; 
 		
 		
 		$("#single-article .article-title").html(title);
 		$("#single-article .article-content").html(content);
 		
 		
 		$.mobile.changePage( "#single-article" );
 		 
 		

  })	;

		

   $("#myform").prepend('<input type="hidden" name="mobile_form" value=1>') ;



   
   $('#myform').live('submit', function(event){    

   	
   		
   	
   		// handle mobile form submit ... 
   		
   		var name = $("#name").val() ;
   		var email = $("#email").val() ; 
   		var phone = $("#phone").val() ;
   		var message = $("#message").val() ;
       
       if (name=='' || email=='' || phone == '') {
       	
   			//$.mobile.changePage('#dialog', 'pop', true, true);
   	
       		alert('יש למלא את שדות החובה.') ;
       		return false ;
       }                 
       else {
	    	
	    	url = $(this).attr( "action" ).replace( location.protocol + "//" + location.host, "");
	    	dataString = 'name='+ name + '&email=' + email + '&phone=' + phone +  '&message=' + message;    

			
			$.ajax({  
			  type: "POST",  
			  url: url,  
			  data: dataString,  
			  success: function() {
			  	    
		  	     $.mobile.changePage("#message-ok"); 
			  	    
			  }  
			});      	  
	    
       	
       		return false ; 
       	
       } 
       
       
       
       
    });
    

	
	
	// define mobile image gallery ... 

	var myPhotoSwipe = $("#Gallery a").photoSwipe({ enableMouseWheel: false , enableKeyboard: false });


	// handle forms ... 
	
	



});