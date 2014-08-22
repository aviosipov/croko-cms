<?php

class Gallery extends CI_Model {
	
	
	function update_gallery($id,$title,$description,$img,$thumb_width,$full_width,$show_in_menu=1) {
		
        $data = array(
            
            'title' => $title  ,            
            'description' => $description ,          
            'thumb_width' => $thumb_width,
            'full_width' => $full_width ,            
            'site_id' => $this->config->item('site_id'),
            'show_in_menu' => $show_in_menu
				             
        );
			
			
		if ($img) $data['gallery_thumb'] = $img; // update image only if file is uploaded


        $this->db->where('id', $id) ;
	    $this->db->update('galleries',$data) ;
		
	}
	
	
	function update_gallery_img( $id , $title , $description , $filename = '' , $custom1 ='' , $custom2 = '') {

	    $data = array(
			'title' => $title ,
			'description' => $description 
	    );
		
		
		if ($filename) $data['filename'] = $filename; // update image only if file is uploaded 
		if ($custom1) $data['custom1'] = $custom1; // update custom1 only if file is uploaded 
		if ($custom2) $data['custom2'] = $custom2; // update custom2 only if file is uploaded 
		
        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('gallery_images',$data) ;		

		
	}




	
	
	function get_gallery($id ) {
		
        $this->db->select ('id,title,description,thumb_width,full_width,gallery_thumb,show_in_menu')  ;
		
		
		if (is_numeric($id)) $this->db->where('id',$id) ;
		else $this->db->where('title',$id) ; 
		
				
        
		
						
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('galleries');
        $gallery = $query->row() ;	
		
        if ($query->num_rows() >0) return $gallery ; 
        else return false ; 

			
		
	}
	
	
	
	
	function get_gallery_by_title($title) {
		
        $this->db->select ('id,title,description,thumb_width,full_width,gallery_thumb,show_in_menu')  ;		
        $this->db->where('title',$title) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('galleries');
        $gallery = $query->row() ;	
		
		return $gallery ; 		
		
	}
		
	
	
	
	function get_gallery_image ( $id ) {
		
        $this->db->select ('id,filename,title,description,gallery_id,custom1,custom2')  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('gallery_images');
        $img = $query->row() ;	
		
		return $img ; 		
		
		
	} 
	
	function get_img($title){


        $this->db->select ('id,filename,title,description,gallery_id,custom1,custom2')  ;
 		
		if (is_numeric($title)) $this->db->where('id',$title) ; 
		else $this->db->where('title',$title) ;
		
		
						
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('gallery_images');
        $img = $query->row() ;	
		
		return $img ;
				
	}
	

	function get_img_by_title ( $title ) {
		
        $this->db->select ('id,filename,title,description,gallery_id,custom1,custom2')  ;
 		
		if (is_numeric($title)) $this->db->where('id',$title) ; 
		else $this->db->where('title',$title) ;
		
		
						
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('gallery_images');
        $img = $query->row() ;	
		
		return $img->filename ; 				
		
	} 


	function get_img_by_description ( $desc ) {
		
        $this->db->select ('id,filename,title,description,gallery_id,custom1,custom2')  ;		
        $this->db->where('description',$desc) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('gallery_images');
        $img = $query->row() ;	
		
		return $img->filename ; 				
		
	} 






