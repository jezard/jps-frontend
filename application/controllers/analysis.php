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

		//if doing a historical search
		if ( isset($_POST['date-info']))
		{
			if($this->input->post('history') == 'range'){
				//validate the date fields
			    $dateStart = preg_split('/\//', $this->input->post('drange-start'));
			    $dateEnd = preg_split('/\//', $this->input->post('drange-end'));
			    if (!(@checkdate($dateStart[1], $dateStart[0], $dateStart[2]) && @checkdate($dateEnd[1], $dateEnd[0], $dateEnd[2]) && $dateStart[2] > 2000 && $dateEnd[2] > 2000)){
			    	//still get the user's recent activities, but show an error message too 
			    	$validated = false;
					$recentActivities = $this->user_file->get_recent_activities($this->email);
					$this->load->view('analysis', array('recentActivities' => $recentActivities, 'message' => 'Invalid dates. Please enter in the format dd/mm/yyyy'));
			    }
			    else
			    {
			    	//get the list of filtered activites
			    	$date_start = $dateStart[2].'-'.$dateStart[1].'-'.$dateStart[0];
					$date_end = $dateEnd[2].'-'.$dateEnd[1].'-'.$dateEnd[0];
			    	$activity_list = $this->user_file->get_older_activities_range($this->email, $date_start, $date_end);
			    }
			    
			}
			else{
				if($this->input->post('history') == 'week'){
					$activity_list = $this->user_file->get_older_activities_id($this->email, 7);
				}
				if($this->input->post('history') == 'month'){
					$activity_list = $this->user_file->get_older_activities_id($this->email, 28);
				}
				if($this->input->post('history') == 'year'){
					$activity_list = $this->user_file->get_older_activities_id($this->email, 357);
				}
			}
			if($validated){
				////TODO get the id's of all of the user's activities
				print_r($activity_list);
				//get the user's recent activities
				$recentActivities = $this->user_file->get_recent_activities($this->email);
				$this->load->view('analysis', array('recentActivities' => $recentActivities));
			}
			
		}
		//or for just a single page analysis
		else
		{
			
			if ($this->input->cookie('valid_user'))
			{
				////TODO get the id's of all of the user's activities

				//get the user's recent activities
				$recentActivities = $this->user_file->get_recent_activities($this->email);
				$this->load->view('analysis', array('recentActivities' => $recentActivities));
			}
			
		}
		$this->load->view('templates/footer');		
	}

}
?>