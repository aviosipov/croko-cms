            <div class="header">
                <div class="logo">

                    <? $file = $this->Content->get_image('logo' , '/images/logo.png') ; ?>
                

                    <h1><a href="/">
                        <img src="<?=$file;?>" class="croko_widget_image" image-crop-width="400" image-crop-height="125" image-name="logo" />
                    </a></h1>

                </div>
                
                <div class="headercontact">


                <!--
                    <h2 class="change">יוצרים שינוי</h2>
                    <div class="bog">
                        <img src="/images/headercontact.png" alt="" class="contacti"/>
                        <a href="#" class="social-link facebook-icn"></a>
                        <a href="#" class="social-link youtube-icn"></a>
                    </div>

                    -->
                </div>
                
                <div class="menu">
                    <ul>
                        <? $this->Content->get_menu() ;?>

                        
                    </ul>
                </div>
            </div><!-- header -->