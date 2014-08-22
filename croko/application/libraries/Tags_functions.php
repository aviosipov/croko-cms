<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * Tags_Functions class.
 */

class Tags_functions extends Posts_parser
{
	
	
	var $content_id;    // used for recognizing the current content id ( for page or article ) 
	var $content_type;  // set the type for the current content (page or article ... )
	
	
	
	
		
	
	/**
	 * Tags_Function function.
	 * Tags_functions is a child of Posts_parser
	 */
	function Tags_functions()
	{
		parent::Posts_parser();
	}
	
	
	function set_content_id($id) {
		
		// set current content id 
		
		$this->content_id = $id ; 
	}
	
	function set_content_type($type) {
				
		// set current content type 
		
		$this->content_type = $type ; 
	}
	
	
	
	/**
	 * get_funcs function.
	 * Return registered functions to Posts_parser class
	 * 
	 * @access public
	 * @return void
	 */
	function get_funcs()
	{
		$parsers = array(
			'links',
			'news',
			'gallery',
			'youtube',
			'picture',
			'contact',
			'contacten',
			'frame' , 
			'custom' , 
			'article_list'  
			
		);
		return $parsers;
	}
	
	// ------------------------------------------------------------------------
	/**
	 * Create a dummy link with passed parameters. Totally useless, 
	 * but demonstrate how works the library.
	 * 
	 * @access public
	 * @param mixed $attrs
	 * @return void
	 */
	
	
	function news($attrs) {
		
		$output = 'news';
		
		return $output;
		
		
	}
	
	
	function links($attrs)
	{
		extract($this->merge_attrs(array(
			'id'    => '',
			'class' => '',
			'text'  => ''
		), $attrs));
		
		$output = '<a class="'.$class.'" href="http://example.com">'.$text.'</a>';
		
		return $output;
	}
	
	
	function frame($attrs)
	{
		extract($this->merge_attrs(array(
			'url' => '' , 
			'width' => '550' , 
			'height' => '785' 
		), $attrs));				
		
		$output = '<iframe id="myframe" name="myframe" width="' . $width . '" height="'. $height .'" src="' . $url . '" frameborder="0" noresize="noresize" allowtransparency="allowtransparency"></iframe>' ;  				
		return $output;
	}	



	function article_list ($attrs)
	{

		extract($this->merge_attrs(array(
		
			'limit' => 10 ,
			'cat' => '' 
			  
		), $attrs));
		
				
		$article_list = $this->ci->Content->get_article_list($limit , $cat) ;  
		$output = '' ; 
		 

			
		foreach ($article_list->result() as $article) {
			
			$output .= "<li>" . anchor("articles/$article->id", $article->title ) . "</li>" ; 							
		}
				
		$output = '<ul>' . $output . '</ul>' ; 
		  				
		return $output;
	}
	




	function youtube($attrs)
	{
		 
		
		extract($this->merge_attrs(array(
			'video' => '' , 
			'width' => '425' , 
			'height' => '349' ,
			'autoplay' => '0'
		), $attrs));
		
		
						
		
		$output = '<iframe width="' . $width . '" height="'. $height .'" src="http://www.youtube.com/embed/' . $video . '?rel=0&autoplay=' . $autoplay . '" frameborder="0" allowfullscreen></iframe>' ;  				
		return $output;
	}
	

	function picture($attrs)
	{
		
				
		extract($this->merge_attrs(array(
			'name' => '' , 
			'align' => 'left' , 
			'width' => '250' , 
			'height' => '250' 
		), $attrs));
		
		$CI =& get_instance();		
		$CI->load->model('site/Gallery') ;	 
		$filename = $CI->Gallery->get_img_by_title($name) ;   						
		
//		$output = '<img src="gallery/' . $filename. '" class="'. $align . '" width="' . $width . '" height="'. $height .'"/>' ;  				
		$output = '<img src="/gallery/' . $filename. '" class="'. $align . '" width="' . $width . '"/>' ;
		return $output;
		
		
		 
	}
	
	
	



	function custom($attrs)
	{
		
				
		extract($this->merge_attrs(array(
			'name' => '' ,
			'id' => '' 
		), $attrs));
		
		$CI =& get_instance();
		
		$data['id'] = $id ; 
		$custom = $CI->load->view($name,$data,true) ;	 
	//	$filename = $CI->Gallery->get_img_by_title($name) ;   						
		
//		$output = '<img src="gallery/' . $filename. '" class="'. $align . '" width="' . $width . '" height="'. $height .'"/>' ;  				
//		$output = '<img src="gallery/' . $filename. '" class="'. $align . '" width="' . $width . '"/>' ;
		return $custom;
	}
	
	
	

