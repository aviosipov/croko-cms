<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {


	public function __construct() {
				
        parent::__construct();		

        

		$this->load->model('site/Content') ;
		$this->load->model('site/Newsm') ;
		$this->load->model('site/Gallery') ;		
		$this->load->model('site/Ajaxmodel') ;		


		// DataMapper models 

		$this->load->model('site/DMGalleryImages') ;		
		$this->load->model('site/DMGallery') ;		


		
	}


	function update_field() {

		if (!$this->User->is_logged_in())  redirect('/'); 

		$table = $this->input->post('table') ; 
		$row = $this->input->post('row') ; 
		$field = $this->input->post('field') ; 
		$value = $this->input->post('value') ; 

		

		$this->Ajaxmodel->update_field ($table,$row,$field,$value) ; 

		return "update row" ; 


		//echo ' table : ' . $table . ' , row : ' . $row . ' , field : ' . $field . ' , val : ' . $value ; 



	}


	function set_img_title() {

		if (!$this->User->is_logged_in())  redirect('/'); 

		echo $this->input->post('id') . $this->input->post('title') . $this->input->post('description') ; 

		$this->Gallery->update_gallery_img($this->input->post('id'),$this->input->post('title') , 
		$this->input->post('description')	) ; 

	}

	function update_sort($param) {

		if (!$this->User->is_logged_in())  redirect('/'); 

		echo "(server) start sort ..." . $param ; 

		
		$updateRecordsArray 	= $_POST['recordsArray'];		

		$listingCounter = 1;


		/*
		switch ($param) {

			case 'galleries':
				$list = new DMGallery() ; 
				break;

			case 'images':
				$list = new DMGalleryImages() ; 		
				break;

			case 'pages': 
				$list = new DMPages() ; 		
				break; 

			case 'articles': 
				$list = new DMPages() ; 		
				break; 			
			

		}
		*/ 



		

		foreach ($updateRecordsArray as $recordIDValue) {

			echo " >>>" . '[' . $recordIDValue  . ']'; 


			$data = array(

	               'order' => $listingCounter,

            );

			$this->db->where('id', $recordIDValue);
			$this->db->update($param, $data); 


			$listingCounter = $listingCounter + 1; 
			
		}
		 
		echo "done!" ; 

	

	}
	



}

/* End of file ajax.php */
/* Location: ./application-new/controllers/sites/ajax.php */
