<?php


class Admin extends CI_Controller {
	
	
	
	public function __construct() {
				
        parent::__construct();		
				
		$this->load->model('Project') ;
		$this->load->model('Client') ;
		$this->load->model('Cashflow') ;

		if (!$this->User->is_logged_in()) redirect('users/login') ;
		if (!$this->User->is_admin()) redirect('dashboard') ;		
	}	
	

	function _example_output($output = null)
	{
		$this->load->view('example.php',$output);	
	}
	
	
	function manage_responder() {
		
		$this->load->library('grocery_CRUD');	
		

    	
		$this->grocery_crud->set_table('autoresponders');
		$this->grocery_crud->set_subject('מסרים אוטומטיים');
		
		
		
		$this->grocery_crud->columns('autoresponder_id', 'autoresponder_name','autoresponder_subject','autoresponder_message');


		$this->grocery_crud->set_rules('autoresponder_name','שם הניוזלטר','required');
		
		
		$this->grocery_crud->display_as('autoresponder_id','#') ;  
		$this->grocery_crud->display_as('autoresponder_name','שם') ;
		$this->grocery_crud->display_as('autoresponder_subject','נושא') ;
		$this->grocery_crud->display_as('autoresponder_message','תוכן') ;		

		
		$output = $this->grocery_crud->render();
		
    	$this->_example_output($output);		
				
	}
	
	
	function users() {


		$this->load->model('Site') ;			
			
		$data['user_list'] = $this->User->get_all() ;
		$data['title'] = 'ניהול משתמשים' ;  
		
		$this->load->view('crm/single-col-start',$data) ;
        $this->load->view('crm/admin/users/all',$data) ;
		$this->load->view('crm/single-col-end',$data) ;
		
	}
	
	
	function sites() {
		

		
		
		$this->load->model('Site') ;			
			
		$data['site_list'] = $this->Site->get_sites() ;
		$data['title'] = 'ניהול אתרים' ;  
		
		$this->load->view('crm/single-col-start',$data) ;
        $this->load->view('crm/admin/site_list',$data) ;
		$this->load->view('crm/single-col-end',$data) ;

		
	}
	
	
	function delsite($id) {
		
		$this->load->model('Site') ;				
		$this->Site->delete($id) ; 
		
		
        redirect('admin/sites' );
		
		
	}
	
	

	
	function deluser($id) {
		
						
		$this->User->delete($id) ; 
		
		
        redirect('admin/users' );
		
		
	}
	
	

	function edituser($id) {
		
		

        $this->load->library('form_validation');		
        $this->form_validation->set_rules('username', 'username', 'required');


        if ($this->form_validation->run() == FALSE)
        {


			$data['title'] = 'עריכת משתמש' ;
			$data['page_title'] = 'פרטי משתמש' ;
			$data['user'] = $this->User->get_user($id) ;   
			
			
			$this->load->view('crm/single-col-start',$data) ; 
            $this->load->view('crm/admin/users/update',$data) ;
			$this->load->view('crm/single-col-end',$data) ;


        } else
        {
        	
			

			$this->User->update ( $id ,  $this->input->post('username') ,  $this->input->post('password')  , $this->input->post('nickname') ,
			0 , 0 ) ;
			 								
            redirect('admin/users' );



        }
		
		
				
		
		
	}
	
		
	
	
	function editsite($id) {
		
		

        $this->load->library('form_validation');
		

    	$this->load->model('Site') ;		        		
        $this->form_validation->set_rules('name', 'name', 'required');


        if ($this->form_validation->run() == FALSE)
        {


			$data['title'] = 'עריכת אתר' ;
			$data['page_title'] = 'פרטי אתר ' ;
			$data['site'] = $this->Site->get($id) ;   
			
			
			$this->load->view('crm/single-col-start',$data) ; 
            $this->load->view('crm/admin/edit_site',$data) ;
			$this->load->view('crm/single-col-end',$data) ;


        } else
        {
        	
			

			$this->Site->update ($id ,  $this->input->post('name') , $this->input->post('site_url') , $this->input->post('owner_name') , 
			$this->input->post('contact_email') , $this->input->post('language') , $this->input->post('template') ) ;
			 								
            redirect('admin/sites' );



        }
		
		
				
		
		
	}








	function adduser() {


        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');


        if ($this->form_validation->run() == FALSE)
        {


			$data['title'] = 'הוספת משתמש חדש' ;
			$data['page_title'] = 'פרטי משתמש חדש' ;  
			
			
			$this->load->view('crm/single-col-start',$data) ; 
            $this->load->view('crm/admin/users/add',$data) ;
			$this->load->view('crm/single-col-end',$data) ;


        } else
        {
        	
			

			$this->User->add ( $this->input->post('username') ,  $this->input->post('password')  , $this->input->post('nickname') ,
			0 , 0 ) ;
			 								
            redirect('admin/users' );



        }
		
		
		
		
		
	}
	







 	
	
