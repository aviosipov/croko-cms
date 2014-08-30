<?php


class Articles extends CI_Controller {


	function Articles()
	{
		
		parent::__construct();		
		$this->load->library('posts_parser');
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Gallery') ;
	}
	
	
	
	function search() {
		
		$text = $this->input->post('title')  ;
		$this->all($text) ;  
		
		
	}
	
	
	
	function catgallery($desc) {
		
		
		// used for created a article gallery - displaying thumbnail + title
		// for each article 
		
		
		$this->load->model('site/Content') ;
		
		$site = $this->Content->get_site() ;


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		
		
		
		$data['site'] = $site ;  
		
		

		
	
		$data['article_list'] = $this->Content->get_article_categories_by_description($desc) ;


		
		$this->load->view('site/cms/block-editor') ;								
		$this->load->external_view( "./templates/$site->template/" , 'article-cat-gallery',$data);
			
	


		
	}
		
	
	function gallery($id) {
		
		// used for created a article gallery - displaying thumbnail + title
		// for each article 
		
		
		$this->load->model('site/Content') ;
		$site = $this->Content->get_site() ;


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		$data['site'] = $site ;

		
	
		$data['article_list'] = $this->Content->get_articles_by_category($id) ;


		$this->load->view('site/cms/article-editor') ;				
		$this->load->external_view( "./templates/$site->template/" , 'article-gallery',$data);
			
	
	
	
	}
	
	
	function category($id) {
		
		
		
		$this->load->model('site/Content') ;
		$site = $this->Content->get_site() ;


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;
		
		
		
		$data['category'] = $this->Content->get_article_category($id) ; 

		
	
		$data['article_list'] = $this->Content->get_articles_by_category($id) ;


		$this->load->view('site/cms/article-editor') ;
						
		
		if ($site->template==1) $this->load->view('papa/articles',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'articles',$data);
		
		
		
		
	}
	
	
	
	function index () {
		
		
		
		$this->load->model('site/Gallery') ;
		
		$this->load->model('site/Content') ;
		$site = $this->Content->get_site() ;		
		$id = $this->uri->segment(2) ;
		$article = $this->Content->get_article(urldecode ( $id)) ;		
		$seo_data = $this->Content->get_seo($article) ;
		
		
		if (!$article) $data['not_found'] = 1 ; 
		 
		 		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;
		
		
		
		
		
				
				
		$data['article'] = $article ;
		$data['category'] = $this->Content->get_article_category($article->article_category_id) ; 
		  


		$data['enable_cms'] = $this->load->view('site/cms/aloha',$data,true) ;						 
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',$data,true) ; 						

		$this->load->view('site/cms/article-editor') ; 
		
		
		
		if ($site->template==1) $this->load->view('papa/article',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'article',$data);
		

		
	}
	
	
	function all($search='') {
		
		
		$this->load->model('site/Content') ;
		$site = $this->Content->get_site() ;


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;

		
		if ($search) $data['article_list'] = $this->Content->get_article_list(0,'',$search) ;
		else $data['article_list'] = $this->Content->get_article_list() ;
		
		


		$this->load->view('site/cms/article-editor') ;				

		 
		if ($site->template==1) $this->load->view('papa/articles',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'articles',$data);



		
	}
	
	
	
}




?>