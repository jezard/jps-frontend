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
				//go to the uploads page
				redirect('/upload', 'refresh');

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