<?

if ( $_GET['cmd']=='save' ) {
	
	if ( $_POST['id'] == 'title' ) $this->Content->save_article_title( $article->id ,trim(strip_tags ( $_POST['content'] ) )) ;		
	else $this->Content->save_article_content( $_POST['id'] , $_POST['content'] ) ; 		
		
	exit;  
}


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="he">
<head>
    <title>getcontrol</title>
    <link href="<?=base_url()?>css/style-site.css" rel="stylesheet" type="text/css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="images/icon.ico" />
    
    <link type="text/css" href="<?=base_url()?>css/ui-lightness/jquery-ui-1.8.12.custom.css" rel="stylesheet" />
    
    
    
    <script type="text/javascript" src="<?=base_url()?>js/jquery-ui-1.8.12.custom.min.js"></script>
    
	<script type="text/javascript" src="<?=base_url()?>js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/cms.js"></script>

    
	<script type="text/javascript" src="<?=base_url()?>js/aloha/aloha.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.plugins.Format/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.plugins.Table/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.plugins.List/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.plugins.Link/plugin.js"></script>
	
	
	<script type="text/javascript">
	

			
			
	
	
	
		function saveEditable(event, eventProperties) {				
		$.post("?cmd=save", { content: eventProperties.editable.getContents(), id: eventProperties.editable.getId() } );
		}
		
		GENTICS.Aloha.settings = {
			"i18n": {"current": "en"},
			"ribbon": false,
			"plugins": { 
				"com.gentics.aloha.plugins.GCN": { 
					"enabled": false 
				},
				
				
			 	"com.gentics.aloha.plugins.Format": { 
					config : [ 'b', 'i','u','del','sub','sup', 'p', 'title', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre', 'removeFormat'],
				} 
		 	}
		};
	
		$(document).ready(function() {

			$('.editable').aloha();
			
		});

		GENTICS.Aloha.EventRegistry.subscribe(GENTICS.Aloha, "editableDeactivated", saveEditable);
	
	
	
	
			
	
	
	</script>	    
    
    

    
    
    
    
</head>

<body class="inner">
    <div class="container">
        <div class="main-content">
            <div class="header">
                <a href="#" class="logo"><img alt="" src="<?=base_url()?>css/images/logo.png"/></a>
                <div class="loging">
                    <form>
                        <div class="loger"><input type="text" value="משתמש"/></div>
                        <div class="loger"><input type="text" value="סיסמא"/></div>
                        <input class="submiter" type="submit" value="התחבר"/>
                    </form>
                </div>
                

                <?  $this->load->view('site/template/menu'); ?>
                

            </div><!-- header -->
            
            <div class="content">
                <div class="slida inna">
                	
                	

                	
                	 
                	
                    <h2 class="title">
	                 
	                 <div id="title" class="editable">   
	                    <?=$article->title;?>
	                </div>    
	                
	                
	                    
                    </h2>
	                    
	                 
                	<?=anchor("site/delete/article/$article->id", "מחק" ) ; ?> 
	                	 
	                	
	                	
	                	 	                	
	                	 
	                	    
	                

	                    
	                    <div class="signup">
	                        <a href="#" class="sign"></a>
	                    </div>
                    
                    
                    
                </div>
                
                <div id="<?=$article->id;?>" class="righter editable">
                	
                	<? if (!$this->Content->get_article_content($article->id)) { ?>
                	
    
                    <h3>כותרת מאמר</h3>
                    <p>
                        כאן יש לכתוב תוכן למאמר.
                    </p>
                    
                    
                    <? } ?>
                            
                </div>
                
                <div class="lefter">
                    
                    <div class="sidebar-div">
				    <div class="sidebar-top"></div>
				    <div class="sidebar-bottom"></div>
				    <div class="sidebar-content">
                                        
                                        <h3>שיטות לשיפור העסק</h3>
                                        <div class="divider"></div>
                                        <img src="<?=base_url()?>css/images/better.jpg" alt="" />
                                        
                                        <div class="btnhor left">
                            <a href="#" class="btnr">קרא עוד<span class="btnl"></span></a>
                            </div>
                                        
                                        </div>
                                    
                                    
				</div> 
                    
                    
                </div>
                
                
            </div><!-- content -->
             <div class="pre-footer"></div>
            <div class="footer">
                
                <hr/>
                
            <div class="foot-links clear">
                <ul>
                    <li><a href="#">איך זה עובד</a><span>|</span></li>
                    <li><a href="#">תקנון</a><span>|</span></li>
                    <li><a href="#">פרטיות</a><span>|</span></li>
                    <li><a href="#">הטבות</a><span>|</span></li>
                    <li><a href="#">תנאי שימוש</a></li>
                </ul>
            </div>
            <div class="rights">
                כל הזכויות שמורות 2011 ©
            </div>
            
            <div class="open-studio">
                <a href="#" class="open-logo"><span class="ope">open</span><span class="stu">studio.co.il</span><span class="di">|</span><span class="bui">בניית אתרים</span></a>
            </div>
            </div><!-- footer -->
           
            
        </div><!-- main-content -->
    </div><!-- container -->
    
    
    
    
    
</body>

</html>
