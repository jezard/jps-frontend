<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Privacypolicy extends CI_Controller {

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
		$this->load->view('templates/header', array('title' => 'Home - '.$this->config->item('site_name'), 'user_image' => '/images/icons/default-bust.png'));
		$this->load->view('privacy_policy');
		$this->load->view('templates/footer');
	}
}