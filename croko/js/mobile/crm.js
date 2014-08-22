
	
$(document).bind("mobileinit", function(){
	
 

	$('div.ui-page').live("swiperight", function(){
		
		var nextpage = $(this).next('div[data-role="page"]');
		// swipe using id of next page if exists
		if (nextpage.length > 0) {
			$.mobile.changePage(nextpage, 'slide');
		}
	});
	
	
	$('div.ui-page').live("swipeleft", function(){
		var prevpage = $(this).prev('div[data-role="page"]');
		// swipe using id of next page if exists
		if (prevpage.length > 0) {
			$.mobile.changePage(prevpage, 'slide', true);
		}
	});

});

	
	
