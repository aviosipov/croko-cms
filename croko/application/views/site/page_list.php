<?  $this->load->view('template/header-cms'); ?>


<body>


	<div class="cms-header">

		<div class="right">
			<h2>
				עמודים
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>

			</h2>
		</div>

		<div class="left">			
			<input class="search-box" type="text" placeholder="הזן מלל לחיפוש" id="search-field" />
			
		
		
			<a href="/admin/add/page" class="cms-button   left "><span class="icon icon3"></span><span class="label">דף חדש</span></a>

			
		</div> 
		
	</div>

	<div class="clear"></div>


	


	<div class="nano"> 


	<div class="page-list content">

	<? foreach ($page_list->result() as $page) { ?>
		
		<? if ($page->parent>0) $class = 'indent' ; else $class = '' ; ?>
		
		<div class="row page <?=$class;?>" row-id="<?=$page->id;?>" id="recordsArray_<?=$page->id;?>" >

			<div class="right">
				<h4 class="editable" data-field="title"><?=$page->title;?></h4>
				<a class="editable" data-field="url"><?=$page->url;?></a>				
			</div>

			<div class="left">

				
				 
				<img class="update-boolean-field <? if ($page->published == 0) echo 'not-active' ;  ?> " src="http://getcontrol.co.il/images/icons/cms/appbar.rss.png" title="פרסם דף" data-field="published" /> 
				<img class="update-boolean-field <? if ($page->show_in_menu == 0 ) echo 'not-active' ; ?>"   src="http://getcontrol.co.il/images/icons/cms/appbar.eye.png" title="הצג בתפריט ראשי" data-field="show_in_menu" /> 				
				<img class="action-link" data-target="/admin/editck/page/<?=$page->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.page.edit.png" title="עריכה"  /> 							
				<img class="action-link" data-target="/admin/edit/page/<?=$page->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.settings.png" title="הגדרות דף" /> 
				<img class="action-link alert" data-target="/admin/delete/page/<?=$page->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.delete.png" title="מחיקה" /> 
				
				<a class="clear" href="/<?=$page->url;?>" target="_blank">				
					<img src="http://getcontrol.co.il/images/icons/cms/appbar.new.window.png" title="פתח בחלון חדש" /> 
				</a> 

			</div>
		</div>



	<? } ?>

	</div>

	</div>







	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>

</body>