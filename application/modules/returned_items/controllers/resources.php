<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * resources controller
 */
class resources extends Admin_Controller
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

		$this->auth->restrict('Returned_Items.Resources.View');
		$this->load->model('returned_items_model', null, true);
		$this->lang->load('returned_items');
		
		Template::set_block('sub_nav', 'resources/_sub_nav');

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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->returned_items_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('returned_items_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('returned_items_delete_failure') . $this->returned_items_model->error, 'error');
				}
			}
		}

		$records = $this->returned_items_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Returned Items');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Returned Items object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Returned_Items.Resources.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_returned_items())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('returned_items_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'returned_items');

				Template::set_message(lang('returned_items_create_success'), 'success');
				redirect(SITE_AREA .'/resources/returned_items');
			}
			else
			{
				Template::set_message(lang('returned_items_create_failure') . $this->returned_items_model->error, 'error');
			}
		}
		Assets::add_module_js('returned_items', 'returned_items.js');

		Template::set('toolbar_title', lang('returned_items_create') . ' Returned Items');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Returned Items data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('returned_items_invalid_id'), 'error');
			redirect(SITE_AREA .'/resources/returned_items');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Returned_Items.Resources.Edit');

			if ($this->save_returned_items('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('returned_items_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'returned_items');

				Template::set_message(lang('returned_items_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('returned_items_edit_failure') . $this->returned_items_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Returned_Items.Resources.Delete');

			if ($this->returned_items_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('returned_items_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'returned_items');

				Template::set_message(lang('returned_items_delete_success'), 'success');

				redirect(SITE_AREA .'/resources/returned_items');
			}
			else
			{
				Template::set_message(lang('returned_items_delete_failure') . $this->returned_items_model->error, 'error');
			}
		}
		Template::set('returned_items', $this->returned_items_model->find($id));
		Template::set('toolbar_title', lang('returned_items_edit') .' Returned Items');
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
	private function save_returned_items($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['worker_id']        = $this->input->post('returned_items_worker_id');
		$data['student_id']        = $this->input->post('returned_items_student_id');
		$data['item_id']        = $this->input->post('returned_items_item_id');
		$data['quantity']        = $this->input->post('returned_items_quantity');

		if ($type == 'insert')
		{
			$id = $this->returned_items_model->insert($data);

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
			$return = $this->returned_items_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}