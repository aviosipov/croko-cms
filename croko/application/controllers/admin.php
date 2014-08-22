<?php


class Admin extends CI_Controller {
	
	 
	
   	
	public function __construct() {
				
        parent::__construct();		
		$this->load->model('site/Content') ;
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Gallery') ;
		
		$this->load->library('form_validation');
		
						
		
	}


	
	
	function password($type,$id) {


		$this->load->model('site/Content') ;
        $this->form_validation->set_rules('password', 'password', 'required');
		

        if ($this->form_validation->run() == FALSE)
        {
		
			
	
		
		
		
		
			$data['type'] = $type ; 
			$data['id'] = $id ;
		
		 	$this->load->view('site/messages/password', $data ) ;
	
			
		} else {
			
			
			
			if ($type=='page') $content = $this->Content->get_page_by_id($id) ; 
			else $content = $this->Content->get_article($id) ;
					
			
			if ($this->input->post('password') == $content->password) { // pass ok			
			
				$this->session->set_userdata('page_password',$this->input->post('password'));
				redirect('/' . $content->url ) ;  
				
			} else redirect ('/admin/password/' . $type .'/' . $id) ;
			
		} 
		
	
	}
	
	
	
	
	
	
	function clearpage($id) {
		
		// used to clear page format and remove html junk
		
		$this->Content->clear_page($id) ;
		redirect ("admin/ok") ;			
		
		
	}
	
	
	function showblocks() {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$data['title'] = 'רשימת קטעי תוכן באתר' ; 
		$data['content_blocks'] = $this->Content->get_content_list() ;
		 
		$this->load->view('site/content_block_list',$data) ;		
		
		
	}
		
		
		
	function deletecontent($id) {

		if (!$this->User->is_logged_in())  redirect('/'); 


		$this->Content->delete_content($id) ;
		redirect ("admin/ok") ;				
		
	}
		
		
		 
   	
	
	
   
	
	
	
	
	
	
	function ok() {
		
		$data['title'] = 'ברוכים הבאים למערכת הניהול' ; 
		$data['content'] = '' ; 			
		
		$this->load->view('site/ok',$data ) ;		
		
		
	}
	
	
	
