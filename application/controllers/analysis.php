<?php

class Analysis extends CI_Controller {

	function index()
	{
		$this->load->view('templates/header', array('title' => 'My Profile - JoulePerSecond'));
		$this->load->view('my_analysis');
		$this->load->view('templates/footer');
	}
}
?>