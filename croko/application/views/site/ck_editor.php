<?  $this->load->view('template/header-cms'); ?>


<body>
	
	
	<p class="hidden content-id" ><?=$id; ?></p>
	<p class="hidden content-type" ><?=$current_module; ?></p>
	

	<div class="cms-header">

		<div class="right">			
			<h2>

				<?
				

				switch ($current_module) {

					case 'pages':
						
						$action_title = 'עמודים' ;
						$action_url = 'page_list' ; 
						break;

					case 'articles':

						$action_title = 'מאמרים' ;
						$action_url = 'article_list' ; 
						break;					
					
				}
				?>

				<a href="/admin/<?=$action_url;?>"><?=$action_title;?></a> 


			<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
			עריכת תוכן 
			<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
			<?=$title;?></h2>
		</div>

		<div class="left">			
			
			<a class="cms-button  left save-content"><span class="icon icon44"></span><span class="label">שמור שינויים</span></a>

		</div> 
		
	</div>

	<div class="clear"></div>





	<div class="html-editor">

		
		<textarea name="editor"><?=$content;?></textarea>
		<script>CKEDITOR.replace( 'editor' , {  height:'425px'  } ); </script>


	</div>


	

	<div class="section-header">
		<? $this->load->view('site/menu') ; ?>  
	</div>



</body>