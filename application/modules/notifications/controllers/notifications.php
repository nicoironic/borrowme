<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * notifications controller
 */
class notifications extends Front_Controller
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
		$this->load->model('notifications_model', null, true);
		$this->lang->load('notifications');
		

		Assets::add_module_js('notifications', 'notifications.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		$records = $this->notifications_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

	//--------------------------------------------------------------------



}