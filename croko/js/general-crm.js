


  $(document).ready(function(){

    // hide dialogs and set them up

    

    $( "#dialog-message" ).dialog({
      modal: true,
      autoOpen: false, 
      hide: 'fold',      
      show: 'fade',
    });    
  	
  	
  	// datepicker stuff ... 
  	
  	$( "#datepicker" ).datepicker( {  dateFormat: 'dd-mm-yy'  });
  	$( "#datepicker" ).datepicker( $.datepicker.regional[ "he" ] );
  	  	
  	$( "#datepicker2" ).datepicker( {  dateFormat: 'dd-mm-yy'  });
  	$( "#datepicker2" ).datepicker( $.datepicker.regional[ "he" ] );
  	
  	// autogrowing textarea's
  	  	
	$("#txt_notes,#txt_notes2,#txt_notes3,#txt_notes4").autoGrow(); /* enable text area auto grow*/   	
	$('#tabvanilla > ul').tabs({ fx: { height: 'toggle', opacity: 'toggle' } });
	
	
	// numeric fields 
		
    $(".numeric").numeric();
    
    
    
    
    
    /* auto sum update in cashflow modules ...  */
	    
	
	  var sum = 0 ; 


    $("#payments").focus(function(){    	
    	sum = $("#sum").val() ;     	
    });
    
     
 
    $("#payments").keyup(function(){
    	
    	if ($("#payments").val()!='') 
    		$("#sum").val( sum / $("#payments").val() ) ; 
    });

    /* end of auto sum update in cashflow modules ...  */

    
    
    
  });
