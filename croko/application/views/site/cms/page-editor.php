<?

	if ( $_GET['cmd']=='save' ) {
		
		if ( $_POST['id'] == 'title' ) $this->Content->save_page_title( $page->id ,trim(strip_tags ( $_POST['content'] ) )) ;		
		else $this->Content->save_page_content( $_POST['id'] , $_POST['content'] ) ; 
			
		exit;  
		
	}

?>