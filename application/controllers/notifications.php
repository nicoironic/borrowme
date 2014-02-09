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
class Notifications extends CI_Controller
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

    public function index() {
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

	//--------------------------------------------------------------------
}//end class