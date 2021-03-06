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
        Assets::add_css(array(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.css')));
        Assets::add_js('codeigniter-csrf.js');
        Assets::add_js(Template::theme_url('js/jquery-ui-1.8.13.min.js'), 'external', true);
        Assets::add_js(Template::theme_url('js/jNotify-master/jquery/jNotify.jquery.js'), 'external', true);
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

    public function item_list_ajax() {
        $user   = $this->auth->user();
        $body   = '';
        $page   = $this->input->post('page');
        $type   = $this->input->post('type');
        $search = $this->input->post('search');
        $search = trim($search);

        $page   = $page-2 < 0 ? 0 : (($page+10)-2);
        $this->items_model->offset($page);
        $this->items_model->limit(10);

        if($search != '')
            $this->items_model->like('name',$search,'both');

        $this->items_model->where('category',$type);

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
                            if($type == 'apparatus') {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Borrow
                                    </a>';
                            }
                            else {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>';
                            }
                        }
                        else {
                            $button = '';
                        }

                        if($type == 'apparatus') {
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
                            if($type == 'apparatus') {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Borrow
                                    </a>';
                            }
                            else {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$x]->id.'">
                                        <i class="icon-shopping-cart icon-white"></i> Add to cart
                                    </a>';
                            }

                        }
                        else {
                            $button = '';
                        }

                        if($type == 'apparatus') {
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
                            if($type == 'apparatus') {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$y+$num]->id.'">
                                            <i class="icon-shopping-cart icon-white"></i> Borrow
                                        </a>';
                            }
                            else {
                                $button = '<a class="btn btn-success borrow-item" href="javascript:void(0);" id="product-item-'.$items[$y+$num]->id.'">
                                            <i class="icon-shopping-cart icon-white"></i> Add to cart
                                        </a>';
                            }

                        }
                        else {
                            $button = '';
                        }

                        if($type == 'apparatus') {
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
        $type       = $this->input->post('type');
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
                    'status'            => 'approved',
                    'id_number'         => $worker->id_number,
                    'created_on'        => date('Y-m-d H:i:s'),
                    'modified_on'       => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);

                $desc = $type == 'apparatus' ? 'A Lab-Incharge borrowed an item' : 'A Lab-Incharge purchased a chemical/s';

                $data = array(
                    'user_id'       => 1,
                    'role_user'     => 'admin',
                    'description'   => $desc,
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
                    'status'            => 'approved',
                    'id_number'         => $student->id_number,
                    'created_on'        => date('Y-m-d H:i:s'),
                    'modified_on'       => date('Y-m-d H:i:s')
                );
                $this->db->insert('bf_returned_items', $data);

                $desc = $type == 'apparatus' ? 'A Student borrowed an item' : 'A Student purchased a chemical/s';

                $data = array(
                    'user_id'       => 1,
                    'role_user'     => 'admin',
                    'description'   => $desc,
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
	//--------------------------------------------------------------------
}//end class