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
                                ניהול אתרים
                            </h2>
                        </header>
                        <section class="container_6 clearfix">


                            

                            
                            <?=anchor("admin/addsite" , "הוסף אתר" ) ; ?> 
                            


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





