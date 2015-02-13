<?php

class Signout extends CI_Controller {

	function index()
	{
		$this->load->helper('cookie');

		delete_cookie('valid_user', $this->config->item('site_name'),'/', '');
		delete_cookie('social_user', $this->config->item('site_name'),'/', '');

		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}
?>