    <div class="hmbottom sidebar">

                    <div class="newsleta">
                        <div class="boxtitleline">

                            <div id="sidebar-about-title" class="editable">
                            <? if (!$this->Content->get_content('sidebar-about-title')) { ?>

                            <h3 class=" nlsu">אודותינו</h3>

                            <? } ?>
                            </div>

                            <div class="dottdivi"></div>
                        </div>

                        <div id="sidebar-about-content" class="editable">
                        <? if (!$this->Content->get_content('sidebar-about-content')) { ?>

                        
                        <p>כאן ניתן להזין תוכן שיוצג לגולשים, לחצו על המלל לביצוע העריכה. </p>


                        <? } ?>
                        </div>
                        
                        
                        
                        
                    </div><!-- newsleta -->

                    <div class="lastupdates">
                        <div class="boxtitleline croko_widget" croko-data-type="articles" croko-data-category="latest-news">

                            <div id="sidebar-updates-title" class="editable">
                            <? if (!$this->Content->get_content('sidebar-updates-title')) { ?>

                            <h3 class="lsup">עדכונים אחרונים</h3>

                            <? } ?>
                            </div>
                            

                            <div class="dottdivi"></div>
                        </div>
                        
                        <ul>

                            <?

                            $article_list = $this->Content->get_article_list(5,'latest-news') ; 
                            foreach ($article_list->result() as $article) { 

                            ?>                         


                            <li>
                                <div class="bubbr">
                                    <div class="padder1">
                                        <p class="darker"><?=$this->Content->get_article_short($article->id);?></p>
                                        
                                        
                                    </div>
                                    
                                    <div class="bubbl"></div>
                                </div>
                                <div class="postersec">
                                    <a href="/articles/<?=$article->id;?>"><?=$article->title;?></a>
                                    
                                    <div class="shad"></div>
                                </div>
                            </li>
                            
                            <? } 

                            if ($article_list->num_rows() == 0) { ?>                            

                              <li>
                                <div class="bubbr">
                                    <div class="padder1">
                                        <p class="darker">תוכן של עדכון לדוגמה</p>                                                                                
                                    </div>
                                    
                                    <div class="bubbl"></div>
                                </div>
                                <div class="postersec">
                                    <a >כותרת עדכון</a>                                    
                                    <div class="shad"></div>
                                </div>
                            </li>



                            <? } ?>
                            
                            
                        </ul>
                    </div><!-- lastupdates -->
                    

                    
                    
                    
                </div><!-- hmbottom -->