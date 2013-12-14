<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * laboratories controller
 */
class laboratories extends Front_Controller
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
		$this->load->model('laboratories_model', null, true);
		$this->lang->load('laboratories');
		

		Assets::add_module_js('laboratories', 'laboratories.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->laboratories_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}