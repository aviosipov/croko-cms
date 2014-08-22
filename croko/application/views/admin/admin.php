<?  $this->load->view('template/header'); ?>


<body>
    <div id="wrapper">
    	
		<?  $this->load->view('template/menu'); ?>

        <section>
            <div class="container_8 clearfix">

                <!-- Main Section -->

                <section class="main-section grid_8">

                    <!-- Statistics Section -->
                    <div class="main-content">
                        <header>



                            <h2>
                                ניהול חברות
                            </h2>
                        </header>
                        <section class="container_6 clearfix">


                            

                            
                            <a href="admin/addorganization" >
                            <button class="button button-blue"><span class="add"></span>הוסף עסק חדש</button>
                            </a>


                            <Br><br>

                            <h2>רשימת עסקים המשתמשים במערכת</h2>



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
	
	            <?
	
	

                }




        ?>








        </tbody>
    </table>


                            <br><br>







                        </section>
                    </div>
                    <!-- End Statistics Section -->


                </section>

                <!-- Main Section End -->

            </div>
        </section>
    </div>

    <?  $this->load->view('template/footer'); ?>

</body>


</html>