	function help() {
		

			
		$data['title'] = 'ברוכים הבאים למערכת הניהול' ; 
		$data['content'] = '' ; 			
		
		$this->load->view('site/help',$data ) ;		
		
		
	}
	
	
	function customform() {
		
		// run trough all post array elements and create a message text containing 
		// only the filled fields. 
		
				        
        $this->form_validation->set_rules('name', 'name', 'required');
		

		$msg = '' ; 
		
		
		
		
		

		if($_POST)
        {
        	
            foreach($_POST as $k => $v)
            {
            	
				if ($this->input->post($k))
				$msg = $msg . $k . ' : ' . $this->input->post($k) . '<br />'; 				                
            }
			
			
			
			$form_header = $this->input->post('form_header') ; 
			$form_footer = $this->input->post('form_footer') ;
			
        	
			
			$site= $this->Content->get_site() ; 
		
			$this->load->library('autoresponder') ;
			
			$this->autoresponder->to_email($site->contact_email);
			$this->autoresponder->to_name($site->owner_name);
			
			$this->autoresponder->variable_values(array('owner_name' => $site->owner_name ,'message' => $msg . ',' . $site->name , 
			'form_header' => $form_header , 'form_footer' => $form_footer ));			
			$this->autoresponder->send('new_lead_short');
			 

			 
			
			redirect ("/thanks") ;
		
		} 













		 

		
	}
	
	
	function forms () {
		
		 
		
        $this->form_validation->set_rules('name', 'name', 'required');		

		// check for captcha code ..
		
		$code_ok = 1 ;  
	
		if ($this->input->post('captcha_enabled') ==1 ) {
			
			session_start();	
	
			if( @strtolower($this->input->post('captcha')) == strtolower($_SESSION['random_number']))
			$code_ok  =1 ; else $code_ok  = 0 ;  
							
		}
		
		
		
		$spam = 0 ; 
		
		if (strpos($this->input->post('name'), '[url=') != FALSE ) $spam = 1 ;
		if (strpos($this->input->post('email'), '[url=') != FALSE ) $spam = 1 ;
		if (strpos($this->input->post('phone'), '[url=') != FALSE ) $spam = 1 ;
		if (strpos($this->input->post('message'), '[url=') != FALSE ) $spam = 1 ;
		
		
		// anti spam protection 
		
    	if ($this->input->post('url')) $spam = 1 ; 
		
		
        if ($this->form_validation->run() == true && $code_ok==1 && $spam == 0 )
        {
        	
		
			
			
			// add lead to getcontrol account ... 
			
			$source_id = $this->input->post('source_id') ;			
			$info = '' ; 

			
			// send notificaiton mail ...		
        	
			$this->load->library('autoresponder') ;
			$site= $this->Content->get_site() ;
			$current_url = '<br>התקבל מהכתובת : ' . $this->input->post('current_url') ;
			if ($this->input->post('subject')) $subject = $this->input->post('subject') ; else $subject = '' ;  

			

			$this->autoresponder->to_email($site->contact_email);
			$this->autoresponder->to_name($site->owner_name);

			$this->autoresponder->reply_email($this->input->post('email')) ; 
			$this->autoresponder->reply_name($this->input->post('name')) ; 			
			 
			
			
			$this->autoresponder->variable_values(array('owner_name' => $site->owner_name , 'name' => $this->input->post('name') , 'email' => $this->input->post('email') , 
			'phone' => $this->input->post('phone') , 'subject' => $subject , 'message' => $this->input->post('message') . ',' . $site->name . $current_url . $info));
			
			$this->autoresponder->send('new_lead');
			
			
			
			 
			
			if ($this->input->post('mobile_form')) redirect ("mobile/page/thanks") ; 
			else redirect ("/thanks") ;
			
			
		
		} 
		
	}
	
	

	function mobilesettings() {

		
		// user for general site setup. elemnt dimensions, style 
		// and more.

		if (!$this->User->is_logged_in())  redirect('/'); 
		


		$this->load->library('upload');
        $this->load->library('form_validation');		
        $this->form_validation->set_rules('articles-default-image', 'required');
		
		
		

        if ($this->form_validation->run() == FALSE)
        {

			
			$data['mobile_settings'] = unserialize( $this->Content->get_mobile_settings() ) ;  
			$data['title'] = 'הגדרות mobile web' ;
			
			
			$this->load->view('site/mobile-settings',$data ) ;
			
			
			
			
			
		} else 	{
			
			/* generate templates settings array ... */
			
			$data = array();
			
			 
			if($_POST) {
	        	
	            foreach($_POST as $k => $v) 
	            	$data["$k"] = $this->input->post($k) ; 
				
			}
			
			 
			
			
			/* save array to database ... */
			
			$this->Content->save_mobile_settings( serialize($data) ) ; 		 
			redirect ("admin/mobilesettings") ; 
		
			

			
			
			
				
		}	



		
	}
	
	
	function shortcodes() {
		
		// used to guide the user in system
		// short codes .. 
		
		if (!$this->User->is_logged_in())  redirect('/'); 
		  
		$data['title'] = 'קודים וקיצורים במערכת ניהול' ;
		$this->load->view('site/shortcodes',$data ) ;		
		
		
	}
	
