
	<div class="btnhor right nmt ml10">
	    <a href="/admin/addorganization" class="btnr">הוסף עסק חדש<span class="btnl"></span></a>
	</div>                            

                

    <table class="simple full">
        <thead>
            <tr>

                        <th width="8%">איש קשר</th>
                        <th width="14%">שם העסק</th>
                        <th width="14%">תיאור</th>
                        <th width="14%">אימייל</th>
                        <th width="8%">תאריך הצטרפות</th>
                        <th width="8%">כניסה אחרונה</th>
                        <th width="8%">מספר לקוחות\לידים</th>
                        <th width="8%">פעולות</th>


            </tr>
        </thead>
        <tbody>

        <?

	        foreach ($org_list->result() as $org ) {
	
	            ?>
	
	            <tr>
	            	<td><?=$org->contact_name;?></td>
	                <td>
	                    <a href="/index.php/clients/show/<?=$org->id;?>">
	                    <?=$org->name;?>
	                    </a>
                    </td>
	                <td><?=$org->description;?></td>
	                <td><?=$org->email;?></td>	                
	                <td><?=$org->created;?></td>	                
	                <td><?=$org->last_login;?></td>	                
	                <td><?=$this->Client->count($org->id);?></td>
	                
	                <Td>
	
	                    <a href="admin/edit/<?=$org->id;?>">עריכה</a> |
	                    <a href="admin/delete/<?=$org->id;?>">מחיקה</a>
	
	
	                </td>
	            </tr>
	
	            <? } ?>



        </tbody>
    </table>

