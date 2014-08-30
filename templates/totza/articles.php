<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>


    <div class="container">
    
        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">

            <div class="col-md-9">
                  

                <div id="articles-title" class="editable">
                <? if (!$this->Content->get_content('articles-title')) { ?>                        

                    <h2>מאמרים</h2>

                <? } ?>
                </div>

            
                <? foreach ($article_list->result() as $article) { ?> 

                <div class="article">
                    

                    <? if ($article->img) $img = '/gallery/' .  $article->img;  
                    else $img =  'http://placehold.it/162x84' ; ?>                    

                    <a href="/articles/<?=$article->id;?>"><img alt="" src="<?=$img;?>" class="pull-right" /></a> 
                    
                    <a href="/articles/<?=$article->id;?>" class="homeblocktitle strong"><?=$article->title;?></a>
                    <p><?=$this->Content->get_article_short($article->id);?></p>
                    <a href="/articles/<?=$article->id;?>" class="">קרא עוד</a>

                </div>

                <? } 
                
                    
              if ($article_list->num_rows == 0) { ?> 

              <p>נראה שעוד לא נוספו מאמרים לאתר, לחצו על לחצן "מאמרים" להוספת מאמר חדש.</p>

              <? } ?>                 
                
            </div>
            <div class="col-md-3">
                <? $this->load->view('template/sidebar') ; ?>
            </div>
            
        </div>


        

            
            
            
        <? $this->load->view('template/footer') ; ?>
           
            
        
    </div><!-- container -->
</body>
</html>
