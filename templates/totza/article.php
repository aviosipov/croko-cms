<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">

        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">

            <div class="col-md-9">

                <div class="title-hold">
                    <h2><?=$article->title;?></h2>
                </div>
                
                <div style="width:230px;" class="">

                <? $file = $this->Content->get_image('article' . $article->id , getTemplatePath() .'images/pic1.jpg') ; ?> 
                <img src="<?=$file;?>" alt="<?=$article->title;?>" class="pull-right croko_widget_image" image-crop-width="230" image-crop-height="220" image-name="article<?=$article->id;?>"  />
                </div>                    

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
