

var currentImageSelection ; 
var selectedImageSettings = {} ;


function load_image_editor(image) {

	var w = image.attr('image-crop-width') ; 
	var h = image.attr('image-crop-height') ; 
	var name = image.attr('image-name') ; 

	selectedImageSettings.imageWidth = w ; 
	selectedImageSettings.imageHeight = h ; 
	selectedImageSettings.imageSource = $(image).attr('src');
	selectedImageSettings.imageName = name ; 
	selectedImageSettings.imageObject = image ; 

	jQuery("#photo_selector_dialog").dialog("open") ; 

}


function hideImageAreaSelect() {


	$('img#preview_image').imgAreaSelect({
        hide: true 
    });			

}


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
		        aspectRatio: selectedImageSettings.imageWidth + ':' + selectedImageSettings.imageHeight
		    });			

		    /*
			x1 : selectedImageSettings.imageWidth * 0.1 , 
			y1 : selectedImageSettings.imageHeight * 0.1 , 		

			x2 : selectedImageSettings.imageWidth - selectedImageSettings.imageWidth * 0.1 , 
			y2 : selectedImageSettings.imageHeight - selectedImageSettings.imageHeight * 0.1 , 		

		    */ 

        }

        reader.readAsDataURL(input.files[0]);
    }			
}




jQuery(document).ready(function(){ 

	



	jQuery("#photo_selector_dialog" ).dialog({

		title : '' , 
		width : 650 , 
		height : 550  , 
		dialogClass: 'noTitleDialog' , 
		autoOpen : false


	});


	/// image selection preview 

	$("#image_selector").change(function(){
		previewSelectedImage(this);
	});			


	$("#image_dialog_close").click(function(event) {

		hideImageAreaSelect() ; 
		jQuery("#photo_selector_dialog").dialog("close") ; 

	}) ; 

	$("#image_dialog_save_image").click(function(event) {

		$(".loadingAnimation").show() ;  


  		var fileInput = document.querySelector('#image_selector');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/admin/services/upload_image/');

        xhr.upload.onprogress = function(e) 
        {

                 /* values that indicate the progression
                 e.loaded);
             e.total);*/
        };

        xhr.onload = function()
        {

            $(".loadingAnimation").hide() ; 



            var file_name = '/gallery/' + xhr.responseText ; 

            /// update image object with the updated image 
            d = new Date();
            selectedImageSettings.imageObject.attr('src' , file_name + '?' + d.getTime()) ;

            /// close selection 
            hideImageAreaSelect() ; 

            /// hide dialog 
        	jQuery("#photo_selector_dialog").dialog("close") ; 





        };

        var form = new FormData();

        form.append('preview_width', $("#preview_image").width()  ) ; 
        form.append('target_width', selectedImageSettings.imageWidth  ) ; 
        
		form.append('name',selectedImageSettings.imageName);
        form.append('title', 'my title');
        form.append('userfile', fileInput.files[0]);
        form.append('selection', JSON.stringify( currentImageSelection));

        xhr.send(form);


		console.log('start upload') ; 
		
	}) ;




}) ; 