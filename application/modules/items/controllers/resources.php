<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * resources controller
 */
class resources extends Admin_Controller
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

		$this->auth->restrict('Items.Resources.View');
		$this->load->model('items_model', null, true);
		$this->lang->load('items');
		
		Template::set_block('sub_nav', 'resources/_sub_nav');
        Assets::add_module_js('items', 'items.js');
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
					$result = $this->items_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('items_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('items_delete_failure') . $this->items_model->error, 'error');
				}
			}
		}

		$records = $this->items_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage Items');
        Template::set_view('resources/index');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a Items object.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->auth->restrict('Items.Resources.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_items())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('items_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'items');

				Template::set_message(lang('items_create_success'), 'success');
				redirect(SITE_AREA .'/resources/items');
			}
			else
			{
				Template::set_message(lang('items_create_failure') . $this->items_model->error, 'error');
			}
		}
		Assets::add_module_js('items', 'items.js');

		Template::set('toolbar_title', lang('items_create') . ' Items');
        Template::set_view('resources/edit');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of Items data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(5);

		if (empty($id))
		{
			Template::set_message(lang('items_invalid_id'), 'error');
			redirect(SITE_AREA .'/resources/items');
		}

        if ($this->input->post('file')) {
            if( $_FILES['file']['name'] != "" ) {

                $item_id = $id;
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
                $success = $this->items_model->update($id, array('photo' => $filename));

                $result = array(
                    'result' => $success,
                );
            }
        }

		if (isset($_POST['save']))
		{
			$this->auth->restrict('Items.Resources.Edit');

			if ($this->save_items('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('items_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'items');

				Template::set_message(lang('items_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('items_edit_failure') . $this->items_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			$this->auth->restrict('Items.Resources.Delete');

			if ($this->items_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('items_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'items');

				Template::set_message(lang('items_delete_success'), 'success');

				redirect(SITE_AREA .'/resources/items');
			}
			else
			{
				Template::set_message(lang('items_delete_failure') . $this->items_model->error, 'error');
			}
		}
		Template::set('items', $this->items_model->find($id));
		Template::set('toolbar_title', lang('items_edit') .' Items');
        Template::set_view('resources/edit');
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
	private function save_items($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['name']               = $this->input->post('items_name');
		$data['description']        = $this->input->post('items_description');
		$data['specifications']     = $this->input->post('items_specifications');
		$data['quantity']           = $this->input->post('items_quantity');
        $data['penalty']            = $this->input->post('items_penalty');
        $data['damage_charge']      = $this->input->post('items_damage_charge');
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
		elseif ($type == 'update')
		{
			$return = $this->items_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}