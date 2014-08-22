<?  $this->load->view('template/header-cms'); ?>

                
<body>
	
	<h2><?=$title;?></h2>
	<a href="/galleries/addgallery" class="btn action-button"  >ביטול</a>
	<hr/>


        
	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("galleries/editgallery/$gallery->id",$attributes); 
	?>
	
	
	
	<div class="right-bar"> 
		
		<h3>הגדרות כלליות</h3>
    	
		
		<label>כותרת</label>		
        <input class="required" required="required" name="title" type="text" value="<?=$gallery->title;?>"/>
        
        

        
        <label>תיאור</label>	                        	    
        <textarea name="description"><?=$gallery->description;?></textarea>        

		<label>הצג בתפריטים</label>		
		<?=form_checkbox('show_in_menu', '1', $gallery->show_in_menu); ?>
        

    	<label>תמונת גלריה</label>        
        <input type="file" name="userfile" size="20" />
        
        
        <label>&nbsp;</label>
        <? if ($gallery->gallery_thumb) { ?>
        	<img src="/gallery/<?=$gallery->gallery_thumb;?>" class="right" width="250" />  
    	<? } ?> 
        
        
        



        
    </div>
    
    <div class="left-bar">	                        
	    
	    <h3>גדלים ומידות</h3>
	    
	    <label>רוחב תמונה מוקטנת</label>	    
        <input name="thumb_width" type="text" value="<?=$gallery->thumb_width;?>"/>
        
	    <label>רוחב תמונה בגודל מלא</label>	    
        <input name="full_width" type="text" value="<?=$gallery->full_width;?>"/>
        
        
        
        
        

	        	                        
		
		<label>&nbsp;</label>
	    <input class="btn" type="submit" value=" שמור שינויים " />
	    
    </div>
	    
	    
    </form>



    	<? $this->load->view('site/menu') ; ?> 


    
    
    
            
</body>

