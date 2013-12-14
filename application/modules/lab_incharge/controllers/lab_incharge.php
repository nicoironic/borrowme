<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * lab_incharge controller
 */
class lab_incharge extends Front_Controller
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
		$this->load->model('lab_incharge_model', null, true);
		$this->lang->load('lab_incharge');
		

		Assets::add_module_js('lab_incharge', 'lab_incharge.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->lab_incharge_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}