	function designsettings() {
		
		// user for general site setup. elemnt dimensions, style 
		// and more.
		
		if (!$this->User->is_logged_in())  redirect('/'); 

		$this->load->library('upload');
        $this->load->library('form_validation');		
        $this->form_validation->set_rules('page-pic-width', 'page-pic-width', 'required');
		
		
		

        if ($this->form_validation->run() == FALSE)
        {

			
			$data['style'] = unserialize( $this->Content->get_design_settings() ) ;  
			$data['title'] = 'הגדרות עיצוב אתר' ;
			$data['site'] = $this->Content->get_site() ;
			
			$this->load->view('site/design-settings',$data ) ;
			
			
			
			
			
		} else 	{
			
			/* generate templates settings array ... */
			
			$data = array();
			
			 
			if($_POST) {
	        	
	            foreach($_POST as $k => $v) 
	            	$data["$k"] = $this->input->post($k) ; 
				
			}
			
			 
			
			
			/* save array to database ... */
			
			$this->Content->save_design_settings( serialize($data) ) ; 		 
			redirect ("admin/designsettings") ; 
		
			

			
			
			
				
		}	

		
		
				
		 
		
		
	}


	function crop ($file,$width=1,$height=1) {
		
	if (!$this->User->is_logged_in())  redirect('/'); 
		// internal corp tool ...
		
		$data['file'] = $file ; 
		$data['width'] = $width ;
		$data['height'] = $height ;
		$data['title'] = 'חיתוך תמונה' ; 		
		
        $this->form_validation->set_rules('w', 'w', 'required');
		
		
		

        if ($this->form_validation->run() == FALSE)
        {		
		
			

			
			 
			$this->load->view('site/crop',$data ) ;
			
			
			
			
		} else {
			
			
			// crop image
						
			$targ_w = $_POST['w'] ; 
			$targ_h = $_POST['h'];			
			
			$jpeg_quality = 95;
			
			$src = 'gallery/' . $file;
			$img_r = imagecreatefromjpeg($src);
			$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
			
			imagecopyresampled($dst_r,$img_r,0,0,$_POST['x1'],$_POST['y1'],
			    $targ_w,$targ_h,$_POST['w'],$_POST['h']);
			
			
			
			
			
			// write file (overwrite the original file ..)									
			imagejpeg($dst_r, $src, $jpeg_quality);			
						
			// show the cropped file ..
			$this->load->view('site/crop',$data ) ;
			
			
		} 
			
		
			
					
		
	}
	
	
	function generator() {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		// used for the template (papa template) generator. generaes style
		// settings, logo positions ect'.
		
		

		$this->load->library('upload');
        $this->load->library('form_validation');		
        $this->form_validation->set_rules('logo_position', 'logo_position', 'required');
		
		
		

        if ($this->form_validation->run() == FALSE)
        {

			
			$data['style'] = unserialize( $this->Content->get_template_style() ) ;  
			$data['title'] = 'מחולל התבניות' ;
			$data['site'] = $this->Content->get_site() ;
			
			$this->load->view('site/generator',$data ) ; 
			 
			
			
			
			
		} else 	{
			
			/* generate templates settings array ... */
			
			$data = array();
			
			 
			if($_POST) {
	        	
	            foreach($_POST as $k => $v) 
	            	$data["$k"] = $this->input->post($k) ; 
				
			}
			
			 
			
			
			/* save array to database ... */
			
			$this->Content->save_template_style( serialize($data) ) ; 		 
			redirect ("admin/generator") ; 
		
			

			
			
			
				
		}	



		 		
		
		
	}
	
	
	function settings() {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$this->load->library('upload');
        $this->load->library('form_validation');		
        $this->form_validation->set_rules('site_name', 'site_name', 'required');
		
		
		$site = $this->Content->get_site() ;

        if ($this->form_validation->run() == FALSE)
        {

			
			 
			$data['title'] = 'הגדרות כלליות לאתר' ;
			$data['site'] = $site ; 
			
			$this->load->view('site/site_settings',$data ) ;
			
			
			
			
			
		} else 	{
			
			
			if (  $this->upload->do_upload())
			{
				
				if (file_exists("gallery/$site->logo") && $site->logo ) unlink("gallery/$site->logo") ;	
				
				
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;								
			}				
			
		
			$this->Content->save_settings ( $this->input->post('site_name') , $this->input->post('owner_name') , $this->input->post('site_description') , 
			$this->input->post('contact_email') , $this->input->post('online') , $this->input->post('site_url') ,
			$this->input->post('meta_title') , $this->input->post('meta_keywords') , $this->input->post('meta_description') ,
			$this->input->post('head_scripts') ,  $this->input->post('thanks_scripts') , $file_name , $this->input->post('google_analytics_code') ) ;
			
			
			    
			  
			 
			redirect ("admin/ok") ; 
		
			

			
			
			
				
		}	



		 
		
		
	}
	



