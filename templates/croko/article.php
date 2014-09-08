<? $this->load->view('template/head') ; ?>

<body>
    

    <?=$editor_menu; ?>

    <div class="container">

        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">

            <div class="col-md-9">


                <? if ($article->img) { ?> 
                    <img title="<?=$article->title;?>" class="pull-right" src="/gallery/<?=$article->img;?>" alt="<?=$article->title;?>" />
                <? } ?>

                
                <h1><?=$article->title;?></h1>
                
                

                <div id="<?=$article->id;?>" class="editable">
                <? if (!$this->Content->get_article_content($article->id)) { ?>       

                <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>                    

                <? } ?>
                </div>             
            
            </div>

            <div class="col-md-3">

                <? $this->load->view('template/sidebar') ; ?>

                
                
            </div>



        </div>
        

        <? $this->load->view('template/footer') ; ?>

   
    </div><!-- container -->
</body>
</html>
