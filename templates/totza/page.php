<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">

        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">
            
            <div class="col-md-9">
            
                
                <? if ($page->img) { ?> 
                    <img title="<?=$page->title;?>" class="pull-right" src="/gallery/<?=$page->img;?>" alt="<?=$page->title;?>" />
                <? } ?>

                <h1><?=$page->title;?></h1>
                
                
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
