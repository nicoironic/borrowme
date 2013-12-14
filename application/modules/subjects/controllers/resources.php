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

		$this->auth->restrict('Subjects.Resources.View');
		$this->load->model('subjects_model', null, true);
		$this->lang->load('subjects');
		
		Template::set_block('sub_nav', 'resources/_sub_nav');
        Assets::add_module_css('subjects', 'subjects.css');
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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->subjects_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('subjects_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('subjects_delete_failure') . $this->subjects_model->error, 'error');
				}
			}
		}

		$records = $this->subjects_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Subjects');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Subjects object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Subjects.Resources.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_subjects())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('subjects_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'subjects');

				Template::set_message(lang('subjects_create_success'), 'success');
				redirect(SITE_AREA .'/resources/subjects');
			}
			else
			{
				Template::set_message(lang('subjects_create_failure') . $this->subjects_model->error, 'error');
			}
		}
		Assets::add_module_js('subjects', 'subjects.js');

		Template::set('toolbar_title', lang('subjects_create') . ' Subjects');
        Template::set_view('resources/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Subjects data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('subjects_invalid_id'), 'error');
			redirect(SITE_AREA .'/resources/subjects');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Subjects.Resources.Edit');

			if ($this->save_subjects('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('subjects_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'subjects');

				Template::set_message(lang('subjects_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('subjects_edit_failure') . $this->subjects_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Subjects.Resources.Delete');

			if ($this->subjects_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('subjects_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'subjects');

				Template::set_message(lang('subjects_delete_success'), 'success');

				redirect(SITE_AREA .'/resources/subjects');
			}
			else
			{
				Template::set_message(lang('subjects_delete_failure') . $this->subjects_model->error, 'error');
			}
		}
		Template::set('subjects', $this->subjects_model->find($id));
		Template::set('toolbar_title', lang('subjects_edit') .' Subjects');
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
	private function save_subjects($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']        = $this->input->post('subjects_name');
		$data['description']        = $this->input->post('subjects_description');
		$data['time_start']        = $this->input->post('subjects_time_start');
		$data['time_end']        = $this->input->post('subjects_time_end');
		$data['status']        = $this->input->post('subjects_status');

		if ($type == 'insert')
		{
			$id = $this->subjects_model->insert($data);

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
			$return = $this->subjects_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}