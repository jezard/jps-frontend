<?php

class Activity extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_file_model', 'user_file', TRUE);
		$this->load->model('user_model', 'user', TRUE);
		$this->load->model('user_activity_model', 'user_activity', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if (get_user() != "")
		{
			$this->email = get_user();

			if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){
				redirect('http://joulepersecond.com/activity', 'refresh');
			}
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

		//determine if strava user
		$user_settings = $this->user->getSettings($this->email);
		if(!isset($user_settings['strava_access_token']) || $user_settings['strava_access_token'] == ''){
			$strava_user = false;
		}else{
			$strava_user = true;
		}

		$this->load->view('templates/header', array('title' => 'My Profile - '.$this->config->item('site_name'), 'user_image' => $user_image, 'strava_user' => $strava_user));

		$count = count($this->user_file->get_recent_activities($this->email));
			
		if ($count > 0 && get_user() != "")
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

			//check for strava upload flag
			if(isset($_POST['strava_upload'])){
				$poll_strava = true;
			}else{
				$poll_strava = false;
			}

			//if user is updating use id to show on load, else show the most recent activity
			if(isset($id)){
				$displayActivity = $id;
			}else{
				$displayActivity = @$recentActivities[0]['activity_id'];
			}

			$this->load->view('activity', array('recentActivities' => $recentActivities, 'displayActivity' => @$displayActivity, 'poll_strava' => $poll_strava));
		}else
			$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
			
		$this->load->view('templates/footer');		
	}
	function delete(){
		$activity_id = $this->input->post('activity_id');
		$filename = $this->user_file->get_filename_by_activity_id($activity_id);
		//$this->output->enable_profiler(TRUE);
		$this->user_activity->delete($activity_id, $this->email, $filename);
		redirect('/activity', 'location');
	}

	function get(){
		//TODO get id from post/get and return and show in view
		$id = $this->input->post('activity_id');
		$activity_info = $this->user_file->get_activity_basic($id);
		echo $activity_info;
	}

}
?>