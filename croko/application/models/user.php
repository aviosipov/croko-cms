<?php

class User extends CI_Model {
	
	
	function is_mobile() {
		
		$this->load->library('user_agent');
		$agent_string = $this->agent->agent_string() ;
		
		
		//if ($this->is_admin()) return true ; 
		
	
		
		if (strpos($agent_string,'Mobile') > 0 ) return TRUE ; else return FALSE ;  
		
	}
	
	
	function set_google_access_token($access_token) {
		
        $data = array(
            'google_access_token' => $access_token                         
            );
			
			
		$id = $this->get_id() ; 

		 
        $this->db->where('id', $id ) ;
        $this->db->update('users', $data) ;		 
		
	}
	
	
	function get_google_access_token() {
		
		$id = $this->get_id() ; 

        $this->db->select ('id, google_access_token' )  ;
        $this->db->where('id',$id) ;
        
        $query = $this->db->get('users');
		$row = $query->row() ; 
		

        return $row->google_access_token ; 

		
	}
	
	
	
	function get_all() {
		
		// get all users in system ... 

        $this->db->select ('id,nickname,username,email,level,org_id,site_id,permissions' )  ;		
        $query = $this->db->get('users');

        return $query ;
		
	}


    function get_user_list() {
    	
		// get user list for the current org id ...

        $this->db->select ('id,nickname' )  ;
		$this->db->where('org_id',$this->session->userdata('org_id')) ;
        $query = $this->db->get('users');

        return $query ;

    }
	
	
	function is_logged_in () {
		
		if ($this->session->userdata('logged_in') == 1) return true ;
		else return false;  
		
	}
	
	function is_admin () {
		
		if ($this->session->userdata('user_level') == 2) return true ;
		else return false;  
		
	
		
		
	}

	function can_access_cashflow_table() {
		
		// limited by user ID, improve in the future ...
		
		
		
		
		
		if ( $this->session->userdata('user_id') == 51  ) return false;  
		else return true;
		   
		
	}
	
	
	function can_access_cashflow() {
		
		// limited by user ID, improve in the future ...
		
		return true ;  
		
		
		/*
		if ( $this->session->userdata('user_id') == 51  ) return false;  
		else return true;
		 * 
		 */  
		
	}
	
	function get_level() {
		
		return $this->session->userdata('user_level') ;
		
	}
	
	function get_name () {
		
		return $this->session->userdata('nickname') ; 
		
	}
	

	
	
	function get_id () {
		return $this->session->userdata('user_id') ;
	}
	
	
	function show_greeting () {
		
		echo "שלום " . $this->session->userdata('nickname') . " ," .
		anchor('users/logout', 'התנתק') ; 
		
		
	}



    function add($username,$password,$nickname,$org_id = 0 , $site_id = 0 ) {
    	
		$pass = md5($password) ; 

        $data = array(
            'username' => $username  ,
            'password' => $pass ,
            'nickname' => $nickname ,
            'org_id' => $org_id ,
            'site_id' => $site_id   
            );

        $this->db->insert('users', $data);
		$new_id = $this->db->insert_id() ;
		
		return $new_id ; 
		
    }
	
	
	
    function update($id , $username,$password,$nickname,$org_id = 0 , $site_id = 0 ) {


        $data = array(
            'username' => $username  ,            
            'nickname' => $nickname ,
            );
			
		if ($password) $data['password'] = md5($password) ; 


        $this->db->where('id', $id ) ;
        $this->db->update('users', $data) ;
					
		
		
    }
		
	
	
	function change_password($user_id,$new_password) {
		
		$pass = md5($new_password) ; 

        $data = array(
            'password' => $pass  
            );

        $this->db->where('id', $user_id) ;
		$this->db->where('org_id',$this->session->userdata('org_id')) ;		
		
        $this->db->update('users',$data) ;


		
	}



    function delete ($id) {

	    $this->db->where('id', $id);				
        $this->db->delete('users');

    }


    function check_user($username,$password) {

    	/// check user via : site_id , username , password 

        $this->db->select ('*')  ;
		
        $this->db->where('username',$username) ;		
		$this->db->where('password',md5($password)) ;
		$this->db->where('id', $this->config->item('site_id')) ; 
		
        $query = $this->db->get('sites');
		
		if ($query->num_rows == 1) {
			
			// user was found 
			
			$site = $query->row(); 
			
			$this->session->set_userdata('user_id',$site->id);
            $this->session->set_userdata('username',$site->username);
            $this->session->set_userdata('nickname',$site->owner_name);
			
            $this->session->set_userdata('logged_in', 1);			
			
			
			
						
			return true ;
		}  
		else {
			
			 
			return false ;
		}  

        		
		
		
		
        
    }
	
	
	function do_logout () {
		
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('nickname');
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('org_id');
		$this->session->unset_userdata('user_level');
		$this->session->unset_userdata('cashflow_simulation');
		
	}











    function get_user ($id) {

        $this->db->select ('id, username , password , nickname , org_id , site_id , email , permissions , level ' )  ;
        $this->db->where('id',$id) ;
        $query = $this->db->get('users');

        return $query->row() ;

    }
	
	function get_nick_by_id($id) {
		
        $this->db->select ('id, nickname , org_id' )  ;
        $this->db->where('id',$id) ;
        
        $query = $this->db->get('users');
		$row = $query->row() ; 
		

        return $row->nickname ; 
		
		
		
		
	}
	
	
	
	function check_name($name) {
		
		
        $this->db->select ('username' )  ;
        $this->db->where('username',$name) ;
        $query = $this->db->get('users');
		
		if ($query->num_rows() > 0 ) return true ; 
		else return false ; 
		
		
	}
	
	
	






}


?>