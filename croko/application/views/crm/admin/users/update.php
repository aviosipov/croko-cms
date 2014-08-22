	
	
	
	<?
	
	echo validation_errors();
	
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open("admin/edituser/" . $user->id ,$attributes);
	
	$this->generator->render_input('username','שם משתמש',true,$user->username  ) ;
	$this->generator->render_input('password','סיסמה',0,'' ) ;
	$this->generator->render_input('nickname','כינוי',true,$user->nickname ) ;
	
	
	$this->generator->render_submit('שמור') ;
	
	echo form_close() ;  
	
	
	
	?>
	
	<br>
	* - אם אינך רוצה לשנות את הסיסמה יש להשאיר את שדה הסיסמה ריק.
