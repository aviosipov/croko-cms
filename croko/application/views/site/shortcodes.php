<?  $this->load->view('template/header-cms'); ?>


<body>



	<h2 class="title"><?=$title;?></h2>
	
	
	<div id="copycode" class="copycode">
		<input id="mycode" value="" />
	</div>
	
	 

	<div class="right-bar"> 
		
    	
    	<h3>יצירת קוד לסרטון youtube</h3>	
		
		
		
		
		<label>כתובת הסרטון</label>		
        <input id="youtube-link" name="youtube-link" type="text" value=""/>
        
    	
    	
    	<input onclick="generate_youtube_code();" value="צור קוד" type="button" />
	    
		         


        
    </div>


	
	<? $this->load->view('site/menu') ; ?> 



</body>