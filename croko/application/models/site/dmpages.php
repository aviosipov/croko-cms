<?php

class DMPages extends DataMapper {

	var $table = 'pages'; // not nececary ..
	 
	
//	var $has_one = array("country", "group");
//	var $has_many = array("book", "setting");
	
	
	
    // Optionally, don't include a constructor if you don't need one.
	function __construct($id = NULL)
	{
	    parent::__construct($id);
	}	 

}
