<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Structure URL Matcher Module Control Panel File
 *
 * @package		Structure URL Matcher
 * @subpackage	Addons
 * @category	Module
 * @author		Craig Duarte
 * @link		http://www.craigduarte.co.uk/
 */

class Structure_url_matcher_mcp {
	
	public $return_data;
	public $return_array = array();

	private $_base_url;
	private $data = array();
	private $module = 'structure_url_matcher';
	
	public function __construct()
	{
		$this->EE =& get_instance();
		
		$this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=structure_url_matcher';
		
		$this->EE->cp->set_right_nav(array(
			'module_home'	=> $this->_base_url,
			// Add more right nav items here.
		));

		ee()->load->library('sum_functions');
	}
	
	// ----------------------------------------------------------------

	/**
	 * Index Function
	 *
	 * @return 	void
	 */
	public function index()
	{
		$this->EE->load->library('table');
		$this->EE->view->cp_page_title = lang('structure_url_matcher_module_name');
		$this->data['action_url'] = $this->_form_url('update_structure_urls');

		$unmatched_entries = ee()->sum_functions->get_unmatched_entries();

		$this->data['unmatched_entries'] = $unmatched_entries;

		return $this->EE->load->view('index', $this->data, TRUE);	
	}

	public function update_structure_urls()
	{
		$this->EE->view->cp_page_title = lang('structure_url_matcher_module_name');

		$match_entries = ee()->sum_functions->set_structure_url_as_url_title();

		$this->data['view_content'] = '<p>URLs updated.</p>';
		return $this->EE->load->view('generic', $this->data, TRUE);
	}

	private function _form_url ($method = 'index', $variables = array()) {
		$url = 'C=addons_modules' . AMP . 'M=show_module_cp' . AMP . 'module=' . $this->module . AMP . 'method=' . $method;
		
		foreach ($variables as $variable => $value) {
			$url .= AMP . $variable . '=' . $value;
		}
		
		return $url;
	}
	
}
/* End of file mcp.structure_url_matcher.php */
/* Location: /system/expressionengine/third_party/structure_url_matcher/mcp.structure_url_matcher.php */