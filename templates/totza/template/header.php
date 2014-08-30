<div class="row header">
    <div class="col-md-6">

        <? $file = $this->Content->get_image('logo' , getTemplatePath() . 'images/logo.png') ; ?>

        <a href="/">
            <img src="<?=$file;?>" class="croko_widget_image" image-crop-width="400" image-crop-height="125" image-name="logo" />
        </a>

    </div>
    
    <div class="col-md-6">

        <ul class="nav nav-pills pull-left">
            <? $this->Content->get_menu() ;?>        
        </ul>

    </div>

</div><!-- header -->

<div class="row">

    <div class="col-md-12">
        <hr/>
    </div>

</div>