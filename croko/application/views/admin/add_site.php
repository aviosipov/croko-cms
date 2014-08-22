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
                                <?=$title; ?>
                            </h2>
                        </header>
                        <section class="container_6 clearfix">
                                <div class="grid_4 clearfix">
                                    <header class="clearfix">
                                    	<h3>עזרה</h3>
                                    </header>
                                    <section>





                                    </section>
                                </div>

                                <!-- Progress Bars -->
                                <div class="grid_2">
                                    <h3><?=$page_title; ?></h3>




<br>




                            <?

                            echo validation_errors();

                            $attributes = array('class' => 'form', 'id' => 'myform');
                            echo form_open("admin/addsite",$attributes);


                            ?>


                                <div class="clearfix">
                                    <label>שם האתר<em>*</em></label><input type="text" name="name" required="required" />
                                </div>
                                
                                <div class="clearfix">
                                    <label>כתובת האתר</label><input type="text" name="site_url" />
                                </div>

                                <div class="clearfix">
                                    <label>שם מנהל האתר</label><input type="text" name="owner_name"  />
                                </div>


                                <div class="clearfix">
                                    <label>אימייל מנהל האתר</label><input type="text" name="contact_email"  />
                                </div>


                                <div class="clearfix">
                                    <label>שפה</label>
                                    
                                    <select name="language">
                                    	<option value="he">עברית</option>
                                    	<option value="en">אנגלית</option>
                                    </select>
                                    
                                </div>

                                <div class="clearfix">
                                    <label>תבנית פנימית?</label>
                                    
                                     <input type="checkbox" name="template" value="1"  />
                                    
                                     
                                </div>


                                <div class="action clearfix">
                                    <button class="button button-gray"  type="submit"><span class="accept"></span>שמור שינויים</button>
                                </div>
                                
                            </form>






                                </div>
                                <!-- End Progress Bars -->
                        </section>
                    </div>

















                </section>

                <!-- Main Section End -->

            </div>
        </section>
    </div>

	<?  $this->load->view('template/footer'); ?>

</body>


</html>





