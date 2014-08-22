<?  $this->load->view('template/header-cms'); ?>

<body style="direction:ltr;"> 
                	

        
    	
    	
    	
    	
    	<div class="crop-box">
    		
    		<h2><?=$title;?></h2>
    		

    		    		
    		<img src="/gallery/<?=$file;?>"  id="cropbox"  />
    		


		<form action="/admin/crop/<?=$file;?>" method="post" class="coords">
			<input type="hidden" size="4" id="x1" name="x1" />
			<input type="hidden" size="4" id="y1" name="y1" />
			<input type="hidden" size="4" id="x2" name="x2" />
			<input type="hidden" size="4" id="y2" name="y2" />
			<input type="hidden" size="4" id="w" name="w" />
			<input type="hidden" size="4" id="h" name="h" />
			
			
			<br>
			
			<input type="button" value="סגור חלון" onclick="window.open('', '_self', '');window.close();">
			<input type="submit" value="גזור תמונה" />
		</form>    		 
    		
		


        
        </div>
        

        
        
 
    
    
    
                    
                            
</body>                