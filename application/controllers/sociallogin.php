<?php

class Sociallogin extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');


		if ($this->form_validation->run() == FALSE)
		{
			echo 'No email supplied';
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//get the user's details
			$details = $this->user->validateViaSocial();

			if($details)
			{


				//set the session var
				$is_social = true;
				set_user($details[2], $is_social, $details[3]);

				$cookie = array(
				    'name'   => 'social_user',
				    'value'  => 'yes',
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				//create the settings cookies
				$settings = $this->user->getsettings($details[2]);

				$cookie = array(
				    'name'   => 'paid_account',
				    'value'  => $settings['paid_account'],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				//go to the uploads page
				redirect('http://joulepersecond.com/upload', 'refresh');

			}
			else
			{
				$this->load->view('templates/header', array('title' => 'Login Incorrect - '.$this->config->item('site_name')));
				$this->load->view('login_form');
				$this->load->view('templates/footer');
			}
		}
	}
}
?>