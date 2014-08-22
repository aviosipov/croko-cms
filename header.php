<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >
<html lang="he">
<head>
    <title><?=$meta_title;?></title>        
    
	<meta name="description" content="<?=$meta_description;?>" />
	<meta name="keywords" content="<?=$meta_keywords;?>" />   
    <link href="/css/style.css" rel="stylesheet" type="text/css" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    
    <?= $enable_cms; ?>
</head>
<body>
	
	<?= $editor_menu; ?>
	
    <div class="container">
        <div class="main-content">
            <div class="header">

            
                <h1 class="logo right"><a href="/">


                    <? $file = $this->Content->get_image('logo' , '/images/logo.png') ; ?>
                    <img src="<?=$file;?>" class="croko_widget_image" image-crop-width="257" image-crop-height="140" image-name="logo" />                

                    
                </a></h1>

                
                <div class="top-head">
                    
                
                    
                </div>
                
                <div class="menu">
                    <ul>
                        
                        <? $this->Content->get_menu() ; ?>
                        
                        
                    </ul>
                </div>
                
                
                
            </div><!-- header -->