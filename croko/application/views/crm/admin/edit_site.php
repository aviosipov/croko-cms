	
	
	
	<?
	
	echo validation_errors();
	
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open("admin/editsite/" . $site->id ,$attributes);
	
	$this->generator->render_input('name','שם האתר',true,$site->name ) ;
	$this->generator->render_input('site_url','כתובת האתר',0,$site->site_url ) ;
	$this->generator->render_input('owner_name','שם מנהל האתר',0,$site->owner_name ) ;
	$this->generator->render_input('contact_email','אימייל מנהל האתר',0,$site->contact_email ) ;
	
	$this->generator->render_checkbox('template','תבנית פנימית?',0,$site->template ) ;


	$select_options  = array(
      'he'  => 'עברית',
      'en'    => 'אנגלית'
    );
	
	$this->generator->render_select('language','שפה',0,$site->language,$select_options ) ;

	
	$this->generator->render_submit('שמור') ;
	
	echo form_close() ;  
	
	
	
	?>
	