	function contacten($attrs)
	{
		extract($this->merge_attrs(array(
			'form' => '1' , 
			'width' => '425'  			
		), $attrs));
		
		
		$CI =& get_instance();
		
			
			
		$attributes = array('class' => 'en-contact-form', 'id' => 'myform');
		$form_open =  form_open("admin/forms",$attributes); 
			 				
		
		$form = $form_open .  '
		
			<label>Name</label>
			<input name="name" class="required" type="text" /> 
			<br>
			
			<label>Email</label>
			<input name="email" class="required email" type="text" /> 
			<br>

			<label>Phone</label>
			<input name="phone" type="text" /> 
			<br>
			
			
			<label>Comments</label>
			<textarea name="message"></textarea>
			<br><br>
			
			
			<input type="submit" value="Send" class="submit"/>
			
			
			</form>
					
		
		
		' ; 
		
		$output = $form ; 
		   				
		return $output;
	}
	
	


	
	

	function contact($attrs)
	{
		extract($this->merge_attrs(array(
			'form' => '' ,  
			'subject' => '' ,  
			'source' => '' , 
			'width' => '425' , 
			'captcha' => '1'  			
		), $attrs));
		
		
		$CI =& get_instance();


		
		
		if ($subject ) {  // if subject not empty ... 
				
			$subject = explode (',',$subject ) ; // convert string to array 
			$subject = array_combine ( $subject , $subject ) ;  // set keys to values 
			$subject = form_dropdown ('subject' , $subject ) ;
			
			$subject =  '<label>נושא הפנייה</label>' . $subject . '<br>' ; 
		
		}  else $subject = '' ; 
						
		
		if ($captcha==1) {
				
			$captcha_code = '
			


	<label>	
		<img src="http://getcontrol.co.il/images/cms/helpers/refresh.jpg" width="15" alt="" id="refresh">
 	</label>
	<img src="/admin/services/captcha" alt="" id="captcha" />

	
	<label>
	קוד אימות
	</label>
	<input name="captcha_enabled" type="hidden" value="1" >
	<input name="captcha" type="text" id="captcha" class="captcha" >
	<br>


		

		

		<Br>	
						
			
			
			' ;
			
			
		} else $captcha_code = '' ;

		
		
		if ($form==1) $form = '' ; 
			
		$attributes = array('class' => 'contact-form', 'id' => 'myform' . $form , 'data-ajax' => 'false');
		$form_open =  form_open("admin/forms",$attributes);
		 
		
		
			$form = $form_open . form_hidden('current_url', current_url() ) .
			form_hidden('source_id', $source ) .   '
			
			
			<p class="antispam">Leave this empty:
			<br /><input name="url" /></p>			
			
		
			<label>שם (*)</label>
			<input id="name" name="name" class="required" type="text" /> 
			<br>
			
			<label>אימייל (*)</label>
			<input id="email" name="email" class="required email" type="text" /> 
			<br>

			<label>טלפון (*)</label>
			<input id="phone" name="phone" class="required"  type="text" /> 
			<br>
			
			' . $subject  . '

			
			<label>הודעה</label>
			<textarea id="message" name="message"></textarea>
			<br>'
			
			. $captcha_code .
			
			
			'

			<label>&nbsp;</label>
			* - שדות חובה
			<br><br>


			<label>&nbsp;</label>
			<input type="submit" id="submit" value="שלח" class="submit"/>
			
			
			</form>
					
		
		
		' ; 
		
		$output = $form ; 
		   				
		return $output;
	}

	

	
	// ------------------------------------------------------------------------
	/**
	 * gallery function.
	 * This function show that you can load data and retun partial
	 * view which will replace the string.
	 */
	function gallery($attrs)
	{		
		extract($this->merge_attrs(array(
			'id'  => '0',
			'template' => 'other'
		), $attrs));
		
		// shouldn't be hardcoded here in real life...
		$images[] = array('alt' => 'picture 1', 'link' => 'http://farm5.static.flickr.com/4144/4947787901_c9e1c921d7_t.jpg');
		$images[] = array('alt' => 'picture 2', 'link' => 'http://farm4.static.flickr.com/3136/3024106895_54c2c097e8_t.jpg');
		$images[] = array('alt' => 'picture 3', 'link' => 'http://farm5.static.flickr.com/4153/4947642587_3f64204647_t.jpg');
		$images[] = array('alt' => 'picture 4', 'link' => 'http://farm5.static.flickr.com/4136/4904782732_bb99d8d153_t.jpg');
		$data['images'] = $images;
		$data['title'] = 'gallery with id '.$id. ' and template file ' .$template. '.php';
		
		$view_file = APPPATH.'views/galleries/'.$template.'.php';
		
		if (file_exists($view_file) && is_file($view_file))
		{
			$output = $this->ci->load->view('galleries/'.$template, $data, true);
			return $output;
		}
		
		return 'Template Not Found!!';
	}
	
}
?>