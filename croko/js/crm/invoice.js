// from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number,decimals) {
  var newString;// The new rounded number
  decimals = Number(decimals);
  if (decimals < 1) {
    newString = (Math.round(number)).toString();
  } else {
    var numString = number.toString();
    if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
      numString += ".";// give it one at the end
    }
    var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
    var d1 = Number(numString.substring(cutoff,cutoff+1));// The value of the last decimal place that we'll end up with
    var d2 = Number(numString.substring(cutoff+1,cutoff+2));// The next decimal, after the last one we want
    if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
      if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
        while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
          if (d1 != ".") {
            cutoff -= 1;
            d1 = Number(numString.substring(cutoff,cutoff+1));
          } else {
            cutoff -= 1;
          }
        }
      }
      d1 += 1;
    } 
    if (d1 == 10) {
      numString = numString.substring(0, numString.lastIndexOf("."));
      var roundedNum = Number(numString) + 1;
      newString = roundedNum.toString() + '.';
    } else {
      newString = numString.substring(0,cutoff) + d1.toString();
    }
  }
  if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
    newString += ".";
  }
  var decs = (newString.substring(newString.lastIndexOf(".")+1)).length;
  for(var i=0;i<decimals-decs;i++) newString += "0";
  //var newNumber = Number(newString);// make it a number if you like
  return newString; // Output the result to the form field (change for your purposes)
}


function update_total() {
  var total = 0;
  $('.price').each(function(i){
    price = $(this).html().replace("$","");
    if (!isNaN(price)) total += Number(price);
  });

  total = roundNumber(total,2);

  $('#subtotal').html(total);
  $('#total').html(total);
  
  update_balance();
}

function update_balance() {
  var due = $("#total").html().replace("$","") - $("#paid").val().replace("$","");
  due = roundNumber(due,2);
  
  $('.due').html("$"+due);
}

function update_price() {
  var row = $(this).parents('.payment-item-row');
  var price = row.find('.cost').val().replace("$","") * row.find('.qty').val();
  price = roundNumber(price,2);
  isNaN(price) ? row.find('.price').html("N/A") : row.find('.price').html(price);
  
  update_total();
}

function bind() {
  $(".cost").blur(update_price);
  $(".qty").blur(update_price);
}



$(document).ready(function() {
	
  $('input').click(function(){
    $(this).select();
  });	

   
  $("#add-payment-item-row").click(function(){
  	
  	var id = parseInt( $(".payment-item-row:last").attr('id') ) + 1  ; 
  	
    $(".payment-item-row:last").after('<tr id="' + id + '" class="payment-item-row"><td class="item-name"><textarea name="payment-item[' + id + '][title]" >שם המוצר/שירות</textarea></td><td><textarea class="cost" name="payment-item['+id+'][amount]">0</textarea></td><td><textarea name="payment-item['+id+'][qty]" class="qty">1</textarea></td><td><span class="price">0</span></td><td><a class="delete-payment-row" href="javascript:;" title="Remove row" >X</a></td></tr>');
    
    if ($(".delete-payment-row").length > 0) $(".delete-payment-row").show();
    
    bind();

  });
  
  
   
  $("#add-cheque-row").click(function(){
  	
  	var id = parseInt( $(".cheque-row:last").attr('id') ) + 1  ;
  	
  	
	
	var new_row = '<tr id="00" class="cheque-row" ><td ><input type="text"  name="cheque[00][dateY]" class="input-date"><input type="text"  name="cheque[00][dateM]" class="input-date"><input type="text"  name="cheque[00][dateD]" class="input-date"></td><td><textarea name="cheque[00][account]" >0</textarea></td><td><textarea name="cheque[00][snif]" >0</textarea></td><td><textarea name="cheque[00][number]">0</textarea></td><td><textarea name="cheque[00][bank]">0</textarea></td><td><textarea name="cheque[00][amount]">0</textarea></td><td><a class="delete-cheque-row" href="javascript:;" title="Remove row" >X</a></td></tr>' ;
	new_row = new_row.replace(/00/g,id) ;
	
	    	   
  	
    $(".cheque-row:last").after(new_row);
    
    if ($(".delete-cheque-row").length > 0) $(".delete-cheque-row").show();
    
    

  });
  
    
  
  
  bind();
  

  
  $(".delete-payment-row").live('click',function(){
    $(this).parents('.payment-item-row').remove();    
    update_total();
    if ($(".delete-payment-row").length < 2) $(".delete-payment-row").hide();
  });


  $(".delete-cheque-row").live('click',function(){
    $(this).parents('.cheque-row').remove();        
    if ($(".delete-cheque-row").length < 2) $(".delete-cheque-row").hide();
  });  

  
});