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
		}

		$this->form_validation->set_rules('set_autofill', 'Autofill', 'required');
		$this->form_validation->set_rules('set_data_cutoff', 'Data Cutoff', 'required');
		$this->form_validation->set_rules('my_firstname', 'First name', 'alpha');
		$this->form_validation->set_rules('my_lastname', 'Last name', 'alpha');
		$this->form_validation->set_rules('my_age', 'Firstname', 'integer');
		$this->form_validation->set_rules('my_mhr', 'Max Heart Rate', 'integer');
		$this->form_validation->set_rules('my_thr', 'Threshold Heart Rate', 'integer');
		$this->form_validation->set_rules('my_ftp', 'Functional Threshold Power', 'integer');


		if ($this->form_validation->run() == FALSE)
		{

			$this->load->view('templates/header', array('title' => 'My Account - '.$this->config->item('site_name')));
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
				    'name'   => 'set_data_cutoff',
				    'value'  => $settings['set_data_cutoff'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

    			$this->load->view('templates/header', array('title' => 'Settings saved! - '.$this->config->item('site_name')));
				$this->load->view('my_account');
				$this->load->view('templates/footer');
			}
			//on database error
			else
			{
				$this->load->view('templates/header', array('title' => 'Database error - '.$this->config->item('site_name')));
				$this->load->view('my_account');
				$this->load->view('templates/footer');
			}
		}

	}
}
?>