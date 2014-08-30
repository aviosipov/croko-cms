<div class="widget">
    
    <div id="sidebar-content" class="editable">
    <? if (!$this->Content->get_content('sidebar-content')) { ?>                        

    <h4>אודותינו</h4>
    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
        
    <? } ?>
    </div>       

</div>

<div class="widget">

    <div id="sidebar-subtitle" class="editable">
    <? if (!$this->Content->get_content('sidebar-subtitle')) { ?>                        

    <h4 class="secondtitle">עדכונים אחרונים</h4>

    <? } ?>
    </div>


    <ul class="list-unstyled">

        <?

        $article_list = $this->Content->get_article_list(5,'latest-news') ; 
        foreach ($article_list->result() as $article) { 

        ?>                         

            <li><a href="/articles/<?=$article->id;?>"><?=$article->title;?></a></li>



        <? } if ($article_list->num_rows ==0) { ?>

            <li><a >עדכון לדוגמה 1</a></li>
            <li><a >עדכון לדוגמה 2</a></li>
            <li><a >עדכון לדוגמה 3</a></li>

        <? } ?>



    </ul>
    
</div>


               