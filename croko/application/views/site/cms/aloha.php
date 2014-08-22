<? if ($not_found ==1 ) header("HTTP/1.0 404 Not Found"); ?>  <!-- handle 404 header ...  --> 	

<!-- load jquery only if needed --> 

<script type="text/javascript">
var jQueryScriptOutputted = false;

function initJQuery() {
    
    //if the jQuery object isn't available
    //if (typeof($) == 'undefined') {
    if(typeof jQuery == 'undefined')  { 

    	console.log('jQuery not found ... load it ...') ; 
    
        if (! jQueryScriptOutputted) {
            //only output the script once..
            jQueryScriptOutputted = true;
            
            //output the script (load it from google api)
            document.write("<scr" + "ipt type='text/javascript' src='http://code.jquery.com/jquery-latest.min.js'></scr" + "ipt>");
        }
        setTimeout("initJQuery()", 50);
    } else {
                        
        

        	console.log("jQuery was found.");
        	
            // do anything that needs to be done on document.ready
            // don't really need this dom ready thing if used in footer
    }
            
}

initJQuery();



</script>













<script type="text/javascript" src="<?=SYS_PATH?>js/jquery.validate.js"></script>
<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/croko-ui.css" type="text/css"  media="screen">
 
<!-- general site scripts --> 
<? if ($this->Content->get_head_scripts()) echo $this->Content->get_head_scripts() ; ?>   

<!-- google analytics --> 
<? if ($this->Content->get_analytics()) {  ?>
	
	<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
	try{ 
	var pageTracker = _gat._getTracker("<?=$this->Content->get_analytics();?>");
	pageTracker._trackPageview();
	} catch(err) {} 
	</script>
	
<? } ?>  




