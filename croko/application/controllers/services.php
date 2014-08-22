<?php


class Services extends CI_Controller {
	
	 
	
	public function __construct() {
				
        parent::__construct();		
		$this->load->model('site/Content') ;
		$this->load->model('site/Newsm') ;				
		
		$this->load->library('cms/FileInfo') ; 
	}


	function upload_image() {



		/// remove old files 
		
		$name = $_POST['name'] ; 

		if (file_exists('gallery/' . $name . '.png')) unlink('gallery/' . $name . '.png') ; // remove png
		if (file_exists('gallery/' . $name . '.jpg')) unlink('gallery/' . $name . '.jpg') ; // remove png
		if (file_exists('gallery/' . $name . '.jpeg')) unlink('gallery/' . $name . '.jpeg') ; // remove png
			
		/// prepare for upload 
		$fileInfo = new FileInfo($_POST['path']) ;

		/// change extension to lowercase 

		$path_parts = pathinfo($_FILES["userfile"]["name"]);
		$extension = $path_parts['extension'];		

		$config['upload_path'] = 'gallery' ;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '8250'; /* inspired by Liraz! */ 		
		$config['file_name'] = $_POST['name'] . '.' . strtolower( $extension ); 
		$config['overwrite'] = true ; 

		$this->load->library('upload', $config);
		$this->load->library('image_lib');

		$file_path = '' ; 

		/// upload file 

		if ( ! $this->upload->do_upload())
		{
											
			$data['upload_errors'] = array('error' => $this->upload->display_errors());								
			echo  $this->upload->display_errors(); 
			 								
		}
		else
		{

			


			/// file is ready, upload it 

			$file =  $this->upload->data();											
			$crop_settings = json_decode($_POST['selection']) ; 	
			
			
			
			$file_path = $file['full_path'] ;				

			/// calculate preview to original width ratio 			
			
			$preview_width = $_POST['preview_width'] ; 
			$ratio = $file['image_width'] / $preview_width ; 

			/// crop image 

			$crop_config['image_library'] = 'gd2';
			$crop_config['source_image']	= $file_path ;
			$crop_config['maintain_ratio']	= false ; 

			$crop_config['x_axis'] = $crop_settings->x1 * $ratio ; 
			$crop_config['y_axis'] = $crop_settings->y1 * $ratio  ; 
			$crop_config['width'] = $crop_settings->width * $ratio  ; 
			$crop_config['height']	= $crop_settings->height * $ratio  ; 

							
			$this->image_lib->initialize($crop_config);   												
			$this->image_lib->crop() ; 


			/// reize image for fixed size 

			$resize_config['image_library'] = 'gd2';
			$resize_config['source_image']	= $file_path ;
			$resize_config['maintain_ratio']	= true ; 

			$resize_config['width'] = $_POST['target_width']  ; 
							
			$this->image_lib->initialize($resize_config);   												
			$this->image_lib->resize() ; 


			echo $file['file_name'] ; 

		}
			





	//	echo "hello from server!" ; 

	   // $input = $this->input->get_post('userfile');
	  //  print_r($_FILES) ; 
		
//		print_r($_POST); 

//		print_r(json_decode($_POST['selection'])) ; 
		//print_r($_POST['selection']); 

		/// get image 



		/// get image crop settings 


		/// upload image or overrite the old image 

		/// return image / url 





	}

	function images() {
		
		$file_path = $this->uri->uri_string();

		/// if image not found - return file stored on file system 
				
		
		$file = $file_path ; 
		$type = 'image/jpeg';		

		header('Content-Type:'.$type);
		header('Content-Length: ' . filesize($file));
		readfile($file);				


	}
	
	
	
	function robots() {
		
		
		
		$this->load->view('site/services/robots') ;
		
	}
	
	


	
	function dynamicimage($title) {
		
		$this->load->model('site/Gallery') ;
		
		$img = $this->Gallery->get_img_by_title($title) ;
		
		
		$file = 'gallery/' . $img ;
		$type = 'image/jpeg';		

		header('Content-Type:'.$type);
		header('Content-Length: ' . filesize($file));
		readfile($file);		
		
		
		
		
	}
	
	
	
