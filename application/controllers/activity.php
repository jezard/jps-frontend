<?php

class Activity extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_file_model', 'user_file', TRUE);
		$this->load->model('user_model', 'user', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}
		else
		{
			redirect('/login', 'refresh');
		}

	}

	function index()
	{
		$user_image = $this->user->get_user_image($this->email);
		$validated = true;
		$this->load->view('templates/header', array('title' => 'My Profile - '.$this->config->item('site_name'), 'user_image' => $user_image));

		$count = count($this->user_file->get_recent_activities($this->email));
			
		if ($count > 0 && $this->input->cookie('valid_user'))
		{
			//if updating activity
			if (isset($_POST['activity_id']))
			{
				$id = $_POST['activity_id'];
				$name = $_POST['activity_title'];
				$notes = $_POST['activity_notes'];
				$this->user_file->update_basic($id, $name, $notes);
			}
			//get the user's recent activities
			$recentActivities = $this->user_file->get_recent_activities($this->email);

			//if user is updating use id to show on load, else show the most recent activity
			if(isset($id)){
				$displayActivity = $id;
			}else{
				$displayActivity = @$recentActivities[0]['activity_id'];
			}

			$this->load->view('activity', array('recentActivities' => $recentActivities, 'displayActivity' => @$displayActivity));
		}else
			$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
			
		$this->load->view('templates/footer');		
	}

	function get(){
		//TODO get id from post/get and return and show in view
		$id = $this->input->post('activity_id');
		$activity_title = $this->user_file->get_activity_basic($id);
		echo $activity_title;
	}

}
?>