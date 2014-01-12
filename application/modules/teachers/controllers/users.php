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

		$this->auth->restrict('Teachers.Users.View');
		$this->load->model('teachers_model', null, true);
		$this->lang->load('teachers');
		
		Template::set_block('sub_nav', 'users/_sub_nav');

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

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->teachers_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('teachers_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('teachers_delete_failure') . $this->teachers_model->error, 'error');
				}
			}
		}

		$records = $this->teachers_model->find_all();

        if(!empty($records)) {
            foreach($records as $row) {
                $user = $this->user_model->find($row->user_id);
                $row->email = $user->email;
            }
        }

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Teachers');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Teachers object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Teachers.Users.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_teachers())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('teachers_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'teachers');

				Template::set_message(lang('teachers_create_success'), 'success');
				redirect(SITE_AREA .'/users/teachers');
			}
			else
			{
				Template::set_message(lang('teachers_create_failure') . $this->teachers_model->error, 'error');
			}
		}
		Assets::add_module_js('teachers', 'teachers.js');

		Template::set('toolbar_title', lang('teachers_create') . ' Teachers');
        Template::set_view('users/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Teachers data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('teachers_invalid_id'), 'error');
			redirect(SITE_AREA .'/users/teachers');
		}

        $teachers = $this->teachers_model->find($id);
        $user = $this->user_model->find($teachers->user_id);

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Teachers.Users.Edit');

			if ($this->save_teachers('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('teachers_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'teachers');

				Template::set_message(lang('teachers_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('teachers_edit_failure') . $this->teachers_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Teachers.Users.Delete');

			if ($this->teachers_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('teachers_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'teachers');

				Template::set_message(lang('teachers_delete_success'), 'success');

				redirect(SITE_AREA .'/users/teachers');
			}
			else
			{
				Template::set_message(lang('teachers_delete_failure') . $this->teachers_model->error, 'error');
			}
		}
		Template::set('teachers', $this->teachers_model->find($id));
        Template::set('user', $user);
		Template::set('toolbar_title', lang('teachers_edit') .' Teachers');
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
	private function save_teachers($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['teacher_id'] = $id;
		}

        $this->form_validation->set_rules('teachers_firstname', 'First Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('teachers_lastname', 'Last Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('teachers_address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('teachers_contact_details', 'Contact Details', 'trim|xss_clean');

        if($type == 'insert') {
            $this->form_validation->set_rules('teachers_email', 'lang:bf_email', 'required|trim|valid_email|max_length[120]|unique[users.email]');
            $this->form_validation->set_rules('teachers_username', 'lang:bf_username', 'required|trim|max_length[30]|unique[users.username]');
        }

        $pass = $this->input->post('teachers_password');
        if($pass != '') {
            $this->form_validation->set_rules('teachers_password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('teachers_confirm_password', 'lang:bf_password_confirm', 'required|matches[teachers_password]');
        }


        if ($this->form_validation->run() !== FALSE) {

            if ($type == 'insert') {
                $data = array();
                $data['firstname']              = $this->input->post('teachers_firstname');
                $data['lastname']               = $this->input->post('teachers_lastname');
                $data['address']                = $this->input->post('teachers_address');
                $data['contact_details']        = $this->input->post('teachers_contact_details');

                $id = $this->teachers_model->insert($data);
                $id = $this->db->insert_id();

                if (is_numeric($id)) {
                    $return = $id;
                }
                else {
                    $return = FALSE;
                }

                $data = array();
                $data['email']                  = $this->input->post('teachers_email');
                $data['username']               = $this->input->post('teachers_username');
                $data['password']               = $this->input->post('teachers_password');
                $data['display_name']           = $this->input->post('teachers_username');
                $data['active']                 = 1;
                $data['role_desc']              = 'teacher';

                if ($user_id = $this->user_model->insert($data)) {
                    $data               = array();
                    $data['user_id']    = $user_id;
                    $this->db->update('bf_teachers',$data,array('teacher_id' => $id));
                    return $id;
                }
                else {
                    Template::set_message(lang('us_registration_fail'), 'error');
                    return false;
                }
            }
            elseif ($type == 'update') {
                $data = array();
                $data['firstname']              = $this->input->post('teachers_firstname');
                $data['lastname']               = $this->input->post('teachers_lastname');
                $data['address']                = $this->input->post('teachers_address');
                $data['contact_details']        = $this->input->post('teachers_contact_details');

                $return                         = $this->teachers_model->update($id, $data);

                return $return;
            }
        }//end if
	}

	//--------------------------------------------------------------------


}