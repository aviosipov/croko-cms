<?  $this->load->view('template/header-cms'); ?>
                
<body>
	

        
	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("admin/edit_article_category/$category->id",$attributes); 
	?>
	
	<h2>עריכת קטגוריה</h2>
	
	
	
	
	<div class="right-bar"> 
		
    	
		
		
		
		
		<label>שם<em>*</em></label>		
        <input required="required" name="title" type="text" value="<?=$category->title;?>"/>
        
        <label>תיאור</label>	                        	    
        <textarea name="description"><?=$category->description;?></textarea>
        

    	<label>תמונה</label>        
        <input type="file" name="userfile" size="20" />
        <br>
        <?=img("gallery/" . $category->img) ; ?>
        <br>
                
        
		<label>&nbsp;</label>
	    <input type="submit" value=" שמור שינויים " />
		         


        
    </div>
    
	    
	    
    </form>

	<? $this->load->view('site/menu') ; ?> 


    
    
    
    
            
</body>

