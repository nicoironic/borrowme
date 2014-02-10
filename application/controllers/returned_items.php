<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Bonfire
 *
 * An open source project to allow developers get a jumpstart their development of CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2013, Bonfire Dev Team
 * @license   http://guides.cibonfire.com/license.html
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Home controller
 *
 * The base controller which displays the homepage of the Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Returned_items extends CI_Controller
{
    protected $current_user = null;

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
        //$this->lang->load('items/items_lang');
        $this->load->model('items/items_model', null, true);
        $this->load->model('returned_items/returned_items_model', null, true);
        $this->load->model('notifications/notifications_model', null, true);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        Assets::add_css(array(Template::theme_url('css/jqueryui.bootstrap.css')));
        Assets::add_css(array(Template::theme_url('css/always.css')));
        Assets::add_js('codeigniter-csrf.js');
        Assets::add_js(Template::theme_url('js/jquery-ui-1.8.13.min.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/always.js'), 'external', true);
	}

	//--------------------------------------------------------------------

    public function index() {
        Assets::add_css(array(Template::theme_url('css/return-item.css')));
        Assets::add_js(Template::theme_url('js/return-item.js'), 'external', true);

        $this->set_current_user();
        Template::set_view('home/return-item');
        Template::render();
    }

    public function return_item_ajax() {
        $itemid     = $this->input->post('id');
        $quantity   = $this->input->post('qty');
        $status     = 'lacking';

        $item       = $this->returned_items_model->find($itemid);
        if($item->return_qty > 0 && $item->return_qty != '') {
            $quantity = $quantity + $item->return_qty;
            if($quantity >= $item->quantity) {
                $quantity   = $item->quantity;
                $status     = 'for approval';
            }
        }
        else {
            if($quantity >= $item->quantity) {
                $quantity   = $item->quantity;
                $status     = 'for approval';
            }
        }

        $data = array(
            'return_qty'    => $quantity,
            'status'        => $status
        );
        $this->db->where('id', $itemid);
        $this->db->update('bf_returned_items', $data);

        $data = array(
            'user_id'       => $this->current_user->id,
            'role_user'     => 'admin',
            'description'   => 'A User returned an item',
            'page'          => site_url().'admin/logs/returned_items/edit/'.$this->db->insert_id(),
            'seen'          => 'No',
            'created_on'    => date('Y-m-d H:i:s'),
            'modified_on'   => date('Y-m-d H:i:s')
        );
        $this->db->insert('bf_notifications', $data);

        $result = array(
            'quantity'  => $quantity,
            'status'    => $status,
            'result'    => 'success'
        );

        die(json_encode($result));
    }

    public function return_item_list_ajax() {
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $body       = '';
        $type       = $this->input->post('type');

        $user       = $this->auth->user();
        $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
        if(!empty($worker)) {
            $this->returned_items_model->where('worker_id',$worker->worker_id);
        }
        $student    = $this->students_model->find_by('user_id',$user->id);
        if(!empty($student)) {
            $this->returned_items_model->where('student_id',$student->student_id);
        }

        $this->returned_items_model->order_by('created_on', 'desc');
        switch($type) {
            case 'lacking':
                $items = $this->returned_items_model->find_all_by('status','lacking');
            break;
            case 'for approval':
                $items = $this->returned_items_model->find_all_by('status','for approval');
                break;
            case 'returned':
                $items = $this->returned_items_model->find_all_by('status','returned');
            break;
            default:
                $items = $this->returned_items_model->find_all();
            break;
        }

        if(!empty($items)) {
            foreach($items as $row) {
                $disabled = '';
                $item = $this->items_model->find($row->item_id);
                if($row->status == 'for approval' || $row->status == 'returned') {
                    $disabled = 'disabled';
                }
                $body .= '<tr>
                        <td>'.$row->id.'<input type="hidden" class="item-id" value="'.$row->id.'"></td>
                        <td>'.$item->name.'</td>
                        <td class="align-right">'.$item->quantity.'</td>
                        <td class="align-right">'.$row->quantity.'<input type="hidden" class="borrow-qty" value="'.$row->quantity.'"></td>
                        <td class="align-right"><span class="span-return-qty">'.$row->return_qty.'</span><input type="hidden" class="return-qty" value="'.$row->return_qty.'"></td>
                        <td>'.$row->due_date.'</td>
                        <td>'.$row->overdue_charge.'</td>
                        <td><span class="span-status">'.$row->status.'</span></td>
                        <td class="align-right">
                            <div class="input-append input-prepend">
                                <span class="add-on">Pieces</span>
                                <input class="align-right span5 return-qty" type="text" value="0" '.$disabled.'>
                                <button class="btn btn-success return-btn" type="button" '.$disabled.'>Return</button>
                            </div>
                        </td>
                    </tr>';
            }
        }
        else {
            $body .= '<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="align-right">&nbsp;</td>
                        <td class="align-right">&nbsp;</td>
                        <td class="align-right">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="align-right">&nbsp;</td>
                    </tr>';
        }

        die($body);
    }

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

	//--------------------------------------------------------------------
}//end class