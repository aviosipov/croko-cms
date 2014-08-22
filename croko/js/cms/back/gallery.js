function getUrlParam( paramName ) {

    var reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' ) ;
    var match = window.location.search.match(reParam) ;

    return ( match && match.length > 1 ) ? match[ 1 ] : null ;
}

$(document).ready(function() {

	 
	
			
	// setup mosaic plugin ...
	$('.bar2').mosaic({ animation	:'slide' , hover_y: "-15px" });


	// setup up pixler editor 
	var base_url = window.location.origin ; 


	pixlr.settings.target = base_url + '/galleries/saveimage/1973';
	pixlr.settings.exit = base_url + '/galleries/addimage/304';
	pixlr.settings.credentials = true;
	pixlr.settings.method = 'get';

	

	// setup flip cards ..

	$(".flip").click(function() {

	    $(this).find('.card').addClass('flipped').mouseleave(function(){
            $(this).removeClass('flipped');

        });
        return false;
	  
	});


	/* Save image data (title and description) by AJAX */ 
	$(".btn-save-image-info").click(function() {

		// send data to server 

		console.log('about to save') ; 


		var url = "/admin/ajax/set_img_title";
		
		
        
        // step #4 
        var id = $(this).parent().find("input[name=id]").val() ; 
        var title = $(this).parent().find("input[name=title]").val() 
        var description = $(this).parent().find("textarea[name=description]").val()
        

        var card = $(this).parent().parent()  ; 
                             
		$.ajax({
     	 
			url: url,
			
			data: { 										
				id : id , title : title , description : description 
			} ,
					
					
			type: "POST",
          
			success: function(data){

				console.log('saved : ' + data ) ; 

				
				// done ... flip it back 
				
				$(card).removeClass('flipped'); 
				$(card).parent().parent().parent().find(".right").text(title) ; 
				return false ; 
				

          		    
          	
			}
		});



	}) ; 




	// setup sortable plugin ... 

	$(".sortable-images").sortable({ tolerance: "pointer"  , forceHelperSize: true , forcePlaceholderSize: true  ,  delay : 120 ,  items : '> div' , opacity: 0.6, cursor: 'move', update: function() {
						
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings';			
			console.log(order) ; 

			
			$.post("/admin/ajax/update_sort/images/"  , order, function(theResponse){

				console.log(theResponse) ; 
				//$("#contentRight").html(theResponse);
			});
			 
	}});    


	$(".sortable-galleries").sortable({ tolerance: "pointer"  , forceHelperSize: true , forcePlaceholderSize: true  ,  delay : 120 ,  items : '> div' , opacity: 0.6, cursor: 'move', update: function() {
						
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings';			
			console.log(order) ; 

		
			$.post("/admin/ajax/update_sort/galleries/"  , order, function(theResponse){

				console.log(theResponse) ; 
				//$("#contentRight").html(theResponse);
			});
			 
	}});    



	$(".embed-img").click(function() { 

		var funcNum = $(this).attr('data-ckid');		
		var fileUrl =  $(this).attr('data-url') ;

		console.log(fileUrl + ' ,' + funcNum) ; 


		window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl );
		window.close() ; 

	}) ; 

	
}) ;	