<? foreach ($article_list->result() as $article) { ?> 

<div class="article">
    

    <? if ($article->img) {

        $img = '/gallery/' .  $article->img;  ?>                 
        <a href="/articles/<?=$article->id;?>"><img alt="" src="<?=$img;?>" class="pull-right" /></a> 

    <? } ?>

    
    <a href="/articles/<?=$article->id;?>" class="article-title"><h4><?=$article->title;?></h4></a>
    <p class="article-body"><?=$this->Content->get_article_short($article->id);?> <a href="/articles/<?=$article->id;?>" class="">קרא עוד</a></p>

    
    

</div>

<? } 

    
if ($article_list->num_rows == 0) { ?> 

    <p>נראה שעוד לא נוספו מאמרים לאתר, לחצו על לחצן "מאמרים" להוספת מאמר חדש.</p>

<? } ?> 