	function newsletter_form() {
		
		$site = $this->Content->get_site() ;
		
		$name = $this->input->post('name') ; 
		$phone = $this->input->post('phone') ; 
		$email = $this->input->post('email') ;
		
		
		 
		
		$this->load->library('NewsletterMailerAPI') ;		
		$nlapi = new NewsletterMailerAPI($site->newsletter_url, $site->newsletter_api_code);


		$categories = $nlapi->getCategories();
		
		//add new subscribers
		
		$data = array("e-mail" => $email ,
		    "first_name" => $name ,   "last_name" => '', 
		    "description" => $phone ,  
		    "Category" => array($site->newsletter_cat_id)
		);
		
		
		if (!$nlapi->checkSubscriber($data["e-mail"])) {
		    //Add subscriber using Form #4
		    //$return = $nlapi->formAddSubscriber(4,$data);
		    //Add subscriber directly
		    $return = $nlapi->addSubscriber($data);
		
		    if ($return["status"] == "ok") {
		        //echo "Subscriber added";
		    } else {
		      //  echo "Add Subscriber Failed:" . $return["msg"];
		    }
		}else{
		    //echo "Subscriber exists";
		} 
			 
			
		redirect ("/thanks") ;
				 
		
	}
	
	
	function custom_style($param = '') {
		
		// generates dynamic css ... a dream come true!
		

		$this->load->model('site/Content') ;
		
		
		if (!$param) {
		
			$data['style'] = unserialize ($this->Content->get_template_style() )  ; 
			$this->load->view('papa/style-custom',$data);
			
		} else {
				
			$style = $this->Content->get_page_by_url($param) ;
			
			echo  header("Content-type: text/css;charset:UTF-8"); 			 
			echo $style->content; 
			
		}		
		
		
	}
	
	
	function captcha () {
		
		/* generates captcha image ... */
		
		
		session_start();
		
		$string = '';
		
		for ($i = 0; $i < 5; $i++) {
			$string .= chr(rand(48, 57));
		}
		
		$_SESSION['random_number'] = $string;
		
		
		
		$image = imagecreatetruecolor(140, 50);
		$color = imagecolorallocate($image, 113, 193, 217);// color
		
		
		$white = imagecolorallocate($image, 255, 255, 255); // background color white
		imagefilledrectangle($image,0,0,399,99,$white);  
		
		imagettftext ($image, 30, 0, 10, 40, $color, '/usr/shared/gc/tmp/1.ttf', $_SESSION['random_number']);
		
		header("Content-type: image/png");
		imagepng($image);
		

 
		
		
	}
	

	
	function postcaptcha() {
		
		// check ajax captcha values ... 
		
	
		session_start();
	
		
		
		if( @strtolower($_REQUEST['captcha']) == strtolower($_SESSION['random_number']))
		{
			
			// insert your name , email and text message to your table in db
			
			echo 1;// submitted 
			
		}
		else
		{
			echo 0; // invalid code
		}
					
		
		
	}
	
	
	
	function xml($param,$param2 = '' ) {
		
		 
	
		switch ($param) {
			
			case 'articles':
					
					
				$this->load->dbutil();
				$this->load->helper('file');
				
				
				if (!$param2) $query = $this->Content->get_article_list() ;
				else $query = $this->Content->get_article_list(0,$param2) ;
				
				
				
				$config = array (
				                  'root'    => 'root',
				                  'element' => 'article', 
				                  'newline' => "\n", 
				                  'tab'    => "\t"
				                );
				
				$xml_file = $this->dbutil->xml_from_result($query, $config);
				
				
				$data['xml_code'] = $xml_file ; 
				$this->load->view('site/xml/page',$data) ; 
				 
				
				
				
								
								
					
				break;
			
			
			default:
				
				break;
		}
	
	
		
	}
	
	
	
	
	
	
}