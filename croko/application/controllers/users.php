<?php


class Users extends CI_Controller {
	

    function  login()  {
    	
		
		if ($this->User->is_logged_in()) redirect('/') ;
		
		if ($this->config->item('site_id') > 0) $prefix = 'site/' ;
		else $prefix = '' ;  
		
		$this->load->library('form_validation'); 

        $this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		
		
		
		
        if ($this->form_validation->run() == FALSE)
        {
        	
	        $data['error'] = '' ;
			$data['title'] = 'כניסה למערכת' ;
        	$this->load->view($prefix . 'login',$data) ;	


        } else {
        	
			
			$user_ok = $this->User->check_user ( $this->input->post('username') , $this->input->post('password')  ) ;
			
			 
			
			if ($user_ok) {
							
				redirect('');
				
			}				
			else {
				
				$data['title'] = 'כניסה למערכת' ;
	        	$data['error'] = 'משתמש לא נמצא' . "<br><br>" ;
        		$this->load->view($prefix . 'login',$data) ;
			} 
							


        }
		
		
		
	
		
		
		
	}
	
	function logout() {
		
		$this->load->model('User') ;		
		$this->User->do_logout() ; 

		redirect('');
		
	}
	
	
}