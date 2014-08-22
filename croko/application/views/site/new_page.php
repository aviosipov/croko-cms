<?  $this->load->view('template/header-cms'); ?>


<body content-height="260">
	

	<div class="cms-header">

		<div class="right">
			<h2>
				<a href="/admin/page_list">עמודים</a> 	
				<img class="header" src="http://getcontrol.co.il/images/icons/cms/appbar.chevron.left.png"/>  
				<?=$title;?>

			</h2>
		</div>

		<div class="left">			
			<input type="submit" value=" שמור שינויים " class="cms-button left" tabindex="4"  form="myform" />
			<!--
			<a href="/admin/page_list" class="button   left "><span class="icon icon140"></span><span class="label">רשימת עמודים</span></a>
			-->
			
			
			
		</div> 
		
	</div>
	<div class="clear"></div>	



<div class="right bar"> 	


	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open_multipart("admin/add/$param",$attributes); 
	?> 
	
	
     
        <label>שם הדף</label>        
        <input tabindex="1" name="title" class="required" id="page-name" required="required" type="text" value=""/>
                
        
		<a class="tooltip"> ?
			<span>
				שם הדף, לדוגמה "אודותינו" או "איך זה עובד". חשוב לדעת כי שם הדפן מוצג גם למנועי החיפוש. 
			</span>
		</a>
		        
		        
        
        
        <br/> 
    
        <label>כתובת (URL)</label>        
        <input name="url" tabindex="2" class="required" required="required" id="url-address" type="text" value=""/>
      
        
		<a class="tooltip"> ?
			<span>
				הכתובת של הדף. רצוי להזין שדה זה באנגלית עם כי קיימת תמיכה גם בעברית. עמוד "אודותינו" יקבל את הכתבות "about-us"
			</span>
		</a>
        
        
        
        <br/>
        
    	<label>תמונת הדף</label>    
        <input type="file" name="userfile" size="20" tabindex="3" />

		<a class="tooltip"> ?
			<span>
				לכל עמוד ניתן להוסיף תמונה שתצוג באופן אוטומטי באתר. מיקום התמונה בדף וגודל התמונה נקבעים על ידי תבנית העיצוב של האתר.
			</span>
		</a>


        <br/> <Br/>
     	
  
    
    
	</form>



</div>


<div class="left bar">


	<? if ($status) { ?> 

	<div class="notification ok">		
		<p><?=$status ; ?></p>
	</div>

	<? } ?>

</div>


<div class="clear"></div>	

<div class="section-header">
	<? $this->load->view('site/menu') ; ?>  
</div>


</body>