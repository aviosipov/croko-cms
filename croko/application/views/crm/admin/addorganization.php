
    <?

    echo validation_errors();

    $attributes = array('class' => 'form', 'id' => 'myform');
    echo form_open("admin/addorganization",$attributes);


    
    
    $this->generator->render_input('org_name','שם העסק',true, '' ) ; 
    $this->generator->render_textarea('description','תיאור',0, '' ) ;
	$this->generator->render_input('contact_name','שם איש קשר',0, '' ) ;
	$this->generator->render_input('phone','טלפון',0, '' ) ; 
    $this->generator->render_input('mobile','נייד',true, '' ) ;
	$this->generator->render_input('email','email',0, '' ) ;
	$this->generator->render_input('username','שם משתמש',true, '' ) ;
	$this->generator->render_password('password','סיסמה',true, '' ) ;
	
	$this->generator->render_submit('שמור שינויים') ;
	
    ?>

        
    </form>


