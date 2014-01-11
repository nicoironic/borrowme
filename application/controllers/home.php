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
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
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

		$this->load->library('users/auth');
		$this->set_current_user();

		Template::render();
	}//end index()

	//--------------------------------------------------------------------

    public function item_list_ajax() {
        $body = '';
        $this->items_model->offset(0);
        $this->items_model->limit(10);
        $items = $this->items_model->find_all();

        $count = count($items) / 5;
        if($count < 2) {
            $body = '<div class="pbox-row">';
            for($x=0;$x<count($items);$x++) {
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
            $body = '<div class="pbox-row">';
            for($x=0;$x<$count;$x++) {
                for($y=0;$y<5;$y++) {
                    $num = $x * 5;
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
            }
            $body .= '</div>';
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