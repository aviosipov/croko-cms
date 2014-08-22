


                            
			<div class="btnhor right nmt ml10">
				
				
			    <a href="/admin/addsite" class="btnr">הוסף אתר חדש<span class="btnl"></span></a>
			    <a href="/admin/users" class="btnr">הצג רשימת משתמשים<span class="btnl"></span></a>
			    
			    
			</div>
    


    <Br><br>

    



    <table class="simple full">
        <thead>
            <tr>

                        <th width="8%">קוד</th>
                        <th width="14%">שם האתר</th>
                        <th width="14%">שם הבעלים</th>
                        <th width="14%">אתר פעיל?</th>
                        <th width="8%">קוד ארגון</th>
                        <th width="8%">כתובת אתר</th>                        
                        <th width="8%">פעולות</th>

    





            </tr>
        </thead>
        <tbody>



        <?

	
	
	        foreach ($site_list->result() as $site ) {
	
	            ?>
	
	            <tr>
	            	<td><?=$site->id;?></td>
	                <td><?=$site->name;?></td>
	                <td><?=$site->owner_name;?></td>
	                <td><?=$site->online;?></td>
	                <td><?=$site->org_id;?></td>
	                <td><?=$site->site_url;?></td>
	                
	                
	                
	                
	                                
	                <Td>
	                	
	                	
	                	<?=anchor("admin/editsite/$site->id" , "עריכה") ; ?> |
	                	<?=anchor("admin/delsite/$site->id" , "מחיקה") ; ?> 
	                	
	
	
	                </td>
	            </tr>
	
	            <?
	
	

                }




        ?>








        </tbody>
    </table>


                 


                  