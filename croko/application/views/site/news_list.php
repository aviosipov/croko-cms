<?  $this->load->view('template/header-cms'); ?>


<body>


<h2 class="title"><?=$title;?></h2>


<table>
	
	
	<tr bgcolor="#aadddd"  style="color:blue; ">
		
		<td width="55">#</td>
		<td width="170">שם</td>
		<td width="100">תוכן</td>		
		<td width="55">פעולות</td>
		
	</tr>
	
	
	<? foreach ($list->result() as $data) { ?>
	
	<tr>
		
		<td><?=$data->id;?></td>
		<td><?=$data->title;?></td>
		<td><?=$data->content;?></td>
		
		<td>
		
			<?=anchor('admin/news/update/' . $data->id , 'ערוך' );?> | 
			<?=anchor('admin/news/delete/' . $data->id , 'מחק' );?> 
		 
			
		</td>
		
		
	</tr>
	
	
	<? } ?>
	
</table>

<br>

<?=anchor('admin/news/add','הוסף עדכון חדשות' ) ; ?>







<br>
	<? $this->load->view('site/menu') ; ?> 




</body>