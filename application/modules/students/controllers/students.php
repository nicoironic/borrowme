<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * students controller
 */
class students extends Front_Controller
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
		$this->load->model('students_model', null, true);
		$this->lang->load('students');
		

		Assets::add_module_js('students', 'students.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->students_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}