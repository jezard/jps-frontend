<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->helper('cookie');
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
		}
	}

	function index()
	{
		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name')));
		$this->load->view('upload_form', array('error' => ' ' ));
		$this->load->view('templates/footer');
	}

	function do_upload()
	{
		$this->upload->initialize(array(
			'upload_path' => './uploads/',
			'allowed_types' => 'tcx|pwx|fit|gpx',
			'max_size'	=> 5000,
			'remove_spaces' => TRUE,
			'overwrite' => TRUE
		));


		if (! $this->upload->do_multi_upload("powerfiles",md5($this->email))) {
       		$error = array('error' => $this->upload->display_errors());
       		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name')));
			$this->load->view('upload_form', $error);
			$this->load->view('templates/footer');
       	}

		else
		{
			$this->load->model('user_file_model', 'user_file', TRUE);
			$this->user_file->linkuser($this->email);
			$data = $this->upload->get_multi_upload_data();
			$this->load->view('templates/header', array('title' => 'Upload Success - '.$this->config->item('site_name')));
       		$this->load->view('upload_success', $data);
       		$this->load->view('templates/footer');
		}
	
	}
}
?>
