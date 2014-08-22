<? $this->load->view('header') ; ?>
            
            <div class="content">
                <br/><br/>
                
                <div class="pagespace">
                	
                    <div class="page-title"><h2><?=$article->title;?></h2></div>
                    
     	
			            
	                <div id="<?=$article->id;?>" class="editable">
	            	<? if (!$this->Content->get_article_content($article->id)) { ?>
	        			
	
		                <p>
		                יש לכתוב תוכן למאמר.
		                </p>
	                    
	                    
	                <? } ?> 
	                </div>


                    
                    
                    
                </div><!-- pagespace -->
                
                
                <? $this->load->view('page-sidebar') ; ?>
                
                
            </div><!-- content -->
            </div><!-- main-content -->
            
            <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-comments" data-href="http://shefa.org.il/articles/<?=$article->id;?>" data-num-posts="2" data-width="626"></div>
            
    </div><!-- container -->
    
    <? $this->load->view('footer') ; ?>
    

           
