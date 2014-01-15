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

		$this->auth->restrict('Returned_Items.Logs.View');
		$this->load->model('returned_items_model', null, true);
        $this->load->model('items/items_model', null, true);
        $this->load->model('students/students_model', null, true);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
		$this->lang->load('returned_items');
		
		Template::set_block('sub_nav', 'logs/_sub_nav');

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

        if (isset($_POST['the-status'])) {
            switch($_POST['the-status']) {
                case 'lacking':
                    $items = $this->returned_items_model->find_all_by('status','lacking');
                    break;
                case 'for approval':
                    $items = $this->returned_items_model->find_all_by('status','for approval');
                    break;
                case 'returned':
                    $items = $this->returned_items_model->find_all_by('status','returned');
                    break;
                case 'all':
                    $items = $this->returned_items_model->find_all();
                    break;
            }
        }
        else {
            $items = $this->returned_items_model->find_all();
        }

        if(!empty($items)) {
            foreach($items as $row) {
                $item                   = $this->items_model->find($row->item_id);
                if(!empty($item))
                    $row->item_id       = $item->name;

                $labincharge            = $this->lab_incharge_model->find($row->worker_id);
                if(!empty($labincharge))
                    $row->worker_id     = $labincharge->firstname.' '.$labincharge->lastname;

                $student                = $this->students_model->find($row->student_id);
                if(!empty($student))
                    $row->student_id    = $student->firstname.' '.$student->lastname;
            }
        }

        Template::set('status',$_POST['the-status']);
		Template::set('records', $items);
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
		$this->auth->restrict('Returned_Items.Logs.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_returned_items())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('returned_items_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'returned_items');

				Template::set_message(lang('returned_items_create_success'), 'success');
				redirect(SITE_AREA .'/logs/returned_items');
			}
			else
			{
				Template::set_message(lang('returned_items_create_failure') . $this->returned_items_model->error, 'error');
			}
		}
		Assets::add_module_js('returned_items', 'returned_items.js');

        Template::set('items', $this->get_items());
        Template::set('students', $this->get_students());
        Template::set('labincharge', $this->get_labincharge());
		Template::set('toolbar_title', lang('returned_items_create') . ' Returned Items');
        Template::set_view('logs/edit');
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
			redirect(SITE_AREA .'/logs/returned_items');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Returned_Items.Logs.Edit');

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
			$this->auth->restrict('Returned_Items.Logs.Delete');

			if ($this->returned_items_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('returned_items_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'returned_items');

				Template::set_message(lang('returned_items_delete_success'), 'success');

				redirect(SITE_AREA .'/logs/returned_items');
			}
			else
			{
				Template::set_message(lang('returned_items_delete_failure') . $this->returned_items_model->error, 'error');
			}
		}

        Template::set('items', $this->get_items());
        Template::set('students', $this->get_students());
        Template::set('labincharge', $this->get_labincharge());
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
		$data['worker_id']      = $this->input->post('returned_items_worker_id');
		$data['student_id']     = $this->input->post('returned_items_student_id');
		$data['item_id']        = $this->input->post('returned_items_item_id');
		$data['quantity']       = $this->input->post('returned_items_quantity');

        $status = $this->input->post('returned_items_status');
        if($status != '')
            $data['status']         = $this->input->post('returned_items_status');

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
            if(isset($data['status']) && $data['status'] == 'returned') {
                $item_qty   = 0;
                $retu_qty   = 0;
                $total   = 0;
                $item       = $this->items_model->find($data['item_id']);
                $return     = $this->returned_items_model->find($id);

                $item_qty   = $item->quantity;
                $retu_qty   = $return->return_qty;
                $total      = $item_qty + $retu_qty;

                $array      = array('quantity' => $total);
                $this->db->where('id', $data['item_id']);
                $this->db->update('bf_items', $array);
            }

			$return = $this->returned_items_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------

    /**
     * Get list of lab incharge
     *
     * @return array
     */
    private function get_items()
    {
        return $this->items_model->find_all();
    }

    /**
     * Get list of lab incharge
     *
     * @return array
     */
    private function get_students()
    {
        return $this->students_model->find_all();
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
}