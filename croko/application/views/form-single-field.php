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

                            <h2><?=$title;?></h2>
                        </header>
                        
                        <section class="container_6 clearfix">
                        	
	                        <div class="grid_4 clearfix">
	
	                            <header class="clearfix">
	                            	<h3>עזרה</h3>
	                            </header>
	
	                            <section>
	                            	<?=$help_text;?>
	                            </section>
	                        </div>
	
	                        <!-- Progress Bars -->
	                        <div class="grid_2">
	                        	
	                            <h3><?=$subtitle;?></h3>


	                            <?
	
	                             // echo validation_errors();
	
	                            $attributes = array('class' => 'form', 'id' => 'myform');
	                            echo form_open("$target",$attributes);
	
	                            ?>
	
	                                <div class="clearfix">
	                                    <label><?=$field_title;?><em>*</em></label><input type="text" name="<?=$field_name;?>" required="required" value="<?= set_value('title', (isset($field_value) ? $field_value : '' )); ?>"/>
	                                </div>
	
	
	                                <div class="action clearfix">
	                                    <button class="button button-gray"  type="submit">שמור שינויים</button>
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





