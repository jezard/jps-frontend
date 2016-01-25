<?php

class Signout extends CI_Controller {

	function index()
	{
		$this->load->helper('cookie');
		//CLEAR ALL COOKIES
		foreach ($_COOKIE as $key => $value)
		{
			delete_cookie($key, $this->config->item('site_name'),'/', '');
		}
		unset_user();

		$this->load->helper('url');
		redirect('/login', 'refresh');
	}
}
?>