<?  if ($this->User->is_logged_in()) { ?>


    <!-- load google style buttons -->    
    <link rel="stylesheet" href="<?=SYS_PATH?>css/cms/css3-buttons.css" type="text/css" media="screen">    
	<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/tiptip.css" type="text/css"  media="screen">
	<script src="<?=SYS_PATH?>js/jquery.tiptip.js"></script>
		 
	<!-- load ckeditor inline editor --> 
	<script src="<?=SYS_PATH?>js/cms/back/ckeditor/ckeditor.js"></script>		

	<!-- load openstudio CMS & styling -->		
	<link href="<?=SYS_PATH?>css/cms/admin-style.css" rel="stylesheet" type="text/css" /> <!-- admin-style replaces cms-stlye -->     
    <link href="<?=SYS_PATH?>css/cms/editor-style.css" rel="stylesheet" type="text/css" />
        
    <script src="<?=SYS_PATH?>js/jquery.easing.1.3.min.js"></script>    
	<script src="<?=SYS_PATH?>js/cms/ui.js"></script>
	<script src="<?=SYS_PATH?>js/cms/gallery.js"></script>
	<script src="<?=SYS_PATH?>js/spin.min.js"></script>

	<!-- load alertify.js -->
	<script src="<?=SYS_PATH?>js/cms/alertify.min.js"></script>
	<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/alertify.core.css">    
	<link rel="stylesheet" href="<?=SYS_PATH?>css/cms/alertify.default.css">    


	<!-- custom jquery ui for modal dialogs -->
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


	<!-- jquery image crop plugin -->

	<link rel="stylesheet" type="text/css" href="<?=SYS_PATH?>css/cms/imgareaselect-default.css" />  	
  	<script type="text/javascript" src="<?=SYS_PATH?>js/cms/back/jquery.imgareaselect.pack.js"></script>	





	
	<script type="text/javascript">


		var spin_options ; 
		var spinner ; 


		

		function save_content() {				

			var i = 0 ; 

			for(var instance in CKEDITOR.instances) {

				var id = CKEDITOR.instances[instance].name ; 
				var content =  CKEDITOR.instances[instance].getData() ; 

				jQuery.post("?cmd=save", { content: content , id: id } );
				i++ ; 
				
			}		

			console.log('data saved, total ' + i + ' elements') ; 
			alertify.success("שינויים נשמרו בהצלחה.");

			
		}


	

		jQuery(document).ready(function(){

			
			// find widgets and add edit image icons 

			setup_widgets() ; 







			/// configue spin.js 

			jQuery("body").append('<div id ="center" style="position:fixed;top:20%;left:50%"></div>') ; 

			spin_options = {

			  lines: 9, // The number of lines to draw
			  length: 13, // The length of each line
			  width: 5, // The line thickness
			  radius: 18, // The radius of the inner circle
			  corners: 1, // Corner roundness (0..1)
			  rotate: 0, // The rotation offset
			  color: '#000', // #rgb or #rrggbb
			  speed: 1.5, // Rounds per second
			  trail: 60, // Afterglow percentage
			  shadow: false, // Whether to render a shadow
			  hwaccel: false, // Whether to use hardware acceleration
			  className: 'spinner', // The CSS class to assign to the spinner
			  zIndex: 2e9, // The z-index (defaults to 2000000000)
			  top: 'auto', // Top position relative to parent in px
			  left: 'auto' // Left position relative to parent in px
			};



	
			ui_listener() ; 


			console.log('admin ready ... ') ; 
			jQuery('.tiptip a.button, .tiptip button').tipTip();

			
			jQuery(document).mouseup(function (e)
			{
			    var container = jQuery(".cms-window");
			    

			    if (container.has(e.target).length === 0 && jQuery(".cms-window").is(":visible") )
			    {
			        hide_menu();
			    }
			});	


			jQuery(document).keydown(function(event) {

			    //19 for Mac Command+S
			    if (!( String.fromCharCode(event.which).toLowerCase() == 's' && event.ctrlKey) && !(event.which == 19)) return true;

			    console.log("Ctrl-s pressed");
			    save_content() ;

			    event.preventDefault();
			    return false;
			});





			/// add editable class to 'editable classes' for old cms version themes 

			jQuery('.editable').each(function(index) {
    			jQuery(this).attr('contenteditable', 'true');
			});

			console.log('added editables to page .. ') ;


			jQuery("#save_content").click(function() {
						  
			  save_content() ; 

			});		



			jQuery("#exit_admin").click(function() {
						  
			  window.location = "/users/logout" ; 

			});		


			


		}) ; 


		
	 

		
	
	</script>



<? } ?> 







	<script>
  

	jQuery(document).ready(function(){
		
		console.log('site ready')  ; 
  		

  		/* general sutff goes here */

	
	    jQuery("#myform,#validate-form").validate( );
	    jQuery("#myform1").validate( );
	    jQuery("#myform2").validate( );
	    jQuery("#myform3").validate( );
	    jQuery("#myform4").validate( );
	    jQuery("#contact-form").validate( ); 
	
	    
		<? if ($site->language=='he') { ?>
	
		    jQuery.validator.messages['required'] = 'שדה חובה';
	    	jQuery.validator.messages['email'] = 'יש להזין כתובת מייל';	
			
		<? } else { ?>
	
		    jQuery.validator.messages['required'] = '*';
	    	jQuery.validator.messages['email'] = '*';		
			
		<? } ?>  	    
	    
	    
	    
	
	
	
		
		
		jQuery.validator.addMethod("captcha", function(value, element) {
			
		     var return_val = null;
		
		      jQuery.ajax({
		          type: "POST",
		          async: false,
		          url: "/admin/services/postcaptcha",
		          data: "captcha="+value,
		          dataType:"html",
		       success: function(msg)
		       {
		          
		          if(msg == 1) return_val = true; 
		          else return_val = false; 
		              
		       }
		     }) ;
		     return return_val ;  
		     
		}, "יש להזין קוד");
	
	
	
	
		 // refresh captcha
		 jQuery('img#refresh').click(function() {  
		 
				change_captcha();
		 });
		 
		 function change_captcha()
		 {
			document.getElementById('captcha').src="/admin/services/captcha?rnd=" + Math.random();
		 }
		    
		    
		     
		    
	    
	
	
	    
    
  });
  
  </script>
  

