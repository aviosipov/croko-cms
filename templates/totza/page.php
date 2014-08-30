<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">
        <div class="main-content">
            <? $this->load->view('template/header') ; ?>
            
            <div class="content">
                
                <div class="pager right">

                    <div class="title-hold">
                        <h2><?=$page->title;?></h2>
                    </div>


                    <div style="width:230px;" class="">

                    <? $file = $this->Content->get_image('page' . $page->id , getTemplatePath() .'images/pic1.jpg') ; ?> 
                    <img src="<?=$file;?>" alt="<?=$page->title;?>" class="right croko_widget_image" image-crop-width="230" image-crop-height="220" image-name="page<?=$page->id;?>"  />
                    </div>



                    <div id="<?=$page->id;?>" class="editable">
                    <? if (!$this->Content->get_page_content($page->id)) { ?>       

                        <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>

                    <? } ?>
                    </div>
                    
                    <? if ($page->template) $this->load->view('template/' . $page->template) ;  ?>

                    
                    
                    
                </div>
                
                <? $this->load->view('template/sidebar') ; ?>
                
                
                
                
                
            </div><!-- content -->
            
             <div class="pre-footer"></div>
             
            <? $this->load->view('template/footer') ; ?>
           
            
        </div><!-- main-content -->
    </div><!-- container -->
</body>
</html>
