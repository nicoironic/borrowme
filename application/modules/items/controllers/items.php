<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * items controller
 */
class items extends Front_Controller
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
		$this->load->model('items_model', null, true);
		$this->lang->load('items');
		

		Assets::add_module_js('items', 'items.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->items_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}