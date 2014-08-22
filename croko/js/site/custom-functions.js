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
