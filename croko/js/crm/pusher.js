  

    var pusher = new Pusher('aa4e0117d28855c6a4ad');
    var channel = pusher.subscribe('notifications');

    channel.bind('incoming-call', function(data) {

      $( "#dialog-message .link").show() ; 

      if (data.name) {

        $( "#dialog-message .title").text(data.name + ' מחייג אליך') ; 
        $( "#dialog-message .subtitle").text(data.biz_name) ; 
        $( "#dialog-message .link").attr('url','http://getcontrol.co.il/clients/show' + data.id) ; 

      } else {

        $( "#dialog-message .title").text(data.From + ' מחייג אליך') ; 
        $( "#dialog-message .link").attr('url','http://getcontrol.co.il/clients/add' ) ; 

      }

      $( "#dialog-message" ).dialog( "open" );
      $(".ui-dialog-titlebar").removeClass('ui-widget-header');


      console.log('incoming call') ; 
      console.log(data) ; 
    });

    channel.bind('incoming-call-end', function(data) {

      $( "#dialog-message .status").text(' השיחה הסתיימה') ; 


      console.log('call ended') ; 
      console.log(data) ; 
    });


  
    $(document).ready(function() {


        $(".call-number").click(function() {

            var number = $(this).text() ; 

            /// show dilog 
            $( "#dialog-message .title").text('מחייג למספר : ' + number ) ; 
            $( "#dialog-message .subtitle").text('') ; 
            $( "#dialog-message .link").hide() ; 

            $( "#dialog-message" ).dialog( "open" );
            $(".ui-dialog-titlebar").removeClass('ui-widget-header');

            /// do call 


                  
            $.ajax({
                  
                url: '/callcenter/call',                
                data: { number : number    },                    
                    
                type: "POST",
                      
                success: function(data)  {
                  
                    console.log(data) ; 
                          
                        
                }
            });            




        });
  
    });