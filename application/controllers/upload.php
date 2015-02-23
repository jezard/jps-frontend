<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('upload');
		$this->load->helper('cookie');
		$this->load->model('user_model', 'user', TRUE);
		$this->load->model('user_activity_model', 'user_activity', TRUE);
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
		$data = $this->user_activity->get_spent_num($this->email);
		$user_image = $this->user->get_user_image($this->email);
		$settings = $this->user->getsettings($this->email);
		$data['paid_account'] = $settings['paid_account'];

		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name'), 'user_image' => $user_image));
		//if user has remaining credits
		if($data['balance'] > 0)
		{
			$this->load->view('upload_form', array($data, 'message' => '<span class="note">You have <strong>'.$data['balance'].'</strong> upload credits remaining. </span><br>Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
		}
		//or is a subscriber
		elseif($settings['paid_account'] > 0)
		{
			$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
		}
		else
		{
			$data['message'] = 'Get unlimited uploads and unlock addtional Premium features for just &pound;3.99 billed monthly';
			$this->load->view('go_premium', $data);
		}



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
			$this->load->view('upload_form', array('message' => 'Failed. Please upload only .fit or .tcx files, or try uploading fewer files:'));
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
