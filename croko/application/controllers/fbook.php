<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fbook extends CI_Controller {
	
	// mobile access for pages/and other content controller 
	
	
	

	public function __construct() {
				
        parent::__construct();
		
		$this->load->library('posts_parser');
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;
														
				
	}
	
	
	function index() {
		
		
		
		$page = $this->uri->segment(2) ;

		
		// loads content page, i.e : MyDomain.Com/Pages/About
		// uses the 'page.php' template file 
		
		
		$page_content = $this->Content->get_page_by_url($page) ;				
		$seo_data = $this->Content->get_seo($page_content) ;		 
		$site = $this->Content->get_site() ; 
		
		
		$data['page'] = $page_content ;  	
		$data['site'] = $site ; 
			
		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		
		 						

		//$data['enable_cms'] = $this->load->view('site/cms/aloha',$data,true) ; 
		//$data['editor_menu'] = $this->load->view('site/cms/editor-menu',$data,true) ;
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ; 						
		
		 
		  
		  
		  
		 
		$this->load->view('site/cms/page-block-editor') ;		 
		$this->load->view('papa/facebook/page',$data);
		
	

		
		 
		
		
		 
	}
	
	

	
	
	
	
}
	