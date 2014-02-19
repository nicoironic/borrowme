<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * orders controller
 */
class orders extends Admin_Controller
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

		$this->auth->restrict('Purchase_Order.Orders.View');
		$this->load->model('purchase_order_model', null, true);
		$this->lang->load('purchase_order');
		
		Template::set_block('sub_nav', 'orders/_sub_nav');

		Assets::add_module_js('purchase_order', 'purchase_order.js');
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
					$result = $this->purchase_order_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('purchase_order_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('purchase_order_delete_failure') . $this->purchase_order_model->error, 'error');
				}
			}
		}

		$records = $this->purchase_order_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Purchase Order');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Purchase Order object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Purchase_Order.Orders.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_purchase_order())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('purchase_order_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'purchase_order');

				Template::set_message(lang('purchase_order_create_success'), 'success');
				redirect(SITE_AREA .'/orders/purchase_order');
			}
			else
			{
				Template::set_message(lang('purchase_order_create_failure') . $this->purchase_order_model->error, 'error');
			}
		}
		Assets::add_module_js('purchase_order', 'purchase_order.js');

		Template::set('toolbar_title', lang('purchase_order_create') . ' Purchase Order');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Purchase Order data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('purchase_order_invalid_id'), 'error');
			redirect(SITE_AREA .'/orders/purchase_order');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Purchase_Order.Orders.Edit');

			if ($this->save_purchase_order('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('purchase_order_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'purchase_order');

				Template::set_message(lang('purchase_order_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('purchase_order_edit_failure') . $this->purchase_order_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Purchase_Order.Orders.Delete');

			if ($this->purchase_order_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('purchase_order_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'purchase_order');

				Template::set_message(lang('purchase_order_delete_success'), 'success');

				redirect(SITE_AREA .'/orders/purchase_order');
			}
			else
			{
				Template::set_message(lang('purchase_order_delete_failure') . $this->purchase_order_model->error, 'error');
			}
		}
		Template::set('purchase_order', $this->purchase_order_model->find($id));
		Template::set('toolbar_title', lang('purchase_order_edit') .' Purchase Order');
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
	private function save_purchase_order($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['purchase_order_no']        = $this->input->post('purchase_order_purchase_order_no');
		$data['sales_order_id']        = $this->input->post('purchase_order_sales_order_id');
		$data['supplier']        = $this->input->post('purchase_order_supplier');
		$data['address']        = $this->input->post('purchase_order_address');
		$data['terms']        = $this->input->post('purchase_order_terms');
		$data['contact_person']        = $this->input->post('purchase_order_contact_person');
		$data['ordered_by']        = $this->input->post('purchase_order_ordered_by');
		$data['requested_by']        = $this->input->post('purchase_order_requested_by');
		$data['received_by']        = $this->input->post('purchase_order_received_by');
		$data['status']        = $this->input->post('purchase_order_status');

		if ($type == 'insert')
		{
			$id = $this->purchase_order_model->insert($data);

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
			$return = $this->purchase_order_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}