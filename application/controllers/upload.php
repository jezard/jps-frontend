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
		$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
		$this->load->view('templates/footer');
	}

	//upload files, converting .fit to .tcx, and store record of upload in database
	function do_upload()
	{
		$this->upload->initialize(array(
			'upload_path' => './uploads/',
			'allowed_types' => 'tcx|fit|gpx',
			'max_size'	=> 5000,
			'remove_spaces' => TRUE,
			'overwrite' => TRUE
		));


		if (! $this->upload->do_multi_upload("powerfiles",md5($this->email))) {
       		$error = array('error' => $this->upload->display_errors());
       		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name')));
			$this->load->view('upload_form', array('message' => 'Failed due to incorrect filetype. Please upload only .fit or .tcx files.'));
			$this->load->view('templates/footer');
       	}

		else
		{
			$data = $this->upload->get_multi_upload_data();
			//print_r($data);
			$this->load->model('user_file_model', 'user_file', TRUE);
			$this->user_file->linkuser($this->email, $data);
			$this->load->view('templates/header', array('title' => 'Upload Success - '.$this->config->item('site_name')));
       		$this->load->view('upload_success', array('fileinfo' => $data));
       		$this->load->view('templates/footer');
		}
	
	}
}
?>
