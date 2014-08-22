<? $this->load->view('header') ; ?>
            
            <div class="content">
                <div class="main-slider">
                        <div class="fopics">
                            <? $file = $this->Content->get_image('home-intro' , '/images/pic1.jpg') ; ?>                        
                            <img src="<?=$file;?>" class="croko_widget_image" image-crop-width="480" image-crop-height="280" image-name="home-intro"  />
                        </div>
                        
                        <div id="home-about" class="abouter editable">
                    	<? if (!$this->Content->get_content('home-about')) { ?>
                        	
                            <h2>כותרת גדולה</h2>
                            <p class="f14 light1">
                                כאן ניתן להזין תוכן שיוצג לגולשים בדף הבית, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים בדף הבית, לחצו על המלל לביצוע העריכה.
                            </p>
                            
                        <? } ?> 
                        </div>
                    
                </div>
                
                <div class="hmbottom">
                    <div class="lastupdates">
                        <div class="boxtitleline">

                            <div id="home-right-title" class="editable">
                            <? if (!$this->Content->get_content('home-right-title')) { ?>                        

                            <h3 class="lsup">אודותינו</h3>


                            <? } ?> 
                            </div>


                            <div class="dottdivi"></div>
                        </div>
                        
                        <div id="home-right-content" class="editable">
                        <? if (!$this->Content->get_content('home-right-content')) { ?>                        

                        <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים בדף הבית, לחצו על המלל לביצוע העריכה.</p>

                        <? } ?>
                        </div>
                        
                        
                    </div><!-- lastupdates -->
                    
                    <div class="newsleta">
                        <div class="boxtitleline">

                            <div id="home-left-title" class="editable">
                            <? if (!$this->Content->get_content('home-left-title')) { ?>                        

                            <h3 class="nlsu">דברו איתנו</h3>

                            <? } ?>
                            </div>

                            <div class="dottdivi"></div>
                        </div>

                        <div id="home-left-content" class="editable">
                        <? if (!$this->Content->get_content('home-left-content')) { ?>                        

                        <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים בדף הבית, לחצו על המלל לביצוע העריכה.</p>

                        <? } ?>
                        </div>
                        
                       
                    </div><!-- newsleta -->
                    
                    
                    
                </div><!-- hmbottom -->
            </div><!-- content -->
            </div><!-- main-content -->
    </div><!-- container -->
    
    <? $this->load->view('footer') ; ?>
    
    