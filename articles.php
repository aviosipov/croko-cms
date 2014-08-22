<? $this->load->view('header') ; ?>
            
            <div class="content">
                <br/><br/>
                
                <div class="pagespace">
                	
                    <div class="page-title"><h2>עדכונים</h2></div>
                    
                    <br><br>
                    
     	
			            
                	<? foreach ($article_list->result() as $article) { ?>
                	
                	
                    <div class="artic">
                    
                        <h4><a href="/articles/<?=$article->id;?>"><?=$article->title;?></a></h4>
                    
                        <div class="short-head">
                            <p><?=mb_substr( strip_tags ( $article->content ) , 0 , 500 );?></p>
                            <a href="/articles/<?=$article->id;?>" class="btn arti-btn">קרא עוד</a>
                        </div>
                        
                    </div>
                    
                    <? } 
                    

              if ($article_list->num_rows == 0) { ?> 

              <p>נראה שעוד לא נוספו מאמרים לאתר, לחצו על לחצן "מאמרים" להוספת מאמר חדש.</p>

              <? } ?>                    
                    
                    
                </div><!-- pagespace -->
                
                
                <? $this->load->view('page-sidebar') ; ?>
                
                
            </div><!-- content -->
            </div><!-- main-content -->
            
    </div><!-- container -->
    
    <? $this->load->view('footer') ; ?>
    

           
