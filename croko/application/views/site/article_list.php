<?  $this->load->view('template/header-cms'); ?>


<body>


	<div class="cms-header">

		<div class="right">
			<h2>
				מאמרים
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>

			</h2>
		</div>

		<div class="left">			

			<!--

			<select id="example" name="example" multiple="multiple">

				<? foreach ($category_list->result() as $cat) { ?>
				<option value="<?=$cat->id;?>"><?=$cat->title;?></option>
				<? } ?> 
				
			</select>


			--> 


			<input class="search-box" type="text" placeholder="הזן מלל לחיפוש" id="search-field" />
		
			<a href="/admin/add/article?category=<?=$category;?>" class="cms-button   left "><span class="icon icon3"></span><span class="label">מאמר חדש</span></a>
			<a href="/admin/article_cat_list" class="cms-button   left "><span class="icon icon140"></span><span class="label">קטגוריות מאמרים</span></a>

			
		</div> 
		
	</div>

	<div class="clear"></div>







	<div class="nano"> 


	<div class="page-list content">

	<? foreach ($article_list->result() as $article) { ?>
		
		<? if ($article->parent>0) $class = 'indent' ; else $class = '' ; ?>
		
		<div class="row page <?=$class;?>" row-id="<?=$article->id;?>" id="recordsArray_<?=$article->id;?>" >



			<div class="right">

				<div class="article-header"> 
					<? if ($article->cat)  echo $article->cat; else echo 'ללא' ; ?>
				</div>

			</div>


			<div class="right">
				<h4 class="editable" data-field="title"><?=$article->title;?></h4>
				<a class="editable" data-field="url"><?=$article->url;?></a>				
			</div>

			<div class="left">

				
				 
				<img class="update-boolean-field <? if ($article->published == 0) echo 'not-active' ;  ?> " src="http://getcontrol.co.il/images/icons/cms/appbar.rss.png" title="פרסם מאמר" data-field="published" /> 				
				<img class="action-link" data-target="/admin/editck/article/<?=$article->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.page.edit.png" title="עריכה"  /> 							
				<img class="action-link" data-target="/admin/edit/article/<?=$article->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.settings.png" title="הגדרות מאמר" /> 
				<img class="action-link alert" data-target="/admin/delete/article/<?=$article->id;?>" src="http://getcontrol.co.il/images/icons/cms/appbar.delete.png" title="מחיקה" /> 

				<a class="clear" href="/articles/<?=$article->id;?>" target="_blank">				
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