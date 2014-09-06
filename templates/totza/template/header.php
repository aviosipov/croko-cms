<div class="row header">
    <div class="col-md-5 logo">

        <? $file = $this->Content->get_logo(0 , 'http://placehold.it/350x95/ffffff/9B9B9B/&text=logo(350x95)') ; ?>


        <a href="/">
            <img src="<?=$file;?>"  class="img-responsive" image-name="logo" />
        </a>

    </div>
    
    <div class="col-md-7">

        <ul class="nav nav-pills pull-left visible-lg visible-md ">
            <? $this->Content->get_menu() ;?>        
        </ul>

    </div>

</div><!-- header -->

<div class="row">

    <div class="col-md-12">
        <hr/>
    </div>

</div>