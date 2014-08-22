<?php

class Content extends CI_Model {
	
	
 	function __construct()
    {
        // Call the Model constructor
        parent::__construct();		
		$this->load->library('posts_parser');
    }	
	
	function get_image($name,$preset) {

		/// try loading file from disk png or jpg, if not
		/// found return preset. 

		if (file_exists('gallery/' . $name . '.jpg'  )) return '/gallery/' . $name . '.jpg' ; 
		elseif (file_exists('gallery' . $name . '.png')) return '/gallery/' . $name . '.png' ; 
		else return $preset ; 

	}	
	
	
	function empty_page($id) {
		
		
		// clear page contents ... 
		


        $data = array(
            
            'content' => ''  
             
        );

        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('pages',$data) ;
		
		
		
		
	}
	
	
	function clear_page($id) {
		
		// clear page format and remove html tags ... 
		
		
		$page = $this->get_page_by_id($id) ; 
		
		$clean = strip_tags($page->content,"<br><p><a><h1><h2><h3><h4><ul><li>") ; 
		$clean = preg_replace("'<style[^>]*>.*</style>'siU",'',$clean);
		
		
		$clean = preg_replace('/<p style="(.+?)">(.+?)<\/p>/i', "<p>$2</p>", $clean);
		$clean = preg_replace('/<h1 style="(.+?)">(.+?)<\/h1>/i', "<h1>$2</h1>", $clean);
		$clean = preg_replace('/<h2 style="(.+?)">(.+?)<\/h2>/i', "<h2>$2</h2>", $clean);
		$clean = preg_replace('/<h3 style="(.+?)">(.+?)<\/h3>/i', "<h3>$2</h3>", $clean);
		
		
		


        $data = array(
            
            'content' => $clean  
             
        );

        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('pages',$data) ;
		

		
		
	}
	
	
	
	function get_logo($width = 0 , $preset = '' ) {
		
		
		// get the logo and some other info first ...
		
		$this->db->select ('name , meta_title, logo' )  ;		
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		if ($site ) {

			if ($site->logo) $logoFile = '/gallery/' . $site->logo ; 
			else $logoFile = $preset ; 
			
			
			$image_properties = array(
			          'src' =>  $logoFile  ,
			          'alt' =>  $site->meta_title , 
			          
			);
			
			if ($width>0) $image_properties['width'] = $width ;  
			echo anchor('/' , img ( $image_properties  ) ) ;
			
			   
		} else return false ; 
		
		
		
	}


	function get_design_settings() {
			
    	$this->db->select ('design_settings' )  ;				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		return $site->design_settings ; 
			
				
	}


	function get_mobile_settings() {
			
    	$this->db->select ('mobile_settings' )  ;				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		return $site->mobile_settings ; 
			
				
	}



	function get_template_style() {
			
    	$this->db->select ('template_style' )  ;				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		return $site->template_style ; 
			
				
	}
	
	
	function save_template_style($style) {
		

        $data = array(
            'template_style' => $style  
        );
		
        
		$this->db->where('id', $this->config->item('site_id') ) ;				
	    $this->db->update('sites',$data) ;
				
		
	}
	


	function save_design_settings($style) {
		

        $data = array(
            'design_settings' => $style  
        );
		
        
		$this->db->where('id', $this->config->item('site_id') ) ;				
	    $this->db->update('sites',$data) ;
				
		
	}



