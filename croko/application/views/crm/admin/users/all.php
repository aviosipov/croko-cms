 


                            
			<div class="btnhor right nmt ml10">
				
				
			    <a href="/admin/adduser" class="btnr">הוסף משתמש<span class="btnl"></span></a>
			    
			    
			    
			</div>
    


    <Br><br>

    



    <table class="simple full">
        <thead>
            <tr>

                        <th width="8%">קוד</th>
                        <th width="14%">שם משתמש</th>
                        <th width="14%">כינוי</th>
                        <th width="14%">אימייל</th>
                        <th width="8%">קוד ארגון</th>
                        <th width="8%">קוד אתר</th>                        
                        <th width="8%">פעולות</th>



            </tr>
        </thead>
        <tbody>



        <?

	        foreach ($user_list->result() as $user ) {
	
	            ?>
	
	            <tr>
	            	<td><?=$user->id;?></td>
	                <td><?=$user->username;?></td>
	                <td><?=$user->nickname;?></td>
	                <td><?=$user->email;?></td>
	                <td><?=$user->org_id;?></td>
	                <td><?=$user->site_id;?></td>
	                
	                                
	                <Td>
	                	
	                	
	                	<?=anchor("admin/edituser/$user->id" , "עריכה") ; ?> |
	                	<?=anchor("admin/deluser/$user->id" , "מחיקה") ; ?> 
	                	
	
	
	                </td>
	            </tr>
	
	            <?
	
	

                }




        ?>








        </tbody>
    </table>


                 


                   