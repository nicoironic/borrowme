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

		$this->auth->restrict('Sales_Order.Orders.View');
		$this->load->model('sales_order_model', null, true);
		$this->lang->load('sales_order');
		
			Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
			Assets::add_js('jquery-ui-1.8.13.min.js');
		Template::set_block('sub_nav', 'orders/_sub_nav');

		Assets::add_module_js('sales_order', 'sales_order.js');
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
					$result = $this->sales_order_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('sales_order_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('sales_order_delete_failure') . $this->sales_order_model->error, 'error');
				}
			}
		}

		$records = $this->sales_order_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Sales Order');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Sales Order object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Sales_Order.Orders.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_sales_order())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sales_order_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'sales_order');

				Template::set_message(lang('sales_order_create_success'), 'success');
				redirect(SITE_AREA .'/orders/sales_order');
			}
			else
			{
				Template::set_message(lang('sales_order_create_failure') . $this->sales_order_model->error, 'error');
			}
		}
		Assets::add_module_js('sales_order', 'sales_order.js');

		Template::set('toolbar_title', lang('sales_order_create') . ' Sales Order');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Sales Order data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('sales_order_invalid_id'), 'error');
			redirect(SITE_AREA .'/orders/sales_order');
		}

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Sales_Order.Orders.Edit');

			if ($this->save_sales_order('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sales_order_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'sales_order');

				Template::set_message(lang('sales_order_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('sales_order_edit_failure') . $this->sales_order_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Sales_Order.Orders.Delete');

			if ($this->sales_order_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('sales_order_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'sales_order');

				Template::set_message(lang('sales_order_delete_success'), 'success');

				redirect(SITE_AREA .'/orders/sales_order');
			}
			else
			{
				Template::set_message(lang('sales_order_delete_failure') . $this->sales_order_model->error, 'error');
			}
		}
		Template::set('sales_order', $this->sales_order_model->find($id));
		Template::set('toolbar_title', lang('sales_order_edit') .' Sales Order');
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
	private function save_sales_order($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['invoice_no']        = $this->input->post('sales_order_invoice_no');
		$data['supplier']        = $this->input->post('sales_order_supplier');
		$data['ris_no']        = $this->input->post('sales_order_ris_no');
		$data['po_no']        = $this->input->post('sales_order_po_no');
		$data['jor_no']        = $this->input->post('sales_order_jor_no');
		$data['date_received']        = $this->input->post('sales_order_date_received') ? $this->input->post('sales_order_date_received') : '0000-00-00';
		$data['date_invoice']        = $this->input->post('sales_order_date_invoice') ? $this->input->post('sales_order_date_invoice') : '0000-00-00';
		$data['receiving_dept']        = $this->input->post('sales_order_receiving_dept');
		$data['received_by']        = $this->input->post('sales_order_received_by');
		$data['noted_by']        = $this->input->post('sales_order_noted_by');

		if ($type == 'insert')
		{
			$id = $this->sales_order_model->insert($data);

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
			$return = $this->sales_order_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}