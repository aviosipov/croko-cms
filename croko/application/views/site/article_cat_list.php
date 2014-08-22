<?  $this->load->view('template/header-cms'); ?>


<body>


<h2 class="title"><?=$title;?></h2>


<table>
	
	
	<tr bgcolor="#aadddd"  style="color:blue; ">
		
		<td width="80">#</td>
		<td width="150">שם</td>
		<td width="180">תיאור</td>
		<td width="150">פעולות</td>
		<td width="50">תמונה</td>
		
	</tr>
	
	
	<? foreach ($category_list->result() as $cat) { ?>
	
	<tr>
		
		<td><?=$cat->id;?></td>
		
		<td><?=$cat->title ;?></td>
		
		<td><?=$cat->description;?></td>
		
		<td>
						
			<?= anchor("admin/edit_article_category/$cat->id" , "ערוך" ) ;  ?> | 
			<?= anchor("admin/delete_article_category/$cat->id" , "מחק" ) ;  ?> 


		</td>
		
		<td>
		<? if ($cat->img) echo "<img src='/gallery/$cat->img' width=50 height=50>" ;  ?> </td>
		
	</tR>
	
	
	<? } ?>
	
</table>

<br>




<h3 class="title">הוספת קטגוריה חדשה</h3>


<br>

<? 
$attributes = array('class' => 'form', 'id' => 'myform');
echo form_open_multipart("admin/article_cat_list",$attributes); 
?> 
	
	
	
	<label>שם</label>
    <input name="title" type="text" value=""/>
    
    <label>תיאור</label>
    <textarea name="description"></textarea>
    
	<label>תמונה</label>    
    <input type="file" name="userfile" size="20" />    
            
    <label>&nbsp;</label>
    <input type="submit" value=" שמור שינויים " />
    
    
</form>

	<? $this->load->view('site/menu') ; ?> 


</body>