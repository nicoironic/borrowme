<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * purchase_order controller
 */
class purchase_order extends Front_Controller
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
        $this->lang->load('purchase_order');
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

        $this->load->model('purchase_order/purchase_order_model', null, true);
        $this->load->model('sales_order/sales_order_model', null, true);

        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/purchase-order.css')));
        Assets::add_js(Template::theme_url('js/purchase-order.js'), 'external', true);

        Template::set('rows',$rows = $this->purchase_order_model->find_all());
        Template::set_view('purchase_order/purchase-order');
        Template::render();
    }

    public function purchase_order_record() {
        $this->set_current_user();
        $user = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc != '')
            redirect('/');

        $this->load->model('purchase_order/purchase_order_model', null, true);
        $this->load->model('sales_order/sales_order_model', null, true);

        if(isset($_POST['delete'])) {
            $this->db->where('id', $this->input->post('purchase_order_id'));
            $this->db->delete('bf_purchase_order');

            $this->db->where('purchase_order_id', $this->input->post('purchase_order_id'));
            $this->db->delete('bf_purchase_order_details');

            redirect('/purchase-order');
        }

        $id = $this->uri->segment(2);

        $record                     = $this->purchase_order_model->find($id);

        if(empty($record))
            $record                 = new stdClass();

        $record->id                 = isset($record->id) ? $record->id : 0;
        $record->purchase_order_no  = isset($record->purchase_order_no) ? $record->purchase_order_no : '';
        $record->sales_order_id     = isset($record->sales_order_id) ? $record->sales_order_id : 0;
        $record->supplier           = isset($record->supplier) ? $record->supplier : '';
        $record->address            = isset($record->address) ? $record->address : '';
        $record->terms              = isset($record->terms) ? $record->terms : '';
        $record->contact_person     = isset($record->contact_person) ? $record->contact_person : '';
        $record->ordered_by         = isset($record->ordered_by) ? $record->ordered_by : '';
        $record->requested_by       = isset($record->requested_by) ? $record->requested_by : '';
        $record->received_by        = isset($record->received_by) ? $record->received_by : '';
        $record->status             = isset($record->status) ? $record->status : '';

        Template::set('record',$record);

        $details = $this->db->get_where('bf_purchase_order_details', array('purchase_order_id' => $id));
        Template::set('details',$details);

        if(isset($_POST['submit'])) {
            $data = array(
                'purchase_order_no' => $this->input->post('purchase_order_purchase_order_no'),
                'sales_order_id'    => $this->input->post('purchase_order_sales_order_id'),
                'supplier'          => $this->input->post('purchase_order_supplier'),
                'address'           => $this->input->post('purchase_order_address'),
                'terms'             => $this->input->post('purchase_order_terms'),
                'contact_person'    => $this->input->post('purchase_order_contact_person'),
                'ordered_by'        => $this->input->post('purchase_order_ordered_by'),
                'requested_by'      => $this->input->post('purchase_order_requested_by'),
                'received_by'       => $this->input->post('purchase_order_received_by'),
                'status'            => $this->input->post('purchase_order_status'),
                'created_on'        => date('Y-m-d H:i:s'),
                'modified_on'       => date('Y-m-d H:i:s')
            );

            $this->db->insert('bf_purchase_order', $data);
            $newid = $this->db->insert_id();

            $results = $this->db->get_where('bf_sales_order_details', array('sales_order_id' => $this->input->post('purchase_order_sales_order_id')));
            if ($results->num_rows() > 0) {
                foreach ($results->result() as $row) {
                    $data = array(
                        'purchase_order_id'     => $newid,
                        'item_id'               => $row->item_id,
                        'quantity'              => $row->quantity,
                        'unit_cost'             => $row->unit_cost,
                        'total'                 => $row->total
                    );
                    $this->db->insert('bf_purchase_order_details', $data);
                }
            }

            redirect('/purchase-order-record/'.$newid);
        }

        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/purchase-order.css')));
        Assets::add_js(Template::theme_url('js/purchase-order.js'), 'external', true);

        Template::set('items',$items = $this->items_model->find_all());
        Template::set('sales_order',$lab = $this->sales_order_model->find_all());
        Template::set_view('purchase_order/purchase-order-record');
        Template::render();
    }

    public function purchase_order_details() {
        $this->load->model('purchase_order/purchase_order_model', null, true);

        $po    = $this->purchase_order_model->find($this->input->post('id'));

        $items = $this->input->post('items');
        $data = array(
            'purchase_order_no' => $this->input->post('purchase_order_purchase_order_no'),
            'sales_order_id'    => $this->input->post('purchase_order_sales_order_id'),
            'supplier'          => $this->input->post('purchase_order_supplier'),
            'address'           => $this->input->post('purchase_order_address'),
            'terms'             => $this->input->post('purchase_order_terms'),
            'contact_person'    => $this->input->post('purchase_order_contact_person'),
            'ordered_by'        => $this->input->post('purchase_order_ordered_by'),
            'requested_by'      => $this->input->post('purchase_order_requested_by'),
            'received_by'       => $this->input->post('purchase_order_received_by'),
            'status'            => $this->input->post('purchase_order_status'),
            'modified_on'       => date('Y-m-d H:i:s')
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('bf_purchase_order', $data);

        $this->db->where('purchase_order_id', $this->input->post('id'));
        $this->db->delete('bf_purchase_order_details');

        if(!empty($items)) {
            for($x=0; $x<count($items); $x++) {
                $data = array(
                    'purchase_order_id' => $this->input->post('id'),
                    'item_id'           => $items[$x]['item_id'],
                    'quantity'          => $items[$x]['quantity'],
                    'unit_cost'         => $items[$x]['unit_cost'],
                    'total'             => $items[$x]['total']
                );
                $this->db->insert('bf_purchase_order_details', $data);

                if($po->status == 'pending' && $this->input->post('purchase_order_status') == 'approved') {
                    $item = $this->items_model->find($items[$x]['item_id']);
                    $data = array('quantity' => $item->quantity + $items[$x]['quantity']);
                    $this->db->where('id', $items[$x]['item_id']);
                    $this->db->update('bf_items', $data);
                }
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