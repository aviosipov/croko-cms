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

function show_panel(panel) {


	
    var target = panel ,
        other = $(target).siblings('.active');
    
    if (!$(target).hasClass('active')) {
        $(other).each(function(index, self) {
            var $this = $(this);
            $this.removeClass('active').animate({
                left: $this.width()
            }, 500);
        });

        $(target).addClass('active').show().css({
            left: +($(target).width())
        }).animate({
            left: 0
        }, 500);
    }
    
    
    
	
}




$(document).ready(function(event){	


	$(".toggle-button").click(function(e) {
		
		
		if ( $("#info-panel").css('left') == "0px" ) {
			
			show_panel("#main-panel");
			$(this).text($(".toggle-button").attr('title')) ;
			 	
		} else {
			
			show_panel("#info-panel");
			$(this).text("ביטול")
			
		}
		
		  
		 
		 
	}) ;   	

}) ; 
  	
  	// handle action click on div 




