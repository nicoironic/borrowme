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

		$this->auth->restrict('Laboratories.Resources.View');
		$this->load->model('laboratories_model', null, true);
        $this->load->model('teachers/teachers_model', null, true);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('subjects/subjects_model', null, true);
		$this->lang->load('laboratories');
		
		Template::set_block('sub_nav', 'resources/_sub_nav');

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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->laboratories_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('laboratories_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('laboratories_delete_failure') . $this->laboratories_model->error, 'error');
				}
			}
		}

		$records = $this->laboratories_model->find_all();
        foreach($records as $row) {
            $teacher                = $this->teachers_model->find($row->teacher_id);
            if(!empty($teacher))
                $row->teacher_id    = $teacher->firstname.' '.$teacher->lastname;

            $labincharge            = $this->lab_incharge_model->find($row->worker_id);
            if(!empty($labincharge))
                $row->worker_id     = $labincharge->firstname.' '.$labincharge->lastname;

            $subject                = $this->subjects_model->find($row->subject_id);
            if(!empty($subject))
                $row->subject_id    = $subject->name;
        }

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Laboratories');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Laboratories object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Laboratories.Resources.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_laboratories())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('laboratories_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'laboratories');

				Template::set_message(lang('laboratories_create_success'), 'success');
				redirect(SITE_AREA .'/resources/laboratories');
			}
			else
			{
				Template::set_message(lang('laboratories_create_failure') . $this->laboratories_model->error, 'error');
			}
		}
		Assets::add_module_js('laboratories', 'laboratories.js');

        $subjects       = $this->get_subjects();
        $teachers       = $this->get_teachers();
        $labincharge    = $this->get_labincharge();

        Template::set('subjects', $subjects);
        Template::set('teachers', $teachers);
        Template::set('labincharge', $labincharge);
		Template::set('toolbar_title', lang('laboratories_create') . ' Laboratories');
        Template::set_view('resources/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Laboratories data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('laboratories_invalid_id'), 'error');
			redirect(SITE_AREA .'/resources/laboratories');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Laboratories.Resources.Edit');

			if ($this->save_laboratories('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('laboratories_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'laboratories');

				Template::set_message(lang('laboratories_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('laboratories_edit_failure') . $this->laboratories_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Laboratories.Resources.Delete');

			if ($this->laboratories_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('laboratories_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'laboratories');

				Template::set_message(lang('laboratories_delete_success'), 'success');

				redirect(SITE_AREA .'/resources/laboratories');
			}
			else
			{
				Template::set_message(lang('laboratories_delete_failure') . $this->laboratories_model->error, 'error');
			}
		}
        Template::set('teachers', $this->get_teachers());
        Template::set('labincharge', $this->get_labincharge());
        Template::set('subjects', $this->get_subjects());
		Template::set('laboratories', $this->laboratories_model->find($id));
		Template::set('toolbar_title', lang('laboratories_edit') .' Laboratories');
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
	private function save_laboratories($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']           = $this->input->post('laboratories_name');
		$data['teacher_id']     = $this->input->post('laboratories_teacher_id');
		$data['worker_id']      = $this->input->post('laboratories_worker_id');
		$data['subject_id']     = $this->input->post('laboratories_subject_id');
		$data['status']         = $this->input->post('laboratories_status');

		if ($type == 'insert')
		{
			$id = $this->laboratories_model->insert($data);

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
			$return = $this->laboratories_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------

    /**
     * Get list of teachers
     *
     * @return array
     */
    private function get_teachers()
    {
        return $this->teachers_model->find_all();
    }


    /**
     * Get list of lab incharge
     *
     * @return array
     */
    private function get_labincharge()
    {
        return $this->lab_incharge_model->find_all();
    }


    /**
     * Get list of subjects
     *
     * @return array
     */
    private function get_subjects()
    {
        return $this->subjects_model->find_all();
    }

}