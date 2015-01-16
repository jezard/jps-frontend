<?php

class Forum extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}

	}

	function index()
	{
		$validated = true;
		$this->load->view('templates/header', array('title' => 'JoulePerSecond Forum - '.$this->config->item('site_name')));

		$this->load->view('forum');

		$this->load->view('templates/footer');		
	}

}
?>