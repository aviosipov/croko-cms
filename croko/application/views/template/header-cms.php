<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="he">

	
	<head>
	
	    
	    
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	    
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	    <link rel="stylesheet" media="screen" href="<?=SYS_PATH?>css/cms/cms-new.css" />
	    <link rel="stylesheet" media="screen" href="<?=SYS_PATH?>css/cms/cms-buttons.css" />
	    <link rel="stylesheet" media="screen" href="<?=SYS_PATH?>css/cms/flip-cards.css" />


 		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    
    	


    	<!-- load alert plugins --> 

		<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/humane-js/bigbox.css" type="text/css" media="screen">    
		<script src="<?=SYS_PATH?>js/cms/back/humane.min.js"></script>	    
	    	    
	    
	    <!-- load google style buttons -->
	    
	    <link rel="stylesheet" href="<?=SYS_PATH?>css/cms/css3-buttons.css" type="text/css" media="screen">    
		<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/tiptip.css" type="text/css"  media="screen">
		<script src="<?=SYS_PATH?>js/jquery.tiptip.js"></script>	    
	    
	    
	    	    
	        
	    <!-- jquery crop plugin -->
	    
		<script src="<?=SYS_PATH?>js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="<?=SYS_PATH?>css/jquery.Jcrop.css" type="text/css" />    
	
	    	    
    	<!-- jquery color picker plugin -->
	
		<link rel="stylesheet" media="screen" type="text/css" href="<?=SYS_PATH?>css/cms/colorpicker.css" />
		<script type="text/javascript" src="<?=SYS_PATH?>js/colorpicker.js"></script>    	
		
		<!-- Load Mosaic jQuery pblub -->
		
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/mosaic.1.0.1.js"></script>
		<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/mosaic.css" type="text/css" media="screen" />


		<!-- load slider functions --> 
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/jquery.bxSlider.js" ></script>
		<link rel="stylesheet" media="screen" type="text/css" href="<?=SYS_PATH?>css/cms/bx_styles.css" />


		<!-- load custom multi-select jquery ui widget --> 
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/jquery.multiselect.min.js" ></script>
		<link rel="stylesheet" media="screen" type="text/css" href="<?=SYS_PATH?>js/cms/back/jquery.multiselect.css" />



		<!-- load custom scrollbars --> 
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/nanoScroller/javascripts/ga.js"></script>
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/nanoScroller/javascripts/overthrow.min.js"></script>
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/nanoScroller/javascripts/jquery.nanoscroller.min.js"></script>
		<link rel="stylesheet" href="<?=SYS_PATH?>js/cms/back/nanoScroller/css/nanoscroller.css"> 
		
	
		<!-- Custom CMS Backend functions --> 		
		<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/general.js"></script>



		




		<!-- load custom JS scripts --> 

		<? 


		if ($custom_script) {

			if (is_array($custom_script)) {

				foreach ($custom_script as $script) {
					
					?>
					<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/<?=$script;?>"></script>

					<?


				}



			} else {
			
			?>

			<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/<?=$custom_script;?>"></script>

			<?


			}


		}



		?> 


		
		

  


 </head>