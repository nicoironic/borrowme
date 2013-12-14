<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * teachers controller
 */
class teachers extends Front_Controller
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
		$this->load->model('teachers_model', null, true);
		$this->lang->load('teachers');
		

		Assets::add_module_js('teachers', 'teachers.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->teachers_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}