	function save_mobile_settings($style) {
		

        $data = array(
            'mobile_settings' => $style  
        );
		
        
		$this->db->where('id', $this->config->item('site_id') ) ;				
	    $this->db->update('sites',$data) ;
				
		
	}
	
	
	function save_settings ( $site_name , $owner_name , $site_description , $contact_email , $online , $site_url , 
	$meta_title , $meta_keywords , $meta_description , $head_scripts , $thanks_scripts , $logo = '' , $google_analytics_code = '' ) {


        $data = array(
            
            'name' => $site_name  ,
            'owner_name' => $owner_name  ,
            'description' => $site_description  ,
            'contact_email' => $contact_email ,
            'online' => $online ,
            'site_url' => $site_url ,						
            'meta_title' => $meta_title  ,
            'meta_keywords' => $meta_keywords  ,
            'meta_description' => $meta_description  ,
            'head_scripts' => $head_scripts  ,
            'thanks_scripts' => $thanks_scripts  , 
            'google_analytics_code' => $google_analytics_code								             		
                         
        );
		
		if ($logo) $data['logo'] = $logo; // update image only if file is uploaded		
		
        
		$this->db->where('id', $this->config->item('site_id') ) ;				
	    $this->db->update('sites',$data) ;
		
		
		
	}
	
	
	
	
	function get_article_menu() {
		
        $this->db->select ('id,title' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $menu = $this->db->get('articles');
		

        foreach ($menu->result() as $menu_item) {
        	echo "<li>" . anchor("articles/$menu_item->id", $menu_item->title ) . "</li>" ;
		} 
		
		
		return true ;   		
				
		
	}
	
	
	function get_article_categories_by_description($desc='') {

        $this->db->select ('id,title,img,description' )  ;
		if ($desc) $this->db->where('description', $desc ) ;					        
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('article_categories');
		return $query ; 		

		
	}
	
	
	function get_article_categories() {
		
        $this->db->select ('id,title,img,description' )  ;		        
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('article_categories');
		return $query ; 		
		
		
	}

	function get_article_category($id) {
		
		
        $this->db->select ('id,title,img,description ' )  ;
		
		if (is_numeric($id)) $this->db->where('id',$id) ;
		else $this->db->where('title',$id) ;


		$this->db->where('site_id', $this->config->item('site_id') ) ;				
        $query = $this->db->get('article_categories');

        if ($query->num_rows() >0) {

	        $row = $query->row() ;				
			return $row ; 


        }	else return false ; 

				
	}
	
	
	
	
	function get_articles_by_custom($custom1 = '' , $custom2 = '' , $custom3 = '' , $custom4 = '' , $limit = 0) {

        $this->db->select ('*' )  ;
		
		
		if ($custom1) $this->db->where('custom1',$custom1) ;
		if ($custom2) $this->db->where('custom2',$custom2) ;
		if ($custom3) $this->db->where('custom3',$custom3) ;
		if ($custom4) $this->db->where('custom4',$custom4) ;
		
        $this->db->where('published',1) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		
		$this->db->order_by('order',"desc") ;
		$this->db->order_by('id',"desc") ;
		
		if ($limit>0) $this->db->limit($limit); 				
		
        $query = $this->db->get('articles');
		return $query ;  		

		
	}
	
	
	
	function get_articles_by_category($id, $limit=0) {

        $this->db->select ('*' )  ;
		$this->db->where('article_category_id',$id) ;		
        $this->db->where('published',1) ;				
		
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		
		$this->db->order_by('order',"desc") ;
		$this->db->order_by('id',"desc") ;
		
		if ($limit>0) $this->db->limit($limit); 				
		
        $query = $this->db->get('articles');
		return $query ;  		

		
	}
	
	
	

	
	
	function get_article_list($limit = 0 , $cat_id = '' , $search = '' , $published = 1 , $custom1 = '' , $custom2 = '' , $custom3 = '' , $custom4 = '' , $start=0) {
		

		if ($cat_id) {


			$aritcle_cat = $this->get_article_category($cat_id) ; 			
		 	$this->db->where('articles.article_category_id',$aritcle_cat->id) ;

		}

		
		
        $this->db->select ('*' )  ;		

        if ($published != 'all') $this->db->where('published',$published) ;


        if ($custom1 != '') $this->db->where('custom1',$custom1) ;
        if ($custom2 != '') $this->db->where('custom2',$custom2) ;
        if ($custom3 != '') $this->db->where('custom3',$custom3) ;
        if ($custom4 != '') $this->db->where('custom4',$custom4) ;

        /// get category 

        

        
		$this->db->where('articles.site_id', $this->config->item('site_id') ) ;
				
		
		
		if ($search) {
			
			$search = mysql_real_escape_string ($search) ; 						
			$where = "( articles.title LIKE '%$search%' OR articles.content LIKE '%$search%' OR articles.short LIKE '%$search%' )";
			
   			$this->db->where($where);
			
		}		 


		$this->db->join('article_categories', 'articles.article_category_id = article_categories.id', 'left');


		$this->db->order_by('articles.order',"asc") ;
		$this->db->order_by('articles.id',"desc") ;
		
		
		
		if ($limit>0) $this->db->limit($limit,$start);		
        $query = $this->db->get('articles');
		
		
		if ($limit==1) return $query->row() ; 
		else return $query ;  		
				
		
	}
	



	function search($search_text = '' , $limit = 0) {
		
		

		$this->db->select('title, content, id');
		

		
		if ($search_text) {
			
			
			$where = "( title LIKE '%$search_text%' OR content LIKE '%$search_text%' )";
   			$this->db->where($where);
			
		}		

		$this->db->from('pages');
		$query = $this->db->get();
		$this->db->_compile_select();
		$subQuery1 = $this->db->last_query();
		
		
		
		
		$this->db->_reset_select();
		
		// #2 SubQueries no.2 -------------------------------------------
		
		$this->db->select('title, content, id');
		

		
		if ($search_text) {
			
			
			$where = "( title LIKE '%$search_text%' OR content LIKE '%$search_text%' )";
   			$this->db->where($where);
			
		}		
		
		$this->db->from('articles');
		$query = $this->db->get();
		$this->db->_compile_select();
		$subQuery2 = $this->db->last_query();
		
		$this->db->_reset_select();
		
		
		echo $subQuery1 . '<br>' ;
		echo $subQuery2 . '<br>' ; 
		
		
		// #3 Union with Simple Manual Queries --------------------------
		
		$this->db->query("select * from ($subQuery1 UNION $subQuery2) as unionTable");
		
		// #3 (alternative) Union with another Active Record ------------
		
		$this->db->from("($subQuery1) UNION ($subQuery2)");
		$query = $this->db->get();
		
		return $query ; 		
				
				
				
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		
		
		
		
		
		
		
        $this->db->select ('id,url,title,content,img,published,article_category_id,password' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;		
		

		$this->db->order_by('order',"desc") ;
		$this->db->order_by('id',"desc") ;
		
		
		if ($search_text) {
			
			
			$where = "( title LIKE '%$search_text%' OR content LIKE '%$search_text%' )";
   			$this->db->where($where);
			
		}		
		
		
		if ($limit>0) $this->db->limit($limit);
				
		
        $query = $this->db->get('articles');
		return $query ; */  		
				
		
	}









	
	function get_article_by_title($title) {
		
		
	}
	
	
	function update_page($id,$title,$menu_title,$url,$meta_title,$meta_description,$meta_keywords, $order , $parent , 
	$published , $show_in_menu , $file_name , $password = '' , $template = '' , $mobile = '' , $custom1 = '' ,
	$custom2 = '' , $custom3 = '' , $custom4 = '' ) {
		
		

        $data = array(
            
            'title' => htmlspecialchars ( $title ) ,
            'menu_title' =>  htmlspecialchars ($menu_title ) ,
            'url' => $url ,
            'meta_title' => $meta_title  ,
            'meta_description' => $meta_description  ,
            'meta_keywords' => $meta_keywords  ,
            'order' => $order , 
            'site_id' => $this->config->item('site_id') , 
            'parent' => $parent ,
            'published' => $published ,
            'show_in_menu' => $show_in_menu , 
            'password' => $password  , 
            'template' => $template , 
            'mobile' => $mobile ,
            
			'custom1' => $custom1 ,
			'custom2' => $custom2 ,
			'custom3' => $custom3 ,
			'custom4' => $custom4 
			
        );

		if ($file_name) $data['img'] = $file_name; // update image only if file is uploaded


        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('pages',$data) ;
		
	}
	
	
	function update_article($id,$title,$url,$file_name,$meta_title,$meta_description,$meta_keywords , 
		$article_category_id , $short = '' , $order = 0 , $password = '' , $template = '' , $custom1 = '' ,
		$custom2 = '' , $custom3 = '' , $custom4 = ''  ) {
			
		  

        $data = array(
            
            'title' => htmlspecialchars ( $title )  ,  // remove slashes and other sepecial chars            
            'url' => $url ,            
            'meta_title' => $meta_title  ,
            'meta_description' => $meta_description  ,
            'meta_keywords' => $meta_keywords  ,            
            'site_id' => $this->config->item('site_id') , 
            'article_category_id' => $article_category_id , 
            'short' => $short , 
            'order' => $order , 
            'password' => $password , 
            'template' => $template ,
             
            'custom1' => $custom1 ,
            'custom2' => $custom2 ,
            'custom3' => $custom3 ,
            'custom4' => $custom4 
        );
		
		
		
			
		if ($file_name) $data['img'] = $file_name; // update image only if file is uploaded 


		 


        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('articles',$data) ;
		
	}	
	

	function delete_article($id) {
		

	    $this->db->where('id', $id);
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $this->db->delete('articles');

		
		
	}
	

	
	
	function delete_page($id) {
		

	    $this->db->where('id', $id);
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $this->db->delete('pages');

		
		
	}
	
	function delete_content($id) {

	    $this->db->where('id', $id);
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $this->db->delete('content');
		
	}


	function add_article_category ($title , $description , $img = '' ) {		

	    $data = array(
			'title' => $title ,
			'description' => $description , 
			'img' => $img , 
	        'site_id' => $this->config->item('site_id')             
	    );
	
	    $this->db->insert('article_categories', $data);	
	    
	    return $this->db->insert_id(); 
	
	}

	function delete_article_category($id) {

	    $this->db->where('id', $id);
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $this->db->delete('article_categories');

		
	}
	
	function update_article_category($id,$title,$description,$img='') {

        $data = array(
            'title' => $title  ,			
            'description' => $description					             			             
        );
		
		if ($img) $data['img'] = $img; // update image only if file is uploaded
				

		$this->db->where('site_id', $this->config->item('site_id') ) ;
        $this->db->where('id', $id) ;
	    $this->db->update('article_categories',$data) ;
		
	}

	

	function add_article ($url , $title , $img='' , $cat_id = 0 ) {		

	    $data = array(
	        'url' => $url  ,
			'title' => $title ,
			'content' => '' ,
			'img' => $img , 									 
	        'site_id' => $this->config->item('site_id') , 
	        'article_category_id' => $cat_id             
	    );
	
	    $this->db->insert('articles', $data);
		
		return $this->db->insert_id() ;
			
	
	}

	
	
	
	
	function add_page ($url , $title , $img = '') {
		
		  

	    $data = array(
	        'url' => $url  ,
			'title' => $title ,
			'content' => '' ,	
			'img' => $img ,								 
	        'site_id' => $this->config->item('site_id')             
	    );
	
	    $this->db->insert('pages', $data);	
	
	}
	
	
	function get_seo($page) {
		
		// returns Meta Tags for page/article is not empty, 
		// if not found return sitewide Meta tags. 
		
		
		
		$site = $this->get_site() ; 
		
		if ($page->meta_title!='') $seo_data['title'] = $page->meta_title ;
		else $seo_data['title'] = $site->meta_title . ' - '  . $page->title ;
		   
		if ($page->meta_keywords!='') $seo_data['keywords'] = $page->meta_keywords ;
		else $seo_data['keywords'] = $site->meta_keywords  ;


		if ($page->meta_description!='') $seo_data['description'] = $page->meta_description ;
		else $seo_data['description'] = $site->meta_description  ;
		 
		
		return $seo_data ; 
		
	}
	
	
	function get_site_name() {

        $this->db->select ('name' )  ;				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		return $site->name ; 
		
		
	}
	
	
	function get_site_language() {
		
    	$this->db->select ('language' )  ;				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		return $site->language ; 
			
		
		
	}
	
	
	function get_site() {


		
        $this->db->select ('*' )  ;
				
		$this->db->where('id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('sites');
        $site = $query->row() ;
		
		
		return $site ; 
				
		
		
	}
	
	
	function get_analytics() {

		$site = $this->get_site() ;
		return $site->google_analytics_code ; 
		
	}
	
	function get_head_scripts() {

		$site = $this->get_site() ;
		return $site->head_scripts ; 
		
	}
	
	
	
	function get_sub_menu($menu_id) {

        $this->db->select ('*' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('show_in_menu',1) ;
		$this->db->where('parent',$menu_id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		$this->db->order_by('order') ; 		
        $menu = $this->db->get('pages');
		
		
		if ($menu->num_rows() > 0 ) {
			
			echo '<ul class="sub-menu">' ; 

	        foreach ($menu->result() as $menu_item) {
	        	
				if ($menu_item->menu_title=='') $url = $menu_item->title ; 
				else $url = $menu_item->menu_title ;				
				
				if ($menu_item != end($menu->result())  ) echo "<li>" . anchor("$menu_item->url", "$url" ) . "</li>" ;
				else  echo '<li class="laster">' . anchor("$menu_item->url", "$url" ) . "</li>" ;
				
			}

			echo '</ul>' ;		
					
		} 
						 		
		
		
		return true ;   		
		

		
	}



	
	function get_mobile_menu ($span = '' , $current = 'current' , $force_active = '') {
		
		// $force_active is used for setting and active menu 'by force' and
		// ignore the current url 
		
		
        $this->db->select ('*' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('mobile',1) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		$this->db->order_by('order') ; 		
        $menu = $this->db->get('pages');
		
		$count = 2 ; 
		

        foreach ($menu->result() as $menu_item) {
        	
			 
        	// set menu title ... 
        	
			if ($menu_item->menu_title=='') $url = $menu_item->title ; 
			else $url = $menu_item->menu_title ;
			

			// check for current menu item ...
			
			if ($force_active!='') {
					
				if ( $force_active == $menu_item->url ) $current_class = $current ; 
				else $current_class = '' ;  
				 
				
			} else {

				// check for current menu item ...strtok i used for 
				// extracting the first segment from url i.e gallery/51 >> gallery 
				
				if ($this->uri->segment(1) ==  strtok( $menu_item->url ,'/' ) ) $current_class = $current ; 
				else $current_class = '' ;  
				
			}
			
			 

			echo '<li class="fosm menu-' . $count . ' ' . $current_class . '">' ;  
			
			?>
			
				<a href="#<?=$menu_item->url;?>"><?=$url;?></a>
			
			<? 
			
						
			
			 
			
			
			echo  "</li>" ;
			
			$count++ ; 
			
		}		
		

		
		return true ;   		
		
		
	}
	
		
	
	
	
	function get_menu ($span = '' , $current = 'current' , $force_active = '') {
		
		// $force_active is used for setting and active menu 'by force' and
		// ignore the current url 
		
		
        $this->db->select ('*' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('show_in_menu',1) ;
		$this->db->where('parent',0) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		$this->db->order_by('order') ; 		
        $menu = $this->db->get('pages');
		
		$count = 2 ; 
		

        foreach ($menu->result() as $menu_item) {
        	
			 
        	// set menu title ... 
        	
			if ($menu_item->menu_title=='') $url = $menu_item->title ; 
			else $url = $menu_item->menu_title ;
			

			// check for current menu item ...
			
			if ($force_active!='') {
					
				if ( $force_active == $menu_item->url ) $current_class = $current ; 
				else $current_class = '' ;  
				 
				
			} else {

				// check for current menu item ...strtok i used for 
				// extracting the first segment from url i.e gallery/51 >> gallery 
				
				if ($this->uri->segment(1) ==  strtok( $menu_item->url ,'/' ) ) $current_class = $current ; 
				else $current_class = '' ;  
				
			}
			
			 

			echo '<li class="fosm menu-' . $count . ' ' . $current_class . '">' . anchor("$menu_item->url", "$url" )  ;
			if ($span) echo $span ;
						
			
			$this->get_sub_menu($menu_item->id) ; 
			
			
			echo  "</li>" ;
			
			$count++ ; 
			
		}		
		

		
		return true ;   		
		
		
	}
	
	
	

	
	function get_menu_flat ($span = '' ) {
		
        $this->db->select ('*' )  ;		
        $this->db->where('published',1) ;
		$this->db->where('show_in_menu',1) ;
		$this->db->where('parent',0) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		$this->db->order_by('order') ; 		
        $menu = $this->db->get('pages');
		

        foreach ($menu->result() as $menu_item) {
        	
			if ($menu_item->menu_title=='') $url = $menu_item->title ; 
			else $url = $menu_item->menu_title ; 

			echo '<li class="fosm">' . anchor("$menu_item->url", "$url" )  ;
			if ($span) echo $span ;
		//	$this->get_sub_menu($menu_item->id) ; 
			
			echo  "</li>" ; 
			
		}		
		
						 		
		//return $query ;
		
		return true ;   		
		
		
	}	
	
	
	function get_parent_page_list() {
		
        $this->db->select ('*' )  ;		
        $this->db->where('published',1) ;
		//$this->db->where('parent',0) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		$this->db->order_by('order') ; 		
        $menu = $this->db->get('pages');
		
		return $menu ;   			
		
	}
	
	
	function get_page_list( $published = 0 , $mobile = 0 , $parent = 0 ) {
		
        $this->db->select ('*' )  ;
				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
		if ($published) $this->db->where('published', $published ) ;
		if ($mobile) $this->db->where('mobile', $mobile ) ;  
		if ($parent) $this->db->where('parent',$parent) ; 
		
		$this->db->order_by('order') ; 		
        $page_list = $this->db->get('pages');
		
		return $page_list ;    			
		
		
	}
	
	
	
	
	function save_page_title($id,$title) {

        $data = array(
            'title' => $title  ,								             
			'site_id' => $this->config->item('site_id')             
        );


        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('pages',$data) ;
		
	}
	
	
	
	function save_article_title($id,$title) {

        $data = array(
            'title' => $title  ,								 
            'site_id' => $this->config->item('site_id')
			             
        );


        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('articles',$data) ;
		
	}	
	
	

	function save_article_content($id,$content) {

        $data = array(
            'content' => $content  ,								 
            'site_id' => $this->config->item('site_id')             
        );


        $this->db->where('id', $id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('articles',$data) ;
		
	}




	
	
	
	function save_page_content($id,$content) {
		

        $data = array(
            'content' => $content  ,								 
            'site_id' => $this->config->item('site_id')             
        );
		
		
		if ($id>0) {
			
	        $this->db->where('id', $id) ;
			$this->db->where('site_id', $this->config->item('site_id') ) ;
	    	$this->db->update('pages',$data) ;
			
			
		} 
		
		else $this->db->insert('pages', $data);			
			
		
		
	}
	
	
	function get_article($id) {
		
        $this->db->select ('*' )  ;
		
		
		if (is_numeric($id)) $this->db->where('id',$id) ; 
		else $this->db->where('url',$id) ; // new - support for url in articles! 
						
        				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('articles');
        $article = $query->row() ;		
		
		return $article ; 
		
		
	}
	
	
	function get_article_short ($id,$limit=500) {

        $this->db->select ('*')  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('articles');
        $article = $query->row() ;
		
		if ($article->short!='') return $article->short ;
		elseif ($article->content!='') return mb_substr( strip_tags ( $article->content ) , 0 , $limit ) ; 
		//else return $article->title ; 


		
	}
	
	
	function get_page_by_id ($id) {
		
        $this->db->select ('*' )  ;
				
        $this->db->where('id',$id) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;				

		
        $query = $this->db->get('pages');
        $page = $query->row() ;		
		
		return $page ; 
		
		
	}
	
	
	function get_page_by_url ( $url ) {
		
        	
		
        $this->db->select ('*' )  ;
		
				
        $this->db->where('url',$url) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('pages');
        $page = $query->row() ;
		
		
		return $page ; 
		
		
	}
	
	function get_article_content ($id) {

        $this->db->select ('content' )  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $query = $this->db->get('articles');
        $article = $query->row() ;
		
		if ($article->content!='') {
			
			$content = $this->posts_parser->parse($article->content , $id , 'article');
			echo $content ; 
			return true;  ;
			
		}  					
		else return false ; 		
		
		
	}


	function get_article_content_by_id($id) {

        $this->db->select ('content' )  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('articles');
        $article = $query->row() ;		
		
		return $article->content ;

		
	}	
	
	
	
	function get_page_content_by_id($id) {

				
        $this->db->select ('content' )  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;

		
        $query = $this->db->get('pages');
        $page = $query->row() ;
		
		return $page->content ; 
				

		
	}
	
	
	function get_page_content ($id) {
		
		
		switch ($id ) {

		  	case 'thanks':	

				$lang = $this->get_site_language() ; 
				
				if ($lang=='he') {
					
	
					$content = "
					
					<h2>תודה על פנייתך!</h2>
					<br>
					 לקוח יקר, פנייתך התקבלה - נחזור אליך בהקדם.
					 <br>
					 <br>
					 
					  
					" ; 
					
					
				} else {
					
					$content = "
					
					<h2>Thank you for your request!</h2>
					<br>
					 Someone from our company will get back to you as quickly as possible.
					 <br>
					 <br>
					 
					  
					" ; 				
					
				}
				
				
				// thank you page ...
				
				$site_name = $this->get_site_name() ;  
	
				echo $content ; 						
				return true;  ;
		        
		        break;
		    case 'password':
		        
				echo '
				
				<h2>תוכן זה מוגן סיסמה, יש להזין סיסמת כניסה<h2>
				<br> '  ;  
				
							
				$attributes = array('class' => 'contact-form', 'id' => 'myform');
				$form_open =  form_open("admin/password",$attributes);
		 
				echo $form_open .  '
				
					<input type="hidden" name="id" value="">
				
				
				
					<input type="password" name="password"> 
					<input type="submit" value="כניסה">
				
				</form>
				
				
				' ;				
				
				
				
		        break;
		    
			default:
				
	
				// regualar page ... 
				
					
		        $this->db->select ('content' )  ;		
		        $this->db->where('id',$id) ;				
				$this->db->where('site_id', $this->config->item('site_id') ) ;
		
				
		        $query = $this->db->get('pages');
		        $page = $query->row() ;
				
				if ($page->content!='') {
		
		
					$content = $this->posts_parser->parse($page->content , $id , 'page');
					echo $content ; 						
					return true;  ;
					
				}  					
				else return false ; 					
				break;

			
		}
		
		

		 
		


		
		
	}
	
	function get_content_by_id ($id) {
				
        $this->db->select ('id,content' )  ;		
        $this->db->where('id',$id) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('content');
        $block = $query->row() ;
		
		return $block->content ; 
		
		
	}
	
	
	
	function get_content($name) {
		
		// search for content element, if found get it 
		// if not return false. 
		
		
		
		        			
        $this->db->select ('id,name,content' )  ;		
        $this->db->where('name',$name) ;				
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('content');
        $block = $query->row() ;
		
		
		if ($block->name!='') {
			
			$content = $this->posts_parser->parse($block->content);			
			echo $content  ;
			return true ; 
			
		}
		else return false ; 		
		
		 
		
	}

	function get_content_list() {

        $this->db->select ('id,name,content,published' )  ;						
		$this->db->where('site_id', $this->config->item('site_id') ) ;
		
        $query = $this->db->get('content');
		
		return $query ; 
		
        

		
	}
	
	
	function save_content_by_id ($id, $content) {


        $data = array(            
			'content' => $content 					 	            			             
        );
		
		
	    $this->db->where('id', $id ) ;
		$this->db->where('site_id', $this->config->item('site_id') ) ;
	    $this->db->update('content',$data) ;
		
		


		
	}
	
	
	
	function save_content($name , $content) {
		
		// if block exsits update it, if not create save it.
		

        $data = array(
            'name' => $name  ,
			'content' => $content ,					 	            
			'site_id' => $this->config->item('site_id')             
        );
		
		
				
		if ($this->get_content($name)) {
			
			// update record

	        $this->db->where('name', $name ) ;
			$this->db->where('site_id', $this->config->item('site_id') ) ;
    	    $this->db->update('content',$data) ;
			
			
			
		} else {
			
			

			// not found, add new conent block 
	
	        $this->db->insert('content', $data);		

			
			
		}
		
		 		

		
		
	}
	
	
}




?>