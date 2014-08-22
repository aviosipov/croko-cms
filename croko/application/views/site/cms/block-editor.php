<?


	if ( $_GET['cmd']=='save' ) {
			
		// don't save empty content ... 
		if ( $_POST['content'] ) $this->Content->save_content( $_POST['id'] , $_POST['content'] ) ;
		
		exit;  
		
	}



?>