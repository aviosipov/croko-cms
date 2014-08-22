<?

if ( $_GET['cmd']=='save' ) {	
		
	$this->Content->save_content( $_POST['id'] , $_POST['content'] ) ; 	
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
    
	<script type="text/javascript" src="<?=base_url()?>js/aloha/aloha.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.Format/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.Table/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.List/plugin.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/aloha/plugins/com.gentics.aloha.Link/plugin.js"></script>
	
	
	<script type="text/javascript">
	
	
		function saveEditable(event, eventProperties) {				
		$.post("?cmd=save", { content: eventProperties.editable.getContents(), id: eventProperties.editable.getId() } );
		}
		
		GENTICS.Aloha.settings = {
			"i18n": {"current": "en"},
			"ribbon": false,
			"plugins": { 
				"com.gentics.aloha.GCN": { 
					"enabled": false 
				},
				
				
			 	"com.gentics.aloha.Format": { 
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
<body class="home">
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
                <div class="slida">
                    
                    
                    <div id="home_register" class="signup editable">
                    	
                    	<? if (!$this->Content->get_content('home_register')) { ?>
                    	
                        <h2>הרשם בחינם עכשיו</h2>
                        <p>
                            ארווס סאפיאן - פוסיליס קוויס, אקווזמן 
                            נולום ארווס סאפיאן פוסיליס קוויס, אקווזם 
                            קוואזי במר מודוף. אודיפו בלאסטיק קליר,
                        </p>
                        <a href="#" class="sign"></a>
                        
                        <? } ?> 
                        
                    </div>
                    
                </div>
                
                <div class="preper">
                	
                    <div id="home_box1" class="thirder editable">
                    	
                    	
                    	<? if (!$this->Content->get_content('home_box1')) { ?> 
                    	
                        <h3 class="title">מה זה עושה</h3>
                        <p>
                            ארווס סאפיאן - פוסיליס קוויס, אקווזמן 
                            קוואזי במר מודוף. אודיפו בלאסטיק קליר,
                            נולום ארווס סאפיאן פוסיליס קוויס, אקווזם 
                            קוואזי במר מודוף. אודיפו בלאסטיק קליר,
                        </p>
                            <div class="btnhor more">
                            <a href="#" class="btnr">קרא עוד<span class="btnl"></span></a>
                            </div>
                            
                        <? }  ?> 
                            
                            
                            
                    </div>
                    
                    
                    <div id="home_box2" class="thirder editable">
                    	
                    	<? if (!$this->Content->get_content('home_box2')) { ?>
                    	
                        <h3 class="title">מאיפה זה בא</h3>
                        <p>
                            ארווס סאפיאן - פוסיליס קוויס, אקווזמן 
                            קוואזי במר מודוף. אודיפו בלאסטיק קליר,
                            נולום ארווס סאפיאן פוסיליס קוויס, אקווזם 
                            קוואזי במר מודוף. אודיפו בלאסטיק קליר,
                        </p>
                            <div class="btnhor more">
                            <a href="#" class="btnr">קרא עוד<span class="btnl"></span></a>
                            </div>
                            
                        <? } ?> 
                        
                        
                    </div>
                    <div class="thirder">
                        <h3 class="title">בוא נדבר</h3>
                        <p>
                            השאר את פרטיך וניצור איתך קשר בהקדם
                        </p>
                        
                        <form>
                            <div class="contaline">
                                <span class="contaname"></span>
                                <div class="contaput">
                                    <input type="text" value=""/>
                                </div>
                            </div>
                            <div class="contaline">
                                <span class="contaname mail"></span>
                                <div class="contaput">
                                    <input type="text" value=""/>
                                </div>
                            </div>
                            <div class="contaline">
                            <input type="submit" value="" class="sender"/>
                            </div>
                        </form>
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
