<?  $this->load->view('template/header-cms'); ?>


<body >
	


	<h2><?=$title;?></h2>



	<? 
	$attributes = array('class' => 'form', 'id' => 'myform');
	echo form_open("admin/news/update/$news->id",$attributes); 
	?> 
	
	
     
        <label>כותרת<em>*</em></label>        
        <input name="title" required="required" type="text" value="<?=$news->title;?>"/> 
    
        <label>תוכן</label>
        <textarea name="content"><?=$news->content;?></textarea>        
        
        

  
  		<label>&nbsp;</label>    
    	<input type="submit" value=" שמור שינויים " />
    
    
	</form>






	<? $this->load->view('site/menu') ; ?> 



</body>