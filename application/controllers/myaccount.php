<?php

class Myaccount extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		//load the user model
	    $this->load->model('user_model', 'user', TRUE);
	    $this->load->model('standard_rides_model', 'standard_rides', TRUE);
		if (get_user()!="")
		{
			$this->email = get_user();
			$this->user_image = $this->user->get_user_image($this->email);
		}
		else
		{
			redirect('/login', 'refresh');
		}

		$this->form_validation->set_rules('set_autofill', 'Autofill', 'required');
		$this->form_validation->set_rules('set_data_cutoff', 'Data Cutoff', 'required');
		$this->form_validation->set_rules('set_ncp_rolloff', 'NCP Roll off', 'required');
		$this->form_validation->set_rules('my_firstname', 'First name', 'alpha_dash|max_length[50]|required');
		$this->form_validation->set_rules('my_lastname', 'Last name', 'alpha_dash|max_length[50]|required');
		$this->form_validation->set_rules('my_age', 'Age', 'integer|max_length[3]|less_than[120]|required');
		$this->form_validation->set_rules('my_weight', 'Weight Kg', 'integer|max_length[3]|less_than[150]|required');
		$this->form_validation->set_rules('my_mhr', 'Max Heart Rate', 'integer|max_length[3]|less_than[220]|required');
		$this->form_validation->set_rules('my_thr', 'Threshold Heart Rate', 'integer|max_length[3]|less_than[220]|required');
		$this->form_validation->set_rules('my_rhr', 'Resting Heart Rate', 'integer|max_length[3]|less_than[120]|required');
		$this->form_validation->set_rules('my_ftp', 'Functional Threshold Power', 'integer|max_length[3]|less_than[600]|required');
		$this->form_validation->set_rules('my_vo2', 'VO2 Max', 'integer|max_length[2]|less_than[70]|required');
		$this->form_validation->set_rules('my_location', 'Location', 'alpha|max_length[4]|required');

		


		if ($this->form_validation->run() == FALSE)
		{
			$data = $this->user->getsettings($this->email);
			if($this->input->server('REQUEST_METHOD') == 'POST'){
				$data = array_merge($data, array('validated'=>'no'));
			}
			
			$this->load->view('templates/header', array('title' => 'My Account - '.$this->config->item('site_name'), 'user_image' => $this->user_image));
			$this->load->view('my_account', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			//update the settings
			if($this->user->updatesettings($this->email))
			{
				//update the settings cookies (these are retrieved by go for use in app)
				$settings = $this->user->getsettings($this->email);

				$data =  array('ride_label' => $_POST['ride_label'], 'in_or_out' => $_POST['in_or_out'], 'race_or_train' => $_POST['race_or_train']);
				$this->standard_rides->set($this->email, $data);

				if($this->input->cookie('remember') == '1'){
					$expire = (10 * 365 * 24 * 60 * 60);
				}else{
					$expire = -100;
				}


    			$this->load->view('templates/header', array('title' => 'Settings saved! - '.$this->config->item('site_name'), 'user_image' => $this->user_image));
				$this->load->view('my_account', $settings);
				$this->load->view('templates/footer');
			}
			//on database error
			else
			{
				$this->load->view('templates/header', array('title' => 'Database error - '.$this->config->item('site_name'), 'user_image' => $this->user_image));
				$this->load->view('my_account');
				$this->load->view('templates/footer');
			}
		}

	}
}
?>