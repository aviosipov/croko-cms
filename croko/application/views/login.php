<? $this->load->view('template/header-new-user') ; ?>

            

    <div class="righter full-width">
    <div class="projects">
    <div class="righthalf">
    <div class="setting-option">
	
	<br>	
	<? 	
	echo $error ; 	
	$attributes = array('class' => 'form', 'id' => 'myform');
    echo form_open('users/login',$attributes);
	?> 	
    
        <div class="contaline">
            <span class="contaname">שם משתמש</span>
            <div class="contaput">
                <input type="text" name="username" required="required" value=""/>
            </div>
        </div>
        <div class="contaline">
            <span class="contaname">סיסמה</span>
            <div class="contaput">
                <input type="password" name="password" value=""/>
            </div>
        </div>
        <br>
        <div class="contaline">
        <input type="submit" value="התחבר למערכת" class="pass"/>
        </div>
	    
    </form>
   
    </div>
            
    
            
    
    </div> <!-- righthalf -->
            

    
    
    </div>
        
        
        
        
    </div><!-- content -->
</div>

<? $this->load->view('template/footer') ; ?>
	    
        