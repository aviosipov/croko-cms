<?  $this->load->view('template/header-cms'); ?>

<body> 
	
	

        
	<? 
		$attributes = array('class' => 'form', 'id' => 'myform');
		echo form_open_multipart("admin/generator",$attributes); 
	?> 
    	
    	
    	<h2><?=$title;?></h2>
    	
    	
    	<div class="right-bar">
    		
    		<h3>מבנה האתר</h3>
    		
    		
    		
    		
    		
    		<?
    		
    		echo form_label('מיקום הלוגו');    		
    		
			$options = array(
			                  'rightlogo'  => 'ימין',
			                  'leftlogo'    => 'שמאל'
			                );
			
			echo form_dropdown('logo_position', $options, $style['logo_position']);




    		echo form_label('מיקום התפריט');    		
    		
			$options = array(
			                  'right-menu'  => 'למעלה מימין',
			                  'left-menu'  => 'למעלה משמאל',
			                  'down-menu-right'  => 'למטה מימין',
			                  'down-menu-left'    => 'למטה משמאל'
			                );
			
			echo form_dropdown('menu_position', $options, $style['menu_position']);





    		echo form_label('סליידר\תמונה בדף הבית');    		
    		
			$options = array(
			                  'slider'  => 'סליידר',
			                  'slider-1-pic'  => 'תמונה קבועה',
			                  'none'  => 'אל תציג'			                  
			                );
			
			echo form_dropdown('homepage_slider', $options, $style['homepage_slider']);


			
	        echo form_label('הצג פוטר');
	        echo form_checkbox('footer', 'footer', $style['footer'] );






    		echo form_label('גופן');    		
    		
			$options = array(
			                  'arial'  => 'Arial',			                  
			                  'tahoma'  => 'Tahoma'			                  
			                );
			
			echo form_dropdown('font_family', $options, $style['font_family']);







    		echo form_label('תמונת רקע');    		
    		
			$options = array(
			                  'background'  => 'דוגמה א',
			                  'background2'  => 'דוגמה ב',	
			                  'background3'  => 'דוגמה ג',				                  
			                  'background4'  => 'דוגמה ד',
			                  'none'  => 'ללא'			                  
			                );
			
			echo form_dropdown('bg_image', $options, $style['bg_image']);



			    		    		
    		
    		?>
   
	   

			<h3 class="clear-title">דף הבית</h3>
			
			<? 
			
			
	        echo form_label('הצג קריאה לפעולה');
	        echo form_checkbox('show_call_to_action', 'show_call_to_action', $style['show_call_to_action'] );



    		echo form_label('פריסת דף בית');    		
    		
			$options = array(
			                  '1-col'  => 'עמודה אחת',
			                  '2-col-halfs'  => '2 עמודות שוות',	
			                  '2-col-left'  => 'עמודה רחבה משאמל',				                  
			                  '2-col-right'  => 'עמודה רחבה מימין',
			                  '3-col'  => '3 עמודות'			                  
			                );
			
			echo form_dropdown('homepage_layout', $options, $style['homepage_layout']);






			
			?>

			



	    	<label>כותרת לדף הבית</label>
	    	<input  id="" name="home-title" type="text" value="<?=$style['home-title'] ; ?>"/>

	
        
        </div>
        
        <div class="left-bar">
        	
        	<h3>צבעים</h3>


	    	<label>רקע</label>
	    	<input  id="colorpicker" name="bgcolor" type="text" value="<?=$style['bgcolor'] ; ?>"/>

	    	<label>רקע פנימי</label>
	    	<input  id="colorpicker" name="inner_bgcolor" type="text" value="<?=$style['inner_bgcolor'] ; ?>"/>


	    	<label>תפריט</label>
	    	<input  id="colorpicker" name="menu_bg_color" type="text" value="<?=$style['menu_bg_color'] ; ?>"/>

	    	<label>תת תפריט</label>
	    	<input  id="colorpicker" name="sub_menu_bg_color" type="text" value="<?=$style['sub_menu_bg_color'] ; ?>"/>


	    	<label>כיתוב לתפריט</label>
	    	<input  id="colorpicker" name="menu_text_color" type="text" value="<?=$style['menu_text_color'] ; ?>"/>

	    	<label>כותרת H1</label>
	    	<input  id="colorpicker" name="h1_color" type="text" value="<?=$style['h1_color'] ; ?>"/>

	    	<label>כותרת H2</label>
	    	<input  id="colorpicker" name="h2_color" type="text" value="<?=$style['h2_color'] ; ?>"/>

	    	<label>כותרת H3</label>
	    	<input  id="colorpicker" name="h3_color" type="text" value="<?=$style['h3_color'] ; ?>"/>

	    	<label>תוכן פסקה</label>
	    	<input  id="colorpicker" name="paragraph_color" type="text" value="<?=$style['paragraph_color'] ; ?>"/>

	    	<label>קישור</label>
	    	<input  id="colorpicker" name="link_color" type="text" value="<?=$style['link_color'] ; ?>"/>

	    	<label>כפתור פעולה</label>
	    	<input  id="colorpicker" name="button_color" type="text" value="<?=$style['button_color'] ; ?>"/>

	    	<label>שורת פעולה למעלה</label>
	    	<input  id="colorpicker" name="action_line_color" type="text" value="<?=$style['action_line_color'] ; ?>"/>
        
	    	<label>שורת פעולה</label>
	    	<input  id="colorpicker" name="action_block_color" type="text" value="<?=$style['action_block_color'] ; ?>"/>

	        <label>&nbsp;</label>
	        <input type="submit" value=" שמור שינויים " />
        
        </div>
        
        
    </form>



    	<? $this->load->view('site/menu') ; ?> 

    
    
                    
                            
</body>                


</html>