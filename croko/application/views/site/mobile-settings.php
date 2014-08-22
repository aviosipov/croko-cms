<?  $this->load->view('template/header-cms'); ?>

<body> 
                	

        
	<? 
		$attributes = array('class' => 'form', 'id' => 'myform');
		echo form_open_multipart("admin/mobilesettings",$attributes); 
	?> 
    	
    	
    	<h2><?=$title;?></h2>
    	
    	
    	<div class="right-bar">
    		
    		
    		
    		
    		<h3>הגדרות דפי מאמרים</h3>


	        <label>קוד קטגוריית מאמרים</label>
	        <input name="articles-category" type="text" value="<?=$mobile_settings['articles-category'] ; ?>"/>
	        
    		


	        <label>הצג תמונות ברירת מחדל</label>
	        <?=form_checkbox('articles-default-image', '1', $mobile_settings['articles-default-image']  ); ?>
    		



			
    		
    		<h3>הגדרות גלריות</h3>


	        <label>קוד גלריה</label>
	        <input name="gallery-id" type="text" value="<?=$mobile_settings['gallery-id'] ; ?>"/>
	        
      		
    		
    		<label>&nbsp;</label>
			<input type="submit" value=" שמור שינויים " />

        			

	
        
        </div>
        
        <div class="left-bar">
        	
		

        </div>
        
        
    </form>



    	<? $this->load->view('site/menu') ; ?> 

    
    
                    
                            
</body>                