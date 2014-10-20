<?php

class Analysis extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_file_model', 'user_file', TRUE);
		$this->load->helper('cookie');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}
	}

	function index()
	{

		$this->load->view('templates/header', array('title' => 'My Profile - '.$this->config->item('site_name')));
		if ($this->input->cookie('valid_user'))
		{
			//get the user's recent activities
			$recentActivities = $this->user_file->get_recent_activities($this->email);
			$this->load->view('my_analysis', array('recentActivities' => $recentActivities));
		}
		
		$this->load->view('templates/footer');
	}
}
?>