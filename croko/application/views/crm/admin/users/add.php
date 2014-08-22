	
	
	
	<?
	
	echo validation_errors();
	
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open("admin/adduser",$attributes);
	
	$this->generator->render_input('username','שם משתמש',true,'' ) ;
	$this->generator->render_input('password','סיסמה',true,'' ) ;
	$this->generator->render_input('nickname','כינוי',true,'' ) ;
	
	
	$this->generator->render_submit('שמור') ;
	
	echo form_close() ;  
	
	
	
	?>
	