	function get_galleries_thumbs($id,$li_class='',$a_rel='',$img_class='',$a_class='',$add_title=0) {
		
		
    	$this->db->select ('id,title,description,gallery_thumb' )  ;		
		$this->db->where('show_in_menu',1) ; 
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $img_list = $this->db->get('galleries');
		$counter = 0 ; 
		

        foreach ($img_list->result() as $img) {

        	
			?>
			
			
	            <li class="<?=$li_class;?>">
	              <a rel="<?=$a_rel;?>" class="<?=$a_class;?>" title="<?=$img->title;?>" href="/gallery/<?=$img->id;?>">
	                <img class="<?=$img_class;?>" src="/gallery/<?=$img->gallery_thumb;?>" title="<?=$img->title;?>" alt="<?=$img->description;?>"  class="image<?=$counter;?>">
	              </a>
	              
	              <? if ($add_title==1) echo "<br>$img->title" ; ?> 
	            </li>
	            
	            
			
			
			<? 
			
			$counter++ ; 
			
		}		
		
						 		
		
		
		return true ;   			
		
		
	}



























		
	
	
	function get_gallery_thumbs($id,$li_class='',$a_rel='',$img_class='',$a_class='') {
		
		
    	$this->db->select ('id,title,description,filename' )  ;		
        $this->db->where('gallery_id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $img_list = $this->db->get('gallery_images');
		$counter = 0 ; 
		

        foreach ($img_list->result() as $img) {

        	
			?>
			
			
	            <li class="<?=$li_class;?>">
	              <a rel="<?=$a_rel;?>" class="<?=$a_class;?>" title="<?=$img->title;?>" href="/gallery/<?=$img->filename;?>">
	                <img class="<?=$img_class;?>" src="/gallery/thumbs/<?=$img->filename;?>" title="<?=$img->title;?>" alt="<?=$img->description;?>"  class="image<?=$counter;?>">
	              </a>
	            </li>
			
			
			<? 
			
			$counter++ ; 
			
		}		
		
						 		
		
		
		return true ;   			
		
		
	}
	
	
	function add_gallery_img ( $title , $description , $filename , $gallery_id , $custom1 = '' , $custom2 = '' ) {
		
	    $data = array(
			'title' => $title ,
			'description' => $description ,
			'filename' => $filename , 
			'gallery_id' => $gallery_id , 											 
	        'site_id' => $this->config->item('site_id') , 
	        'custom1' => $custom1 , 
	        'custom2' => $custom2             
	    );
	
	    $this->db->insert('gallery_images', $data);		
		
		
	}
	
	
	function add_gallery($title,$description,$full_width = '') {
		
	    $data = array(
			'title' => $title ,
			'description' => $description ,											 
	        'site_id' => $this->config->item('site_id')             
	    );

	    if ($full_width) $data['full_width'] = $full_width ; 
	
	    $this->db->insert('galleries', $data);		
	    return $this->db->insert_id() ; 
		
		
	}
	
	
	function delete_gallery($id) {
		
	    $this->db->where('id', $id);
		$this->db->where('site_id',$this->config->item('site_id') ) ; // security check
		
        $this->db->delete('galleries');		
		
	}


	function delete_gallery_image($id) {
		
	    $this->db->where('id', $id);
		$this->db->where('site_id',$this->config->item('site_id') ) ; // security check
		
        $this->db->delete('gallery_images');		
		
	}
		
	
	
	function get_gallery_list( $only_published = 0 ) {
		
        $this->db->select ('id,title,description,gallery_thumb' )  ;		        				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		if ($only_published == 1) $this->db->where('show_in_menu', 1 ) ; 
		$this->db->order_by("order", "asc");  
		
        $query = $this->db->get('galleries');
		
		return $query ; 
		
		
	}
	
	
	function get_gallery_menu($active=0) {
		
        $this->db->select ('id,title,description' )  ;		        				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		$this->db->where('show_in_menu', 1 ) ;
		
        $query = $this->db->get('galleries');
		
		
        foreach ($query->result() as $menu_item) {
        	
			
        	if ($active==$menu_item->id) $act = ' class="active" ' ;
			else $act = '' ;  

			echo '<li' . $act .  ' >' . anchor("gallery/" . $menu_item->id , $menu_item->title ) .
			"</li>" ;
			 
			
		}		
		
		return true ; 
		
	}


	function get_img_list_by_decription($dec ,$limit=0) {
		
		
        
		
		$this->db->where('description', $dec) ;
		
		$this->db->select ('id,filename,title,description,gallery_id,custom1,custom2' )  ;				        				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		if ($limit>0) $this->db->limit($limit); 
		
        $query = $this->db->get('gallery_images');
		
		return $query ; 
		
		
		
	}
	
	
	function get_img_list($gallery_id ,$limit=0, $custom1 = '' , $custom2 = '') {
		
		
        
		
		if (is_numeric($gallery_id)) $this->db->where('gallery_id', $gallery_id ) ;
		else {
			
			 $gal = $this->get_gallery_by_title($gallery_id) ;
			 $this->db->where('gallery_id', $gal->id ) ;
		 }  
		
		$this->db->select ('id,filename,title,description,gallery_id,custom1,custom2' )  ;				        				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		if ($custom1) $this->db->where('custom1', $custom1 ) ;
		if ($custom2) $this->db->where('custom2', $custom2 ) ;
		
		if ($limit>0) $this->db->limit($limit); 

		$this->db->order_by("order", "asc"); 

		
        $query = $this->db->get('gallery_images');
		
		return $query ; 
		
		
		
	}
	
	
	
}




?>