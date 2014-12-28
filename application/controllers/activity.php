<?php

class Activity extends CI_Controller {
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

		//if updating activity
		if ( isset($_POST['activity_id']))
		{
			
			
		}
		//or for just a single page analysis
		else
		{
			
			if ($this->input->cookie('valid_user'))
			{

				//get the user's recent activities
				$recentActivities = $this->user_file->get_recent_activities($this->email);
				$this->load->view('activity', array('recentActivities' => $recentActivities));
			}
			
		}
		$this->load->view('templates/footer');		
	}

	function get(){
		//TODO get id from post/get and return and show in view
		$id = $this->input->post('activity_id');
		$activity_title = $this->user_file->get_activity_title($id);
		echo $activity_title;
	}

}
?>