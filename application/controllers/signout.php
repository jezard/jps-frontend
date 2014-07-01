<?php

class Signout extends CI_Controller {

	function index()
	{
		$this->load->helper('cookie');

		delete_cookie('ValidUser','joulepersecond.com','/', 'joulepersecond_');

		$this->load->view('templates/header', array('title' => 'Login - JoulePerSecond'));
		$this->load->view('front_page');
		$this->load->view('templates/footer');
	}

}
?>