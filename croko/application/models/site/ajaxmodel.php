<?php

class Ajaxmodel extends CI_Model {

	function update_field($table , $row , $field , $value) {


        $data = array(

            $field => $value
			
        );		


        $this->db->where('id', $row) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ; // security stuff ... 
	    $this->db->update($table,$data) ;

	}
	

	
	
	
	
}
	
	