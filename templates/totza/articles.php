<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>


    <div class="container">
    
        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">

            <div class="col-md-9">
                  

                <div id="articles-title" class="editable">
                <? if (!$this->Content->get_content('articles-title')) { ?>                        

                    <h1>מאמרים</h1>

                <? } ?>
                </div>

                <? $this->load->view('template/article-list') ; ?>
                
                
            </div>
            <div class="col-md-3">
                <? $this->load->view('template/sidebar') ; ?>
            </div>
            
        </div>


        

            
            
            
        <? $this->load->view('template/footer') ; ?>
           
            
        
    </div><!-- container -->
</body>
</html>
