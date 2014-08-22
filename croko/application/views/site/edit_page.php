<?  $this->load->view('template/header-cms'); ?>

                
<body>
	

	<div class="cms-header">

		<div class="right">
			<h2>

				<a href="/admin/page_list">עמודים</a>
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$page->title;?>


			</h2>
		</div>

		<div class="left">			
			<a href="/admin/editck/page/<?=$page->id;?>" class="cms-button  left"><span class="icon icon145"></span><span class="label">ערוך תוכן</span></a>
			<input type="submit" value=" שמור שינויים " class="cms-button left" tabindex="4"  form="myform" />

			
		</div> 
		
	</div>
	<div class="clear"></div>	



	
	
	

        
	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("admin/edit/page/$page->id",$attributes); 
	?>



	
	
	
	
	
	
	
	
	


	
	
	
	
	<div class="right bar"> 
		
		<h3>הגדרות כלליות</h3>
    	
		
		
		
		
		<label>שם העמוד</label>		
        <input class="required" required="required" name="title" type="text" value="<?=$page->title;?>"/>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

        
        <br/>
        
        <label>שם בתפריט</label>
        <input name="menu_title"  type="text" value="<?=$page->menu_title;?>"/>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

        <br/>
        


        <label>תפריט אב</label>        
		<?php echo form_dropdown('parent', $page_list, $page->parent ); ?>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>
		<br/>


    	<label>תמונת דף</label>                
    	<? if ($page->img) { ?> 
        <img src="<?="/gallery/" . $page->img ;?>" class="thumb right" />
        <label>&nbsp;</label>
        <? } ?>

        
        <input type="file" name="userfile" size="20" />
        
        <br/>
        
        

        <label>קוד מיון</label>
        <input name="order" type="text" value="<?=$page->order;?>"/>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

        <br/>        
        
      		

		


        


        <label>כתובת url</label>
        <input class="required" required="required" name="url" id="url-address" type="text" value="<?=$page->url;?>"/>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

        <br/>
        		

	    <label>פרסם דף</label>
	    <?=form_checkbox('published', '1', $page->published ); ?>


	
        <label>שדה מותאם אישית 1</label>
        <input name="custom1" type="text" value="<?=$page->custom1;?>"/>

        <label>שדה מותאם אישית 2</label>
        <input name="custom2" type="text" value="<?=$page->custom2;?>"/>

        <label>שדה מותאם אישית 3</label>
        <input name="custom3" type="text" value="<?=$page->custom3;?>"/>

        <label>שדה מותאם אישית 4</label>
        <input name="custom4" type="text" value="<?=$page->custom4;?>"/>	
		

		
		
		
		         


        
    </div>
    
    <div class="left bar">	                        
	    
	    <h3>תגי מטה</h3>
	    
	    <label>title - כותרת הדף</label>	    
        <input name="meta_title" type="text" value="<?=$page->meta_title;?>"/>

        
        
        <label>מילות מפתח - keywords</label>	                        	    
        <textarea name="meta_keywords"><?=$page->meta_keywords;?></textarea>
        
        <label>תיאור הדף</label>	                        	    
        <textarea name="meta_description"><?=$page->meta_description;?></textarea>
	        	                        
		
		<h3>הגדרות מתקדמות</h3>

	    <label>הצג במובייל</label>
	    <?=form_checkbox('mobile', '1', $page->mobile ); ?>


	    <label>הצג בתפריט</label>
	    <?=form_checkbox('show_in_menu', '1', $page->show_in_menu); ?>
		
		
		<label>מוגן בסיסמה</label>		
        <input name="password" type="text" value="<?=$page->password;?>"/>		


		<label>קוד תבנית</label>		
        <input name="template" type="text" value="<?=$page->template;?>"/>		

		
		
	    
    </div>
	    
	    
    </form>


	<div class="clear"></div>	
	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>

	

    
    
    
    
            
</body>

