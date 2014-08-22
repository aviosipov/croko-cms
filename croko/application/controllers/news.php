<?php

class News extends CI_Controller {
	
   	
	public function __construct() {
				
        parent::__construct();		
		$this->load->model('site/Newsm') ;		
		
	}	
	
	
	function all() {
		
		$data['title'] = 'רשימת החדשות' ; 
		$data['list'] = $this->Newsm->get_all() ;
		 
		$this->load->view('site/news_list',$data) ;
				
		
		
	}
	
	
	
	function add() {
		
if (!$this->User->is_logged_in())  redirect('/'); 

        $this->load->library('form_validation');		
        $this->form_validation->set_rules('title', 'title', 'required');
		

        if ($this->form_validation->run() == FALSE)
        {

			 
			$data['title'] = 'הוספת עדכון חדשות' ;
			$this->load->view('site/new_news',$data ) ;
			
			

			
			
			
		} else 	{
			
			
			
			$this->Newsm->add ($this->input->post('title') ,  $this->input->post('content')) ;			
			redirect ("admin/news/all") ; 
			
				
		}	
		


		
		
	}
	
	
	function delete($id) {
		if (!$this->User->is_logged_in())  redirect('/'); 
		$this->Newsm->delete($id) ; 
		redirect ("admin/news/all") ;
		
	}
	
	function update($id) {
		if (!$this->User->is_logged_in())  redirect('/'); 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('title', 'title', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            
			$data['news'] = $this->Newsm->get($id) ;
			$data['title'] = 'עריכת חדשות' ; 									
			 
            $this->load->view('site/edit_news' , $data ) ;


        } else
        {
        	
			
            $this->Newsm->update ($id ,  $this->input->post('title') , $this->input->post('content')  ) ;
            redirect('admin/news/all' );



        }		
		
		
		
	}
	
	
}