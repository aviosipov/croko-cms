<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >


<html lang="he">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <link rel="stylesheet" media="screen" href="http://getcontrol.co.il/css/cms/cms-new.css" />
        <link rel="stylesheet" media="screen" href="http://getcontrol.co.il/css/cms/cms-buttons.css" />


        <!-- load google style buttons -->
        
        <link rel="stylesheet" href="http://getcontrol.co.il/css/cms/css3-buttons.css" type="text/css" media="screen">    
        <link rel="stylesheet" href="http://getcontrol.co.il/css/cms/tiptip.css" type="text/css"  media="screen">
        <script src="http://getcontrol.co.il/js/jquery.tiptip.js"></script>

        <script type="text/javascript">

        $(document).ready(function() {


            $("#username").focus() ; 
          
        });

        </script>


</head>
<body>


    <div class="login-window">


            <img src="http://getcontrol.co.il/images/cms/login-splash-bunny.png" /> 

             
            
            <?                      
            $attributes = array('class' => 'login', 'id' => 'myform');
            echo form_open('users/login',$attributes);
            ?>  
                
                <input id="username" name="username"  required="required" type="text" value="" placeholder="משתמש">            
                <input name="password"  required="required" type="password" value="" placeholder="סיסמה">            
                <input type="submit" value=" כניסה" class="btn">

            </form>






    </div>
                        

                    
















    
</body>
</html>