	function addsite() {


        $this->load->library('form_validation');
		

    	$this->load->model('Site') ;		        		
        $this->form_validation->set_rules('name', 'name', 'required');


        if ($this->form_validation->run() == FALSE)
        {


			$data['title'] = 'הוספת אתר חדש' ;
			$data['page_title'] = 'פרטי אתר חדש' ;  
			
			
			$this->load->view('crm/single-col-start',$data) ; 
            $this->load->view('crm/admin/add_site',$data) ;
			$this->load->view('crm/single-col-end',$data) ;


        } else
        {
        	
			

			$this->Site->add ( $this->input->post('name') , $this->input->post('site_url') , $this->input->post('owner_name') , 
			$this->input->post('contact_email') , $this->input->post('language') , $this->input->post('template') ) ;
			 								
            redirect('admin/sites' );



        }
		
		
		
		
		
	}
	
	function oauth2callback() {
		
		echo "da" ; 
	}



	function restore_backup() {

		$this->load->dbforge() ; 

		$site_id = 40 ; 


		echo "connect to backup database ... <br>" ; 
		$backup_db = $this->load->database('backup', TRUE);


		echo "restore backup database ... <br>" ; 

		

		$sql=file_get_contents('backups/tuesday.sql');
      	foreach (explode(";\n", $sql) as $sql) 
       	{
        	$sql = trim($sql);
          
           if($sql) 
               {
                $backup_db->query($sql);
               } 
      	} 

      		


      	echo "restore backup database - done ... <br><br>" ; 


      	echo "restore article categories ... <br>" ; 

      	$query = $backup_db->query("select * from article_categories where site_id =" . $site_id ) ; 
      	$this->db->query('delete from article_categories where site_id = ' . $site_id ) ; 
      	$this->db->insert_batch('article_categories' , $query->result() );


      	echo "restore articles ... <br>" ; 

      	$query = $backup_db->query("select * from articles where site_id =" . $site_id ) ; 
      	$this->db->query('delete from articles where site_id = ' . $site_id ) ; 
      	$this->db->insert_batch('articles' , $query->result() );

      	

      	echo "restore content ... <br>" ; 

      	$query = $backup_db->query("select * from content where site_id =" . $site_id ) ; 
      	$this->db->query('delete from content where site_id = ' . $site_id ) ; 
      	$this->db->insert_batch('content' , $query->result() );

      	

      	echo "restore news ... <br>" ; 

      	$query = $backup_db->query("select * from news where site_id =" . $site_id ) ; 
      	$this->db->query('delete from news where site_id = ' . $site_id ) ; 
      	$this->db->insert_batch('news' , $query->result() );


      	echo "restore pages ... <br>" ; 

      	$query = $backup_db->query("select * from pages where site_id =" . $site_id ) ; 
      	$this->db->query('delete from pages where site_id = ' . $site_id ) ; 
      	$this->db->insert_batch('pages' , $query->result() );


	}
	
		

	
	function index () {
				

		
		
		$this->load->model('Organizations') ;
		$this->load->model('Client') ;
				
		$data['org_list'] = $this->Organizations->get_organizations_list() ;
		$data['title'] = 'ניהול חברות ומשתמשים' ; 
		
		
		 				
		$this->load->view('crm/single-col-start',$data) ;
        $this->load->view('crm/admin/admin',$data) ;
		$this->load->view('crm/single-col-end',$data) ;
		
		
		
	}
	
	
	function delete($id) {
		

				
		
		// delete organization with all it's data ( logs , users , tasks )
				
		$this->load->model('Organizations') ;		
		$this->Organizations->delete($id) ; 
		
		
		echo $id ; 
		die() ; 		
		
		
		redirect('admin');
		
		
	}
	
	
	function addorganization() {

		
		$this->load->model('Organizations') ;
		$this->load->model('Client') ;
		$this->load->model('User') ;
		$this->load->model('Cashflow') ;
		
        $this->load->library('form_validation');					
		
		$this->form_validation->set_rules('org_name', 'org_name', 'required');
		$this->form_validation->set_rules('username', 'username', 'callback_check_user');
								
		
		$data['title'] = 'הוספת עסק חדש' ;
		$data['subtitle'] = 'פרטי עסק חדש' ;
		
		
        if ($this->form_validation->run() == FALSE)
        {		
		 					
			$this->load->view('crm/single-col-start',$data) ;				
			$this->load->view('crm/admin/addorganization',$data) ;
			$this->load->view('crm/single-col-end',$data) ;


        } else
        {
			
        	
			$new_org_id = $this->Organizations->add( $this->input->post('org_name') ,$this->input->post('description') , 
			$this->input->post('phone') , $this->input->post('mobile') , $this->input->post('email') , 
			$this->input->post('contact_name')	);
			
			/* carefull ! use new organization's ID for creating startup data */			
			$current_org_id = $this->session->userdata('org_id') ;			
			$this->session->set_userdata('org_id',$new_org_id);  
						
			
			
			/* create default user & pass */
			
			$new_user_id = $this->User->add ( $this->input->post('username') , 
			$this->input->post('password') , $this->input->post('contact_name') , $new_org_id ) ; 
			

			/* create client sources  */
			
			$this->Client->add_source('המלצה של לקוח') ;
			$this->Client->add_source('שיווק רשתי') ;
			$this->Client->add_source('אינטרנט') ;
			$this->Client->add_source('מפה לאוזן') ;
			
			
			/* create defualt earning types */ 
			
			$this->Cashflow->add_earning_type ('עסק') ;
			$this->Cashflow->add_earning_type ('אחר') ;
			
			
			/* create default expense types */
			
			$this->Cashflow->add_expense_type ('שכר דירה') ;
			$this->Cashflow->add_expense_type ('אוכל') ;
			$this->Cashflow->add_expense_type ('בילויים') ;
			$this->Cashflow->add_expense_type ('שונות') ;
			$this->Cashflow->add_expense_type ('רכב') ;
			$this->Cashflow->add_expense_type ('החזר הלוואות') ;
			$this->Cashflow->add_expense_type ('עסק - כללי') ;
			$this->Cashflow->add_expense_type ('עסק - הוצאות שיווק') ; 
						
			
			/* create new client */
			
			$new_client_id = $this->Client->add ( 'העסק שלי' , $this->input->post('org_name') , 
			$this->input->post('phone') , $this->input->post('mobile') , $this->input->post('email') , 
			'לקוח שהוגדר לניהול מטלות ופרויקטים הקיימים בתוך העסק שלי' , 2 , 0 	) ;  
			
			
			/* add notes to the new inner client */
			
			$this->Client->add_note($new_client_id , 'ניתן לרשום הערות בתוך כרטיס הלקוח. הערות יכולות לשמש למעקב אחר התקדמות או רישום הערות.' ) ;
			
			
			/* add some tasks to the new client */
			
			$this->Client->add_task ( $new_client_id , 'בתפריט הגדרות - להגדיר מקורות הגעה ללקוח.' , date('Y-m-d') ,$new_user_id) ;
			$this->Client->add_task ( $new_client_id , 'בתפריט הגדרות - להגדיר סוגי הכנסות והוצאות.' , date('Y-m-d') ,$new_user_id) ;
			$this->Client->add_task ( $new_client_id , 'להוסיף רשימת לקוחות בתפריט לקוחות' , date('Y-m-d') ,$new_user_id) ;
			$this->Client->add_task ( $new_client_id , 'להוסיף רשימת לקוחות פוטנציאליים (לידים) בתפריט לקוחות.' , date('Y-m-d') ,$new_user_id) ;  
			 			
			
			
			/* return to the original org ID */ 	
			$this->session->set_userdata('org_id',$current_org_id);
			
			
			
			/* send user & pass by mail */


			
			$this->load->library('autoresponder') ;
			
			$this->autoresponder->to_email($this->input->post('email'));
			$this->autoresponder->to_name($this->input->post('contact_name'));
			$this->autoresponder->variable_values(array('first_name' => $this->input->post('contact_name') , 'user' => $this->input->post('username') , 'pass' => $this->input->post('password') ));
			
			$this->autoresponder->send('welcome');
			 
			 		 		
			
						
			
			
			
			/* add to mailing list ... */ 
				
			$this->load->library('NewsletterMailerAPI') ; 		
			$nlapi = new NewsletterMailerAPI("http://open-college.co.il/newsletter/", "5ba2e770be2dfeb24746f0156fcd17f9");
			
			
			$data = array("e-mail" =>  $this->input->post('email') ,
			    "first_name" => $this->input->post('contact_name') ,   "last_name" => "",
			    "Category" => array(11)
			);
					
			if (!$nlapi->checkSubscriber($data["e-mail"])) {
				
			    $return = $nlapi->addSubscriber($data);
			
			    if ($return["status"] == "ok") {
			        
					redirect('admin');
			    } else {
			        echo "לא ניתן להוסיף לרשימת תפוצה:" . $return["msg"];
					die() ; 
			    }
			}else{				
				
			    echo "קיים ברשימת התפוצה";
				die () ; 
			} 
							
			
			

            redirect('admin');

        }		
		
		
	}



	function check_user($name) {
		
		
		$this->load->model('User') ;
		
		
		
		if ($this->User->check_name($name)) {
			
			$this->form_validation->set_message('check_user', 'שם משתמש קיים במערכת');
			return FALSE;
			
		} else  return true ; 
		
		
		
	}
	
	
	
	
	
	
	
	
    

}





?>
