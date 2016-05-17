<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Structure URL Matcher Module Front End File
 *
 * @package		Structure URL Matcher
 * @subpackage	Addons
 * @category	Module
 * @author		Craig Duarte
 * @link		http://www.craigduarte.co.uk/
 */

class Structure_url_matcher {
	
	public $return_data;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
	}
	
	// ----------------------------------------------------------------


	public function something_goes_here() {
		
	    return ee()->TMPL->parse_variables(ee()->TMPL->tagdata, $variables);

	}
	
}
/* End of file mod.structure_url_matcher.php */
/* Location: /system/expressionengine/third_party/structure_url_matcher/mod.structure_url_matcher.php */