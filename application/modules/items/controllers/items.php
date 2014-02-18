<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * items controller
 */
class items extends Front_Controller
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
        $this->lang->load('items');
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
	public function index()
	{

		$records = $this->items_model->find_all();

		Template::set('records', $records);
		Template::render();
	}

    public function add_item() {
        $this->auth->restrict('Items.Resources.Create');

        $this->set_current_user();
        $user = $this->auth->user();

        if(empty($user))
            redirect('/');

        if($user->role_desc != '')
            redirect('/');

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
        Template::set_view('items/add-item');
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