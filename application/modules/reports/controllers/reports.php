<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * notifications controller
 */
class reports extends Front_Controller
{

	//--------------------------------------------------------------------

    protected $current_user = null;

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
        $this->lang->load('reports');

        $this->load->model('reports_model', null, true);
        $this->load->model('items/items_model', null, true);
        $this->load->model('returned_items/returned_items_model', null, true);
        $this->load->model('notifications/notifications_model', null, true);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        Assets::add_css(array(Template::theme_url('css/jqueryui.bootstrap.css')));
        Assets::add_css(array(Template::theme_url('css/always.css')));
        Assets::add_css(array(Template::theme_url('css/reports.css')));
        Assets::add_css(array(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.css')));
        Assets::add_js('codeigniter-csrf.js');
        Assets::add_js(Template::theme_url('js/jquery-ui-1.8.13.min.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/always.js'), 'external', true);
		

		Assets::add_module_js('notifications', 'notifications.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
    public function index() {
        $rows = '';
        $this->set_current_user();
        $user = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc == 'student')
            redirect('/');

        Assets::add_js(Template::theme_url('js/reports.js'), 'external', true);
        Template::set_view('reports/reports');
        Template::render();
    }

    public function report_list() {
        $body       = '';
        $where      = '';

        $start      = $this->input->post('start_date');
        $end        = $this->input->post('end_date');
        $search     = $this->input->post('search');
        $category   = $this->input->post('category');

        if($start != '') {
            $where .= " AND r.created_on >= '".$start."'";
            if($end != '')
                $where .= " AND r.created_on <= '".$end."'";
        }
        else if($end != '') {
            $where .= " AND r.created_on <= '".$end."'";
        }

        if($search != '') {
            $where .= " AND i.name like '%".$search."%'";
        }

        if($category != '') {
            $where .= " AND category = '".$category."'";
        }

        $rows = $this->db->query("SELECT i.`name` AS 'name',
                                i.`quantity` AS 'quantity',
                                SUM(r.`quantity`) AS 'borrowed_quantity',
                                SUM(r.`return_qty`) AS 'returned_quantity',
                                SUM(r.`quantity`) * 10 AS 'total_quantity',
                                SUM(r.`return_qty`) * i.price AS 'total_cost',
                                unit_of_measure
                                FROM bf_returned_items r
                                INNER JOIN bf_items i ON i.id = r.`item_id`
                                WHERE 1=1
                                ".$where."
                                GROUP BY r.`item_id`
                                ORDER BY borrowed_quantity DESC");

        if($category == '') {
            $body .= '<table class="table table-bordered" id="reports-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Borrowed Quantity</th>
                                <th>Returned Quantity</th>
                                <th>Overall Weight Purchased</th>
                                <th>Overall Cost</th>
                            </tr>
                        </thead>';
        }
        else if($category == 'apparatus') {
            $body .= '<table class="table table-bordered" id="reports-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Borrowed Quantity</th>
                                <th>Returned Quantity</th>
                            </tr>
                        </thead>';
        }
        else if($category == 'chemical') {
            $body .= '<table class="table table-bordered" id="reports-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Overall Weight Purchased</th>
                                <th>Overall Cost</th>
                            </tr>
                        </thead>';
        }

        if(!empty($rows)):
            $body .= '<tbody id="dynamic-tbody">';
            foreach($rows->result() as $row) {
                if($category == '') {
                    $body .= '<tr>
                                <td>'.$row->name.'</td>
                                <td class="align-right">'.$row->quantity.'</td>
                                <td class="align-right">'.$row->borrowed_quantity.'</td>
                                <td class="align-right">'.$row->returned_quantity.'</td>
                                <td class="align-right">'.$row->total_quantity.$row->unit_of_measure.'</td>
                                <td class="align-right">'.$row->total_cost.'</td>
                            </tr>';
                }
                else if($category == 'apparatus') {
                    $body .= '<tr>
                                <td>'.$row->name.'</td>
                                <td class="align-right">'.$row->quantity.'</td>
                                <td class="align-right">'.$row->borrowed_quantity.'</td>
                                <td class="align-right">'.$row->returned_quantity.'</td>
                            </tr>';
                }
                else if($category == 'chemical') {
                    $body .= '<tr>
                                <td>'.$row->name.'</td>
                                <td class="align-right">'.$row->total_quantity.$row->unit_of_measure.'</td>
                                <td class="align-right">'.$row->total_cost.'</td>
                            </tr>';
                }
            }
            $body .= '</tbody>';
        endif;
        $body .= '</table>';

        die($body);
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