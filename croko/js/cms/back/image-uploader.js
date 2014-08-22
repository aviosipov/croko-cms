
var currentImage = new Object() ; 
var currentImageSelection ; 



function updateSectionSize(img, selection) {  

	currentImageSelection = selection ; 
}


function previewSelectedImage(input) {

	if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {

        $('#preview_image').attr('src', e.target.result);
        
		/// enable preview image cropping 
		/// calculate aspect ration

		$('img#preview_image').imgAreaSelect({
	        handles: true , 
	        onSelectChange : updateSectionSize,
	        aspectRatio: currentImage.width + ':' + currentImage.height
	    });			

    }

    reader.readAsDataURL(input.files[0]);

	}			
}


jQuery(document).ready(function(){

	// init image dialog 

	jQuery("#photo_selector_dialog" ).dialog({

		title : '' , 
		width : 800 , 
		height : 650  , 
		dialogClass: 'noTitleDialog' , 
		autoOpen : false


	});


	/// image selection preview 

	$("#image_selector").change(function(){
		previewSelectedImage(this);
	});			


	/// handle image selection options for each image on page 

	jQuery( "img" ).mouseover(function() {
			  
	});			


	$("#image_dialog_close").click(function(event) {

        $('img#preview_image').imgAreaSelect({hide:true})
		jQuery("#photo_selector_dialog").dialog("close") ; 

	}) ; 

	// post request for image uploading and ui update 

	$("#image_dialog_save_image").click(function(event) {


		$(".loadingAnimation").show() ; 

  		var fileInput = document.querySelector('#image_selector');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/admin/services/upload_image/');


        xhr.onload = function()
        {
            
        	$(".loadingAnimation").hide() ; 

            console.log('upload complete') ; 
            console.log(xhr.responseText); 
            


            /// refresh image after update 

			d = new Date();
			currentImage.image.attr("src", currentImage.src + '?' + d.getTime());





            jQuery("#photo_selector_dialog").dialog("close") ; 
            
            $('img#preview_image').imgAreaSelect({hide:true})



        };

        var form = new FormData();

        form.append('title', 'my title');
        form.append('userfile', fileInput.files[0]);
        form.append('selection', JSON.stringify( currentImageSelection));
        form.append('preview_width', $("#preview_image").width());
        form.append('path', currentImage.src);
        form.append('original_width', currentImage.width);
        form.append('original_height', currentImage.height);
        


        xhr.send(form);



		console.log('start upload') ; 
		
	}) ;

	
	/// display image edit dialog 

	jQuery("img").not(".not-editable").click(function(event) {

		event.preventDefault() ; 

		var w = $(this).width() ; 
		var h = $(this).height() ; 

		currentImage.src = $(this).attr('src') ; 
		currentImage.image = $(this) ; 		
		currentImage.width = w ; 
		currentImage.height = h ; 		

		$('#preview_image').attr('src', '' ) ; 
		$("#image_selector").val(''); 
		
		jQuery("#photo_selector_dialog").dialog("open") ; 

	});


	/// configue spin.js 

	jQuery("body").append('<div id ="center" style="position:fixed;top:20%;left:50%"></div>') ; 

	spin_options = {

	  lines: 9, // The number of lines to draw
	  length: 13, // The length of each line
	  width: 5, // The line thickness
	  radius: 18, // The radius of the inner circle
	  corners: 1, // Corner roundness (0..1)
	  rotate: 0, // The rotation offset
	  color: '#000', // #rgb or #rrggbb
	  speed: 1.5, // Rounds per second
	  trail: 60, // Afterglow percentage
	  shadow: false, // Whether to render a shadow
	  hwaccel: false, // Whether to use hardware acceleration
	  className: 'spinner', // The CSS class to assign to the spinner
	  zIndex: 2e9, // The z-index (defaults to 2000000000)
	  top: 'auto', // Top position relative to parent in px
	  left: 'auto' // Left position relative to parent in px
	};

}) ; 