	function clear($param='page', $id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		if ($param=='page') {
			
			
			$this->Content->empty_page($id) ; 
			
			redirect ( "") ; 
		}
		
		
		
		/*
		if ($param=='article') {
			
			
			$this->Content->delete_article($id) ; 
			
			//redirect ("articles") ;
			redirect ("/") ; 
		}
		*/
		
		
	}


	
	
	function delete($param='page', $id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		
		if ($param=='page') {
						
			$this->Content->delete_page($id) ; 			
			redirect ("/admin/page_list") ; 
		}
		
		
		if ($param=='article') {
			
			
			$this->Content->delete_article($id) ; 			
			redirect ("/admin/article_list") ; 
			
		}
		
		
		
	}












	function editck($param='page',$id) {
		
		// load page or content in html editor .... 

		if (!$this->User->is_logged_in())  redirect('/'); 


		$data['title'] = 'עורך תוכן' ;
		$data['id'] = $id ; 
		$data['param'] = $param ;


		$data['custom_script'] = array( 'ckeditor/ckeditor.js' , 'ajax.js' , 'ckedit.js'  )  ; 			
		
		switch ($param) {
			
			case 'page' :

				$page = $this->Content->get_page_by_id($id) ; 
				
				$data['title'] = $page->title ; 
				$data['current_module'] = 'pages' ; 
				$data['content'] = $this->Content->get_page_content_by_id($id) ;
				break;
				
			case 'article':

				$article = $this->Content->get_article($id) ; 
				 
				$data['title'] = $article->title ; 
				$data['current_module'] = 'articles' ;
				$data['content'] = $this->Content->get_article_content_by_id($id) ;
				break; 
				
			case 'block' :
				
				$data['content'] = $this->Content->get_content_by_id($id) ; 					
				break ; 
				
			case 'file' :
				
		} 
		

		 
		$this->load->view('site/ck_editor',$data) ;		
				
							
			
		
		
		
		 
		

			
		
		
	}
	













	
	
	
	function edithtml($param='page',$id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		// load page or content in html editor .... 
		
        $this->form_validation->set_rules('content', 'content', 'required');
		
		
		
				
		

        if ($this->form_validation->run() == FALSE)
        {
        	
	
			$data['title'] = 'עריכת קוד HTML' ;
			$data['id'] = $id ; 
			$data['param'] = $param ;
			
			switch ($param) {
				
				case 'page' :
					
					$data['content'] = $this->Content->get_page_content_by_id($id) ;
					break;
					
				case 'article':
					
					$data['content'] = $this->Content->get_article_content_by_id($id) ;
					break; 
					
				case 'block' :
					
					$data['content'] = $this->Content->get_content_by_id($id) ; 					
					break ; 
					
				case 'file' :
					
					
			/*		$filename = $id ;					
					$data['content'] = file_get_contents($filename . '.php') ;   
					 					
					break ; */  
				
			} 
			
	
			 
			$this->load->view('site/html_editor',$data) ;		
					
							
			
		} else {
			
			// save content (page/content block/article)

			
			switch ($param) {
				
				case 'page' :
					
					$this->Content->save_page_content($id,$this->input->post('content')) ;	
					break;
					
				case 'article':
					
					$this->Content->save_article_content($id,$this->input->post('content')) ;
					break; 
					
				case 'block' :
					
					$this->Content->save_content_by_id($id,$this->input->post('content')) ;	 					
					break ; 
				
			} 			
			
			
			
			
			
			
			redirect('admin/edithtml/' . $param . '/' . $id) ;
			
			
			 
			
		}		
		
		
		 
		

			
		
		
	}
	
	
	function edit($param='page', $id) {

if (!$this->User->is_logged_in())  redirect('/'); 
		
        		
        $this->form_validation->set_rules('title', 'title', 'required');
		$design_settings = unserialize( $this->Content->get_design_settings() ) ;
		
		
		  
		
		
		
		
		// image upload preperations 
		
		$config['upload_path'] = 'gallery';
		$config['allowed_types'] = 'gif|jpg|png|JPG|PNG|GIF';
		$config['max_size']	= '4950';
		$config['max_width']  = '5524';
		$config['encrypt_name'] = 'true' ; 
		//$config['max_height']  = '1268';
		
		$this->load->library('upload', $config);
		
		
		

        if ($this->form_validation->run() == FALSE)
        {
        	
			if ($param=='page') {

				$data['title'] = 'עריכת עמוד' ; 
				$data['current_module'] = 'pages' ; 
				$data['page'] = $this->Content->get_page_by_id($id) ;
				
				
				$page_list = $this->Content->get_parent_page_list() ;
				$page_list = db_2_array ( $page_list , 'id','title' , 'ללא') ;
				
				
				 
				 							             				
				$data['page_list'] = $page_list ; 
				
				
				
				 
				$this->load->view('site/edit_page',$data) ;

				
			} else { // article 
				
				
				$article_cat_list = $this->Content->get_article_categories() ;
				$article_cat_list = db_2_array ( $article_cat_list , 'id','title' , 'ללא') ;
				
				
				 
				 							             				
				$data['article_cat_list'] = $article_cat_list  ;
				 				
				
				$data['design_settings'] = $design_settings ; 
				$data['title'] = 'עריכת מאמר' ; 
				$data['article'] = $this->Content->get_article($id) ;
				 
				$this->load->view('site/edit_article',$data) ;				
				
			}
			
			
		} else 	{
			
			
			// handle file upload 

			if (  $this->upload->do_upload())
			{
				
				
				if ($param=='page') $content = $this->Content->get_page_by_id($id) ;
				else $content = $this->Content->get_article($id) ; 
				

				if (file_exists("gallery/$content->img") && $content->img) unlink("gallery/$content->img") ;
				
				
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;
				
				
				
				
			}				
			
			if ($param=='page') {
				
				
				// resize in neeeded
				
				if ($file && $design_settings['page-pic-width']) resize_img($file,$design_settings['page-pic-width'],$design_settings['page-pic-height']) ; 
				
			
				$this->Content->update_page ($id , $this->input->post('title') ,  $this->input->post('menu_title') , $this->input->post('url') , 
				$this->input->post('meta_title') , $this->input->post('meta_description') , $this->input->post('meta_keywords') , 
				$this->input->post('order') , $this->input->post('parent') , $this->input->post('published') , $this->input->post('show_in_menu') ,  
				$file_name , $this->input->post('password')	, $this->input->post('template') , $this->input->post('mobile') ,
				$this->input->post('custom1') , $this->input->post('custom2') , $this->input->post('custom3') , $this->input->post('custom4') ) ;
				
				$url =  $this->input->post('url') ; 
				

				redirect ("admin/edit/page/" . $id ) ;
				
			} else {
				
				
				// resize in neeeded
			
				if ($file && $design_settings['article-pic-width']) resize_img($file,$design_settings['article-pic-width'],$design_settings['article-pic-height']) ;
				
				
				
				
				$this->Content->update_article ($id , $this->input->post('title')  , $this->input->post('url') , $file_name ,  
				$this->input->post('meta_title') , $this->input->post('meta_description') , $this->input->post('meta_keywords') , 
				$this->input->post('article_category_id') , $this->input->post('short') , $this->input->post('order') , 
				$this->input->post('password') , $this->input->post('template') , 
				$this->input->post('custom1') , $this->input->post('custom2') , $this->input->post('custom3') , $this->input->post('custom4')   ) ;
				
				redirect ("admin/edit/article/" . $id ) ;
			} 
			
			
			
			
				
		}	

		
		
	} 

	
	
