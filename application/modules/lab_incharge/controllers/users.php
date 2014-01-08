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

		$this->auth->restrict('Lab_Incharge.Users.View');
		$this->load->model('lab_incharge_model', null, true);
		$this->lang->load('lab_incharge');
		
		Template::set_block('sub_nav', 'users/_sub_nav');

		Assets::add_module_js('lab_incharge', 'lab_incharge.js');
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
					$result = $this->lab_incharge_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('lab_incharge_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('lab_incharge_delete_failure') . $this->lab_incharge_model->error, 'error');
				}
			}
		}

		$records = $this->lab_incharge_model->find_all();

        foreach($records as $row) {
            $user = $this->user_model->find($row->user_id);
            $row->email = $user->email;
        }

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Lab Incharge');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Lab Incharge object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Lab_Incharge.Users.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_lab_incharge())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('lab_incharge_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'lab_incharge');

				Template::set_message(lang('lab_incharge_create_success'), 'success');
				redirect(SITE_AREA .'/users/lab_incharge');
			}
			else
			{
				Template::set_message(lang('lab_incharge_create_failure') . $this->lab_incharge_model->error, 'error');
			}
		}
		Assets::add_module_js('lab_incharge', 'lab_incharge.js');

		Template::set('toolbar_title', lang('lab_incharge_create') . ' Lab Incharge');
        Template::set_view('users/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Lab Incharge data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('lab_incharge_invalid_id'), 'error');
			redirect(SITE_AREA .'/users/lab_incharge');
		}

        $labincharge = $this->lab_incharge_model->find($id);
        $user = $this->user_model->find($labincharge->user_id);

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Lab_Incharge.Users.Edit');

			if ($this->save_lab_incharge('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('lab_incharge_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'lab_incharge');

				Template::set_message(lang('lab_incharge_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('lab_incharge_edit_failure') . $this->lab_incharge_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Lab_Incharge.Users.Delete');

			if ($this->lab_incharge_model->delete($id))
			{

                $this->user_model->delete($labincharge->user_id);
				// Log the activity
				log_activity($this->current_user->id, lang('lab_incharge_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'lab_incharge');

				Template::set_message(lang('lab_incharge_delete_success'), 'success');

				redirect(SITE_AREA .'/users/lab_incharge');
			}
			else
			{
				Template::set_message(lang('lab_incharge_delete_failure') . $this->lab_incharge_model->error, 'error');
			}
		}

        Template::set('lab_incharge', $labincharge);
        Template::set('user', $user);
		Template::set('toolbar_title', lang('lab_incharge_edit') .' Lab Incharge');
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
	private function save_lab_incharge($type='insert', $id=0)
	{
		if ($type == 'update') {
			$_POST['worker_id'] = $id;
		}

        $this->form_validation->set_rules('lab_incharge_firstname', 'First Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('lab_incharge_lastname', 'Last Name', 'required|trim|max_length[255]');
        $this->form_validation->set_rules('lab_incharge_address', 'Address', 'trim|xss_clean');
        $this->form_validation->set_rules('lab_incharge_contact_details', 'Contact Details', 'trim|xss_clean');

        if($type == 'insert') {
            $this->form_validation->set_rules('lab_incharge_email', 'lang:bf_email', 'required|trim|valid_email|max_length[120]|unique[users.email]');
            $this->form_validation->set_rules('lab_incharge_username', 'lang:bf_username', 'required|trim|max_length[30]|unique[users.username]');
        }

        $pass = $this->input->post('lab_incharge_password');
        if($pass != '') {
            $this->form_validation->set_rules('lab_incharge_password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('lab_incharge_confirm_password', 'lang:bf_password_confirm', 'required|matches[lab_incharge_password]');
        }


        if ($this->form_validation->run() !== FALSE) {

            if ($type == 'insert') {
                $data = array();
                $data['firstname']              = $this->input->post('lab_incharge_firstname');
                $data['lastname']               = $this->input->post('lab_incharge_lastname');
                $data['address']                = $this->input->post('lab_incharge_address');
                $data['contact_details']        = $this->input->post('lab_incharge_contact_details');

                $id = $this->lab_incharge_model->insert($data);
                $id = $this->db->insert_id();

                if (is_numeric($id)) {
                    $return = $id;
                }
                else {
                    $return = FALSE;
                }

                $data = array();
                $data['email']                  = $this->input->post('lab_incharge_email');
                $data['username']               = $this->input->post('lab_incharge_username');
                $data['password']               = $this->input->post('lab_incharge_password');
                $data['display_name']           = $this->input->post('lab_incharge_username');
                $data['active']                 = 1;
                $data['role_desc']              = 'lab_incharge';

                if ($user_id = $this->user_model->insert($data)) {
                    $data               = array();
                    $data['user_id']    = $user_id;
                    $this->db->update('bf_lab_incharge',$data,array('worker_id' => $id));
                    return $id;
                }
                else {
                    Template::set_message(lang('us_registration_fail'), 'error');
                    return false;
                }
            }
            elseif ($type == 'update') {
                $data = array();
                $data['firstname']              = $this->input->post('lab_incharge_firstname');
                $data['lastname']               = $this->input->post('lab_incharge_lastname');
                $data['address']                = $this->input->post('lab_incharge_address');
                $data['contact_details']        = $this->input->post('lab_incharge_contact_details');

                $return                         = $this->lab_incharge_model->update($id, $data);

//                $data = array();
//                $data['email']                  = $this->input->post('lab_incharge_email');
//                $data['username']               = $this->input->post('lab_incharge_username');
//                $pass                           = $this->input->post('lab_incharge_password');
//                if($pass != '')
//                    $data['password']           = $pass;
//                $data['display_name']           = $this->input->post('lab_incharge_username');
//
//                $details                        = $this->lab_incharge_model->find($id);
//                $user                           = $this->user_model->update($details['user_id'], $data);

                return $return;
            }
        }//end if
	}

	//--------------------------------------------------------------------


}