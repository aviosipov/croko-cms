	<p>
	<?=$help_text;?>
	<br><br>
	</p>

    <?

    $attributes = array('class' => 'form', 'id' => 'myform');
    echo form_open("$target",$attributes);

    ?>
    

	<? $this->generator->render_input($field_name,$field_title,true,set_value('title', (isset($field_value) ? $field_value : '' )) ) ; ?>
	<? $this->generator->render_submit('שמירה') ; ?>

        
    </form>
   