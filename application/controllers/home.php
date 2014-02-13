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
class Home extends CI_Controller
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

	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('installer_lib');
        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/index.css')));
        Assets::add_js(Template::theme_url('js/index.js'), 'external', true);

        Assets::add_css(array(Template::theme_url('js/jquery.bxslider/jquery.bxslider.css')));
        Assets::add_js(Template::theme_url('js/jquery.bxslider/jquery.bxslider.js'), 'external', true);

		if (!$this->installer_lib->is_installed())
		{
			redirect( site_url('install') );
		}

		$this->set_current_user();
        if(!empty($this->current_user)) {
            if($this->current_user->role_desc == '') {
                $items = $this->items_model->find_all();
                Template::set('items',$items);
                Template::set_view('home/admin-index');
            }
            else {
                Template::set_view('home/index');
            }
        }
        else {
            Template::set_view('home/index');
        }

		Template::render();
	}//end index()

	//--------------------------------------------------------------------


    public function add_item() {
        $this->auth->restrict('Items.Resources.Create');

        if (isset($_POST['save']))
        {
            if ($insert_id = $this->save_items())
            {
                if ($this->input->post('file')) {
                    if( $_FILES['file']['name'] != "" ) {

                        $item_id = $insert_id;
                        $item = $this->items_model->find($item_id);
                        $filename = $_FILES['file']['name'];
                        $path = '/userfiles/item-'.$item_id.'/photos';

                        if($item) {
                            $recent = $item->photo;
                            if($recent != '') {
                                if(file_exists(SERVERPATH.'/'.$path.'/thumbnail/'.$recent))
                                    unlink(SERVERPATH.'/'.$path.'/thumbnail/'.$recent);
                                if(file_exists(SERVERPATH.'/'.$path.'/'.$recent))
                                    unlink(SERVERPATH.'/'.$path.'/'.$recent);
                            }

                            $tempFile = $_FILES['file']['tmp_name'];
                            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $path;
                            $targetFile = rtrim($targetPath,'/') . '/' . $_FILES['file']['name'];

                            $fileParts = pathinfo($_FILES['file']['name']);

                            if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id)) {
                                mkdir($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id, 0777, true);
                            }
                            if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id.'/photos')) {
                                mkdir($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id.'/photos', 0777, true);
                            }
                            if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id.'/photos/thumbnails')) {
                                mkdir($_SERVER['DOCUMENT_ROOT'].'/userfiles/item-'.$item_id.'/photos/thumbnails', 0777, true);
                            }

                            // Validate the file type
                            $fileTypes = array('JPG','JPEG','GIF','PNG','TIF'); // File extensions

                            if (in_array(strtoupper($fileParts['extension']),$fileTypes)) {
                                move_uploaded_file($tempFile,$targetFile);
                            } else {
                                return false;
                            }


                        }
                        $success = $this->items_model->update($insert_id, array('photo' => $filename));

                        $result = array(
                            'result' => $success,
                        );
                    }
                }

                // Log the activity
                log_activity($this->current_user->id, lang('items_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'items');
                Template::set_message(lang('items_create_success'), 'success');
                redirect('/');
            }
            else
            {
                Template::set_message(lang('items_create_failure') . $this->items_model->error, 'error');
            }
        }

        $this->set_current_user();
        Template::set_view('home/add-item');
        Template::render();
    }

    private function save_items($type='insert')
    {
        // make sure we only pass in the fields we want

        $data = array();
        $data['category']           = $this->input->post('items_category');
        $data['name']               = $this->input->post('items_name');
        $data['description']        = $this->input->post('items_description');
        $data['specifications']     = $this->input->post('items_specifications');
        $data['quantity']           = $this->input->post('items_quantity');
        $data['price']              = $this->input->post('items_price');
        $data['unit_of_measure']    = $this->input->post('items_unit_of_measure');
        $data['status']             = $this->input->post('items_status');

        if ($type == 'insert')
        {
            $id = $this->items_model->insert($data);

            if (is_numeric($id))
            {
                $return = $id;
            }
            else
            {
                $return = FALSE;
            }
        }

        return $return;
    }

    public function return_item() {
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

    public function item_list_ajax() {
        $user   = $this->auth->user();
        $body   = '';
        $page   = $this->input->post('page');
        $search = $this->input->post('search');
        $search = trim($search);

        $page   = $page-2 < 0 ? 0 : (($page+10)-2);
        $this->items_model->offset($page);
        $this->items_model->limit(10);

        if($search != '')
            $this->items_model->like('name',$search,'both');

        $items  = $this->items_model->find_all();

        if(!empty($items)) {
            $count  = count($items) / 5;
            if($count < 2) {
                $body .= '<div class="pbox-row">';
                for($x=0;$x<5;$x++) {
                    if(isset($items[$x]) && !empty($items[$x])) {
                        if($items[$x]->photo == '')
                            $path = Template::theme_url('images/default.png');
                        else
                            $path = '/userfiles/item-'.$items[$x]->id.'/photos/'.$items[$x]->photo;

                        if(isset($user->role_id) && $user->role_id != 1) {
                            $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>';
                        }
                        else {
                            $button = '';
                        }

                        if($items[$x]->category == 'apparatus') {
                            $category = '<span>Quantity:</span> <span class="actual-quantity" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->quantity.'</span>';
                        }
                        else {
                            $category = '<span>Price:</span> <span class="actual-quantity" actual-unit="'.$items[$x]->unit_of_measure.'" actual-price="'.$items[$x]->price.'" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->price.' - '.$items[$x]->quantity.$items[$x]->unit_of_measure.'</span>';
                        }

                        $body .= '<div class="pbox">
                                    <div>
                                        <img src="'.$path.'" class="img-polaroid">
                                    </div>
                                    <div class="item-name" thisid="'.$items[$x]->id.'">'.$items[$x]->name.'</div>
                                    <div>
                                        '.$category.'
                                    </div>
                                    <div>
                                        '.$button.'
                                    </div>
                                </div>';
                    }
                }
                $body .= '</div>';

                $body .= '<div class="pbox-row">';
                for($x=5;$x<10;$x++) {
                    if(isset($items[$x]) && !empty($items[$x])) {
                        if($items[$x]->photo == '')
                            $path = Template::theme_url('images/default.png');
                        else
                            $path = '/userfiles/item-'.$items[$x]->id.'/photos/'.$items[$x]->photo;

                        if(isset($user->role_id) && $user->role_id != 1) {
                            $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>';
                        }
                        else {
                            $button = '';
                        }

                        if($items[$x]->category == 'apparatus') {
                            $category = '<span>Quantity:</span> <span class="actual-quantity" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->quantity.'</span>';
                        }
                        else {
                            $category = '<span>Price:</span> <span class="actual-quantity" actual-unit="'.$items[$x]->unit_of_measure.'" actual-price="'.$items[$x]->price.'" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->price.' - '.$items[$x]->quantity.$items[$x]->unit_of_measure.'</span>';
                        }

                        $body .= '<div class="pbox">
                                    <div>
                                        <img src="'.$path.'" class="img-polaroid">
                                    </div>
                                    <div class="item-name" thisid="'.$items[$x]->id.'">'.$items[$x]->name.'</div>
                                    <div>
                                        '.$category.'
                                    </div>
                                    <div>
                                        '.$button.'
                                    </div>
                                </div>';
                    }
                }

                $body .= '</div>';
            }
            else if($count == 2) {
                for($x=0;$x<$count;$x++) {
                    $body .= '<div class="pbox-row">';
                    for($y=0;$y<5;$y++) {
                        $num = $x * 5;
                        if($items[$y+$num]->photo == '')
                            $path = Template::theme_url('images/default.png');
                        else
                            $path = '/userfiles/item-'.$items[$y+$num]->id.'/photos/'.$items[$y+$num]->photo;

                        if(isset($user->role_id) && $user->role_id != 1) {
                            $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$y+$num]->id.'">
                                            <i class="icon-shopping-cart icon-white"></i> Add to cart
                                        </a>';
                        }
                        else {
                            $button = '';
                        }

                        if($items[$x]->category == 'apparatus') {
                            $category = '<span>Quantity:</span> <span class="actual-quantity" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->quantity.'</span>';
                        }
                        else {
                            $category = '<span>Price:</span> <span class="actual-quantity" actual-unit="'.$items[$x]->unit_of_measure.'" actual-price="'.$items[$x]->price.'" actual-qty="'.$items[$x]->quantity.'">'.$items[$x]->price.' - '.$items[$x]->quantity.$items[$x]->unit_of_measure.'</span>';
                        }

                        $body .= '<div class="pbox">
                                    <div>
                                        <img src="'.$path.'" class="img-polaroid">
                                    </div>
                                    <div class="item-name" thisid="'.$items[$y+$num]->id.'">'.$items[$y+$num]->name.'</div>
                                    <div>
                                        '.$category.'
                                    </div>
                                    <div>
                                        '.$button.'
                                    </div>
                                </div>';
                    }
                    $body .= '</div>';
                }
            }

            $body = $this->make_pagination($body,0,$search);
        }

        die($body);
    }

    private function make_pagination($body = '',$page = 0,$search = '') {
        $pages = '';
        if($page == 0) {
            $this->items_model->offset($page);

            if($search != '') {
                $this->items_model->like('name',$search,'both');
            }
            $items  = $this->items_model->find_all();
            $count  = count($items) / 10;
            $ex = explode('.',$count);
            if(isset($ex[1]) != '')
                $count = $ex[0] + 1;

            if($count > 3) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="1">Prev</a></li>';
                for($x=0; $x<3; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x+1).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="3">Next</a></li>';
            }
            else {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="1">Prev</a></li>';


                for($x=0; $x<$count; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x+1).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.$count.'">Next</a></li>';
            }
        }
        else if($page > 0){
            $this->items_model->offset($page);
            $items  = $this->items_model->find_all();

            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page-1).'">Prev</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page-1).'">'.($page-1).'</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page).'">'.($page).'</a></li>';

            $this->items_model->offset($page+1);
            $items  = $this->items_model->find_all();
            if(count($items) > 0) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page+1).'">'.($page+1).'</a></li>';
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page+1).'">Next</a></li>';
            }
        }
        $pagination = '<div class="pagination">
                        <ul>
                        '.$pages.'
                        </ul>
                    </div>';
        $body .= $pagination;

        return $body;
    }

    public function items_checkout_ajax() {
        $confirm_code = substr(md5(uniqid(rand(), true)), 16, 16);
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $is_worker  = false;
        $is_student = false;
        $user       = $this->auth->user();
        $items      = $this->input->post('items');

        $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
        if(!empty($worker))
            $is_worker = true;
        $student    = $this->students_model->find_by('user_id',$user->id);
        if(!empty($student))
            $is_student = true;

        for($x=0; $x<count($items); $x++) {
            $item = $this->items_model->find($items[$x]['id']);

            if($is_worker) {
                $data = array(
                    'worker_id'         => $worker->worker_id,
                    'item_id'           => $items[$x]['id'],
                    'quantity'          => $items[$x]['qty'],
                    'status'            => 'pending',
                    'id_number'         => $worker->id_number,
                    'created_on'        => date('Y-m-d H:i:s'),
                    'modified_on'       => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);

                $data = array(
                    'user_id'       => 1,
                    'role_user'     => 'admin',
                    'description'   => 'A Lab-Incharge borrowed an item',
                    'page'          => site_url().'admin/logs/returned_items/edit/'.$this->db->insert_id(),
                    'seen'          => 'No',
                    'created_on'    => date('Y-m-d H:i:s'),
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_notifications', $data);
            }
            else if($is_student) {
                $data = array(
                    'student_id'        => $student->student_id,
                    'item_id'           => $items[$x]['id'],
                    'quantity'          => $items[$x]['qty'],
                    'status'            => 'pending',
                    'id_number'         => $student->id_number,
                    'created_on'        => date('Y-m-d H:i:s'),
                    'modified_on'       => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);

                $data = array(
                    'user_id'       => 1,
                    'role_user'     => 'admin',
                    'description'   => 'Student borrowed an item',
                    'page'          => site_url().'admin/logs/returned_items/edit/'.$this->db->insert_id(),
                    'seen'          => 'No',
                    'created_on'    => date('Y-m-d H:i:s'),
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_notifications', $data);
            }
        }

        $array = array(
            'code'      => '',
            'result'    => 'success'
        );
        die(json_encode($array));
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

    public function transactions() {
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $user       = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc != '') {
            $page     = $this->input->post('page-num');
            $page_num = $page;
            if($page_num == '' || $page_num == 0)
                $page_num = 0;
            else
                $page_num = 5 * $page_num;

            $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
            if(!empty($worker)) {
                $this->db->where('worker_id',$worker->worker_id);
            }
            $student    = $this->students_model->find_by('user_id',$user->id);
            if(!empty($student)) {
                $this->db->where('student_id',$student->student_id);
            }

            $this->db->group_by(array("id_number","created_on"));
            $this->db->order_by("created_on", "desc");
            $this->db->limit(5, $page_num);

            $transactions = $this->returned_items_model->find_all();

            if(!empty($transactions)) {
                foreach($transactions as $row) {
                    $time = strtotime($row->created_on);
                    $row->date_string = date("F d, Y",$time);
                }
            }

            Assets::add_css(array(Template::theme_url('css/transactions.css')));
            Assets::add_js(Template::theme_url('js/transactions.js'), 'external', true);
            $this->set_current_user();
            Template::set('transactions',$transactions);
            Template::set('pages',$this->transactions_pagination($page));
            Template::set_view('home/transactions');
        }
        else {
            Assets::add_css(array(Template::theme_url('css/transactions-admin.css')));
            Assets::add_js(Template::theme_url('js/transactions-admin.js'), 'external', true);
            $this->set_current_user();
            Template::set_view('home/transactions-admin');
        }


        Template::render();
    }

    private function transactions_pagination($page = 0) {
        $body = '';
        $pages = '';
        if($page == 0) {
            $this->db->limit(5, 0);

            $user       = $this->auth->user();
            $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
            if(!empty($worker)) {
                $this->db->where('worker_id',$worker->worker_id);
            }
            $student    = $this->students_model->find_by('user_id',$user->id);
            if(!empty($student)) {
                $this->db->where('student_id',$student->student_id);
            }

            $this->db->group_by(array("id_number","created_on"));
            $this->db->order_by("created_on", "desc");

            $items = $this->returned_items_model->find_all();
            $count  = count($items) / 5;
            $ex = explode('.',$count);
            if(isset($ex[1]) != '')
                $count = $ex[0] + 1;

            if($count > 5) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="0">Prev</a></li>';
                for($x=0; $x<3; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="2">Next</a></li>';
            }
            else {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="0">Prev</a></li>';
                for($x=0; $x<$count; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.$count.'">Next</a></li>';
            }
        }
        else if($page > 0){
            $user       = $this->auth->user();
            $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
            if(!empty($worker)) {
                $this->db->where('worker_id',$worker->worker_id);
            }
            $student    = $this->students_model->find_by('user_id',$user->id);
            if(!empty($student)) {
                $this->db->where('student_id',$student->student_id);
            }

            $no     = $page;
            $page   = 5 * $page;

            $this->db->limit(5, $page);
            $this->db->group_by(array("id_number","created_on"));
            $this->db->order_by("created_on", "desc");

            $items = $this->returned_items_model->find_all();
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($no-1).'">Prev</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($no-1).'">'.($no).'</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($no).'">'.($no+1).'</a></li>';


            $user       = $this->auth->user();
            $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
            if(!empty($worker)) {
                $this->db->where('worker_id',$worker->worker_id);
            }
            $student    = $this->students_model->find_by('user_id',$user->id);
            if(!empty($student)) {
                $this->db->where('student_id',$student->student_id);
            }

            $this->db->limit(5, $page + 5);
            $this->db->group_by(array("id_number","created_on"));
            $this->db->order_by("created_on", "desc");
            $items = $this->returned_items_model->find_all();
            if(!empty($items) && count($items) > 0) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($no+1).'">'.($no+2).'</a></li>';
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($no+1).'">Next</a></li>';
            }
        }
        $pagination = '<div class="pagination text-right">
                        <ul>
                        '.$pages.'
                        </ul>
                    </div>';
        $body .= $pagination;

        return $body;
    }

    public function generate_table_ajax() {
        $body = '';
        $date = $this->input->post('date');
        $status = $this->input->post('status');
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $user       = $this->auth->user();
        $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
        if(!empty($worker)) {
            $this->db->where('worker_id',$worker->worker_id);
        }
        $student    = $this->students_model->find_by('user_id',$user->id);
        if(!empty($student)) {
            $this->db->where('student_id',$student->student_id);
        }

        $this->db->where('created_on',$date);
        $this->db->where('status',$status);
        $items = $this->returned_items_model->find_all();


        switch($status) {
            case 'pending':
                $body .= '<table class="table table-bordered table-pending">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    $body .= '<tr>
                    <td>'.$item->name.'</td>
                    <td class="text-right">'.$row->quantity.'</td>
                    </tr>';
                }

                $body .= '</tbody></table>';
            break;
            case 'lacking':
                $body .= '<table class="table table-bordered table-lacking">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Returned Quantity</th>
                        <th>Lacking Quantity</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    $body .= '<tr>
                    <td>'.$item->name.'</td>
                    <td class="text-right">'.$row->quantity.'</td>
                    <td class="text-right">'.$row->return_qty.'</td>
                    <td class="text-right">'.($row->quantity - $row->return_qty).'</td>
                    </tr>';
                }
                $body .= '</tbody></table>';

                break;
            case 'borrowed':
                $total = 0;
                $body .= '<table class="table table-bordered table-borrowed">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Charge</th>
                            </tr>
                            </thead>
                            <tbody>';

                            foreach($items as $row) {
                                $item = $this->items_model->find($row->item_id);
                                $body .= '<tr>
                                            <td>'.$item->name.'</td>
                                            <td class="text-right">'.$row->quantity.'</td>
                                            <td>'.$row->created_on.'</td>
                                            <td>'.$row->due_date.'</td>
                                            <td class="text-right">'.$row->overdue_charge.'</td>
                                        </tr>';
                                $total = $total + $row->overdue_charge;
                            }
                            $body .= '<tr>
                                        <td><strong>TOTAL</strong></td>
                                        <td colspan="4" class="text-right"><strong>'.$total.'</strong></td>
                                            </tr>
                                            </tbody>
                                        </table>';
            break;
            case 'returned':
                $total1 = 0;
                $total2 = 0;
                $body .= '<table class="table table-bordered table-returned">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Item Status</th>
                                <th>Damage Charge</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Charge</th>
                            </tr>
                            </thead>
                            <tbody>';

                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    $name = isset($item->name) ? $item->name : '';
                    $body .= '<tr>
                                <td>'.$name.'</td>
                                <td class="text-right">'.$row->quantity.'</td>
                                <td>'.$row->item_status.'</td>
                                <td class="text-right">'.$row->damage_charge.'</td>
                                <td>'.$row->created_on.'</td>
                                <td>'.$row->due_date.'</td>
                                <td class="text-right">'.$row->overdue_charge.'</td>
                            </tr>';
                    $total1 = $total1 + $row->damage_charge;
                    $total2 = $total2 + $row->overdue_charge;
                };


                $body .= '<tr>
                                <td><strong>TOTAL</strong></td>
                                <td colspan="3" class="text-right"><strong>'.$total1.'</strong></td>
                                <td colspan="3" class="text-right"><strong>'.$total2.'</strong></td>
                                </tr>
                                </tbody>
                            </table>';
                break;
        }

        die($body);
    }

    public function transaction_list_ajax() {
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $body       = '';
        $type       = $this->input->post('type');
        $page       = $this->input->post('page');
        $search     = $this->input->post('search');
        $user       = $this->auth->user();

        $this->db->group_by(array("id_number","created_on"));
        $this->db->order_by("created_on", "desc");

        if($search != '') {
            $this->db->like("id_number", $search,"both");
        }

        $this->db->limit(10, $page * 10);


        switch($type) {
            case 'pending':
                $transactions = $this->returned_items_model->find_all_by('status','pending');
                break;
            case 'approved':
                $transactions = $this->returned_items_model->find_all_by('status','approved');
                break;
            case 'borrowed':
                $transactions = $this->returned_items_model->find_all_by('status','borrowed');
                break;
            case 'lacking':
                $transactions = $this->returned_items_model->find_all_by('status','lacking');
                break;
            case 'returned':
                $transactions = $this->returned_items_model->find_all_by('status','returned');
                break;
            case 'all':
                $transactions = $this->returned_items_model->find_all();
                break;
        }

        $body = '<table class="table table-bordered" id="transactions-table">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="dynamic-tbody">';

        if(!empty($transactions)) {
            foreach($transactions as $row) {
                $time = strtotime($row->created_on);
                $row->date_string = date("F d, Y",$time);

                $worker     = $this->lab_incharge_model->find($row->worker_id);
                if(!empty($worker)) {
                    $theuser = $worker->firstname.' '.$worker->lastname;
                    $therole = 'Lab Incharge';
                }
                $student    = $this->students_model->find($row->student_id);
                if(!empty($student)) {
                    $theuser = $student->firstname.' '.$student->lastname;
                    $therole = 'Student';
                }

                $body .= '<tr>
                        <td><a href="javascript:void(0);" class="date-link" value="'.$row->created_on.'" thisidnumber="'.$row->id_number.'" thisstatus="'.$row->status.'" thiscode="'.$row->confirmation_code.'">'.$row->date_string.'</a></td>
                        <td>'.$theuser.'</td>
                        <td>'.$therole.'</td>
                        <td>'.$row->status.'</td>
                    </tr>';
            }
        }
        else {
            $body .= '<tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>';
        }
        $body .= '</tbody>
                </table>';

        $body .= $this->make_transaction_pagination($page,$type);

        die($body);
    }

    public function inner_table_ajax() {
        $sum    = 0;
        $total  = 0;
        $body   = '';
        $code   = $this->input->post('idnum');
        $date   = $this->input->post('date');
        $status = $this->input->post('status');
        $this->load->model('lab_incharge/lab_incharge_model', null, true);
        $this->load->model('students/students_model', null, true);

        $user       = $this->auth->user();
        $worker     = $this->lab_incharge_model->find_by('user_id',$user->id);
        if(!empty($worker)) {
            $this->db->where('worker_id',$worker->worker_id);
        }
        $student    = $this->students_model->find_by('user_id',$user->id);
        if(!empty($student)) {
            $this->db->where('student_id',$student->student_id);
        }

        $this->returned_items_model->where('id_number',$code);
        $this->returned_items_model->where('created_on',$date);
        $this->returned_items_model->where('status',$status);
        $items = $this->returned_items_model->find_all();

        switch($status) {
            case 'pending':
                $body .= '<h3>Details</h3><table class="table table-bordered table-pending">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    if($item->category == 'chemical')
                        $unit = ' x 10'.$item->unit_of_measure;
                    else
                        $unit = '';

                    $body .= '<tr>
                    <td>'.$item->name.'</td>
                    <td class="text-right">'.$row->quantity.$unit.'</td>
                    </tr>';
                }

                $body .= '<tr><td colspan="2" style="text-align:right;"><button type="button" class="btn btn-success btn-pending" thisidnumber='.$code.' thisstatus='.$status.' thisdate='.$date.'>Approve</button></td></tr></tbody></table>';
                break;
            case 'approved':
                $body .= '<h3>Details</h3><table class="table table-bordered table-approved">
                    <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>';
                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    if($item->category == 'chemical') {
                        $unit = ' x 10'.$item->unit_of_measure;
                        $sum = $row->quantity * $item->price;
                        $total += $sum;
                    }
                    else {
                        $unit = '';
                    }

                    $body .= '<tr>
                    <td>'.$item->name.'</td>
                    <td class="text-right">'.$row->quantity.$unit.'</td>
                    <td class="text-right">'.$item->price.'</td>
                    <td class="text-right">'.$sum.'</td>
                    </tr>';
                }

                $body .= '<tr>
                                <td colspan="3">
                                    <strong>Total:</strong>
                                </td>
                                <td class="text-right">
                                    <span class="overall-sum">'.$total.'</span>
                                </td>
                          </tr>
                          <tr>
                            <td colspan="4" style="text-align:right;">
                                <div class="input-prepend">
                                  <span class="add-on"><i class="icon-calendar"></i></span>
                                  <input class="span2 date-borrowed datepicker" id="date-borrowed" type="text" placeholder="Date Borrowed" value="">
                                </div>
                                <input class="span2 due-date" id="due-date" type="text" placeholder="Due Date" value="" disabled>
                                <button style="margin-bottom: 11px;" type="button" class="btn btn-success btn-approved" thisidnumber='.$code.' thisstatus='.$status.' thisdate='.$date.'>Borrow</button>
                            </td>
                          </tr>
                          </tbody>
                          </table>';
                break;
            case 'borrowed':
                $total = 0;
                $body .= '<h3>Details</h3><table class="table table-bordered table-borrowed">
                            <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Item</th>
                                <th>Item Status</th>
                                <th>Damage Charge</th>
                                <th>Quantity</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Date Return</th>
                                <th>Charge</th>
                            </tr>
                            </thead>
                            <tbody>';

                foreach($items as $row) {
                    if($row->status == 'borrowed') {
                        $text = '';
                        $lack = $this->db->get_where('bf_returned_items_lacking', array('returned_items_id' => $row->id));

                        $item = $this->items_model->find($row->item_id);
                        $datetime1 = strtotime($row->due_date);
                        $datetime2 = strtotime(date('Y-m-d'));

                        $secs = $datetime2 - $datetime1;
                        $days = $secs / 86400;
                        $sum  = $item->penalty * $days;
                        $sum  = $sum < 0 ? 0 : $sum;

                        if ($lack->num_rows() > 0)
                        {
                            foreach ($lack->result() as $detail)
                            {
                                $text = '<td class="text-right">
                                        <a class="lacking-details" href="javascript:void(0);" thisid="'.$detail->id.'">'.$item->name.'</a>
                                    </td>';
                            }
                        }
                        else {
                            $text = '<td>'.$item->name.'</td>';
                        }

                        $body .= '<tr>
                                    <td><input type="checkbox" class="check-item"></td>
                                    '.$text.'
                                    <td><select class="item-status" thisitemvalue="'.$row->item_id.'" thisitemcharge="'.$item->damage_charge.'"><option value="ok">OK</option><option value="broken">Broken</option></select></td>
                                    <td class="text-right"><span class="item-damage-charge"></span></td>
                                    <td>
                                        <input class="span1 return-qty" id="return-qty" type="text" value="'.($row->quantity - $row->return_qty).'" thisid="'.$row->id.'">
                                        <input class="hidden-quantity" type="hidden" value="'.$row->quantity.'" thisid="'.$row->id.'">
                                        <input class="hidden-return-qty" type="hidden" value="'.$row->return_qty.'" thisid="'.$row->id.'">
                                    </td>
                                    <td>'.$row->date_borrowed.'</td>
                                    <td>'.$row->due_date.'</td>
                                    <td>
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                                            <input class="span1 date-return" id="date-return" type="text" placeholder="Date Return" value="'.date('Y-m-d').'">
                                        </div>
                                    </td>
                                    <td class="text-right"><span class="penalty" id="penalty-'.$row->id.'">'.$sum.'</span></td>
                                </tr>';
                        $total = $total + $sum;
                    }
                }
                $body .= '<tr>
                            <td>&nbsp;</td>
                            <td colspan="3" class="text-right"><span class="total-item-damage-charge">&nbsp;</span></td>
                            <td colspan="5" class="text-right"><strong><span class="total-sum">'.$total.'</span></strong></td>
                          </tr>
                          <tr>
                            <td><strong>TOTAL</strong></td>
                            <td colspan="8" class="text-right"><strong><span class="overall-sum">'.$total.'</span></strong></td>
                          </tr>
                          <tr>
                            <td colspan="9" class="text-right">
                                <button type="button" class="btn btn-success btn-returned" thisidnumber='.$code.' thisstatus='.$status.' thisdate='.$date.'>Return</button>
                            </td>
                          </tr>
                          </tbody>
                          </table>';
                break;
            case 'lacking':
                $total = 0;
                $body .= '<h3>Details</h3><table class="table table-bordered table-lacking">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>No. of Returned Items</th>
                                <th>No. of Remaining Items</th>
                                <th>Remaining Qty</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Charge</th>
                            </tr>
                            </thead>
                            <tbody>';

                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);
                    $datetime1 = strtotime($row->due_date);
                    $datetime2 = strtotime(date('Y-m-d'));

                    $secs = $datetime2 - $datetime1;
                    $days = $secs / 86400;
                    $sum  = $item->penalty * $days;
                    $sum  = $sum < 0 ? 0 : $sum;

                    $body .= '<tr>
                                    <td>'.$item->name.'</td>
                                    <td class="text-right">'.$row->quantity.'</td>
                                    <td class="text-right">'.$row->return_qty.'</td>
                                    <td class="text-right">'.($row->quantity - $row->return_qty).'</td>
                                    <td class="text-right"><input class="span2 return-qty" id="return-qty" type="text" value="'.($row->quantity - $row->return_qty).'" thisid="'.$row->id.'"></td>
                                    <td>'.$row->date_borrowed.'</td>
                                    <td>'.$row->due_date.'</td>
                                    <td class="text-right"><span class="penalty" id="penalty-'.$row->id.'">'.$sum.'</span></td>
                                </tr>';
                    $total = $total + $sum;
                }
                $body .= '<tr>
                            <td><strong>TOTAL</strong></td>
                            <td colspan="7" class="text-right"><strong>'.$total.'</strong></td>
                          </tr>
                          <tr>
                            <td colspan="8" class="text-right">
                                <button type="button" class="btn btn-success btn-returned" thisidnumber='.$code.' thisstatus='.$status.' thisdate='.$date.'>Return</button>
                            </td>
                          </tr>
                          </tbody>
                          </table>';
                break;
            case 'returned':
                $total1 = 0;
                $total2 = 0;
                $body .= '<h3>Details</h3><table class="table table-bordered table-returned">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Item Status</th>
                                <th>Damage Charge</th>
                                <th>Date Borrowed</th>
                                <th>Due Date</th>
                                <th>Charge</th>
                            </tr>
                            </thead>
                            <tbody>';

                foreach($items as $row) {
                    if($row->status == 'returned') {
                        $item = $this->items_model->find($row->item_id);
                        $name = isset($item->name) ? $item->name : '';
                        $body .= '<tr>
                                <td>'.$name.'</td>
                                <td class="text-right">'.$row->quantity.'</td>
                                <td>'.$row->item_status.'</td>
                                <td class="text-right">'.$row->damage_charge.'</td>
                                <td>'.$row->created_on.'</td>
                                <td>'.$row->due_date.'</td>
                                <td class="text-right">'.$row->overdue_charge.'</td>
                            </tr>';
                        $total1 = $total1 + $row->damage_charge;
                        $total2 = $total2 + $row->overdue_charge;
                    }
                };


                $body .= '<tr>
                            <td><strong>TOTAL</strong></td>
                            <td colspan="3" class="text-right"><strong>'.$total1.'</strong></td>
                            <td colspan="3" class="text-right"><strong>'.$total2.'</strong></td>
                            </tr>
                            </tbody>
                        </table>';
                break;
        }

        die($body);
    }

    public function change_status_ajax() {
        $code = $this->input->post('code');
        $date = $this->input->post('date');
        $status = $this->input->post('status');

        switch($status) {
            case 'pending':
                $data = array(
                    'status' => 'approved'
                );

                $this->db->where('id_number', $code);
                $this->db->where('created_on', $date);
                $this->db->where('status', $status);
                $this->db->update('bf_returned_items', $data);
            break;
            case 'approved':
                $message    = '';
                $continue   = true;

                $this->returned_items_model->where('id_number', $code);
                $this->returned_items_model->where('created_on', $date);
                $this->returned_items_model->where('status', $status);
                $items = $this->returned_items_model->find_all();
                foreach($items as $row) {
                    $item = $this->items_model->find($row->item_id);

                    if($item->category == 'apparatus') {
                        if($item->quantity < $row->quantity) {
                            if($row->worker_id != null && $row->worker_id != 0) {
                                $user_id = $row->worker_id;
                                $role = 'labincharge';
                            }
                            else {
                                $user_id = $row->student_id;
                                $role = 'student';
                            }
                            $data = array(
                                'user_id'       => $user_id,
                                'role_user'     => $role,
                                'description'   => 'BORROW REJECTED: '.$item->name.' quantity is short of '.abs($item->quantity - $row->quantity),
                                'page'          => '',
                                'details'       => '[ID:'.$row->id.'] [DATE:'.$row->created_on.']',
                                'seen'          => 'No',
                                'created_on'    => date('Y-m-d H:i:s'),
                                'modified_on'   => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('bf_notifications', $data);

                            $continue = false;
                        }
                    }
                    else if($item->category == 'chemical') {
                        if($item->quantity < ($row->quantity * 10)) {
                            if($row->worker_id != null && $row->worker_id != 0) {
                                $user_id = $row->worker_id;
                                $role = 'labincharge';
                            }
                            else {
                                $user_id = $row->student_id;
                                $role = 'student';
                            }
                            $data = array(
                                'user_id'       => $user_id,
                                'role_user'     => $role,
                                'description'   => 'BORROW REJECTED: '.$item->name.' quantity is short of '.abs($item->quantity - $row->quantity),
                                'page'          => '',
                                'details'       => '[ID:'.$row->id.'] [DATE:'.$row->created_on.']',
                                'seen'          => 'No',
                                'created_on'    => date('Y-m-d H:i:s'),
                                'modified_on'   => date('Y-m-d H:i:s')
                            );
                            $this->db->insert('bf_notifications', $data);

                            $continue = false;
                        }
                    }
                }

                if($continue) {
                    $date_borrowed  = $this->input->post('date_borrowed');
                    $due_date       = $this->input->post('due_date');
                    $overall        = $this->input->post('overall');

                    $data = array(
                        'status'        => 'borrowed',
                        'date_borrowed' => $date_borrowed,
                        'due_date'      => $due_date,
                    );

                    $this->db->where('id_number', $code);
                    $this->db->where('created_on', $date);
                    $this->db->where('status', $status);
                    $this->db->update('bf_returned_items', $data);

                    $this->returned_items_model->where('id_number', $code);
                    $this->returned_items_model->where('created_on', $date);
                    $this->returned_items_model->where('status', 'borrowed');
                    $items = $this->returned_items_model->find_all();
                    foreach($items as $row) {
                        $item = $this->items_model->find($row->item_id);
                        if($item->category == 'apparatus') {
                            $data = array(
                                'quantity'  => $item->quantity - $row->quantity
                            );
                        }
                        else if($item->category == 'chemical') {
                            $data = array(
                                'quantity'  => $item->quantity - ($row->quantity * 10)
                            );
                        }

                        $this->db->where('id',$row->item_id);
                        $this->db->update('bf_items', $data);

                        if($row->worker_id != null && $row->worker_id != 0) {
                            $user_id = $row->worker_id;
                            $role = 'labincharge';
                        }
                        else {
                            $user_id = $row->student_id;
                            $role = 'student';
                        }

                        $message .= $item->name.',';
                    }



                    $message = 'ITEMS: '.trim($message,',').' are available for pick-up. If DONE, ignore this message.';
                    $data = array(
                        'user_id'       => $user_id,
                        'role_user'     => $role,
                        'description'   => $message,
                        'page'          => '',
                        'details'       => '[ID:'.$row->id.'] [DATE:'.$row->created_on.'] [TOTAL:'.$overall.']',
                        'seen'          => 'No',
                        'created_on'    => date('Y-m-d H:i:s'),
                        'modified_on'   => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('bf_notifications', $data);
                }
                else {
                    die('low quantity');
                }
            break;
            case 'borrowed':
                $items      = $this->input->post('items');
                $overall    = $this->input->post('overall');

                for($x=0; $x<count($items); $x++) {
                    $ret  = $this->returned_items_model->find($items[$x]['id']);

                    if(($items[$x]['qty'] + $ret->return_qty) != $ret->quantity) {
                        // LACKING QUANTITY

                        // INSERT INTO returned_items_lacking table
                        $data = array(
                            'returned_items_id' => $items[$x]['id'],
                            'quantity'          => $items[$x]['qty'],
                            'date_returned'     => $items[$x]['date_return'],
                            'created_on'        => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('bf_returned_items_lacking', $data);

                        // UPDATE the return_qty
                        $data = array(
                            'overdue_charge'    => $items[$x]['penalty'],
                            'return_qty'        => $items[$x]['qty']
                        );
                        $this->db->where('id', $items[$x]['id']);
                        $this->db->update('bf_returned_items', $data);

                        // ADD UP the quantity to the item's quantity
                        $ret  = $this->returned_items_model->find($items[$x]['id']);
                        $item = $this->items_model->find($ret->item_id);
                        if($item->category == 'apparatus') {
                            $data = array(
                                'quantity'  => $item->quantity + $items[$x]['qty']
                            );
                        }
                        else if($item->category == 'chemical') {
                            $data = array(
                                'quantity'  => $item->quantity + ($items[$x]['qty'] * 10)
                            );
                        }

                        $this->db->where('id',$ret->item_id);
                        $this->db->update('bf_items', $data);


                    }
                    else {
                        // FULL RETURN QUANTITY
                        $data = array(
                            'overdue_charge'    => $items[$x]['penalty'],
                            'return_qty'        => $items[$x]['qty']
                        );
                        $this->db->where('id', $items[$x]['id']);
                        $this->db->update('bf_returned_items', $data);

                        $ret  = $this->returned_items_model->find($items[$x]['id']);
                        $item = $this->items_model->find($ret->item_id);
                        if($item->category == 'apparatus') {
                            $data = array(
                                'quantity'  => $item->quantity + $items[$x]['qty']
                            );
                        }
                        else if($item->category == 'chemical') {
                            $data = array(
                                'quantity'  => $item->quantity + ($items[$x]['qty'] * 10)
                            );
                        }

                        $this->db->where('id',$ret->item_id);
                        $this->db->update('bf_items', $data);

                        $data = array(
                            'status' => 'returned'
                        );

                        $this->db->where('id', $items[$x]['id']);
                        $this->db->update('bf_returned_items', $data);
                    }

                    if($ret->worker_id != null && $ret->worker_id != 0) {
                        $user_id = $ret->worker_id;
                        $role = 'labincharge';
                    }
                    else {
                        $user_id = $ret->student_id;
                        $role = 'student';
                    }
                    $ret_id         = $ret->id;
                    $ret_created_on = $ret->created_on;
                }

                if($overall > 0) {
                    $data = array(
                        'user_id'       => $user_id,
                        'role_user'     => $role,
                        'description'   => 'You have a PENALTY CHARGE to pay!',
                        'page'          => '',
                        'details'       => '[ID:'.$ret_id.'] [DATE:'.$ret_created_on.'] [TOTAL:'.$overall.']',
                        'seen'          => 'No',
                        'created_on'    => date('Y-m-d H:i:s'),
                        'modified_on'   => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('bf_notifications', $data);
                }

            break;
        }

        die('success');
    }

    private function make_transaction_pagination($page = 0,$status = '') {
        $pages = '';

        $this->db->group_by(array("id_number","created_on"));
        $this->db->order_by("created_on", "desc");

        if($page == 0) {
            $this->returned_items_model->offset($page);

            switch($status) {
                case 'pending':
                    $items = $this->returned_items_model->find_all_by('status','pending');
                    break;
                case 'approved':
                    $items = $this->returned_items_model->find_all_by('status','approved');
                    break;
                case 'borrowed':
                    $items = $this->returned_items_model->find_all_by('status','borrowed');
                    break;
                case 'lacking':
                    $items = $this->returned_items_model->find_all_by('status','lacking');
                    break;
                case 'returned':
                    $items = $this->returned_items_model->find_all_by('status','returned');
                    break;
                case 'all':
                    $items = $this->returned_items_model->find_all();
                    break;
            }

            $count  = count($items) / 10;
            $ex = explode('.',$count);
            if(isset($ex[1]) != '')
                $count = $ex[0] + 1;

            if($count > 3) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="0">Prev</a></li>';
                for($x=0; $x<3; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="2">Next</a></li>';
            }
            else {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="0">Prev</a></li>';
                for($x=0; $x<$count; $x++) {
                    $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($x).'">'.($x+1).'</a></li>';
                }
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($count-1).'">Next</a></li>';
            }
        }
        else if($page > 0){
            $this->returned_items_model->offset($page);

            switch($status) {
                case 'pending':
                    $items = $this->returned_items_model->find_all_by('status','pending');
                    break;
                case 'approved':
                    $items = $this->returned_items_model->find_all_by('status','approved');
                    break;
                case 'borrowed':
                    $items = $this->returned_items_model->find_all_by('status','borrowed');
                    break;
                case 'lacking':
                    $items = $this->returned_items_model->find_all_by('status','lacking');
                    break;
                case 'returned':
                    $items = $this->returned_items_model->find_all_by('status','returned');
                    break;
                case 'all':
                    $items = $this->returned_items_model->find_all();
                    break;
            }

            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page-1).'">Prev</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page-1).'">'.($page-1).'</a></li>';
            $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page).'">'.($page).'</a></li>';

            $this->returned_items_model->offset(10,$page+1);

            switch($status) {
                case 'pending':
                    $items = $this->returned_items_model->find_all_by('status','pending');
                    break;
                case 'approved':
                    $items = $this->returned_items_model->find_all_by('status','approved');
                    break;
                case 'borrowed':
                    $items = $this->returned_items_model->find_all_by('status','borrowed');
                    break;
                case 'lacking':
                    $items = $this->returned_items_model->find_all_by('status','lacking');
                    break;
                case 'returned':
                    $items = $this->returned_items_model->find_all_by('status','returned');
                    break;
                case 'all':
                    $items = $this->returned_items_model->find_all();
                    break;
            }

            if(!empty($items)) {
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page+1).'">'.($page+1).'</a></li>';
                $pages .= '<li><a class="page-link" href="javascript:void(0);" pageno="'.($page+1).'">Next</a></li>';
            }
        }
        $pagination = '<div class="pagination">
                        <ul>
                        '.$pages.'
                        </ul>
                    </div>';
        $body = $pagination;

        return $body;
    }

    public function notifications() {
        $this->set_current_user();

        if($this->current_user->role_desc == '') {
            $id = $this->current_user->id;
            $role = 'admin';
            Template::set_view('home/notifications');
        }
        else {
            $worker     = $this->lab_incharge_model->find_by('user_id',$this->current_user->id);
            if(!empty($worker)) {
                $id = $worker->user_id;
                $role = 'labincharge';
            }
            $student    = $this->students_model->find_by('user_id',$this->current_user->id);
            if(!empty($student)) {
                $id = $student->user_id;
                $role = 'student';
            }
            Template::set_view('home/notifications_user');
        }

        $this->notifications_model->update_where('seen', 'No', array('seen' => 'Yes','user_id' => $id, 'role_user' => $role));

        $this->notifications_model->limit(20);
        $this->notifications_model->order_by('created_on', 'desc');
        $this->notifications_model->where('user_id', $id);
        $this->notifications_model->where('role_user', $role);
        $rows = $this->notifications_model->find_all();

        Template::set('rows',$rows);
        Template::render();
    }

    public function get_notifications() {
        $this->set_current_user();

        if(empty($this->current_user))
            return false;

        if($this->current_user->role_desc == '') {
            $id = $this->current_user->id;
            $role = 'admin';
        }
        else {
            $worker     = $this->lab_incharge_model->find_by('user_id',$this->current_user->id);
            if(!empty($worker)) {
                $id = $worker->worker_id;
                $role = 'labincharge';
            }
            $student    = $this->students_model->find_by('user_id',$this->current_user->id);
            if(!empty($student)) {
                $id = $student->student_id;
                $role = 'student';
            }
        }

        $this->notifications_model->where('user_id',$id);
        $this->notifications_model->where('role_user',$role);
        $rows = $this->notifications_model->count_by('seen','No');

        $array = array('count' => $rows);
        die(json_encode($array));
    }

    public function reports() {
        $rows = '';
        $this->set_current_user();
        $mode       = $this->input->post('mode');
        $category   = $this->input->post('category');

        if($mode == 'daily') {
            $rows = $this->db->query("SELECT i.`name` AS 'name',
                                SUM(i.`quantity`) AS 'quantity',
                                SUM(r.`quantity`) AS 'borrowed_quantity',
                                SUM(r.`return_qty`) AS 'returned_quantity',
                                SUM(r.`quantity`) * 10 AS 'total_quantity',
                                SUM(r.`return_qty`) * i.price AS 'total_cost',
                                unit_of_measure
                                FROM bf_returned_items r
                                INNER JOIN bf_items i ON i.id = r.`item_id`
                                WHERE r.created_on >= CURDATE()
                                AND r.created_on <= CURDATE()
                                AND category = '".$category."'
                                GROUP BY r.`item_id`
                                ORDER BY borrowed_quantity DESC");
        }
        else if($mode == 'weekly') {
            $rows = $this->db->query("SELECT i.`name` AS 'name',
                                SUM(i.`quantity`) AS 'quantity',
                                SUM(r.`quantity`) AS 'borrowed_quantity',
                                SUM(r.`return_qty`) AS 'returned_quantity',
                                SUM(r.`quantity`) * 10 AS 'total_quantity',
                                SUM(r.`return_qty`) * i.price AS 'total_cost',
                                unit_of_measure
                                FROM bf_returned_items r
                                INNER JOIN bf_items i ON i.id = r.`item_id`
                                WHERE r.created_on >= ADDDATE(CURDATE(), INTERVAL 1-DAYOFWEEK(CURDATE()) DAY)
                                AND r.created_on <= ADDDATE(CURDATE(), INTERVAL 7-DAYOFWEEK(CURDATE()) DAY)
                                AND category = '".$category."'
                                GROUP BY r.`item_id`
                                ORDER BY borrowed_quantity DESC");
        }
        else if($mode == 'monthly') {
            $rows = $this->db->query("SELECT i.`name` AS 'name',
                                SUM(i.`quantity`) AS 'quantity',
                                SUM(r.`quantity`) AS 'borrowed_quantity',
                                SUM(r.`return_qty`) AS 'returned_quantity',
                                SUM(r.`quantity`) * 10 AS 'total_quantity',
                                SUM(r.`return_qty`) * i.price AS 'total_cost',
                                unit_of_measure
                                FROM bf_returned_items r
                                INNER JOIN bf_items i ON i.id = r.`item_id`
                                WHERE r.created_on >= DATE_FORMAT(CURDATE(), '%Y-%m-01')
                                AND r.created_on <= LAST_DAY(CURDATE())
                                AND category = '".$category."'
                                GROUP BY r.`item_id`
                                ORDER BY borrowed_quantity DESC");
        }


        Assets::add_js(Template::theme_url('js/reports.js'), 'external', true);
        Template::set('rows',$rows);
        Template::set('mode',$mode);
        Template::set('category',$category);
        Template::set_view('home/reports');
        Template::render();
    }

    public function lacking_details() {
        $body   = '';
        $id     = $this->input->post('id');
        $lack   = $this->db->get_where('bf_returned_items_lacking', array('id' => $id));

        $body .= '<tr class="sub-detail"><td>&nbsp;</td><td colspan="8">';

        $body .= '<h4>Returned Quantity:</h4><table class="table table-bordered table-lacking">
                    <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Date Returned</th>
                    </tr>
                    </thead>
                    <tbody>';

        if ($lack->num_rows() > 0)
        {
            foreach ($lack->result() as $detail)
            {
                $body .= '<tr>
                                <td>'.$detail->quantity.'</td>
                                <td>'.$detail->date_returned.'</td>
                          </tr>';
            }
        }

        $body .= '</tbody></table></td></tr>';

        die($body);
    }

	//--------------------------------------------------------------------
}//end class