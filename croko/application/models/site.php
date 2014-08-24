<?php


class Site extends CI_Model {
	
	
	function get($id) {

        $this->db->select ('*' )  ;
		$this->db->where('id',$id) ;
		
        $query = $this->db->get('sites');

        return $query->row() ;				

	}
	
	
	function get_sites() {
		
        $this->db->select ('*' )  ;
        $query = $this->db->get('sites');

        return $query ;				
		
		
	}
	
	
	function delete($id) {

	    $this->db->where('id', $id);				
        $this->db->delete('sites');

		
	}
	
	
	function add ($name , $site_url , $owner_name , $contact_email , $language = 'he' , $template = 0 ) {
		
        $data = array(
            'name' => $name  ,
            'site_url' => $site_url  ,
            'owner_name' => $owner_name ,
            'contact_email' => $contact_email , 
            'language' => $language ,
            'template' => $template
            );

        $this->db->insert('sites', $data);			
		
	}


	
	function update ($id , $name , $site_url , $owner_name , $contact_email , $language = 'he' , $template = 0 ) {
		
        $data = array(
            'name' => $name  ,
            'site_url' => $site_url  ,
            'owner_name' => $owner_name ,
            'contact_email' => $contact_email , 
            'language' => $language ,
            'template' => $template
            );

		
        $this->db->where('id', $id ) ;
        $this->db->update('sites', $data) ;
					
		
	}



	
	
	
}




