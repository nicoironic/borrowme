<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * users controller
 */
class users extends Admin_Controller
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

		$this->auth->restrict('Students.Users.View');
		$this->load->model('students_model', null, true);
		$this->lang->load('students');
		
		Template::set_block('sub_nav', 'users/_sub_nav');

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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->students_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('students_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('students_delete_failure') . $this->students_model->error, 'error');
				}
			}
		}

		$records = $this->students_model->find_all();

        foreach($records as $row) {
            $user = $this->user_model->find($row->user_id);
            $row->email = $user->email;
        }

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Students');
        Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Students object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Students.Users.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_students())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('students_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'students');

				Template::set_message(lang('students_create_success'), 'success');
				redirect(SITE_AREA .'/users/students');
			}
			else
			{
				Template::set_message(lang('students_create_failure') . $this->students_model->error, 'error');
			}
		}
		Assets::add_module_js('students', 'students.js');

		Template::set('toolbar_title', lang('students_create') . ' Students');
        Template::set_view('users/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Students data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('students_invalid_id'), 'error');
			redirect(SITE_AREA .'/users/students');
		}

        $students = $this->students_model->find($id);
        $user = $this->user_model->find($students->user_id);

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Students.Users.Edit');

			if ($this->save_students('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('students_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'students');

				Template::set_message(lang('students_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('students_edit_failure') . $this->students_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Students.Users.Delete');

			if ($this->students_model->delete($id))
			{
                $this->user_model->delete($students->user_id);
				// Log the activity
				log_activity($this->current_user->id, lang('students_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'students');

				Template::set_message(lang('students_delete_success'), 'success');

				redirect(SITE_AREA .'/users/students');
			}
			else
			{
				Template::set_message(lang('students_delete_failure') . $this->students_model->error, 'error');
			}
		}
		Template::set('students', $this->students_model->find($id));
        Template::set('user', $user);
		Template::set('toolbar_title', lang('students_edit') .' Students');
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
	private function save_students($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['student_id'] = $id;
		}

        $this->form_validation->set_rules('students_firstname', 'First Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('students_lastname', 'Last Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('students_address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('students_contact_details', 'Contact Details', 'trim|xss_clean');

        if($type == 'insert') {
            $this->form_validation->set_rules('students_email', 'lang:bf_email', 'required|trim|valid_email|max_length[120]|unique[users.email]');
            $this->form_validation->set_rules('students_username', 'lang:bf_username', 'required|trim|max_length[30]|unique[users.username]');
        }

        $pass = $this->input->post('students_password');
        if($pass != '') {
            $this->form_validation->set_rules('students_password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('students_confirm_password', 'lang:bf_password_confirm', 'required|matches[students_password]');
        }


        if ($this->form_validation->run() !== FALSE) {

            if ($type == 'insert') {
                $data = array();
                $data['firstname']              = $this->input->post('students_firstname');
                $data['lastname']               = $this->input->post('students_lastname');
                $data['address']                = $this->input->post('students_address');
                $data['contact_details']        = $this->input->post('students_contact_details');

                $id = $this->students_model->insert($data);
                $id = $this->db->insert_id();

                if (is_numeric($id)) {
                    $return = $id;
                }
                else {
                    $return = FALSE;
                }

                $data = array();
                $data['email']                  = $this->input->post('students_email');
                $data['username']               = $this->input->post('students_username');
                $data['password']               = $this->input->post('students_password');
                $data['display_name']           = $this->input->post('students_username');
                $data['active']                 = 1;
                $data['role_desc']              = 'student';

                if ($user_id = $this->user_model->insert($data)) {
                    $data               = array();
                    $data['user_id']    = $user_id;
                    $this->db->update('bf_students',$data,array('student_id' => $id));
                    return $id;
                }
                else {
                    Template::set_message(lang('us_registration_fail'), 'error');
                    return false;
                }
            }
            elseif ($type == 'update') {
                $data = array();
                $data['firstname']              = $this->input->post('students_firstname');
                $data['lastname']               = $this->input->post('students_lastname');
                $data['address']                = $this->input->post('students_address');
                $data['contact_details']        = $this->input->post('students_contact_details');

                $return                         = $this->students_model->update($id, $data);

                return $return;
            }
        }//end if
	}

	//--------------------------------------------------------------------


}