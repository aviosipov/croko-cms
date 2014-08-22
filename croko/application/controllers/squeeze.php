<?php


class Squeeze extends CI_Controller {
	

	
	function index() {
		
		// loads content page, i.e : MyDomain.Com/Pages/About
		// uses the 'page.php' template file 
		
				
		$this->load->model('site/Content') ;
		
		$page = $this->uri->segment(2) ;		
		$seo_data = $this->Content->get_seo($page_content) ; 
		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ; 
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ; 						

		$this->load->view('site/cms/block-editor') ; 
		$this->load->external_view( "./" , "/squeeze/$page",$data);
		 

		
		
	}

	
	function thanks() {
		
		
		echo "thank you!" ; 
		
		

		
		
		
	}
	

	
	
}




?>