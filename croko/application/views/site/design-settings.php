<?  $this->load->view('template/header-cms'); ?>

<body> 
                	

        
	<? 
		$attributes = array('class' => 'form', 'id' => 'myform');
		echo form_open_multipart("admin/designsettings",$attributes); 
	?> 
    	
    	
    	<h2><?=$title;?></h2>
    	
    	
    	<div class="right-bar">
    		
    		
    		
    		
    		<h3>תמונת עמוד</h3>
    		
	    	<label>רוחב</label>
	    	<input name="page-pic-width" type="text" value="<?=$style['page-pic-width'] ; ?>"/>

	    	<label>גובה</label>
	    	<input name="page-pic-height" type="text" value="<?=$style['page-pic-height'] ; ?>"/>



    		<h3>תמונת מאמר</h3>
    		
	    	<label>רוחב</label>
	    	<input name="article-pic-width" type="text" value="<?=$style['article-pic-width'] ; ?>"/>

	    	<label>גובה</label>
	    	<input name="article-pic-height" type="text" value="<?=$style['article-pic-height'] ; ?>"/>


    		<h3>תמונת דף מאמרים</h3>
    		
	    	<label>רוחב</label>
	    	<input name="articles-pic-width" type="text" value="<?=$style['articles-pic-width'] ; ?>"/>

	    	<label>גובה</label>
	    	<input name="articles-pic-height" type="text" value="<?=$style['articles-pic-height'] ; ?>"/>



    		
    		


	
        
        </div>
        
        <div class="left-bar">
        	
        	<h3>כותרות לשדות מותאמים אישית - מאמרים</h3>

    		
	    	<label>שדה מותאם אישית 1</label>
	    	<input name="articles-custom1" type="text" value="<?=$style['articles-custom1'] ; ?>"/>

	    	<label>שדה מותאם אישית 2</label>
	    	<input name="articles-custom2" type="text" value="<?=$style['articles-custom2'] ; ?>"/>
    		    		
	    	<label>שדה מותאם אישית 3</label>
	    	<input name="articles-custom3" type="text" value="<?=$style['articles-custom3'] ; ?>"/>

	    	<label>שדה מותאם אישית 4</label>
	    	<input name="articles-custom4" type="text" value="<?=$style['articles-custom4'] ; ?>"/>





        	<h3>כותרות לשדות מותאמים אישית - דפי תוכן</h3>

    		
	    	<label>שדה מותאם אישית 1</label>
	    	<input name="pages-custom1" type="text" value="<?=$style['pages-custom1'] ; ?>"/>

	    	<label>שדה מותאם אישית 2</label>
	    	<input name="pages-custom2" type="text" value="<?=$style['pages-custom2'] ; ?>"/>
    		    		
	    	<label>שדה מותאם אישית 3</label>
	    	<input name="pages-custom3" type="text" value="<?=$style['pages-custom3'] ; ?>"/>

	    	<label>שדה מותאם אישית 4</label>
	    	<input name="pages-custom4" type="text" value="<?=$style['pages-custom4'] ; ?>"/>









	        <label>&nbsp;</label>
	        <input type="submit" value=" שמור שינויים " />
        
        </div>
        
        
    </form>



    	<? $this->load->view('site/menu') ; ?> 


    
    
                    
                            
</body>                