<?php

class Myaccount extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		//load the user model
	    $this->load->model('user_model', 'user', TRUE);
		if ($this->input->cookie('valid_user'))
		{
			$this->email = $this->input->cookie('valid_user', false);
			$this->user_image = $this->user->get_user_image($this->email);
		}

		$this->form_validation->set_rules('set_autofill', 'Autofill', 'required');
		$this->form_validation->set_rules('set_data_cutoff', 'Data Cutoff', 'required');
		$this->form_validation->set_rules('my_firstname', 'First name', 'alpha');
		$this->form_validation->set_rules('my_lastname', 'Last name', 'alpha');
		$this->form_validation->set_rules('my_age', 'Firstname', 'integer|max_length[3]|less_than[120]');
		$this->form_validation->set_rules('my_weight', 'Weight Kg', 'integer|max_length[3]|less_than[150]');
		$this->form_validation->set_rules('my_mhr', 'Max Heart Rate', 'integer|max_length[3]|less_than[220]');
		$this->form_validation->set_rules('my_thr', 'Threshold Heart Rate', 'integer|max_length[3]|less_than[220]');
		$this->form_validation->set_rules('my_rhr', 'Resting Heart Rate', 'integer|max_length[3]|less_than[120]');
		$this->form_validation->set_rules('my_ftp', 'Functional Threshold Power', 'integer|max_length[3]|less_than[600]');
		$this->form_validation->set_rules('my_vo2', 'VO2 Max', 'integer|max_length[2]|less_than[70]');
		$this->form_validation->set_rules('my_location', 'Location', 'alpha|max_length[4]');



		if ($this->form_validation->run() == FALSE)
		{
			
			$this->load->view('templates/header', array('title' => 'My Account - '.$this->config->item('site_name'), 'user_image' => $this->user_image));
			$this->load->view('my_account', $this->user->getsettings($this->email));
			$this->load->view('templates/footer');
		}
		else
		{
			//update the settings
			if($this->user->updatesettings($this->email))
			{
				//update the settings cookies (these are retrieved by go for use in app)
				$settings = $this->user->getsettings($this->email);


				$cookie = array(
				    'name'   => 'set_autofill',
				    'value'  => $settings['set_autofill'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_gender',
				    'value'  => $settings['my_gender'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'set_data_cutoff',
				    'value'  => $settings['set_data_cutoff'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_mhr',
				    'value'  => $settings['my_mhr'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_rhr',
				    'value'  => $settings['my_rhr'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_vo2',
				    'value'  => $settings['my_vo2'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_weight',
				    'value'  => $settings['my_weight'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_thr',
				    'value'  => $settings['my_thr'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_ftp',
				    'value'  => $settings['my_ftp'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'my_age',
				    'value'  => $settings['my_age'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);


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