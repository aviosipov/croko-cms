<? $this->load->view('template/head') ; ?>

<body>

    <?=$editor_menu; ?>

    <div class="container">
        <div class="main-content">
            <? $this->load->view('template/header') ; ?>
            
            <div class="content">
            

                <div id="main-content" class="editable">
                <? if (!$this->Content->get_content('main-content')) { ?>                        

                <img src="http://lorempixel.com/400/300/business" class="left" />

                <h3 >תחומי עיסוק</h3>
                <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה.  כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>


                <? } ?>
                </div>
                    
                
                <div class="homebottom">
                    <div class="third hmthird">

                        <div id="home-bottom" class="editable">
                        <? if (!$this->Content->get_content('home-bottom')) { ?>        

                        <h5 class=" firsttitle">אודותינו</h5>
                        <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>
                        
                        <? } ?>
                        </div>
                        
                    </div>
                    <div class="third hmthird croko_widget"  croko-data-type="articles" croko-data-category="latest-news">

                        <div id="home-latest-news" class="editable" >
                        <? if (!$this->Content->get_content('home-latest-news')) { ?>        
                        <h5 class=" secondtitle">עדכונים אחרונים</h5>
                        <? } ?>
                        </div>


                        <ul>

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
                    <div class="third hmthird">
                        <h5 class=" contacttitle">צור קשר</h5>
                        <form>
                            <div class="input-line">
                                <span class="input-name">שם:</span>
                                <div class="input-pic"><input type="text" value="" /></div>
                            </div>
                            <div class="input-line">
                                <span class="input-name">מייל:</span>
                                <div class="input-pic"><input type="text" value="" /></div>
                            </div>
                            <div class="input-line">
                                <span class="input-name">טלפון:</span>
                                <div class="input-pic"><input type="text" value="" /></div>
                            </div>
                                
                            <div class="input-line">
                                <input type="submit" value="שלח" class="btn input-btn left"/>
                            </div>
                        </form>
                    </div>
                </div>
                
                
                
            </div><!-- content -->
            
             <div class="pre-footer"></div>
             
            <? $this->load->view('template/footer') ; ?>
           
            
        </div><!-- main-content -->
    </div><!-- container -->
</body>
</html>
