<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Generator {
	
	var $ci;
	
	
	
	function Generator()
	{		
		$this->ci =& get_instance();
		
	}	
	
	

	
	
	function render_input($name,$title,$required = 0 , $value = '') {
		
		
		
		$data['name'] = $name ; 
		$data['title'] =htmlspecialchars ($title) ; 		
		$data['value'] = htmlspecialchars ( $value) ; 
		$data['type'] = 'text' ;
		
		if ($required==1) $data['required'] = 'required="required"' ;
		else $data['required'] = '' ;  		
		
		$this->ci->load->view('helpers/input', $data) ; 
		
	}
	
	function render_password($name,$title,$required = 0 , $value = '') {
		
		$data['name'] = $name ; 
		$data['title'] = $title ; 		
		$data['value'] = $value ; 
		$data['type'] = 'password' ;
		
		if ($required==1) $data['required'] = 'required="required"' ;
		else $data['required'] = '' ; 		
		
		$this->ci->load->view('helpers/input', $data) ; 
		
	}


	
	function render_input_file($name='userfile',$title='תמונה',$required = 0 , $value = '') {

		$data['name'] = $name ; 
		$data['title'] = $title ; 		
		$data['value'] = $value ; 
		if ($required==1) $data['required'] = 'required="required"' ; 		
		
		$this->ci->load->view('helpers/input_file', $data) ; 
		
	}
	
	function render_textarea ($name,$title,$required = 0,$value = '') {

		$data['name'] = $name ; 
		$data['title'] = $title ;
		$data['value'] = $value ; 		
		if ($required==1) $data['required'] = 'required="required"' ;
		else $data['required'] = '' ; 		
		
		$this->ci->load->view('helpers/textarea', $data) ; 
		
	}
	
	function render_checkbox ($name,$title,$required = 0,$checked = '') {
		
		 

		$data['name'] = $name ; 
		$data['title'] = $title ;
		
		if ($checked==1) $data['checked'] = 'checked=1"' ;
		 		
		if ($required==1) $data['required'] = 'required="required"' ;
		else $data['required'] = '' ; 
		
		
		
		$this->ci->load->view('helpers/checkbox', $data) ; 
		
	}
	

	
	function render_select($name,$title,$required = 0 , $default = '',$select_options) {

		
		$data['name'] = $name ; 
		$data['title'] = $title ; 		
		$data['default'] = $default; 
		$data['options'] = $select_options;
		
		
		if ($required==1) $data['required'] = 'required="required"' ;
		else $data['required'] = '' ;  		
		
		$this->ci->load->view('helpers/select', $data) ; 
		
	}		
	
	
	
	
	function render_submit ($title='שמור') {
		
		$data['title'] = $title ; 
		
		$this->ci->load->view('helpers/submit', $data) ;
	}
	
	
} // end of generator library

