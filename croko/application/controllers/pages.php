<?php


class Pages extends CI_Controller {

	function Pages()
	{
		
		parent::__construct();		

		$this->load->library('posts_parser');
		$this->load->model('site/Newsm') ;
		
		
		// new addition ... init file upload library for 
		// general use. 
		
		$config = array(
			'upload_path' 	=> 'tmp',
			'allowed_types' => 'gif|jpg|png|pdf|doc|docx',
			'encrypt_name'  => 'true' 
		);
		
		$this->load->library('upload', $config);		
	}
	
	

	
	function index() {
		
		
		
		// loads content page, i.e : MyDomain.Com/Pages/About
		// uses the 'page.php' template file 
		
				
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;
		
		$page = $this->uri->segment(1) ;		
		
		
		
		$page_content = $this->Content->get_page_by_url(urldecode($page)) ;
		
		
		/* if page not found  ... handle 404 eror .. */		
		if (!$page_content) $data['not_found'] = 1 ;   
		
		
		
		
		$seo_data = $this->Content->get_seo($page_content) ;		 
		$site = $this->Content->get_site() ; 
		
		
		$data['page'] = $page_content ;  	
		$data['site'] = $site ; 
			
		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',$data,true) ; 
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',$data,true) ;
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ; 						

		 
		if ($page_content->password!='' && $this->session->userdata('page_password')!=$page_content->password
		&& !$this->User->is_logged_in() ) {
			
			
			 redirect('/admin/password/page/' . $page_content->id );			
			 die() ;   
				
			
		}		 
		 
		$this->load->view('site/cms/page-block-editor') ;
		
		 
		
		if ($site->template==1) $this->load->view('papa/page',$data);
		else $this->load->external_view( "./templates/$site->template/"  , 'page',$data);
		
		
		
		
		
		
	}

	
	function home() {
		
		// this is the hompage, i.e :  MyDomain.Com
		// load the template file 'home.php' and use 
		// site meta tags.
							
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;										
		
		$site = $this->Content->get_site() ;
		
		
		$data['site'] = $site ;  
		
		
		$data['is_home'] = 1 ; 
		

		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		 		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ; 
				
		$this->load->view('site/cms/page-block-editor') ;		
		
		if ($site->template==1) $this->load->view('papa/home',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'home',$data);
		
		
		
	}



	function thanks() {
		
		// special function to tkae care google codes for squeeze pages
		// uses thanks_scripts instead of header_scripts to load home page. 
		
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;										
		$site = $this->Content->get_site() ; 
		
		
		$cmsdata['thanks_scripts'] = $site->thanks_scripts ;  


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',$cmsdata,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;


		$page_content->id = 'thanks' ;				
		$data['page'] = $page_content ;  		
		

		$this->load->view('site/cms/page-block-editor') ; 
		 




		if ($site->template==1) $this->load->view('papa/page',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'page',$data);



			 




		 
		
		
	}
	

	

	
	
}




?>