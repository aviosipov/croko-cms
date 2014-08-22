<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="he">
<head>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>GetControl.co.il - קבל בחזרה את השליטה בעסק</title>
    
    <link href="<?=base_url()?>css/getcontrol/style-cms.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/getcontrol/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    
    
    <link rel="shortcut icon" href="/images/icon.ico" />
    
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	     
	<script type="text/javascript" src="/js/jquery.autogrowtextarea.js"></script>	
	
	<script type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
	
	<script type="text/javascript" src="/js/jquery-ui-datepicker.js"></script>
	<script type="text/javascript" src="/js/jquery.ui.datepicker-he.js"></script>
	<script type="text/javascript" src="/js/jquery.numeric.js"></script>
	
	
	
	
	
	<script type="text/javascript" src="/js/general-crm.js"></script>

	
	<!-- Autocompletion code starts here -->

	<link type="text/css" href="http://pqpon.co.il/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />		
	<script type="text/javascript" src="http://pqpon.co.il/js/jquery-ui-1.8.16.custom.min.js"></script>
															  
	
	<script>
		$(function() {
			
			
	
	
			$( "#project" ).autocomplete({
				minLength: 0,
				
				open: function() { 
		        	$('#project').autocomplete("widget").width(300) 
			    }  ,
	
				source: function(req, add){
						
						$.getJSON("http://getcontrol.co.il/services/bizlist?callback=?", req, function(data) {
						var suggestions = [];
						
						$.each(data, function(i, val){
		                    suggestions.push({name:val.name, phone:val.phone ,id:val.id , email:val.email});
						});
						
						add(suggestions);
					});
				},			
				
				
				
				focus: function( event, ui ) {
					$( "#project" ).val( ui.item.label );
					return false;
				},
				
				select: function( event, ui ) {
			      window.location.href = '/clients/show/' + ui.item.id;
			    }			
				
				
			})
			.data( "autocomplete" )._renderItem = function( ul, item ) {
				return $( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a href='clients/show/" + item.id + "'><b>" + item.name + "</b><br>" + item.phone + "," + item.email + "</a>" )
					.appendTo( ul );
			};
		});
		
		
		
		
		
		function popup (id) {
			
	//		$("#task_" + id).load('/clients/edit_task/' + id ) ;
			
			
		    
		    $("#edit-task").load('/clients/edit_task/' + id ).dialog({
		    	
		    	
		    	title: "עריכת משימה",
		    	draggable: true , 		    	
		    	width: 300, 
		    	height: 350, 
		    	modal:true,
		    	
		 		buttons: {
		 			
				"שמור": function() {
			            $.post('/clients/edit_task', $("#edit-task-form").serialize(), function (data) {
			            	
			                  $("#edit-task").dialog('close');
			                  
			                  
			                  $("#task_" + id).hide("fast") ;
			                  $("#task_" + id).before(data ) ;
			                  

			            });
			                   

			
			        },		 			
		 			
		 			
		        "ביטול": function() {                    
		                $(this).dialog('close');
		            }
		        }		    	  
		    	
		    	
		    	
	    	});
		    
		    
		    
		    
		     

			
		}
		
		
		
		
		
		
		
	</script>
	
	
	
	<!-- Autocompletion code ends here -->
	
<script language="javascript">
document.pelepayform.amount.value= "1525";//put your chart total amount
document.pelepayform.orderid.value= "3341";//put your chart order id number
</script>	
    
</head>
<body class="inner">
    <div class="container">
        <div class="main-content">
            <div class="header">
                <a href="/" class="logo"><img alt="" src="/images/logo2.png"/></a>
                

                
                
                <div class="menu">
		    <div class="btnhor2">
            	
            	<div class="payment-request-title">
                
                	<h2 > <?=$title;?></h2>
                	
			    </div>
            </div>
                    
                    
                    
                </div>
            </div><!-- header -->
            
            <div class="content">
