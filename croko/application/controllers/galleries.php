<?php


class Galleries extends CI_Controller {
	
	
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('site/Content') ;
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Gallery') ;										

	}



	function show() {

		// load gallery by id , i.e : site.com/gallery/52

		$gallery_id = $this->uri->segment(2) ;
		$site = $this->Content->get_site() ;
		
		$gallery = $this->Gallery->get_gallery($gallery_id) ; 
		


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['gallery'] = $gallery ; 
		$data['gallery_images'] = $this->Gallery->get_img_list($gallery_id) ; 
		$data['gallery_id'] = $gallery_id ;
		
		if (!$gallery) $data['not_found'] = 1 ;
		
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',$data,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		
		
		$data['site'] = $site ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;  
		
		$this->load->view('site/cms/block-editor') ;			
		
		

		if ($site->template==1) $this->load->view('papa/gallery',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'gallery',$data);		

	}


	public function test() {

		$t = new DMGallery() ; 

	}


	function all(){


		// display all galleries
		
		$site = $this->Content->get_site() ;



		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		
		$data['gallery_list'] = $this->Gallery->get_gallery_list(1) ; // load only published galleries
		$data['title'] = 'גלריית תמונות' ;  


		$data['site'] = $site ;
		$data['template_style'] = unserialize ($this->Content->get_template_style() )  ;  

		
		$this->load->view('site/cms/block-editor') ;				



		if ($site->template==1) $this->load->view('papa/gallery-list',$data);
		else $this->load->external_view( "./templates/$site->template/" , 'gallery-list',$data);		


	}
	
	
	
	function index() {
		
		$site = $this->Content->get_site() ; 


		$data['meta_title'] = $site->meta_title ;
		$data['meta_keywords'] = $site->meta_keywords ;
		$data['meta_description'] =  $site->meta_description ;
		
		$data['enable_cms'] = $this->load->view('site/cms/aloha',0,true) ;
		$data['editor_menu'] = $this->load->view('site/cms/editor-menu',0,true) ;
		
		$this->load->view('site/cms/block-editor') ;				
		$this->load->external_view( "./templates/$site->template/" , 'gallery',$data);
		

		
	}
	
	
	function delgallery($id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		// delete all gallery images ..
		
		$img_list = $this->Gallery->get_img_list($id) ;

		
		foreach ($img_list->result() as $img ) {
			
			$image = $this->Gallery->get_gallery_image($img->id) ;
			
			// delete files ... 
			
			unlink("gallery/" . $image->filename) ; 
			unlink("gallery/thumbs/" . $image->filename ) ;

			$this->Gallery->delete_gallery_image($img->id) ; 			
			
			
		}

		
		// delete the gallery 
		

		$this->Gallery->delete_gallery($id) ; 			
		redirect ("galleries/addgallery") ; 		
		
		
	}
	
	
	function delimage($id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$image = $this->Gallery->get_gallery_image($id) ;
		
		
		
		// delete files ... 
		
		unlink("gallery/" . $image->filename) ; 
		unlink("gallery/thumbs/" . $image->filename ) ;
		

		$this->Gallery->delete_gallery_image($id) ; 			
		redirect ("galleries/addimage/$image->gallery_id/$image->custom1") ; 				
		
	}
	
	
	
	
	function addimage($gallery_id,$custom1 = '') {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		
		$gallery = $this->Gallery->get_gallery($gallery_id) ; 

		if ($gallery) $gallery_id = $gallery->id ; 
		else {

			// gallery does not exist, create one before use 

			if ($this->input->get('gallery_full_width')) $full_width = $this->input->get('gallery_full_width') ; 
			else $full_width = 960 ; 

			$gallery_id = $this->Gallery->add_gallery($gallery_id,'' , $full_width ) ;  


		}
		
		
		// image upload preperations 



		
		$config['upload_path'] = 'gallery';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '8250'; /* inspired by Liraz! */ 		
		$config['encrypt_name'] = 'true' ; 		
		
		$this->load->library('upload', $config);
		$this->load->library('form_validation');		
		$this->load->library('image_lib');
		
		
		$this->form_validation->set_rules('title', 'title', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{


			
			$data['img_list'] = $this->Gallery->get_img_list($gallery_id,0,$custom1) ; 
			$data['gallery_id'] = $gallery_id ; 
			$data['title'] = "ניהול גלריה" ;
			$data['custom1'] = $custom1 ; 
			$data['gallery'] = $this->Gallery->get_gallery($gallery_id) ;


			$data['CKEditorFuncNum'] = $this->session->userdata('CKEditorFuncNum'); 

			

			$data['custom_script'] = array( 'gallery.js' ,'pixler.js' )  ; 
			$this->load->view('site/new_gallery_img',$data ) ;
			
			
			
			
			
		} else 	{
			
			
			
			
			
			
			$file_path = '' ; 


			if ( ! $this->upload->do_upload())
			{

				$data['upload_errors'] = array('error' => $this->upload->display_errors());								
				echo  $this->upload->display_errors(); die() ; 

			}
			else
			{
				
				/* upload original image to server */ 
				
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;				
				$file_path = "gallery/" . $file_name ;
				
				$ratio = $file['image_width'] / $file['image_height'] ; ;
				
				
				
				/* Resize the original image - only if bigger than the 
				 * original size . */
				
				if ($file['image_width'] > $gallery->full_width ) { 

					$cfg2['image_library'] = 'gd2';
					$cfg2['source_image']	= $file_path ;				 									
					$cfg2['maintain_ratio'] = TRUE;

					
					$cfg2['width'] = $gallery->full_width ;
					$cfg2['height']	= $gallery->full_width / $ratio ; 

					$this->image_lib->initialize($cfg2);   												
					$this->image_lib->resize() ; 
					
				}

				

				/* create thumbnail image */    				
				
				$cfg['image_library'] = 'gd2';
				$cfg['source_image']	= $file_path ;
				$cfg['new_image'] = "gallery/thumbs/" . $file_name ; 

				$cfg['create_thumb'] = TRUE;
				$cfg['thumb_marker'] = '' ; 
				$cfg['maintain_ratio'] = TRUE;

				
				$cfg['width'] = $gallery->thumb_width ;
				$cfg['height']	= $gallery->thumb_width / $ratio ;  
				

				
				$this->image_lib->initialize($cfg);   												
				$this->image_lib->resize() ;
				
				
				
				


				$this->Gallery->add_gallery_img ($this->input->post('title') ,  $this->input->post('description') , $file_name , $gallery_id , 
					$this->input->post('custom1') , $this->input->post('custom2') ) ;

				redirect ("galleries/addimage/$gallery_id/$custom1") ;  



			}


		}	

		
		
		
	}


	function saveimage($id) {


		if (!$this->User->is_logged_in())  redirect('/'); 

		$remote_image = $this->input->get('image') ; 
		$new_image_title = $this->input->get('title') ; 

		// original image 
		$img =  $this->Gallery->get_gallery_image($id) ;

		$gallery_id = $img->gallery_id ; 		
		$gallery = $this->Gallery->get_gallery($gallery_id) ;


		

		if ($remote_image) {  // we do have new image


			// download and replace old image  

			$file_path = "gallery/" . $img->filename  ;			
			file_put_contents($file_path, file_get_contents($remote_image));			


			// update thumbnail ... 



			$vals = @getimagesize($file_path);	        
			$ratio = $vals[0] / $vals[1] ;


			$this->load->library('image_lib');



			$cfg['image_library'] = 'gd2';
			//$cfg['source_image']	= $file_path ;
			$cfg['source_image']	= $remote_image ;
			$cfg['new_image'] = "gallery/thumbs/" . $img->filename ; 

			$cfg['create_thumb'] = TRUE;
			$cfg['thumb_marker'] = '' ; 
			$cfg['maintain_ratio'] = TRUE;

			
			

			$cfg['width'] = $gallery->thumb_width ;
			$cfg['height']	= $gallery->thumb_width / $ratio ;  
			

			
			$this->image_lib->initialize($cfg);   												
			$this->image_lib->resize() ;




		}

		redirect ("galleries/addimage/$gallery_id/") ;  







/*






		*/




}

function editimage($id) {


	if (!$this->User->is_logged_in())  redirect('/'); 

		// image upload preperations 

	$config['upload_path'] = 'gallery';
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= '8250'; /* inspired by Liraz! */ 
	$config['encrypt_name'] = 'true' ; 

	$this->load->library('upload', $config);
	$this->load->library('form_validation');		
	$this->load->library('image_lib');

	$img =  $this->Gallery->get_gallery_image($id) ;
	$gallery_id = $img->gallery_id ; 		
	$gallery = $this->Gallery->get_gallery($gallery_id) ;


	$this->form_validation->set_rules('title', 'title', 'required');


	if ($this->form_validation->run() == FALSE)
	{




		$data['img_list'] = $this->Gallery->get_img_list($gallery_id) ;
		$data['imgx'] = $img ;   
		$data['gallery_id'] = $gallery_id ; 
		$data['gallery_title'] = $gallery->title ; 
		$data['title'] = "עריכת תמונה" ;

		$this->load->view('site/edit_gallery_img',$data ) ;





	} else 	{



		$file_path = '' ;
		$file_name = '' ;  


		if ( $this->upload->do_upload())
		{


				// remove old files ... 

			if (file_exists("gallery/$img->filename")) unlink("gallery/$img->filename") ;
			if (file_exists("gallery/thumbs/$img->filename")) unlink("gallery/thumbs/$img->filename") ;



			/* upload original image to server */ 

			$file =  $this->upload->data();								
			$file_name =  $file['file_name'] ;				
			$file_path = "gallery/" . $file_name ;

			$ratio = $file['image_width'] / $file['image_height'] ; ;



				/* Resize the original image - only if bigger than the 
				 * original size . */
				
				if ($file['image_width'] > $gallery->full_width ) { 

					$cfg2['image_library'] = 'gd2';
					$cfg2['source_image']	= $file_path ;				 									
					$cfg2['maintain_ratio'] = TRUE;

					
					$cfg2['width'] = $gallery->full_width ;
					$cfg2['height']	= $gallery->full_width / $ratio ; 

					$this->image_lib->initialize($cfg2);   												
					$this->image_lib->resize() ; 
					
				}

				

				/* create thumbnail image */    				
				
				$cfg['image_library'] = 'gd2';
				$cfg['source_image']	= $file_path ;
				$cfg['new_image'] = "gallery/thumbs/" . $file_name ; 

				$cfg['create_thumb'] = TRUE;
				$cfg['thumb_marker'] = '' ; 
				$cfg['maintain_ratio'] = TRUE;

				
				$cfg['width'] = $gallery->thumb_width ;
				$cfg['height']	= $gallery->thumb_width / $ratio ;  
				

				
				$this->image_lib->initialize($cfg);   												
				$this->image_lib->resize() ;
				
			}


			
			$this->Gallery->update_gallery_img ($img->id ,  $this->input->post('title') ,  $this->input->post('description') , $file_name , 
				$this->input->post('custom1') , $this->input->post('custom2') ) ;

			$custom1 = $this->input->post('custom1') ; 

			redirect ("galleries/addimage/$gallery_id/$custom1") ;  



			


		}	

		
		
		
	}
	






	function updatethumbs($gallery_id) {

		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$this->load->library('image_lib');
		$this->load->helper('file');

		
		$gallery = $this->Gallery->get_gallery($gallery_id) ;		
		$img_list = $this->Gallery->get_img_list($gallery_id) ;
		
		
		foreach ($img_list->result() as $img) {
			

			/* delete thumbnail ... */
			if (file_exists("gallery/thumbs/$img->filename")) unlink("gallery/thumbs/$img->filename") ;
			
			
			/* get image dimensions */ 
			$img_data = getimagesize("gallery/$img->filename") ;
			$ratio = $img_data[0] / $img_data[1] ; 

			


			/* create new thumbnail image */    				
			
			$cfg['image_library'] = 'gd2';
			$cfg['source_image']	= "gallery/$img->filename"  ;
			$cfg['new_image'] = "gallery/thumbs/" . $img->filename ; 

			$cfg['create_thumb'] = TRUE;
			$cfg['thumb_marker'] = '' ; 
			$cfg['maintain_ratio'] = TRUE;

			
			$cfg['width'] = $gallery->thumb_width ;
			$cfg['height']	= $gallery->thumb_width / $ratio ;  


			
			$this->image_lib->initialize($cfg);   												
			$this->image_lib->resize() ;



			


			
		}
		

		redirect ("galleries/addgallery/") ;  



























		
		



		
		
		
	}




	
	
	
	function addgallery () {

		if (!$this->User->is_logged_in())  redirect('/'); 
		/// if called by ckeditor image finder - get callback id and save it 
		/// for later use 

		if ($this->input->get('CKEditorFuncNum')) {

			$data['CKEditorFuncNum'] = $this->input->get('CKEditorFuncNum') ; 
			$this->session->set_userdata($data);

		}


		
		

		$this->load->library('form_validation');		
		$this->form_validation->set_rules('title', 'title', 'required');
		

		if ($this->form_validation->run() == FALSE)
		{



			

			$data['title'] = 'הוספת גלריה חדשה' ;			
			$data['custom_script'] = array( 'gallery.js' ,'pixler.js' )  ; 
			$data['gallery_list'] = $this->Gallery->get_gallery_list() ; 
			
			$this->load->view('site/new_gallery',$data ) ;
			
			

			
			
			
		} else 	{
			
			
			$this->Gallery->add_gallery ($this->input->post('title') ,  $this->input->post('description')) ;			
			redirect ("galleries/addgallery") ; 
			

		}	
		
		
		
	}
	
	
	



	function editgallery($id) {
		if (!$this->User->is_logged_in())  redirect('/'); 
		
		$config['upload_path'] = 'gallery';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '950';
		$config['max_width']  = '1524';
		$config['encrypt_name'] = 'true' ;		
		
		$this->load->library('form_validation'  , $config );

		$this->load->library('upload');
		$this->form_validation->set_rules('title', 'title', 'required');
		
		
		$gallery = $this->Gallery->get_gallery($id) ; 
		

		if ($this->form_validation->run() == FALSE)
		{


			$data['title'] = 'עריכת גלריה' ;
			$data['gallery'] = $gallery ;  
			
			$this->load->view('site/edit_gallery',$data ) ;
			
			
			
		} else 	{


			if (  $this->upload->do_upload())
			{
				
				
				if (file_exists("gallery/$gallery->gallery_thumb") && $gallery->gallery_thumb ) unlink("gallery/$gallery->gallery_thumb") ;
				
				
				$file =  $this->upload->data();								
				$file_name =  $file['file_name'] ;
				
			}
			
			
			$this->Gallery->update_gallery ($id, $this->input->post('title') ,  $this->input->post('description') , 
				$file_name , $this->input->post('thumb_width') , $this->input->post('full_width') , $this->input->post('show_in_menu') ) ;			
			redirect ("galleries/addgallery") ; 
			

		}			
		
		
	}
	
	

}



?>