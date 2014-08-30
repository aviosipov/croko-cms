<form action="/admin/forms" method="post" accept-charset="utf-8" class="croko-contact-form" id="myform" data-ajax="false">

<h3>צרו קשר</h3>
<p>השאירו לנו הודעה ונחזור אליכם בהקדם</p>

	<input type="hidden" name="current_url" value="<?=current_url();?>">
	
	<p class="antispam">Leave this empty:
	<br><input name="url"></p>			


	<label>שם (*)</label>
	<input id="name" name="name" class="required" type="text"> 
	<br>

	<label>אימייל (*)</label>
	<input id="email" name="email" class="required email" type="text"> 
	<br>

	<label>טלפון (*)</label>
	<input id="phone" name="phone" class="required" type="text"> 
	<br>


	<label>הודעה</label>
	<textarea id="message" name="message"></textarea>
	<br>

	<label>	
	<img src="http://getcontrol.co.il/images/cms/helpers/refresh.jpg" width="15" alt="" id="refresh">
	</label>
	<img src="/admin/services/captcha" alt="" id="captcha">
	<Br>

	<label>קוד אימות</label>
	<input name="captcha_enabled" type="hidden" value="1">
	<input name="captcha" type="text" id="captcha" class="captcha">
	<br><br>	
			

	<label>&nbsp;</label>
	* - שדות חובה
	<br><br>

	<label>&nbsp;</label>
	<input type="submit" id="submit" value="שלח" class="submit">

</form>