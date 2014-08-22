<?php


class Search extends CI_Controller {

	function Search()
	{
		
		parent::__construct();		
		$this->load->library('posts_parser');
		$this->load->model('site/Newsm') ;

		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;
		
	}
	
	

	
	function index() {
		
		
//		$param = 'ענת' ;
		

		$site = $this->Content->get_site() ;


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;
		$data['site'] = $site ;

		
	
		
		
		$res = $this->Content->Search('בריאות') ;
		$data['article_list'] = $res ;


		$this->load->view('site/cms/article-editor') ;				

		 
		if ($site->template==1) $this->load->view('papa/articles',$data);
		else $this->load->external_view( "./" , 'articles',$data);


		
		
		
		 
	}
	
	
}


?>