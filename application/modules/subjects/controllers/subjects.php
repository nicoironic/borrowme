<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * subjects controller
 */
class subjects extends Front_Controller
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
		$this->load->model('subjects_model', null, true);
		$this->lang->load('subjects');
		

		Assets::add_module_js('subjects', 'subjects.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->subjects_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}