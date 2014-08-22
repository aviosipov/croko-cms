function hide_editable(new_value) {


	if ( $('.tiny-editor').length > 0 ) { // if we have editor open ... 

		$('.tiny-editor').hide() ; 

		if (new_value != '' && new_value != ' ') 
		$(".tiny-editor").prev().text(new_value) ;  // update text with new values


		$(".tiny-editor").prev().show() ; 	
		$(".tiny-editor").remove(); 		

		// enable sortable 
		$( ".page-list" ).sortable( "enable" );

	}

}


function update_sort() {

	var order = $('.page-list').sortable("serialize") + '&action=updateRecordsListings';			
	console.log('sortable update function') ; 


	

	$.post("/admin/ajax/update_sort/pages/"  , order, function(theResponse){

		console.log(theResponse) ; 
		//$("#contentRight").html(theResponse);
	});

}


function update_parent(item) {

	// find out who is the father ... 

	var father = 0 ; 

	if (!$(item).prev().hasClass("indent")) 
	{
		father = $(item).prev().attr('row-id') ; 
		console.log('papa is : ' + father) ; 

	} else {

		// previous element is a child .. find who is the
		// father 

		father = $(item).prevAll().not('.indent').first().attr('row-id');  // get first element without indent
		console.log('papa is : ' + father ) ; 

	}

	ajax_update_field('pages',$(item).attr('row-id'),'parent', father ) ; 

}






$(document).ready(function() {


	$('.update-boolean-field').live("click",  function(event) {


		var row_id = $(this).parents('.row').attr('row-id');
		var data_field = $(this).attr('data-field') ; 
		var value ; 

		if ($(this).hasClass('not-active')) {

			value = 1 ; 
			$(this).removeClass('not-active') ; 

		} else {

			value = 0 ; 
			$(this).addClass('not-active') ; 

		}

		ajax_update_field('pages' , row_id , data_field , value) ; 			


	}) ; 




	/* Live Search   */

	
	$("#search-field").live("keyup",  function(event) {

		if ( event.keyCode == 27 ) {  // ESC key was pressed .. cancel all 

			$(this).val('') ; 
			$(".row").removeClass("hidden") ; 


		} else {

	
		    var filter = $(this).val(), count = 0;

		    $(".row").each(function () {

		        if ($(this).children().first().children().first().text().search(new RegExp(filter, "i")) < 0) {
		            $(this).addClass("hidden");
		        } else {
		            $(this).removeClass("hidden");
		            count++;
		        }
		        
		    });

		}

			



	    
	    
	});	

  	
  	//// Nano Scroller plugin 

  	$(".nano").nanoScroller({ preventPageScrolling: true }); // start nano custom scrollbars 


	/* ----------- enable html5 content-editable -----------*/

	$('.editable').dblclick(function() {

		// start editable field ... 
		 
		$(this).hide() ; 

		var width = $(this).width() ; 		
		var text = $(this).text() ; 
		var data_field = $(this).attr('data-field') ; 

		$(this).after('<input type="text" name="my-text" class="tiny-editor" id="5555" style="width:' + width + 'px;" value="' + text + '" data-field="'  + data_field +  '" />') ; 
		$("#5555").focus() ; 

		// disable sortable plugin temporary ... 			
		$( ".page-list" ).sortable( "disable" );

	  
	});		


	$("input.tiny-editor").live("keyup",  function(event) {


		
		
		
	



		if (event.keyCode != 13 && event.keyCode != 27 ) { 

			contents = $(this).val();				/// this code is responsible for input field
			old_width = $(this).width() ; 			/// auto-grow width. 
			charlength = contents.length;
			newwidth = 30 + (charlength * 5.5 );

			if (  newwidth  >  ( old_width + 20 ) )  $(this).stop(true, true).animate({width:newwidth},350);

		}
		
		if ($(this).attr('data-field') == 'url') // prevent spaces for url 		
		$(this).val(function(i, v) { return v.replace(/ /g,"-"); });
		
	});


	$('input.tiny-editor').live("blur",  function(event) {
 		
		
		var row_id = $(this).parents('.row').attr('row-id');
		var data_field = $(this).attr('data-field') ; 
		var text = $(this).val() ; 
		

		// send data to remote server 

		if ( $(".tiny-editor").prev().text() != text && text != '' && text != ' ' )  				/// save data only if field 
		ajax_update_field('pages' , row_id , data_field , text) ; 					/// changed and not empty.
		


		hide_editable(text) ; 
		

 	}) ; 





	
	
	$('input.tiny-editor').live("keydown" , function (event) {



		if (event.keyCode == 13 || event.keyCode == 27 ) {

			
			event.stopPropagation();
			hide_editable() ; 



		}



	});




 
	/* enable page sorting ... */ 



	$(".page-list").sortable({ tolerance: "pointer"  , forceHelperSize: true , forcePlaceholderSize: true  ,  delay : 220 ,  items : '> div' , opacity: 0.6, cursor: 'move', update: function() {


						
		

			 
	} , 


    start: function(event, ui) {

    	console.log('sortable start') ; 

        var start_pos = ui.item.index();
        ui.item.data('start_pos', start_pos);

    },


	stop : function ( event, ui ) {

		console.log('sortable stop') ; 

		
        var start_pos = ui.item.data('start_pos');
        var stop_pos = ui.item.index();


		var item = ui.item ; 
		var item_count = $('div.row').size() 
		var x_offset = ui.offset.left ; 


		if ( (stop_pos-start_pos) == 0 )  { // position not changed so we can add/remove indent 



			if (item.hasClass("indent")) {


				if (x_offset > 45 )  {

					item.removeClass("indent") ; 
					ajax_update_field('pages',$(item).attr('row-id'),'parent','0' ) ; 

					// remove indent/father and update database ... 

					if ($(item).next().hasClass('indent')) {
					$(item).nextUntil('div:not(.indent)').each(function(index) {

						$(this).removeClass('indent') ; 
						ajax_update_field('pages',$(this).attr('row-id'),'parent','0' ) ;  // update db .. 
						
					
					});
					}

				} 
					


			} else {

				if (x_offset < -55)  {

					item.addClass("indent") ; 

					// find out the parent and update ... 
					update_parent(item) ; 


					if ($(item).next().hasClass('indent')) {
					$(item).nextUntil('div:not(.indent)').each(function(index) {


						$(this).removeClass('indent') ; 
						ajax_update_field('pages',$(this).attr('row-id'),'parent','0' ) ; 
						// update database 
					
					});
					}

					// update child elements ... 
					
					

				}
					

			}


			

		} else {  //  position changed


			// not allowed indent for the 1st element or when
			// we have less than 2 elements 



			if ($(item).index() == 0 || item_count < 2  ) {

				if (item.hasClass("indent")) item.removeClass("indent") ;  
				ajax_update_field('pages',$(item).attr('row-id'),'parent','0' ) ; 

			}
			else {

				if (item.hasClass("indent")) update_parent(item) ;  
				else {

					// parent added as a child 					

					if ($(item).next().hasClass('indent')) {

						item.addClass("indent") ; 					
						update_parent(item) ; 					
					}



				}
			}


			update_sort() ; 


				


			


		}

		
		
		



	} , 

	cancel: '.tiny-editor' 



});   


});