<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {
	
	// mobile access for pages/and other content controller 
	
	
	

	public function __construct() {
				
        parent::__construct();
		
		$this->load->library('posts_parser');
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;
														
				
	}
	
	
	function index() {
		
		
		
		
		 
	}
	
	
	function myapp() {

		$site = $this->Content->get_site() ;
		$data['url'] = $site->site_url . '/mobile/app' ; 

		$this->load->view('papa/mobile/myapp',$data);
		


		
	}
	
	function app() {
		

	 
		$site = $this->Content->get_site() ;
		$app_settings  = unserialize ($this->Content->get_mobile_settings() )  ; 
		
		
		$data['site'] = $site ; 
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['app_settings'] = $app_settings ;   						

	
	
		if ($app_settings['gallery-id']  > 0 ) {
			
			$gallery_id = $app_settings['gallery-id'] ; 

			$data['gallery'] = $this->Gallery->get_gallery($gallery_id) ;
			$data['gallery_images'] = $this->Gallery->get_img_list($gallery_id) ; 
			$data['gallery_id'] = $gallery_id ;		

		}


		
		
		if ($app_settings['articles-category']  > 0 ) {
			
			
			$data['articles_category'] = $this->Content->get_article_category($app_settings['articles-category']) ;
			$data['article_list'] = $this->Content->get_articles_by_category($app_settings['articles-category']) ;
				
		}
		
				 
		
		$this->load->view('papa/mobile/app-page',$data);
		


		
	}
	
	function page($page = '') {
		


		
		
		// loads content page, i.e : MyDomain.Com/Pages/About
		// uses the 'page.php' template file 
		
		if ($page=='thanks') $page_content->id = 'thanks' ;
		else $page_content = $this->Content->get_page_by_url($page) ;
		

		
		$seo_data = $this->Content->get_seo($page_content) ;		 
		$site = $this->Content->get_site() ; 
		
		
		$data['page'] = $page_content ;  	
		$data['site'] = $site ; 
			
		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ; 						

		 
		if ($page_content->password!='' && $this->session->userdata('page_password')!=$page_content->password
		&& !$this->User->is_logged_in() ) {
			
			
			 redirect('/admin/password/page/' . $page_content->id );			
			 die() ;   
				
			
		}
		
				 
		 
		
		//if ($site->template==1) $this->load->view('papa/mobile/page',$data);
		//else $this->load->external_view( "./mobile/" , 'page',$data);
		
		$this->load->view('papa/mobile/page',$data);
		

		 
		
	}

	
	function articles($id = 0) {

		
		if ($id==0) $data['article_list'] = $this->Content->get_article_list() ;
		else {
			
			$data['category'] = $this->Content->get_article_category($id) ;
			$data['article_list'] = $this->Content->get_articles_by_category($id) ;
			
		}
		
		
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ; 						

		
		$this->load->view('papa/mobile/articles',$data);		
		
		
		
	}

	
	function article($id = 0) {


		
		if (!$article) $data['not_found'] = 1 ; 
		 
		 		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;
		
		
		
		
		
				
				
		$data['article'] = $article ;  

		
	}
	
	function gallery($id) {
		

		$gallery_id = $id ;
		$site = $this->Content->get_site() ;
		


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		
		$data['gallery'] = $this->Gallery->get_gallery($gallery_id) ;
		$data['gallery_images'] = $this->Gallery->get_img_list($gallery_id) ; 
		$data['gallery_id'] = $gallery_id ;
		
		$data['site'] = $site ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;  
		

		//if ($site->template==1) $this->load->view('papa/mobile/gallery',$data);
		//else $this->load->external_view( "./mobile/" , 'gallery',$data);		
		
		$this->load->view('papa/mobile/gallery',$data);
		 
		
	}
	
	
	
	
}
	