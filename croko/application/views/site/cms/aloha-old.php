<script type="text/javascript" src="http://cdn.aloha-editor.org/latest/lib/vendor/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?=SYS_PATH?>js/jquery.validate.js"></script>

 
<? if ($not_found ==1 ) header("HTTP/1.0 404 Not Found"); ?> <!-- handle 404 header ...  --> 	
<? if ($this->Content->get_head_scripts()) echo $this->Content->get_head_scripts() ; ?>   


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
	
	
	<!-- load aloha editor --> 
	
	<link href="http://cdn.aloha-editor.org/latest/css/aloha.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="http://cdn.aloha-editor.org/latest/lib/require.js"></script>
	
	
	<!-- load openstudio CMS & styling -->
		
	<link href="<?=SYS_PATH?>css/cms/admin-style.css" rel="stylesheet" type="text/css" /> <!-- admin-style replaces cms-stlye -->     
    <link href="<?=SYS_PATH?>css/cms/editor-style.css" rel="stylesheet" type="text/css" />
    
    
    <script src="<?=SYS_PATH?>js/jquery.easing.1.3.min.js"></script>    
	<script src="<?=SYS_PATH?>js/cms/ui.js"></script>




	
	<script>
	
			var Aloha = window.Aloha || ( window.Aloha = {} );
			
			Aloha.settings = {
				locale: 'en',
				plugins: {
					format: {
						config : [ 'b', 'i','sub','sup'],
					  	editables : {
							// no formatting allowed for title
							'#title'	: [ ], 
							'img' : [] , 
							// formatting for all editable DIVs
							'div'		: [ 'b', 'i', 'del', 'sub', 'sup'  ], 
							// content is a DIV and has class .article so it gets both buttons
							'.article'	: [ 'b', 'i', 'p', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre', 'removeFormat']
					  	}
					},
					list: {
					 	// all elements with no specific configuration get an UL, just for fun :)
						config : [ 'ul' ],
					  	editables : {
							// Even if this is configured it is not set because OL and UL are not allowed in H1.
							'#title'	: [ 'ol' ], 
							// all divs get OL
							'div'		: [ 'ol' ], 
							// content is a DIV. It would get only OL but with class .article it also gets UL.
							'.article'	: [ 'ul' ]
					  	}
					},
					link: {
						config : [ 'a' ],
					  	editables : {
							// No links in the title.
							'#title'	: [  ]
					  	}
					}
				},
				sidebar: {
					disabled:true
				}
			};
	</script>
	
	<script type="text/javascript" src="http://cdn.aloha-editor.org/latest/lib/aloha.js"
				data-aloha-plugins="common/ui,
									common/format,
									common/align,
			                        common/table,
			                        common/list,
			                        common/link,			                        
			                        common/block,
			                        common/undo,			                        
			                        common/contenthandler,
			                        common/paste,
			                        common/horizontalruler,
			                        common/commands 
			                        "></script>
	
	<script type="text/javascript">
	Aloha.ready(function() {
		
		 
				
//        var $ = Aloha.jQuery;
        $('.editable').aloha();
        				
	
	});
	
	
	
	

	function saveEditable(event, eventProperties) {				

		$.post("?cmd=save", { content: eventProperties.editable.getContents(), id: eventProperties.editable.getId() } );
	}
	

	Aloha.bind('aloha-editable-deactivated', function(e,a){			
			saveEditable(e,a) ; 
	});




	$('.tiptip a.button, .tiptip button').tipTip();
	 

		
	
	</script>



<? } ?> 







	<script>
  

	$(document).ready(function(){
		
		 
  	
  		/* general sutff goes here */

	
	    $("#myform,#validate-form").validate( );
	    $("#myform2").validate( );
	    $("#myform3").validate( );
	    $("#myform4").validate( );
	    $("#contact-form").validate( ); 
	
	    
		<? if ($site->language=='he') { ?>
	
		    $.validator.messages['required'] = 'שדה חובה';
	    	$.validator.messages['email'] = 'יש להזין כתובת מייל';	
			
		<? } else { ?>
	
		    $.validator.messages['required'] = '*';
	    	$.validator.messages['email'] = '*';		
			
		<? } ?>  	    
	    
	    
	    
	
	
	
		
		
		$.validator.addMethod("captcha", function(value, element) {
			
		     var return_val = null;
		
		      $.ajax({
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
		 $('img#refresh').click(function() {  
		 
				change_captcha();
		 });
		 
		 function change_captcha()
		 {
			document.getElementById('captcha').src="/admin/services/captcha?rnd=" + Math.random();
		 }
		    
		    
		     
		
		<?  if ($this->User->is_logged_in()) { ?>
			
			// move this to a seperate code later .. 
			
			console.log('init CMS ...') ; 
			
			//toggle_menu('hide'); 									
			menu_listener() ; 
			
			 
			
		<? } ?> 		    
	    
	
	
	    
    
  });
  
  </script>
  

