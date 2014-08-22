var slider  ; 

function showCoords(c)
{
	$('#x1').val(c.x);
	$('#y1').val(c.y);
	$('#x2').val(c.x2);
	$('#y2').val(c.y2);
	$('#w').val(c.w);
	$('#h').val(c.h);
};	

function generate_img_code(id) {
	
	var code = '[picture name="' + id + '" width="250" align="right"]' ; 
	
	$("#copycode").show('fast') ; 
	$("#copycode input").val(code) ; 
	
	
}


function generate_youtube_code() {

	
	var s = $("#youtube-link").val() 	
	s = s.split('v=')[1].split('&')[0] ;
	
	var code = '[youtube video="' + s  +  '"]' ; 


	
 	$("#copycode").show('fast') ; 
	$("#copycode input").val(code) ;

	
}



// admin functions 





$(document).ready(function(event){	


	/// if we have 'ok' status display relevant message ... 

	

	
	

	
	// setup ui slider ... 

	slider = $('#ui-slider').bxSlider({
		controls: false , 
		speed : 450 
	});
	
	



	$(".toggle-button").click(function(e) {
		
		
		if ( $(this).text() == "ביטול" ) {			
			
			slider.goToPreviousSlide() ; 
			$(this).text($(".toggle-button").attr('title')) ;
			 	
		} else {
						
			slider.goToNextSlide() ; 
			$(this).text("ביטול")
			
		}
		
		 
	}) ;   	






  	// handle action click on div 
	  	
  	
	$(".action-link").click(function(e) {

  		
  		
		var url = $(this).attr('data-target') ; 
  		
  		
  		if ($(this).hasClass('alert')) {

	  		var r=confirm("האם אתה בטוח?");   //// exit function if user has cancelled 	  		
			if (r==false) return false ; 	//// the action 
  			
  		} 

  		//// We're good to go ...
  		
  		
		e.preventDefault();
		e.stopPropagation();
			 	  			 
		window.location.href = url ;  		
  		
  		
  		
		  
	});
	  	
	  	
  	
	
	
	// prevent from spaceskeys 
	
	$("#url-address").bind("keyup change", function () {
		
		$(this).val(function(i, v) { return v.replace(/ /g,"-"); });
	});
	
	
	$("#copycode").hide() ; 
	
	// color pickers 
	   
	$('#color1, #color2, #colorpicker').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			$(el).val(hex);
			$(el).ColorPickerHide();				
		},
		
		onBeforeShow: function () {
			$(this).ColorPickerSetColor(this.value);
		}
	})
	
	.bind('keyup', function(){
		$(this).ColorPickerSetColor(this.value);
	});
	
	
	
	
	/* jquery crop plugin */
	
	$('#cropbox').Jcrop({
		onChange: showCoords,
		onSelect: showCoords
		
	});
	
	
	
	/* code mirror editor stuff */ 
	
	
	
	if(!(typeof htlmarea === 'undefined')) {
		
		var myCodeMirror = CodeMirror.fromTextArea(htmlarea , {
	        mode: 'text/html',
	        indentUnit : 2,
	        lineWrapping : true,
	        enterMode: "keep",
	        tabMode: "shift",
	        matchBrackets : true,
	        lineNumbers: true,
	        indentWithTabls : true 
	        
	      
	      });  
	      
	  }
		
	


}) ; 
  	
  	// handle action click on div 




