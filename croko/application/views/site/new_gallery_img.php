<?  $this->load->view('template/header-cms'); ?>


<body>	

	<div class="cms-header">

		<div class="right">
			<h2><a href="/galleries/addgallery">גלריות</a> <img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  <?=$gallery->title;?></h2>
		</div>

		<div class="left">			
			<a class="btn action-button toggle-button" title="הוסף תמונות לגלריה" >הוסף תמונה</a>	
		</div> 
		
	</div>

	<div class="clear"></div>
	
	
	
	
	
	
	
	<div id="ui-slider" >
		
		
		<div class="panel" id="main-panel">




			
			
			
		
			<div id="copycode" class="copycode">
				<input id="mycode" value="" />
			</div>
			

			&nbsp;


			<div class="sortable-images">
		
		
			<? foreach ($img_list->result() as $img ) { ?>



			


			<div class="gallery-image" id="recordsArray_<?=$img->id;?>">

				<div class="img">

					<div class="flip"> 
				        <div class="card"> 
				            <div class="face front"> 

								<? 

								if ($img->filename ) $pic = '/gallery/' . $img->filename ; 
								else $pic = 'http://buildinternet.s3.amazonaws.com/projects/mosaic/desroches.jpg' ; 
								
								?>

								<img src="<?=$pic;?>">
				                
				            </div> 
				            <div class="face back"> 


								<input name="id" value="<?=$img->id;?>" type="hidden"/>
								<input name="title" required="required" type="text" value="<?=$img->title;?>" class="required"/>
								<textarea name="description"><?=$img->description;?></textarea>								
							    <input class="btn btn-save-image-info" type="submit" value=" שמור שינויים " />
				                




				            </div> 
				        </div> 
				    </div>



				</div>

				<div class="desc">

					<div class="right">
						<?=$img->title;?>
					</div>

					
					<div class="edit-image left">

						<?

						$baseurl = 'http://' . $_SERVER['SERVER_NAME'] ;  

						?>

						
						<img class="embed-img" data-ckid="<?=$CKEditorFuncNum;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.add.png" data-url="/gallery/<?=$img->filename;?>" />

						<img class="action-link 06opacity" src="http://getcontrol.co.il/images/icons/cms/appbar.page.edit.png" data-target="/galleries/editimage/<?=$img->id;?>" />
						<img src="http://getcontrol.co.il/images/icons/cms/appbar.image.hdr.png" onclick="pixlr.edit({image:'<?=$baseurl;?>/gallery/<?=$img->filename;?>', title:'', service:'editor' , target : '<?=$baseurl;?>/galleries/saveimage/<?=$img->id;?>' });" />												
						<img class="action-link" src="http://getcontrol.co.il/images/icons/cms/appbar.delete.png" data-target="/galleries/delimage/<?=$img->id;?>" />






					</div>


				</div>


			</div>


		
				
			
			
			<? } ?>	


			</div>
		
		
		
	
			<!--
			
			<div class="mosaic-block bar2">
				<a href="" class="mosaic-overlay" style="display: inline; left: 0px; bottom: -50px; ">
					<div class="details">
						
						<div class="gallery-info"> 
						
						</div>					
						
						
						<h4><?=$img->title;?></h4>
						<p>
							
							
							


							<div class="action-link" data-target="/galleries/editimage/<?=$img->id;?>" >ערוך</div>
							<div class="action-link" data-target="/admin/crop/<?=$img->filename;?>" >גזור</div>
							<div class="action-link" data-target="/galleries/delimage/<?=$img->id;?>" >מחק</div>



							

							<div onclick="generate_img_code(<?=$img->id;?>);" >צור קוד</div>
							<div onclick="divdd_image_to_page(<?=$img->id;?>);" >הוסף לדף</div>
							

							
						</p>
						
						
					</div>
				</a>
				<div class="mosaic-backdrop" style="display: block; ">
					<a href="/gallery/<?=$img->filename;?>">
					
					<? 

					if ($img->filename ) $pic = '/gallery/' . $img->filename ; 
					else $pic = 'http://buildinternet.s3.amazonaws.com/projects/mosaic/desroches.jpg' ; 
					
					?>

					<img src="<?=$pic;?>">
					</a>
				</div>
			</div>			
		
			--> 
		
		
		
		
		
		
			
						
			
			
			
			
			
			
			
		</div>
		
		
		
		<div class="panel" id="info-panel">
			


		
		
			<h3 class="title">הוספת תמונה לגלריה</h3>
		
		
			<br>
		
			<? 
			$attributes = array('class' => 'form', 'id' => 'myform');
			echo form_open_multipart("galleries/addimage/$gallery_id/$custom1",$attributes);	 
			?> 
			
			
				<label>כותרת</label>
				<input name="title" required="required" type="text" value="" class="required"/>
				
				<label>תיאור</label>
				<textarea name="description"></textarea>
				
				
				<label>תמונה</label>
				<input type="file" name="userfile" size="20" />
		
				<label>שדה מותאם אישית 1</label>
				<input name="custom1" type="text" value="<?=$custom1;?>"/>
		
				<label>שדה מותאם אישית 2</label>
				<input name="custom2" type="text" value=""/>
		
				
				<label>&nbsp;</label>
			    <input class="btn" type="submit" value=" שמור שינויים " />
		    
		    
			</form>			
					
					
		</div>
		
		
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	 

	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>
 


</body>