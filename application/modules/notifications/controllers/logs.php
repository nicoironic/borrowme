<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * logs controller
 */
class logs extends Admin_Controller
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

		$this->auth->restrict('Notifications.Logs.View');
		$this->load->model('notifications_model', null, true);
		$this->lang->load('notifications');
		
		Template::set_block('sub_nav', 'logs/_sub_nav');

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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->notifications_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('notifications_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('notifications_delete_failure') . $this->notifications_model->error, 'error');
				}
			}
		}

		$records = $this->notifications_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Notifications');
		Template::render();
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_notifications($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['description']        = $this->input->post('notifications_description');
		$data['page']        = $this->input->post('notifications_page');
		$data['seen']        = $this->input->post('notifications_seen');

		if ($type == 'insert')
		{
			$id = $this->notifications_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->notifications_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}