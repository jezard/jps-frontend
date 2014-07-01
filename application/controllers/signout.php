<?php

class Signout extends CI_Controller {

	function index()
	{
		$this->load->helper('cookie');

		delete_cookie('ValidUser','joulepersecond.com','/', 'joulepersecond_');

		$this->load->helper('url');
		redirect('/', 'refresh');
	}

}
?>