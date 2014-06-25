<?php

class Login extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/header', array('title' => 'Login - JoulePerSecond'));
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
				$this->load->view('templates/header', array('title' => 'Welcome '.$details[1].' - JoulePerSecond'));
				$this->load->view('login_success');
				$this->load->view('templates/footer');
				/*need to add a cookie or other setting here*/
			}
			else
			{
				$this->load->view('templates/header', array('title' => 'Login Incorrect - JoulePerSecond'));
				$this->load->view('login_form');
				$this->load->view('templates/footer');
			}
		}
	}
}
?>