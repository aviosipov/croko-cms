<?  $this->load->view('template/header-cms'); ?>


<body content-height="280">
	


	<div class="cms-header">

		<div class="right">
			<h2>
				<a href="/admin/article_list">מאמרים</a> 	
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>

			</h2>
		</div>

		<div class="left">			
			<input type="submit" value=" שמור שינויים " class="cms-button left" tabindex="4"  form="myform" />			
		</div> 
		
	</div>
	<div class="clear"></div>	
	


<div class="right bar"> 	


	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("admin/add/$param?category=$category_title",$attributes); 
	?> 
	
	
     
        <label>שם המאמר</label>        
        <input id="article-name" tabindex="1" name="title" required="required" class="required" type="text" value=""/> 

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

		<br/>
    
        <label>כתובת (URL)</label>        
        <input name="url" tabindex="2" id="url-address" type="text" value=""/>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>
		<br/>
        
        
    	<label>תמונת מאמר</label>    
        <input type="file" tabindex="3" name="userfile" size="20" />
        
		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>
		
		<br/>
        
        
        <label>קטגוריה</label>        
		<?php echo form_dropdown('article_category_id', $article_cat_list, $category_id  ,  'tabindex="4"'); ?>

		<a href="#" class="tooltip">
			?
			<span>
				גשד  גךשחלד גלךש חגךשלףחלג שךףגלח שךףלדגח שלךףגח שדףךגח שדגףךשחדג ךףשחג שג
			</span>
		</a>

		<br/>	    
     	
  
		
    
	</form>

</div>

<div class="left bar">


	<? if ($status) { ?> 

	<div class="notification ok">		
		<p><?=$status ; ?></p>
	</div>

	<? } ?>

</div>


<div class="clear"></div>	

<div class="section-header">
	<? $this->load->view('site/menu') ; ?>  
</div>


</body>