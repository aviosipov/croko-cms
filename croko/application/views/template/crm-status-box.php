                    <div class="signup">
                        <div class="tasker">
			    <div class="takr">
			    <span class="situ">הכנסה חודשית</span><div class="taki">&#8362;<?=anchor('cash/cashflow', number_format( $this->Cashflow->sum_earnings_by_month(date('01-m-Y')) ) );?></div>
			    </div>
			    <div class="takr2">
			    <span class="situ2">פרויקטים פעילים</span><div class="taki2"><?=anchor('projects', $this->Project->count_active_projects() ); ?></div>
			    </div>
			</div>
                        <div class="tasker">
			    <div class="takr">
			    <span class="situ">לידים</span><div class="taki"><?= anchor('clients', $this->Client->count_leads() ) ;?></div>
			    </div>
			    <div class="takr2">
			    <span class="situ2">משימות פתוחות</span><div class="taki2"><?=anchor('tasks', $this->Client->count_open_tasks() + $this->Project->count_open_tasks() ) ;?></div>
			    </div>
			</div>
			    
                    </div>