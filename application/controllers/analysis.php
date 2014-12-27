<?php

class Analysis extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_file_model', 'user_file', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}

	}

	function index()
	{
		$validated = true;
		$this->load->view('templates/header', array('title' => 'My Profile - '.$this->config->item('site_name')));
		$this->load->view('analysis');
		$this->load->view('templates/footer');		
	}

}
?>