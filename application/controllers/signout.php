<?php

class Signout extends CI_Controller {

	function index()
	{
		$this->load->helper('cookie');

		delete_cookie('valid_user', $this->config->item('site_name'),'/', '');
		delete_cookie('s_valid_user', $this->config->item('site_name'),'/', '');
		delete_cookie('social_user', $this->config->item('site_name'),'/', '');
		delete_cookie('paid_account', $this->config->item('site_name'),'/', '');
		delete_cookie('remember', $this->config->item('site_name'),'/', '');
		unset_user();

		

		$this->load->helper('url');
		redirect('/', 'refresh');
	}
}
?>