	function add ( $param = 'page' , $status = '') {
		
		
		if (!$this->User->is_logged_in())  redirect('/'); 
		
        $this->load->library('form_validation');		
        $this->form_validation->set_rules('title', 'title', 'required');
		
		$design_settings = unserialize( $this->Content->get_design_settings() ) ;
		

		// image upload preperations 
		
		$config['upload_path'] = 'gallery';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '4950';
		$config['max_width']  = '4524';
		$config['encrypt_name'] = 'true' ; 
		$config['max_height']  = '1268';
		
		$this->load->library('upload', $config);

		
		

        if ($this->form_validation->run() == FALSE)
        {

			
			$data['param'] = $param ; 
			
			if ($param=='page') {
				
				$data['title'] = 'הוספת עמוד תוכן חדש' ;				
				$data['custom_script'] = array('new-page.js')  ;  
				$data['current_module'] = 'pages' ; 

				if ($status=='ok') $data['status'] = 'שמרתי את הדף, עכשיו אפשר להוסיף דף חדש או <a href="/admin/page_list"> לערוך </a> את רשימת העמודים.' ; 
 				$this->load->view('site/new_page',$data) ;
			} 
			
			else {

				/// check for category preset in new article request 
				////////////////////////////////////////////////////

				if ($this->input->get('category')) {
			
					$category = $this->Content->get_article_category($this->input->get('category')) ; 								
					$data['category_title'] = $this->input->get('category') ; 

			 		if ($category) $data['category_id'] = $category->id ; 
			 		else {

			 			// category not found ... create one so we can use it 
			 			$new_id = $this->Content->add_article_category($this->input->get('category'),'') ; 
			 			$data['category_id'] = $new_id ; 			 			

			 		}
		
				}

				
				

				$data['title'] = 'הוספת מאמר חדש' ;				
				$data['custom_script'] = array('new-article.js')  ;  
				$data['current_module'] = 'articles' ; 
				if ($status=='ok') $data['status'] = 'שמרתי את מאמר, עכשיו אפשר להוסיף מאמר חדש או <a href="/admin/article_list"> לערוך </a> את רשימת המאמרים.' ; 
				
				$article_cat_list = $this->Content->get_article_categories() ;
				$article_cat_list = db_2_array ( $article_cat_list , 'id','title' , 'ללא') ;
				$data['article_cat_list'] = $article_cat_list  ; 									
				
				
				
				$this->load->view('site/new_article',$data) ;
			}
			
			
			
			
			
			
			
		} else 	{


				
			$file_name = '' ; 


			if (  $this->upload->do_upload())
			{
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;								
			}

			
			if ($param=='page') {
				
				// resize if needed
				if ($file && $design_settings['page-pic-width']) resize_img($file,$design_settings['page-pic-width'],$design_settings['page-pic-height']) ; 
			
			
				$this->Content->add_page ($this->input->post('url') ,  $this->input->post('title') , $file_name ) ;
				
				$url =  $this->input->post('url') ; 
				//redirect ( "$url") ; 
				
				redirect ("admin/add/page/ok") ;
			
			}
			
			if ($param=='article') {
					
				
				// resize if needed					
				if ($file && $design_settings['article-pic-width']) resize_img($file,$design_settings['article-pic-width'],$design_settings['article-pic-height']) ;
				
				
				

				$this->Content->add_article ($this->input->post('url') ,  $this->input->post('title') , $file_name ,
				$this->input->post('article_category_id')	) ;

								
				//redirect ( "articles") ;
				if ($this->input->get('category')) redirect ("admin/add/article/ok?category=" . $this->input->get('category')) ; 
				else redirect ("admin/add/article/ok") ; 

				
			}
			
			
			
				
		}	
		
		
		
	}
	
	
	
	
	function show($page='') {
		
		

		
		$data['page'] = $this->Content->get_page_by_url($page) ;
		$data['menu'] = $this->Content->get_menu() ;
				 		
		$this->load->view('site/page',$data) ;
		
	
	}
	
	

	
	
