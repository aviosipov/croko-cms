<? $this->load->view('header') ; ?>
            
            <div class="content">
                <br/><br/>
                
                <div class="pagespace">
                	
                    <div class="page-title"><h2><?=$page->title;?></h2></div>
                    
     	
			            
			            <div id="<?=$page->id;?>" class="editable">
			            	
			            	<? if (!$this->Content->get_page_content($page->id)) { ?>
			            	
			                    
			                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>              
			                
			                <? } ?>
			                                        
			            </div>

                        <? if ($page->template) $this->load->view('template/' . $page->template) ;  ?>

                    
                    
                    
                </div><!-- pagespace -->
                
                
                <? $this->load->view('page-sidebar') ; ?>
                
                
            </div><!-- content -->
            </div><!-- main-content -->
            
    </div><!-- container -->
    
    <? $this->load->view('footer') ; ?>
    

           
