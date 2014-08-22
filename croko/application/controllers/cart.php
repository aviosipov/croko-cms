<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {
	
	// mobile access for pages/and other content controller 
	
	
	

	public function __construct() {
				
        parent::__construct();
		
		$this->load->library('posts_parser');
		$this->load->model('site/Content') ;
		$this->load->model('site/Gallery') ;
											
		$this->load->library('cart');
		
		
		
				
	}
	
	
	function index() {
		
		

		
		
		
		$seo_data = $this->Content->get_seo($page_content) ;		 
		$site = $this->Content->get_site() ; 
		
		
		$data['site'] = $site ; 
			
		
		$data['meta_title'] = $seo_data['title'] ;
		$data['meta_keywords'] = $seo_data['keywords'] ;
		$data['meta_description'] = $seo_data['description'] ;
		
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',$data,true) ; 
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',$data,true) ;
		
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ; 						

		 
				 
		 
		$this->load->view('site/cms/page-block-editor') ;
		
		 
		
		if ($site->template==1) $this->load->view('papa/cart',$data);
		else $this->load->external_view( "./" , 'cart',$data);
		
				 

		
		 
		
		
		 
	}
	
	
	function update() {
		
		

		
		
		$data = json_decode($_POST['myJson'], true);
		$res = $this->cart->update($data);		
	
		echo 'ok' ;
		 
		 
		
	}
	
	
	function show() {
		echo 'show' ; 
	}
	
	function remove($id ) {

		$data = array(
		               'rowid' => $id,
		               'qty'   => 0
		            );
		
		$this->cart->update($data); 		
		 redirect('cart ') ; 
		
		
	}

	function add($id , $qty = 1 , $size = '' )  {
		
		// add item to shopping cart cart. item is defines by 
		// article id. 
		
		$item = $this->Content->get_article($id) ;

		
		$data = array(
		               'id'      => $item->id,
		               'qty'     => $qty ,
		               'price'   => $item->custom1,
		               'name'    => 'title' , 
		               'options' => array('size' => $size )
		               
		            );
		
		$this->cart->insert($data);
		
		redirect('cart ') ; 
				
		
		 
	}
	
	
	
}
	