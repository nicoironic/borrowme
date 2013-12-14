<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * returned_items controller
 */
class returned_items extends Front_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('returned_items_model', null, true);
		$this->lang->load('returned_items');
		

		Assets::add_module_js('returned_items', 'returned_items.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->returned_items_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}