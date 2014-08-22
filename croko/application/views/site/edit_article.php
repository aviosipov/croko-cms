<?  $this->load->view('template/header-cms'); ?>

                
<body>
	

	<div class="cms-header">

		<div class="right">
			<h2>

				<a href="/admin/article_list">מאמרים</a>
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$article->title;?>


			</h2>
		</div>

		<div class="left">			
			<a href="/admin/editck/article/<?=$article->id;?>" class="cms-button  left"><span class="icon icon145"></span><span class="label">ערוך תוכן</span></a>
			<input type="submit" value=" שמור שינויים " class="cms-button left" tabindex="4"  form="myform" />
			
		</div> 
		
	</div>
	<div class="clear"></div>	


        
	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("admin/edit/article/$article->id",$attributes); 
	?>
	
	
	
	
	<div class="right bar"> 
		
		<h3>הגדרות כלליות</h3>
    	
		
		<label>שם המאמר</label>		
        <input required="required" name="title" type="text" value="<?=$article->title;?>"/>
                

        <label>תקציר</label>	                        	    
        <textarea name="short"><?=$article->short;?></textarea>        
        
        
        <label>קטגוריה</label>        
		<?php echo form_dropdown('article_category_id', $article_cat_list, $article->article_category_id ); ?>

        <label>כתובת URL</label>
        <input name="url" id="url-address" type="text" value="<?=$article->url;?>"/>


    	        
    	<label>תמונת מאמר</label>    	        
    	<? if ($article->img) { ?> 
        <img src="<?="/gallery/" . $article->img ;?>" class="thumb right" />
        <label>&nbsp;</label>
        <? } ?>


        <input type="file" name="userfile" size="20" />
        
        
        



        




        <label><? if ($design_settings['articles-custom1']) echo $design_settings['articles-custom1']; else echo 'שדה מותאם אישית 1' ; ?></label>
        <input name="custom1" type="text" value="<?=$article->custom1;?>"/>

        <label><? if ($design_settings['articles-custom2']) echo $design_settings['articles-custom2']; else echo 'שדה מותאם אישית 2' ; ?></label>
        <input name="custom2" type="text" value="<?=$article->custom2;?>"/>

        <label><? if ($design_settings['articles-custom3']) echo $design_settings['articles-custom3']; else echo 'שדה מותאם אישית 3' ; ?></label>        
        <textarea name="custom3" ><?=$article->custom3;?></textarea>

        <label><? if ($design_settings['articles-custom4']) echo $design_settings['articles-custom4']; else echo 'שדה מותאם אישית 4' ; ?></label>
        <input name="custom4" type="text" value="<?=$article->custom4;?>"/>
        



        
    </div>
    
    <div class="left bar">	                        
	    
	    <h3>תגי מטה</h3>
	    
	    <label>title - כותרת הדף</label>	    
        <input name="meta_title" type="text" value="<?=$article->meta_title;?>"/>
        
        <label>מילות מפתח - keywords</label>	                        	    
        <textarea name="meta_keywords"><?=$article->meta_keywords;?></textarea>
        
        <label>תיאור הדף</label>	                        	    
        <textarea name="meta_description"><?=$article->meta_description;?></textarea>

		
		<h3>הגדרות מתקדמות</h3>	        	                        
	        
        <label>סיסמת מאמר</label>
        <input name="password" type="text" value="<?=$article->password;?>"/>

        <label>קוד תבנית</label>
        <input name="template" type="text" value="<?=$article->template;?>"/>
        	                        

	    <label>קוד מיון</label>	    
        <input name="order" type="text" value="<?=$article->order;?>"/>
		
		
        <label><a href="/galleries/addimage/products/<?=$article->id;?>">קישור לגלריה</a></label>


		
		
	    
    </div>
	    
	    
    </form>

	<div class="clear"></div>	
	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>

	

    
    
    
    
            
</body>

