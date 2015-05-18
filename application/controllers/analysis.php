<?php

class Analysis extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		//load the user file model
		$this->load->model('user_file_model', 'user_file', TRUE);
		$this->load->model('user_model', 'user', TRUE);
		$this->load->helper('cookie');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		if (get_user() != "")
		{
			$this->email = get_user();
			if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){
				redirect('http://joulepersecond.com/analysis', 'refresh');
			}
		}
		else
		{
			redirect('/', 'refresh');
		}

	}

	function index()
	{
		$user_image = $this->user->get_user_image($this->email);
		$validated = true;
		$this->load->view('templates/header', array('title' => 'My Profile - '.$this->config->item('site_name'), 'user_image' => $user_image));
		$count = count($this->user_file->get_recent_activities($this->email));
		if ($count > 0)
			$this->load->view('analysis');
		else
			$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
		$this->load->view('templates/footer');		
	}

}
?>