	function home() {
		
		
		$this->form_validation->set_rules('name', 'name', 'required');
		
		
		
		$data['page'] = 0 ; 
		
		$data['menu'] = $this->Content->get_menu() ;		 		
		$this->load->view('site/home',$data) ;
		
		
	}
	
	
	
	function page_list() {
		
		if (!$this->User->is_logged_in())  redirect('/'); 


		$data['title'] = 'רשימת העמודים באתר' ; 
		$data['current_module'] = 'pages' ; 
		$data['page_list'] = $this->Content->get_page_list() ;		
		$data['custom_script'] = array( 'ajax.js' , 'page.js'  )  ; 
		 

		$this->load->view('site/page_list',$data) ;
		
		
	}
	
	
	function article_list($category = '') {


		
		if (!$this->User->is_logged_in())  redirect('/'); 

		$cat = '' ; 


		if ($category != '') {			

			$cat = $this->Content->get_article_category($category) ; 
			if (!$cat) $cat->id = -1 ;  // if category doesnt exsit we cant find artices
						
			$data['category'] = $category ; 			
			$data['title'] = $category ; 

		} else $data['title'] = 'כל המאמרים' ; 

		$data['current_module'] = 'articles' ; 
		$data['article_list'] = $this->Content->get_article_list(0,$cat->id,'','all') ;
		$data['category_list'] = $this->Content->get_article_categories() ;
		$data['custom_script'] = array( 'ajax.js' , 'article.js'  )  ; 
		 
		$this->load->view('site/article_list',$data) ;
		
		
	}	
	
	
	function edit_article_category($id) {
		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$this->load->library('upload') ;				
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', 'title', 'required');
		
		$category = $this->Content->get_article_category($id) ;


        if ($this->form_validation->run() == FALSE)
        {
            
			$data['category'] = $category ; 
			$data['title'] = 'עריכת קטגוריה' ; 									
			 
            $this->load->view('site/article_cat_edit' , $data ) ;


        } else
        {
        	
			

			$file_name = '' ; 

			if (  $this->upload->do_upload())
			{
				
				
				if (file_exists("gallery/$category->img") && $category->img) unlink("gallery/$category->img") ;
								
				
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;								
			}
			
                    
            $this->Content->update_article_category ($id ,  $this->input->post('title') , 
            $this->input->post('description')  , $file_name  ) ;
					

            redirect('admin/article_cat_list' );



        }


		
	}
	
	
	function delete_article_category($id) {

		if (!$this->User->is_logged_in())  redirect('/'); 

		
		$this->Content->delete_article_category($id) ; 
		
		redirect ("admin/article_cat_list") ; 
		
	}
	
	
	function article_cat_list() {
if (!$this->User->is_logged_in())  redirect('/'); 
		
        $this->load->library('form_validation');		
		$this->load->library('upload') ; 		
		
        $this->form_validation->set_rules('title', 'title', 'required');
		

        if ($this->form_validation->run() == FALSE)
        {


			$data['title'] = 'רשימת קטגוריות למאמרים' ; 
			$data['category_list'] = $this->Content->get_article_categories() ;
			 
			$this->load->view('site/article_cat_list',$data) ;			 

			
			
			
		} else 	{

			$file_name = '' ; 


			if (  $this->upload->do_upload())
			{
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;								
			}
			
			$this->Content->add_article_category ($this->input->post('title') ,  $this->input->post('description') , 
				$file_name ) ;			
				
			redirect ("admin/article_cat_list") ; 
			
				
		}			
		
		
		
		
		
		
		
	}
	
	
}



?>