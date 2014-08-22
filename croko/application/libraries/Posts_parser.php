<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/* Name        : Posts_parser.php
*  Description : Codeigniter Library Class that parse specifics string in args.
*  Creation	   : 30/08/2010
*  Version	   : 0.s1
*  Author	   : Tessier Ronan
*  Mail  	   : tessierronan@yahoo.fr
*
* Some code in this file was picked up from Wordpress shortcodes functions.
*/


/**
 * Posts_parser class.
 */

class Posts_parser
{
	var $text;
	var $ci;
	var $pattern;
	var $attrs_string;
	var $methods;
	
	// ------------------------------------------------------------------------
	/**
	 * Posts_parser function.
	 * 
	 * @access public
	 */
	function Posts_parser()
	{		
		$this->ci =& get_instance();
		$this->ci->load->library('tags_functions');
	}
	
	// ------------------------------------------------------------------------
	/**
	 * parse function.
	 * 
	 * @access public
	 * @param mixed $content
	 */
	function parse($content , $content_id = 0 , $content_type = 0)
	{
		
		/* do not parese if you're logged in to admin ... */		
		if ($this->ci->User->is_logged_in()) return $content ; 
		
		
		$this->text = $content;
		
		
		// set content id and type 
		
		$this->ci->tags_functions->set_content_id($content_id);
		$this->ci->tags_functions->set_content_type($content_type);
		
		
		$this->methods = $this->ci->tags_functions->get_funcs();
		$attrs = array();
		foreach ($this->methods as $method)
		{
			$attrs = $this->attrs_array($method);

			if (! is_array($attrs)) $attrs = array($attrs);
			
			foreach ($attrs as $tag)
			{
				$out = $this->ci->tags_functions->$method($tag);
				$this->attrs_string = $tag['attrs_string'];			
				$this->text = $this->replace_text($out, $method);
			}
		}
		return $this->text;
	}
	
	// ------------------------------------------------------------------------	
	/**
	 * attrs_array function.
	 * 
	 * @access public
	 * @param mixed $tag
	 */
	function attrs_array($tag)
	{
		$attrs = $this->find_attrs_in_text($tag);
		$attrs_arr = $this->parse_attrs($attrs);
		
		return $attrs_arr;
	}
	
	// ------------------------------------------------------------------------
	/**
	 * find_attrs_in_text function.
	 * 
	 * @access public
	 * @param mixed $tag
	 */
	function find_attrs_in_text($tag)
	{
		$this->pattern = '`\['.$tag.' ([^]]*)\]`';
		$output = preg_match_all($this->pattern, $this->text, $match);

		if (isset($match[1])) return $match[1];
		
		return false;
	}
	
	// ------------------------------------------------------------------------
	/**
	 * replace_text function.
	 * 
	 * @access public
	 * @param mixed $replacement
	 * @param mixed tag
	 */
	function replace_text($replacement = false, $tag)
	{
		if (! $replacement) return $this->text;
		
		$string_to_replace = '['.$tag.' '.$this->attrs_string.']';
		$content = str_replace($string_to_replace, $replacement, $this->text);
		
		return $content;
	}
	
	// ------------------------------------------------------------------------
	/**
	 * merge_attrs function
	 * source: wordpress
	 * @param array $pairs Entire list of supported attributes and their defaults.
	 * @param array $atts User defined attributes in shortcode tag.
	 * @return array Combined and filtered attribute list.
	 */
	function merge_attrs($pairs, $attrs) 
	{
		$attrs = (array) $attrs;
		$out = array();
		
		foreach($pairs as $name => $default) 
		{
			if ( array_key_exists($name, $attrs) )
				$out[$name] = $attrs[$name];
			else
				$out[$name] = $default;
		}
		return $out;
	}

	// ------------------------------------------------------------------------
	/**
	* parse_atts function.
	*
	* @access public
	* @param mixed $args
	*/
	function parse_attrs($args) 
	{
	   $atts = array();
	   $pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
	   foreach ($args as $key => $arg) {
	   		$atts[$key]['attrs_string'] = $arg;
			$arg = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $arg);
			if ( preg_match_all($pattern, $arg, $match, PREG_SET_ORDER) ) {
			    foreach ($match as $m) {
			    	if (!empty($m[1]))
			    		$atts[$key][strtolower($m[1])] = stripcslashes($m[2]);
			    	elseif (!empty($m[3]))
			    		$atts[$key][strtolower($m[3])] = stripcslashes($m[4]);
			    	elseif (!empty($m[5]))
			    		$atts[$key][strtolower($m[5])] = stripcslashes($m[6]);
			    	elseif (isset($m[7]) and strlen($m[7]))
			    		$atts[$key][] = stripcslashes($m[7]);
			    	elseif (isset($m[8]))
			    		$atts[$key][] = stripcslashes($m[8]);
			    }
			} 
			else {
			    $atts[$key] = ltrim($arg);
			}
		}
	   return $atts;
	}
}

?>