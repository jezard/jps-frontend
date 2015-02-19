<?php

class Login extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->helper('cookie');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Login - '.$this->config->item('site_name')));
			$this->load->view('login_form');
			$this->load->view('templates/footer');
		}
		else
		{
			//load the user model
			$this->load->model('user_model', 'user', TRUE);

			//get the user's details
			$details = $this->user->validate();

			if($details)
			{
				/*need to add a cookie or other setting here*/
				$cookie = array(
				    'name'   => 'valid_user',
				    'value'  => $details[2],
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				$cookie = array(
				    'name'   => 'social_user',
				    'value'  => 'no',
				    'expire' => -100,
				    'domain' => $this->config->item('site_name'),
				    'prefix' => '',
				    'secure' => false
				);
				$this->input->set_cookie($cookie);

				//create the settings cookies
				$settings = $this->user->getsettings($details[2]);

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

				//go to the uploads page
				redirect('/upload', 'refresh');

			}
			else
			{
				$this->load->view('templates/header', array('message' => 'Incorrect login', 'title' => 'Login Incorrect - '.$this->config->item('site_name')));
				$this->load->view('login_form');
				$this->load->view('templates/footer');
			}
		}
	}
}
?>