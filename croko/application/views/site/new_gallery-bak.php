<?  $this->load->view('template/header-cms'); ?>


<body>





	<div class="cms-header">

		<div class="right">
			
			<h2><?=$title;?></h2>
			
		</div>

		<div class="left">			
			
			
		
		
			<!--<a class="cms-button   left  toggle-button"><span class="icon icon3"></span><span class="label">גלריה חדשה</span></a> -->
			<a class="btn action-button toggle-button" title="הוסף גלריה" >הוסף גלריה</a>
			
		</div> 
		
	</div>

	<div class="clear"></div>






	

	<div id="ui-slider" >


	<div class="panel" id="main-panel">
    	

    	<div class="sortable-galleries">	
		<? foreach ($gallery_list->result() as $gallery ) { ?>
			
	
			<div class="mosaic-block bar2" id="recordsArray_<?=$gallery->id;?>">
				<a href="" class="mosaic-overlay" style="display: inline; left: 0px; bottom: -50px; ">
					<div class="details">
						
						<div class="gallery-info"> 
						#<?=$gallery->id; ?> 
						</div>					
						
						
						<h4><?=$gallery->title;?>&nbsp;<? if ($gallery->description) echo '( ' . $gallery->description . ' )' ; ?> </h4>
						<p>
							
							
							<div class="small-menu-button action-link" data-target="/galleries/editgallery/<?=$gallery->id;?>">עריכה</div>
							<div class="small-menu-button action-link alert" data-target="/galleries/delgallery/<?=$gallery->id;?>">מחיקה</div>
							<div class="small-menu-button action-link" data-target="/galleries/updatethumbs/<?=$gallery->id;?>">עדכן תמונות ממוזערות </div>
							
						</p>
						
						
					</div>
				</a>
				<div class="mosaic-backdrop" style="display: block; ">
					<a href="/galleries/addimage/<?=$gallery->id;?>">
					
					<? 
					$img = '' ; 
					if ($gallery->gallery_thumb ) $img = '/gallery/' . $gallery->gallery_thumb ; 
					if ($img == '') $img = 'http://buildinternet.s3.amazonaws.com/projects/mosaic/desroches.jpg' ; 
					
					?>
						
						
					<img src="<?=$img;?>">
					</a>
				</div>
			</div>
		
			
		<? } ?>
		</div>
	
	
		
		
	</div>	
	
	
	<div class="panel" id="info-panel">



	
	
		<h3 class="title">הוספת גלריה חדשה</h3>
	
	
		<br>
		
		<? 
		$attributes = array('class' => 'form', 'id' => 'myform');
		echo form_open("galleries/addgallery",$attributes); 
		?> 
			
			
			
			<label>שם</label>
		    <input name="title" type="text" required="required" value=""/>
		    
		    <label>תיאור</label>
		    <textarea name="description"></textarea>
		    
		        
		    <label>&nbsp;</label>
		    <input class="btn" type="submit" value=" שמור שינויים " />
		    
		    
		</form>
		
	</div>

	</div>
	
	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>
 


</body>