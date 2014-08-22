<?  $this->load->view('template/header-cms'); ?>


<body>


<h2 class="title"><?=$title;?></h2>


<table>
	
	
	<tr bgcolor="#aadddd"  style="color:blue; ">
		
		<td width="5%">#</td>
		<td width="10%">שם</td>
		<td width="45%">תוכן</td>		
		<td width="5%">פורסם</td>
		<td width="30%">פעולות</td>
		
	</tr>
	
	
	<? foreach ($content_blocks->result() as $block) { ?>
	
	<tr>
		
		<td><?=$block->id;?></td>
		<td><?=$block->name;?></td>
		<td><?=$block->content;?></td>
		<td><?=$block->published;?></td>
		
		
		<td>
		
			
			<?=anchor('admin/edithtml/block/' . $block->id , 'ערוך html' );?> | 
			<?=anchor('admin/deletecontent/' . $block->id , 'מחק' );?> 
			
			 
			
		</td>
		
		
	</tr>
	
	
	<? } ?>
	
</table>

<br>



	<? $this->load->view('site/menu') ; ?> 







<br>




</body>