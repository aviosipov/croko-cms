<?php
    
?>


        <header>

            <div class="clearfix">

                <nav>
                    <div class="logo"><a href="<?=site_url(); ?>dashboard"><img alt="open college" src="http://www.getcontrol.co.il/images/logo2.png"/></a></div>
                    <ul class="clearfix menur">
                        
                        
                        
                        <li class="<?=($this->uri->segment(1)==='dashboard')?'active':''?>"> <?=anchor("dashboard", "תמונת מצב"); ?> </li>
                        <li class="<?=($this->uri->segment(1)==='clients')?'active':''?>"> <?=anchor("clients", "לקוחות"); ?> </li>
                        <li class="<?=($this->uri->segment(1)==='projects')?'active':''?>"><?=anchor("projects", "פרויקטים"); ?> </li>
                        <li class="<?=($this->uri->segment(1)==='tasks')?'active':''?>"><?=anchor("tasks", "משימות"); ?></li>
                        
                        
                        <? if ($this->User->get_level() > 0 && $this->User->can_access_cashflow() ) { ?>
                        
                        	<li class="<?=($this->uri->segment(1)==='cash')?'active':''?>"><?=anchor("cash/cashflow", "תזרים מזומנים"); ?></li>
                        	<li class="<?=($this->uri->segment(1)==='settings')?'active':''?>"><?=anchor("settings", "הגדרות"); ?></li>                        	
                        	
                		<? } ?>
                        
                        
                        <?
                        
                        if ($this->User->is_admin()) { 
                        
                        ?>
                        
                        
                        <li class="<?=($this->uri->segment(1)==='admin')?'active':''?>"><?=anchor("admin", "חברות"); ?></li>
                        <li class="<?=($this->uri->segment(2)==='sites')?'active':''?>"><?=anchor("admin/sites", "אתרים"); ?></li>
                        
                        <?
                        
						}
                        
                        ?>
                        
                        
                                                
                    </ul>
                    <div class="welcome"><? $this->User->show_greeting() ;  ?></div>
                </nav>
            </div>
        </header>