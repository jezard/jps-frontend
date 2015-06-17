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
		if (get_user() != "")
		{
			$this->email = get_user();
			if((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443){
				redirect('http://joulepersecond.com/upload', 'refresh');
			}

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
		if($settings['user_set']==0){//user hasn't saved their first run settings
			redirect('https://joulepersecond.com/myaccount', 'refresh');
			return;
		}
		$data['paid_account'] = $settings['paid_account'];
		$data['user_id'] = $settings['user_id'];

		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name'), 'user_image' => $user_image));
		//if user has remaining credits or is a subscriber 
		if($settings['paid_account'] > 0 || $data['balance'] > 0)
		{
			$this->load->view('upload_form', array('message' => 'Upload your .fit or .tcx files below (we recommend uploading in smaller batches):'));
		}
		else
		{
			$data['message'] = 'You have run out of upload credits (20 allocated per rolling 28 day basis). Get unlimited uploads and unlock addtional Premium features for just <strong>&pound;4.99</strong>, billed monthly, or try uploading tomorrow';
			$this->load->view('go_premium', $data);
		}



		$this->load->view('templates/footer');
	}

	//upload files, converting .fit to .tcx, and store record of upload in database
	function do_upload()
	{
		$user_image = $this->user->get_user_image($this->email);
		
		//limit uploads for free users
		$settings = $this->user->getsettings($this->email);
		if($settings['paid_account'] == 0){
			$data = $this->user_activity->get_spent_num($this->email);
		}

		$this->upload->initialize(array(
			'max_num' =>  (isset($data['balance']) ?  $data['balance'] : 0),
			'upload_path' => './uploads/',
			'allowed_types' => 'tcx|fit|gpx',
			'max_size'	=> 50000,
			'remove_spaces' => TRUE,
			'overwrite' => TRUE
		));


		if (! $this->upload->do_multi_upload("powerfiles",md5($this->email))) {
       		$error = array('error' => $this->upload->display_errors());
       		$this->load->view('templates/header', array('title' => 'Upload - '.$this->config->item('site_name'), 'user_image' => $user_image));
			$this->load->view('upload_form', array('message' => '<span class="note"><strong>Upload Failed</strong>: Please upload only .fit or .tcx files, or try uploading fewer files</span><br>'.implode(", ", $error)));
			$this->load->view('templates/footer');
       	}

		else
		{
			$data = $this->upload->get_multi_upload_data();
			//print_r($data);
			$this->load->model('user_file_model', 'user_file', TRUE);
			$this->user_file->linkuser($this->email, $data);
			$this->load->view('templates/header', array('title' => 'Upload Success - '.$this->config->item('site_name'), 'user_image' => $user_image));
       		$this->load->view('upload_success', array('fileinfo' => $data));
       		$this->load->view('templates/footer');
		}
	
	}
}
?>
