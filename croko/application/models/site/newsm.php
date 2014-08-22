<?php

class Newsm extends CI_Model {
	
	function get($id) {
		
        $this->db->select ('id,title,content' )  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('news');
        $article = $query->row() ;		
		
		return $article ; 		
		
		
	}
	
	
	function add($title,$content) {
		
	    $data = array(

			'title' => $title ,
			'content' => $content ,							 
	        'site_id' => $this->config->item('site_id')             
	    );
	
	    $this->db->insert('news', $data);			
		
		
		
	}
	
	
	function update($id,$title,$content) {
		


        $data = array(
            
            'title' => $title  ,            
            'content' => $content             
        );
				

        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
	    $this->db->update('news',$data) ;		
		
		
		
	}
	
	
	function delete($id) {
		
	    $this->db->where('id', $id);
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $this->db->delete('news');		
		
	}
	
	function get_all() {
		
		
        $this->db->select ('id,title,content' )  ;		       
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('news');
		return $query ;  		
						
		
	}
	
	
	
	
}
	
	