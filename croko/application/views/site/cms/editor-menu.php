<?// 	if ($this->User->is_admin())  {  	?>
	
<? 		if ($thanks_scripts) echo $thanks_scripts ; // thank you page scripts only ... ?> 
<?      if ($this->User->is_logged_in()) { ?>
	
	

	<div id="photo_selector_dialog" >



		<label>
		בחר תמונה
		</label>
		
		<input type="file" id="image_selector" name="image_selector" /> 

		
		
		<button id="image_dialog_save_image" class="action  cms-button "><span class="label ">שמירה</span></button>
		<button id="image_dialog_close" class="action  cms-button "><span class="label ">ביטול</span></button>

		<div class="clear"></div>

		<div class="preview_box">
			<img src="<?=SYS_PATH?>images/cms/loading.gif" class="loadingAnimation" /> 
			<img id="preview_image"  class="previewImageFit not-editable" /> 
			<p>יש לבחור תמונה, לאחר בחירת התמונה בחרו את כיצד לחתוך את התמונה על ידי גרירת העכבר ע"ג התמונה המוצגת.</p>
		</div>

	</div>	




	<div class="cms-window">				
		<iframe id="cms-frame" class="cms-frame" ></iframe>		 		
	</div>

    <div class="cms-line">
    	
    	
        <div class="cms-content">
        	
        	
			<div class="cms-buttons xright">
			  
			  	
<!--
 				<a id="help"  class="cms-button menu-button "><span class="icon icon198 "></span><span class="label ">חיפוש</span></a> 
 			-->
 				<a id="settings"  class="cms-button menu-button "><span class="icon icon96 "></span><span class="label ">הגדרות</span></a>
 				<a id="galleries"  class="cms-button menu-button "><span class="icon icon115 "></span><span class="label">גלריות</span></a>
 				<!--
 				<a id="delete"  class="cms-button menu-button "><span class="icon icon186 "></span><span class="label ">מחיקה</span></a>
 				<a id="edit"  class="cms-button menu-button"><span class="icon icon145 "></span><span class="label ">עריכה</span></a>
				-->

			    <? if ($article->id > 0) { ?>

			    	<a id="action" action-url="/admin/delete/article/<?=$article->id;?>"  class="cms-button menu-button"><span class="icon icon186 "></span><span class="label ">מחיקה</span></a>
					<a id="action" action-url="/admin/edit/article/<?=$article->id;?>"  class="cms-button menu-button "><span class="icon icon145 "></span><span class="label ">עריכה</span></a>
 					
			    	
		    	<? } elseif ($page->id > 0) { ?>           
	            
	            	<a id="action" action-url="/admin/delete/page/<?=$page->id;?>"  class="cms-button menu-button"><span class="icon icon186 "></span><span class="label ">מחיקה</span></a>
					<a id="action" action-url="/admin/edit/page/<?=$page->id;?>"  class="cms-button menu-button "><span class="icon icon145 "></span><span class="label ">עריכה</span></a>
 					
		            
	            
	            <? } ?>




 				<a id="articles"  class="cms-button menu-button"><span class="icon icon55"></span><span class="label ">מאמרים</span></a>
 				<a id="pages"  class="cms-button menu-button"><span class="icon icon68"></span><span class="label ">עמודים</span></a>
			</div> <!-- /.cms-buttons -->     
			


			<div class="cms-buttons xleft">
				
				
			  

	            <button id="exit_admin" class="action blue cms-button "><span class="label ">יציאה</span></button>	
 				<button id="save_content" class="action red cms-button " ><span class="label ">שמירה</span></button>

 				
			</div> <!-- /.cms-buttons -->     
			
        	
            
        </div><!-- cms-content -->
    </div><!-- cms-line -->		
    

<? } ?> 