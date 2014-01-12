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
        $this->load->model('items/items_model', null, true);
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
        Assets::add_js('codeigniter-csrf.js');
        Assets::add_css(array(Template::theme_url('css/docs.css')));
        Assets::add_css(array(Template::theme_url('css/index.css')));
        Assets::add_js(Template::theme_url('js/index.js'), 'external', true);

		if (!$this->installer_lib->is_installed())
		{
			redirect( site_url('install') );
		}

		$this->set_current_user();
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
        $data['name']               = $this->input->post('items_name');
        $data['description']        = $this->input->post('items_description');
        $data['specifications']     = $this->input->post('items_specifications');
        $data['quantity']           = $this->input->post('items_quantity');
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

    public function item_list_ajax() {
        $body   = '';
        $page   = $this->input->post('page');
        $page   = $page-2 < 0 ? 0 : (($page+10)-2);
        $this->items_model->offset($page);
        $this->items_model->limit(10);
        $items  = $this->items_model->find_all();
        //die($this->db->last_query());

        $count  = count($items) / 5;
        if($count < 2) {
            $body .= '<div class="pbox-row">';
            for($x=0;$x<count($items);$x++) {
                if($items[$x]->photo == '')
                    $path = Template::theme_url('images/default.png');
                else
                    $path = '/userfiles/item-'.$items[$x]->id.'/photos/'.$items[$x]->photo;

                $body .= '<div class="pbox">
                                <div>
                                    <img src="'.$path.'" class="img-polaroid">
                                </div>
                                <div class="item-name" thisid="'.$items[$x]->id.'">'.$items[$x]->name.'</div>
                                <div>
                                    <span>Quantity:</span> <span class="actual-quantity">'.$items[$x]->quantity.'</span>
                                </div>
                                <div>
                                    <a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>
                                </div>
                            </div>';
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

                    $body .= '<div class="pbox">
                                <div>
                                    <img src="'.$path.'" class="img-polaroid">
                                </div>
                                <div class="item-name" thisid="'.$items[$y+$num]->id.'">'.$items[$y+$num]->name.'</div>
                                <div>
                                    <span>Quantity:</span> <span class="actual-quantity">'.$items[$y+$num]->quantity.'</span>
                                </div>
                                <div>
                                    <a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$y+$num]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>
                                </div>
                            </div>';
                }
                $body .= '</div>';
            }
        }

        $body = $this->make_pagination($body);
        die($body);
    }

    private function make_pagination($body = '',$page = 0) {
        $pages = '';
        if($page == 0) {
            $this->items_model->offset($page);
            $items  = $this->items_model->find_all();
            $count  = count($items) / 10;
            $ex = explode('.',$count);
            if($ex[1] != '')
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
        $this->load->model('returned_items/returned_items_model', null, true);
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
                    'quantity'  => $item->quantity - $items[$x]['qty'],
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $items[$x]['id']);
                $this->db->update('bf_items', $data);

                $data = array(
                    'worker_id' => $worker->worker_id,
                    'item_id'   => $items[$x]['id'],
                    'quantity'  => $items[$x]['qty'],
                    'staus'     => 'lacking',
                    'created_on'    => date('Y-m-d H:i:s'),
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);
            }
            else if($is_student) {
                $data = array(
                    'quantity'  => $item->quantity - $items[$x]['qty'],
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->where('id', $items[$x]['id']);
                $this->db->update('bf_items', $data);

                $data = array(
                    'student_id'    => $student->student_id,
                    'item_id'       => $items[$x]['id'],
                    'quantity'      => $items[$x]['qty'],
                    'staus'         => 'lacking',
                    'created_on'    => date('Y-m-d H:i:s'),
                    'modified_on'   => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);
            }
        }

        die(json_encode('success'));
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