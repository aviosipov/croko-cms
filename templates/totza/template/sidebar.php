<div class="sidebar">


    <div class="widget">


        

        <div id="about-content" class="editable">
        <? if (!$this->Content->get_content('about-content')) { ?>        
        
            <h4>אודותינו</h4>
            <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
        
        <? } ?>
        </div>


    </div>

    <div class="widget">
        

        <div id="sidebar-updates-title" class="editable">
        <? if (!$this->Content->get_content('sidebar-updates-title')) { ?>         
            
            <h4 >עדכונים אחרונים </h4>
    
        <? } ?>
        </div>

        <ul class="list-unstyled">

            <?

            $article_list = $this->Content->get_article_list(5) ; 
            foreach ($article_list->result() as $article) { 

            ?>                         

                <li><a href="/articles/<?=$article->id;?>"><?=$article->title;?></a></li>

            <? } if ($article_list->num_rows ==0) { ?>

                לא נמצאו עדכונים, ניתן להוסיף עדכונים על ידי הוספת מאמרים לאתר.

            <? } ?>



        </ul>
        
    </div>


</div>