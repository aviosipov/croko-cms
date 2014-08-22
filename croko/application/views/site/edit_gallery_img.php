<?  $this->load->view('template/header-cms'); ?>


<body>



	<div class="cms-header">

		<div class="right">
			<h2><a href="/galleries/addimage/<?=$gallery_id;?>"><?=$gallery_title;?></a> <img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  <?=$title;?></h2>
		</div>

		<div class="left">			
			
			
		</div> 
		
	</div>

	<div class="clear"></div>


	

	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("galleries/editimage/$imgx->id",$attributes);	 
	?> 
		
		
		
		
	
		<label>כותרת</label>
		<input name="title" class="required" required="required" type="text" value="<?=$imgx->title;?>"/>
		
		<label>תיאור</label>
		<textarea name="description"><?=$imgx->description;?></textarea>
		
		
		<label>תמונה</label>
		<input type="file" name="userfile" size="20" />
		<img class="thumb" src="/gallery/thumbs/<?=$imgx->filename;?>" />		
		


		<label>שדה מותאם אישית 1</label>
		<input name="custom1" type="text" value="<?=$imgx->custom1;?>"/>

		<label>שדה מותאם אישית 2</label>
		<input name="custom2" type="text" value="<?=$imgx->custom2;?>"/>
    
		<label>&nbsp;</label>
	    <input class="btn" type="submit" value=" שמור שינויים " />
    
	</form>


	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>
 


</body>