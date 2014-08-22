<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="he">
<head>
	
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>GetControl.co.il - קבל בחזרה את השליטה בעסק</title>
    
    <link href="<?=base_url()?>css/getcontrol/style-cms.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>css/getcontrol/style-invoice.css" rel="stylesheet" type="text/css" />
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
	
	
	<!-- Load Custom Js file if needed ..  -->
	
	<? if ($custom_js!='') { ?> 
		
	<script type="text/javascript" src="/js/<?=$custom_js;?>"></script>
	
	<? } ?>
	
	
	
	

	
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
	
	
    
</head>
<body class="inner">
    <div class="container">
        <div class="main-content">
            <div class="header">
                <a href="/" class="logo"><img alt="" src="/images/logo2.png"/></a>
                
                    <div class="navz">
                        <a href="/users/logout" class="submiter2">התנתק</a>
			
			<div class="btnhor-b left">
                            <a href="/settings" class="btnr-b">הגדרות<span class="btnl-b"></span></a>
                        </div>
			<div class="btnhor-b left">
                            <a href="/clients/add" class="btnr-b">הוסף לקוח\ליד<span class="btnl-b"></span></a>
                        </div>

			<div class="search">

				<?                             

                $attributes = array('class' => 'form', 'id' => 'myform');
				if (!$target) $target = 'clients' ;
				
                echo form_open($target,$attributes);
				
                ?>
			    
				<div class="sinputa">
				<input id="project" name="search_text" type="text" value="חפש..." class="find" onfocus="if (this.value == 'חפש...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'חפש...';}" />
				<input type="submit" value="" class="sebtn" />
				</div>
				
			    </form>
			</div>
			
		    </div>
                
                
                <div class="menu">
		    <div class="btnhor2">
                            <div class="btnr2"><span class="btnl2"></span>
                
                    <ul>
                    	<li><a href="/dashboard">תמונת מצב</a></li>
                        <li><a href="/clients">לקוחות</a></li>
                        <li><a href="/projects">פרויקטים</a></li>
                        <li><a href="/tasks">משימות</a></li>
                        
                        <!--<li class="les"><a href="/settings">הגדרות</a></li> -->
                        
                        
                        <? if ($this->User->get_level() > 0 && $this->User->can_access_cashflow_table() ) { ?>                        
                        	<li><a href="/cash/cashflow">תזרים</a></li>	                        	
                		<? } ?>
                        
                        
                        <?
                        
                        if ($this->User->is_admin() || $this->session->userdata('org_id') == 1 ) { 
                        
                        ?>
                        
                        
                        <li><?=anchor("admin", "חברות"); ?></li>
                        <li><?=anchor("admin/sites", "אתרים"); ?></li>
                        
                        <?
                        
						}
                        
                        ?>
                                                
                        
                        
                        
                        <li><?=anchor("notepad", "תזכורן"); ?></li>
                        
                        
                        
                        
                        
                        
                        
                    </ul>
			    </div>
                    </div>
                    
                    <div class="welcome-box">
                    	<? $this->User->show_greeting() ;  ?>
                    </div>
                    
                    
                </div>
            </div><!-- header -->
            
            <div class="content">
                <div class="slida inna">
                    <h2 class="title"><?=$title;?></h2>
                    
                    <?                    
                    if ($this->User->get_level() > 0 && $this->User->can_access_cashflow() )
                    $this->load->view('template/crm-status-box') ; 
                    ?> 
                    
                </div>