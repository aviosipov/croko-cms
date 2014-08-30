<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">

        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">
            
            <div class="col-md-9">
            
                
                <h2><?=$page->title;?></h2>
                
                <? $file = $this->Content->get_image('page' . $page->id , getTemplatePath() .'images/pic1.jpg') ; ?> 
                <img src="<?=$file;?>" alt="<?=$page->title;?>" class="pull-right croko_widget_image" image-crop-width="230" image-crop-height="220" image-name="page<?=$page->id;?>"  />
                



                <div id="<?=$page->id;?>" class="editable">
                <? if (!$this->Content->get_page_content($page->id)) { ?>       

                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>

                <? } ?>
                </div>
                
                <? if ($page->template) $this->load->view('template/' . $page->template) ;  ?>

                
                    

            </div>

            <div class="col-md-3">

                <? $this->load->view('template/sidebar') ; ?>

                
            </div>


        </div>
        
        <? $this->load->view('template/footer') ; ?>


    </div><!-- container -->
</body>
</html>
