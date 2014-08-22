function setup_widgets() {




	jQuery('.croko_widget').each (function()  {

		/// add image 

		var img = '<img class="croko_widget_settings" src="http://iconizer.net/files/Brightmix/orig/monotone_cog_settings_gear.png" width="32" />' ; 
		jQuery(this).prepend(img) ; 

		
	}) ; 

	jQuery('.croko_widget_image').each (function()  {

		var img = '<img class="croko_widget_settings" src="http://iconizer.net/files/Brightmix/orig/monotone_cog_settings_gear.png" width="32" />' ; 

		jQuery(this).wrap('<div class="croko_empty_container croko_widget" croko-data-type="image"></div>') ; 
		jQuery(this).before(img) ; /// generated automatically?!?!

		
	}) ; 
}



jQuery( ".croko_widget_settings" ).live( "click", function(event ) {

	// stop event propogation 
	//event.stopPropagation() ; 
	event.preventDefault() ; 

	// get widget settings 

	var data_type = jQuery(this).parent().attr('croko-data-type') ; 
	var data_category = jQuery(this).parent().attr('croko-data-category') ;  

	switch (data_type) {

		case 'articles' : 

			// open ui for update  

			spinner = new Spinner(spin_options).spin(document.getElementById('center'));		
			jQuery(".cms-frame").attr("src" , '/admin/article_list/' + data_category ) ;

			break ; 


		case 'gallery' : 

			var gallery_full_width = jQuery(this).parent().attr('croko-gallery-full-width') ; 

			spinner = new Spinner(spin_options).spin(document.getElementById('center'));		
			jQuery(".cms-frame").attr("src" , '/galleries/addimage/' + data_category + '?gallery_full_width=' + gallery_full_width ) ;

			break ; 

		case 'image' : 

			var img = jQuery(this).next() ;  // get the image to be editor 
			load_image_editor(img) ; // load image editor ( located in galery.js )

			break ; 

	}



}) ; 

function hide_menu() {

	jQuery(".cms-window").animate(

		{ "height" :  "0px" } , 650 , 'easeInOutQuint' , 		
	
		function() {

    		// Animation complete.	    	
    		jQuery(".cms-window").hide() ;  	    
    		jQuery(".cms-content").fadeIn(); 		    			    	
    	
  		}
  		
	);

}




function ui_listener() { 

	/// iframe re/loading event 

	document.getElementById("cms-frame").onload = function() {			

		if (!jQuery(".cms-window").is(":visible")) {	
			jQuery(".cms-window").show() ;			
		}


		jQuery(".cms-content").fadeOut(); 


		iframe_height = jQuery("#cms-frame").contents().find("body").attr("content-height") ; 
		if (!iframe_height) iframe_height = 620 ; 					

		jQuery(".cms-frame").css("height",    iframe_height +  "px" ) ;  // setup iframe height 
		jQuery(".cms-window").animate({"height":iframe_height + "px" },650 , 'easeInOutQuint' ) ;
		

		spinner.stop();	    
	    console.log('loaded ifrmae') ; 
	};
	
	
	jQuery(".menu-button").click(function() {
		
		var button = jQuery(this).attr('id')   ;
		var iframe_height = 0  ;
		var iframe_url = "" ; 
		
		
		switch (button) {

			case 'articles' : 

				iframe_url = "/admin/article_list/" ; 
				iframe_height = 260 ; 
			
				break ; 

			case 'pages' : 

				iframe_url = "/admin/page_list/" ; 
				iframe_height = 260 ; 
			
				break ; 


			
			case 'new-page' : 
			
				iframe_url = "/admin/add/page/" ; 
				iframe_height = 260 ; 
			
				break ; 
				
			case 'new-article' : 

				iframe_url = "/admin/add/article/" ; 
				iframe_height = 290 ; 

				break ; 

			case 'action' : 

				iframe_url = jQuery(this).attr('action-url') ; 
				iframe_height = 530 ;

			
			case 'edit' : 
				
		//		iframe_url = "/admin/edit/artile/596" ; 
		//		iframe_height = 530 ;
				
				// if (article) 560 ;  
								
				break
				
			case 'delete' :
						
		//		iframe_url = "/admin/edit/article/51" ; 
		//		iframe_height = 290 ; 
			 
				break; 
			
			case 'settings' : 
			
				iframe_url = "/admin/settings" ; 
				iframe_height = 550 ; 
						
				break; 
			
			
			case 'galleries' :
			
				iframe_url = "/galleries/addgallery" ; 
				iframe_height = 260 ; 			
			
				break; 
			
			case 'help' :


				iframe_url = "/admin/help" ; 
				iframe_height = 290 ; 			

				break; 
			 
		}
				
		spinner = new Spinner(spin_options).spin(document.getElementById('center'));		

		console.log('start loading ifrmae') ; 
		jQuery(".cms-frame").attr("src" , iframe_url ) ;

		if (button == 'galleries') {  // due to bug in bxgallery we have to refresh the frame

	         setTimeout(function (){

	             
	             document.getElementById("cms-frame").contentDocument.location.reload(true);
	             
	         }, 2000); // how long do you want the delay to be? 

			

		}







						 



		
  		
	}); 
	
	
	
	
	
	
}



