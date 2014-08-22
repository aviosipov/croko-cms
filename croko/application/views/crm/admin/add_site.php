	
	
	
	<?
	
	echo validation_errors();
	
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open("admin/addsite",$attributes);
	
	$this->generator->render_input('name','שם האתר',true,'' ) ;
	$this->generator->render_input('site_url','כתובת האתר',0,'' ) ;
	$this->generator->render_input('owner_name','שם מנהל האתר',0,'' ) ;
	$this->generator->render_input('contact_email','אימייל מנהל האתר',0,'' ) ;
	
	$this->generator->render_checkbox('template','תבנית פנימית?',0,'' ) ;
	



	$select_options  = array(
      'he'  => 'עברית',
      'en'    => 'אנגלית'
    );
	
	$this->generator->render_select('language','שפה',0,'he',$select_options ) ;



	 
	
	$this->generator->render_submit('שמור') ;
	
	echo form_close() ;  
	
	
	
	?>
	
