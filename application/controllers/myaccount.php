<?php

class Myaccount extends CI_Controller {

	function index()
	{
		$this->load->view('templates/header', array('title' => 'My Account - JoulePerSecond'));
		$this->load->view('my_account');
		$this->load->view('templates/footer');
	}
}
?>