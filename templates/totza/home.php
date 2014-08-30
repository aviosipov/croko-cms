<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">


        <? $this->load->view('template/header') ; ?>

        <div class="row main-content">

            <div class="col-md-8">                
                <div id="main-content-right" class="editable">
                <? if (!$this->Content->get_content('main-content-right')) { ?>                        

                    <h2>כותרת גדולה</h2>
                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.  כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.  כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>


                <? } ?>
                </div>

            </div>

            <div class="col-md-4">                
                <div id="main-content-left" class="editable">
                <? if (!$this->Content->get_content('main-content-left')) { ?>                        

                    <h2>כותרת גדולה</h2>
                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.  כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>


                <? } ?>
                </div>

            </div>


        </div>

        <div class="row">
            
            <div class="col-md-4">

                    <div id="home-bottom-right" class="editable">
                    <? if (!$this->Content->get_content('home-bottom-right')) { ?>        

                    <h4>כותרת</h4>
                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
                    
                    <? } ?>
                    </div>
                
            </div>

            <div class="col-md-4">

                    <div id="home-bottom-center" class="editable">
                    <? if (!$this->Content->get_content('home-bottom-center')) { ?>        

                    <h4>כותרת</h4>
                    <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
                    
                    <? } ?>
                    </div>
                
            </div>

            <div class="col-md-4 croko_widget" croko-data-type="articles" croko-data-category="latest-news">


                    <div id="home-latest-news" class="editable" >
                    <? if (!$this->Content->get_content('home-latest-news')) { ?>        
                    <h4>עדכונים אחרונים</h4>
                    <? } ?>
                    </div>


                    <ul class="list-unstyled">

                        <?

                        $article_list = $this->Content->get_article_list(3,'latest-news') ; 
                        foreach ($article_list->result() as $article) { 

                        ?>                         

                        <li><a href="/articles/<?=$article->id;?>"><?=$article->title;?></a></li>


                        <? } if ($article_list->num_rows ==0) { ?>

                            <li><a href="">עדכון לדוגמה 1</a></li>
                            <li><a href="">עדכון לדוגמה 2</a></li>
                            <li><a href="">עדכון לדוגמה 3</a></li>

                        <? } ?>





                    </ul>                
            </div>

            


        </div>

   
        
         
         
        <? $this->load->view('template/footer') ; ?>
       
        
        
    </div><!-- container -->
</body>
</html>
