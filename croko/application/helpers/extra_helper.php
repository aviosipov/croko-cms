<?


	if ( ! defined('BASEPATH')) exit('No direct script access allowed');




function tidyHTML($html) {






    // load our document into a DOM object
    $dom = new DOMDocument("1.0" , "UTF-8");

    // we want nice output	
	$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
	$dom->formatOutput = true;
	$dom->preserveWhitespace = false;

	$dom->encoding = 'UTF-8';
	
	$body = $dom->getElementsByTagName('html');
	$body = $body->item(0);



	$t  = $dom->saveXml($body);

	$t = preg_replace('~<(?:!DOCTYPE|/?(?:html|head|body))[^>]*>\s*~i', '', $t);

	return $t ;


	//return  $dom->saveXML(); 


}




	
	
	function resize_img($file,$width,$height=0) {
		
		/*
		 *  general function for resizing images.
		 *
		 */ 
		 
		 
		 
		 
		$CI =& get_instance();
						 
		$CI->load->library('image_lib');


				
										
		$file_name =  $file['file_name'] ;				
		$file_path = "gallery/" . $file_name ;
		
		$ratio = $file['image_width'] / $file['image_height'] ; ;
		
		
		
		/* Resize the image only if bigger than the 
		 * original size . */
		
		if ($file['image_width'] > $width ) { 
				
			$cfg2['image_library'] = 'gd2';
			$cfg2['source_image']	= $file_path ;				 									
			
							
			
			$cfg2['width'] = $width ;
			
			
			if ($height==0){
				
				// auto adjust the height
				
				$cfg2['maintain_ratio'] = TRUE;
				$cfg2['height']	= $width / $ratio ;				
				
			}  else $cfg2['height'] = $height ; 
				
			
			$CI->image_lib->initialize($cfg2);   												
			$CI->image_lib->resize() ; 
			
		}
						
		






		
	}
	
	
	
	function today() {
		
		return date("d-m-Y") ; 
		
		
	}
	
	
	function today_mysql() {
		
		return date('Y-m-d') ;		
		
	}
	
	
	
	function current_day () {
		
		
		return date ("d") ; 
	}
	
	
	function current_month () {
		
		return date ("m") ; 
		
	}
	
	function current_month_year () {
		
		return date ("m-Y") ;
	}
	
	
	
	function db_2_array($sql_result , $col1 , $col2 , $default = '' ) {
		
		if ($default) $data = array (0 => $default ) ;
		
		foreach ($sql_result->result_array() as $row ) { 		
			$data [$row[$col1]] = $row[$col2] ;  				   				
		}	
		
		return $data ; 		
		
	}
	
	
	function date_2_sql($date) {
		
		$sql_date = date( 'Y-m-d', strtotime( $date )) ;
		return $sql_date ; 
		
	}
	
	
	function sqldate_2_short($date) {
		
		return date("d-m",strtotime($date));
		
	}
	
	function sqldate_2_med($date) {
		
		return date("d-m-Y",strtotime($date));
		
	}
	
	
	function sqldate_2_monthyear ( $date ) {
		
		return date("m-Y",strtotime($date));
		
	}
	
	
	function sqldate_2_long($date) {
		
		return date("d-m-Y, H:i",strtotime($date));
		
	}
	
	
	
	function count_days( $a, $b ) 
	{ 
	    // First we need to break these dates into their constituent parts: 
	    $gd_a = getdate( $a ); 
	    $gd_b = getdate( $b ); 
	    // Now recreate these timestamps, based upon noon on each day 
	    // The specific time doesn't matter but it must be the same each day 
	    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] ); 
	    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] ); 
	    // Subtract these two numbers and divide by the number of seconds in a 
	    // day. Round the result since crossing over a daylight savings time 
	    // barrier will cause this time to be off by an hour or two.
	    
	    //return round( abs( $a_new - $b_new ) / 86400 );
	     
	    return round( ( $a_new - $b_new ) / 86400 ); 
	}
	
	
	
	function format_text($text) {
		
		if ($text) { 
		
			$text = nl2br($text); // add breaks ; 		
			$text = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $text); // set links
		   		
		} else $text = ' ' ; 
		
		return $text ; 
		
		
	} 	




?>