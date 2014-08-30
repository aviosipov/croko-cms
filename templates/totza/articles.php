<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>


    <div class="container">
        <div class="main-content">

            <? $this->load->view('template/header') ; ?>
            
            <div class="content">
                
                <div class="pager right">
                    <div class="title-hold">

                        <div id="articles-title" class="editable">
                        <? if (!$this->Content->get_content('articles-title')) { ?>                        

                        <h2>מאמרים</h2>

                        <? } ?>
                        </div>


                    </div>

                    <? foreach ($article_list->result() as $article) { ?> 

                    <div class="articleblock">
                        <div class="articleimg">

                            <? if ($article->img) $img = '/gallery/' .  $article->img;  
                            else $img =  'http://placehold.it/162x84' ; ?>                    

                            <a href="/articles/<?=$article->id;?>"><img alt="" src="<?=$img;?>"/></a> 
                        </div>
                        <a href="/articles/<?=$article->id;?>" class="homeblocktitle"><?=$article->title;?></a>
                        <p><strong><?=$this->Content->get_article_short($article->id);?></strong></p>
                        <a href="/articles/<?=$article->id;?>" class="btn turkiz">קרא עוד</a>
                    </div>

                    <? } 
                    
                        
                  if ($article_list->num_rows == 0) { ?> 

                  <p>נראה שעוד לא נוספו מאמרים לאתר, לחצו על לחצן "מאמרים" להוספת מאמר חדש.</p>

                  <? } ?>                    
                    
                    
                </div>
                
                <? $this->load->view('template/sidebar') ; ?>
                
                
                
                
                
            </div><!-- content -->
            
             <div class="pre-footer"></div>
             
            
            <? $this->load->view('template/footer') ; ?>
           
            
        </div><!-- main-content -->
    </div><!-- container -->
</body>
</html>
