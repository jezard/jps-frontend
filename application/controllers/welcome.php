<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		if (get_user()!="")
		{
			$this->load->model('user_model', 'user', TRUE);
			$settings = $this->user->getsettings(get_user());
		}else{
			$settings = array();
		}

		$this->load->view('templates/header', array('title' => 'JoulePerSecond is an analytical fitness tool for Racing Cyclists.', 'user_image' => '/images/icons/default-bust.png'));
		$this->load->view('front_page', $settings);
		$this->load->view('templates/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */