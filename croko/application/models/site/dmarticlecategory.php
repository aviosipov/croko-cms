<?php

class DMArticleCategory extends DataMapper {

	var $table = 'article_categories'; // not nececary ..
	
	
    // Optionally, don't include a constructor if you don't need one.
	function __construct($id = NULL)
	{
	    parent::__construct($id);
	}	 

}
