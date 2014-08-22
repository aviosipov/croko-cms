<?  $this->load->view('template/header-cms'); ?>

<body> 
                	
	<div class="cms-header">

		<div class="right">
			<h2>
				<?=$title;?>

			</h2>
		</div>

		<div class="left">			
			
			<input type="submit" value=" שמור שינויים " class="cms-button left" tabindex="4"  form="myform" />
		</div> 
		
	</div>
	<div class="clear"></div>	
	

        
	<? 
		$attributes = array('class' => 'form', 'id' => 'myform');
		echo form_open_multipart("admin/settings",$attributes); 
	?> 
    	
    	
    	
    	
    	
    	<div class="right bar">
    		
    		<h3>הגדרות כלליות</h3>
    	
	    	<label>קוד האתר</label>
	    	<input type="text" value="<?=$site->id;?>" disabled="disabled" />
	    	
	    	
	    	
	    	<label>שם האתר<em>*</em></label>
	    	<input required="required" name="site_name" type="text" value="<?=$site->name;?>"/>
	    	
	    	<label>שם מנהל האתר<em>*</em></label>
	    	<input required="required" name="owner_name" type="text" value="<?=$site->owner_name;?>"/>
	    	
	    	
	    	<label>אימייל לקבלת פניות מהאתר<em>*</em></label>
	    	<input required="required" name="contact_email" type="text" value="<?=$site->contact_email;?>"/>
	            	                        
	        <!--
	        <label>תיאור האתר</label>
	        <textarea name="site_description"><?=$site->description;?></textarea>
	        -->
	        
	        <label>אתר פעיל?</label>
	        <?=form_checkbox('online', '1', $site->online ); ?>
	        
	        
	        <label>כתובת האתר</label>
	        <input name="site_url" type="text" value="<?=$site->site_url;?>"/>
	        

	    	<label>תמונת לוגו</label>        
	        <input type="file" name="userfile" size="20" />
	        
	        
	        <? if ($site->logo) { ?> 
	        <label>&nbsp;</label>
	        <img width="75" src="/gallery/<?=$site->logo;?>" class="thumb right" />
	        
	        <? } ?> 
	        

	        
	        
        
        
        </div>
        
        <div class="left bar">
        	
        	<h3>הגדרות SEO </h3>

        
	        <label>title - כותרת האתר</label>        
	        <input name="meta_title" type="text" value="<?=$site->meta_title;?>"/>
	        
	        <label>מילות מפתח - keywords</label>	                                
	        <textarea name="meta_keywords"><?=$site->meta_keywords;?></textarea>
	        
	        <label>תיאור האתר - description</label>	                                
	        <textarea name="meta_description"><?=$site->meta_description;?></textarea>
	        
	        <label>קוד Google Analytics</label>
	        <textarea name="google_analytics_code"><?=$site->google_analytics_code;?></textarea>

	        <label>סקריפטים כלליים לאתר</label>
	        <textarea name="head_scripts"><?=$site->head_scripts;?></textarea>
	        
	        <label>סקריפטים לדף המרה לאחר ביצוע פנייה</label>
	        <textarea name="thanks_scripts"><?=$site->thanks_scripts;?></textarea>
	        
	        
	        
        
        </div>
        
        
    </form>

	
	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>

    
                    
                            
</body>                