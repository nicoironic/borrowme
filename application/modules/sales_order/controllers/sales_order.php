<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * sales_order controller
 */
class sales_order extends Front_Controller
{

    protected $current_user = null;

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();


        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('application');
        $this->load->library('Template');
        $this->load->library('Assets');
        $this->load->library('users/auth');
        $this->load->library('events');
        $this->lang->load('application');
        $this->lang->load('sales_order');
        $this->load->model('items/items_model', null, true);
        $this->load->model('returned_items/returned_items_model', null, true);
        $this->load->model('notifications/notifications_model', null, true);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        Assets::add_css(array(Template::theme_url('css/jqueryui.bootstrap.css')));
        Assets::add_css(array(Template::theme_url('css/always.css')));
        Assets::add_css(array(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.css')));
        Assets::add_js('codeigniter-csrf.js');
        Assets::add_js(Template::theme_url('js/jquery-ui-1.8.13.min.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/always.js'), 'external', true);
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
    public function index() {
        $this->set_current_user();
        $user = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc != '')
            redirect('/');

        $this->load->model('sales_order/sales_order_model', null, true);

        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/sales-order.css')));
        Assets::add_js(Template::theme_url('js/sales-order.js'), 'external', true);

        Template::set('rows',$rows = $this->sales_order_model->find_all());
        Template::set_view('sales_order/sales-order');
        Template::render();
    }

    public function sales_order_record() {
        $this->set_current_user();
        $user = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc != '')
            redirect('/');

        $this->load->model('sales_order/sales_order_model', null, true);

        if(isset($_POST['delete'])) {
            $this->db->where('id', $this->input->post('sales_order_id'));
            $this->db->delete('bf_sales_order');

            $this->db->where('sales_order_id', $this->input->post('sales_order_id'));
            $this->db->delete('bf_sales_order_details');

            redirect('/sales-order');
        }

        $id = $this->uri->segment(2);

        $record                     = $this->sales_order_model->find($id);

        if(empty($record))
            $record                 = new stdClass();

        $record->id                 = isset($record->id) ? $record->id : 0;
        $record->supplier           = isset($record->supplier) ? $record->supplier : '';
        $record->date_received      = isset($record->date_received) ? $record->date_received : '';
        $record->invoice_no         = isset($record->invoice_no) ? $record->invoice_no : '';
        $record->date_invoice       = isset($record->date_invoice) ? $record->date_invoice : '';
        $record->receiving_dept     = isset($record->receiving_dept) ? $record->receiving_dept : '';
        $record->received_by        = isset($record->received_by) ? $record->received_by : 0;
        $record->noted_by           = isset($record->noted_by) ? $record->noted_by : '';
        $record->ris_no             = isset($record->ris_no) ? $record->ris_no : '';
        $record->po_no              = isset($record->po_no) ? $record->po_no : '';
        $record->jor_no             = isset($record->jor_no) ? $record->jor_no : '';

        Template::set('record',$record);

        $details = $this->db->get_where('bf_sales_order_details', array('sales_order_id' => $id));
        Template::set('details',$details);

        if(isset($_POST['submit'])) {
            $data = array(
                'invoice_no'            => $this->input->post('sales_order_invoice_no'),
                'supplier'              => $this->input->post('sales_order_supplier'),
                'ris_no'                => $this->input->post('sales_order_ris_no'),
                'po_no'                 => $this->input->post('sales_order_po_no'),
                'jor_no'                => $this->input->post('sales_order_jor_no'),
                'date_received'         => $this->input->post('sales_order_date_received'),
                'date_invoice'          => $this->input->post('sales_order_date_invoice'),
                'receiving_dept'        => $this->input->post('sales_order_receiving_dept'),
                'received_by'           => $this->input->post('sales_order_received_by'),
                'noted_by'              => $this->input->post('sales_order_noted_by'),
                'created_on'            => date('Y-m-d H:i:s'),
                'modified_on'           => date('Y-m-d H:i:s')
            );

            $this->db->insert('bf_sales_order', $data);
            $newid = $this->db->insert_id();

            redirect('/sales-order-record/'.$newid);
        }

        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/sales-order.css')));
        Assets::add_js(Template::theme_url('js/jquery-ui-1.10.4.auto-complete.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/sales-order.js'), 'external', true);

        Template::set('items',$items = $this->items_model->find_all());
        Template::set('labincharge',$lab = $this->lab_incharge_model->find_all());
        Template::set_view('sales_order/sales-order-record');
        Template::render();
    }

    public function sales_order_details() {
        $items = $this->input->post('items');

        $data = array(
            'invoice_no'            => $this->input->post('sales_order_invoice_no'),
            'supplier'              => $this->input->post('sales_order_supplier'),
            'ris_no'                => $this->input->post('sales_order_ris_no'),
            'po_no'                 => $this->input->post('sales_order_po_no'),
            'jor_no'                => $this->input->post('sales_order_jor_no'),
            'date_received'         => $this->input->post('sales_order_date_received'),
            'date_invoice'          => $this->input->post('sales_order_date_invoice'),
            'receiving_dept'        => $this->input->post('sales_order_receiving_dept'),
            'received_by'           => $this->input->post('sales_order_received_by'),
            'noted_by'              => $this->input->post('sales_order_noted_by'),
            'modified_on'           => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('bf_sales_order', $data);

        $this->db->where('sales_order_id', $this->input->post('id'));
        $this->db->delete('bf_sales_order_details');

        if(!empty($items)) {
            for($x=0; $x<count($items); $x++) {
                $data = array(
                    'sales_order_id'    => $this->input->post('id'),
                    'item_id'           => $items[$x]['item_id'],
                    'quantity'          => $items[$x]['quantity'],
                    'unit_cost'         => $items[$x]['unit_cost'],
                    'total'             => $items[$x]['total']
                );
                $this->db->insert('bf_sales_order_details', $data);
            }
        }

        die('success');
    }

	//--------------------------------------------------------------------

    /**
     * If the Auth lib is loaded, it will set the current user, since users
     * will never be needed if the Auth library is not loaded. By not requiring
     * this to be executed and loaded for every command, we can speed up calls
     * that don't need users at all, or rely on a different type of auth, like
     * an API or cronjob.
     *
     * Copied from Base_Controller
     */
    protected function set_current_user()
    {
        if (class_exists('Auth'))
        {
            // Load our current logged in user for convenience
            if ($this->auth->is_logged_in())
            {
                $this->current_user = clone $this->auth->user();

                $this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

                // if the user has a language setting then use it
                if (isset($this->current_user->language))
                {
                    $this->config->set_item('language', $this->current_user->language);
                }
            }
            else
            {
                $this->current_user = null;
            }

            // Make the current user available in the views
            if (!class_exists('Template'))
            {
                $this->load->library('Template');
            }

            Template::set('current_user', $this->current_user);
        }
    }

}